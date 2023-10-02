<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoctorDetail;
use App\Models\User;
use App\Models\Role;
use App\Models\Admin\Group;
use App\Models\Admin\Group_session;
use App\Models\Admin\GroupDoctorAssignment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\DoctorPostRequest;

use App\Http\Requests\DoctorPostUpdateRequest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data['page'] = 'admin.doctor.list';
        $data['js'] = ['doctor'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        if ($request->ajax()) {
            $data = User::with('doctorDetails')->whereIn('role_id', [3, 4])->orderBy('id', 'desc');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    static $count = 1;
                    return $count++;
                })


                ->addColumn('name', function ($row) {

                    $image = Storage::disk('public')->url('doctor/' . $row->image);
                    $name = '<div class="symbol-label">
                    <img src="' . $image . '" alt="No Image" class="w-50">
                </div>' . $row->first_name . ' ' . $row->last_name;
                    return $name;
                })

                ->filterColumn('name', function ($query, $keyword) {
                    $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$keyword}%"]);
                })

                ->addColumn('profession', function ($row) {

                    $name = $row->doctorDetails->profession;
                    return $name;
                })


                ->addColumn('action', function ($row) {

                    $cryptId = encrypt($row->id);

                    $edit_url = route('doctor.edit', $cryptId);
                    $delete_url = route('doctor.destroy', $cryptId);
                    $view = route('doctor.show', $cryptId);
                    $actionBtn = ' <div class="action-icon">
                    
                   
                  
                    <a class="" href="' . $edit_url . '" title="Edit"><i class="fa fa-edit"></i></a>
                    <a class="" href="javascript:;"   data-url="' . $delete_url . '"  id="delete_doctor" title="Delete"><i class="fas fa-trash"></i></a>
                    <a class="" href="' . $view . '"  title="view"><i class="fas fa-eye" title="View" ></i></a>
                    </div>
               ';
                    return $actionBtn;
                })
                ->addColumn('group_assignment', function ($row) {
                    $cryptId = encrypt($row->id);
                    $groupAssign = route('doctor.groupAssign', $cryptId);

                    return   '<a class="btn btn-light" href="' . $groupAssign . '"  role="button" >Assign</a>';
                })
                ->rawColumns(['number', 'name',  'profession', 'action', 'group_assignment'])

                ->make(true);
        }

        return view('admin.main_layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page'] = 'admin.doctor.add';
        $data['js'] = ['doctor'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['doctorType'] = Role::whereIn('id', [3, 4])->get();
        return view('admin.main_layout', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorPostRequest $request)
    {

        try {

            DB::beginTransaction();

            $image = $request->file('avatar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            Storage::disk('public')->putFileAs('doctor', $image, $imageName);

            $doctors = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'identity_number' => str_replace(' ', '', $request->identity_number),
                'role_id' => 3,
                'image' => $imageName,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => '1'
            ]);

            $doctor_id =  $doctors->id;

            $doctors = User::find($doctor_id);

            if (!empty($doctors)) {

                $contactDetail = new DoctorDetail;

                $contactDetail->doctor_id = $doctor_id;
                $contactDetail->date_of_birth =  $request->date_of_birth;
                $contactDetail->gender = $request->gender;
                $contactDetail->contact_number = $request->contact_number;
                $contactDetail->profession = $request->profession;

                $doctors->doctorDetails()->save($contactDetail);
            }
            DB::commit();
            toastr()->success('Doctor Add successfully !');
            return redirect()->route('doctor.index');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            toastr()->error("db error");
            return redirect()->route('doctor.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor_id =  decrypt($id);
        $data['page'] = 'admin.doctor.doctorView';
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['js'] = ['doctor'];
        $data['doctorData'] =  User::with(['doctorDetails', 'groupDoctorAssignments' => function ($query) {
            $query->with('group');
        }])->find($doctor_id);

        return view('admin.main_layout', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor_id =  decrypt($id);
        $data['page'] = 'admin.doctor.edit';
        $data['js'] = ['doctor'];
        $data['doctorDetail'] = User::with('doctorDetails')->where('id', $doctor_id)->get();
        $data['doctorId'] = $id;
        $data['doctorType'] = Role::whereIn('id', [3, 4])->get();
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        return view('admin.main_layout', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorPostUpdateRequest $request, string $id)
    {


        try {

            DB::beginTransaction();

            $doctorId = decrypt($id);
            $doctor = User::with('doctorDetails')->findOrFail($doctorId);

            if (!empty($doctor)) {

                if ($request->hasFile('avatar')) {

                    if (Storage::disk('public')->exists('doctor/' . $doctor->image)) {
                        Storage::disk('public')->delete('doctor/' . $doctor->image);
                    }

                    $image = $request->file('avatar');
                    $imageName = time() . '_' . $image->getClientOriginalName();
                    Storage::disk('public')->putFileAs('doctor', $image, $imageName);


                    $doctor->image = $imageName;
                }

                $doctor->first_name = $request->first_name;
                $doctor->last_name = $request->last_name;
                $doctor->identity_number = str_replace(' ', '', $request->identity_number);
                $doctor->role_id = 3;
                $doctor->email = $request->email;
                if ($doctor->save() == true) {


                    $doctor->doctorDetails->date_of_birth =  $request->date_of_birth;
                    $doctor->doctorDetails->gender = $request->gender;
                    $doctor->doctorDetails->contact_number = $request->contact_number;
                    $doctor->doctorDetails->profession = $request->profession;
                    $doctor->doctorDetails->save();
                }
                DB::commit();
                toastr()->success('Doctor details updated successfully !');
                return redirect()->route('doctor.index');
            } else {
                toastr()->error('Doctor not found');
                return redirect()->route('doctor.edit', $id);
            }
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            toastr()->error($e->getMessage());
            return redirect()->route('doctor.create');
        }
    }


    public function group_assignment($id)
    {
        $data['page'] = 'admin.doctor.groupAssignment';
        $data['js'] = ['doctor'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['groupData'] = Group::where('start_session_date', '>=', date('Y-m-d'))->withCount(['groupPatientAssignments' => function ($query) {
            $query->where('in_out', 'in');
        }])->get();


        $data['selectedGroup'] =  GroupDoctorAssignment::with(['group' => function ($query) {
            $query->withCount(['groupPatientAssignments' => function ($query) {
                $query->where('in_out', 'in');
            }]);
        }])->where(['doctor_id' => decrypt($id)])->get();
        $data['doctorDetail'] = User::select(['first_name', 'last_name'])->where('id', decrypt($id))->get();
        $data['doctor_id'] = $id;
        return view('admin.main_layout', $data);
    }

    public function assignGroupToDoctor(Request $request)
    {

        $id = $request->doctor_id;
        $doctor_id = decrypt($request->doctor_id);
        $group_id = $request->group_id;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        try {

            DB::beginTransaction();

            $AssignGroups = new GroupDoctorAssignment;
            $AssignGroups->group_id = $group_id;
            $AssignGroups->doctor_id = $doctor_id;
            $AssignGroups->start_time = $start_time;
            $AssignGroups->end_time = $end_time;
            $AssignGroups->save();

            DB::commit();
            toastr()->success("groups are assigned succesfully");
            return redirect()->route('doctor.groupAssign', $id);
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->route('doctor.groupAssign', $id);
        }
    }

    public function checkGroupIsNotAssigned($request)
    {
        $checkGroupAssign = GroupDoctorAssignment::select('group_id')->where(['doctor_id' => decrypt($request->doctor_id)])->whereIn('group_id', $request->assignGroup)->get();



        $assignGroup = $checkGroupAssign->pluck('group_id')->toArray();

        $notAssignGroups = [];
        if (!empty($request->assignGroup)) {
            foreach ($request->assignGroup as $value) {

                if (!in_array($value, $assignGroup)) {
                    $notAssignGroups[] = $value;
                }
            }
            return $notAssignGroups;
        }
        return  $request->assignGroup;
    }


    public function removeFromGroup(Request $request)
    {
        $assign_id = $request->assign_id;
        $group_id = $request->group_id;
        $doctor_id = $request->doctor_id;


        try {
            DB::beginTransaction();


            GroupDoctorAssignment::where(['id' => decrypt($assign_id), 'group_id' => decrypt($group_id), 'doctor_id' => decrypt($doctor_id)])->delete();
            DB::commit();
            return response()->json(true);
        } catch (QueryException $e) {

            DB::rollBack();
            return response()->json(false);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $user = User::select('image')->find($id);
            if (Storage::disk('public')->exists('doctor/' . $user->image)) {
                Storage::disk('public')->delete('doctor/' . $user->image);
            }

            $user = User::find($id)->delete();
            DB::commit();
            return response()->json(true);
        } catch (QueryException $e) {

            DB::rollBack();
            return response()->json(false);
        }
    }


    public function check_identity_number_is_already(Request $request)
    {
        try {

            $doctor = User::where('identity_number', $request->identity_number)->get();

            if (count($doctor) > 0) {
                if (isset($request->id) && !empty($request->id)) {

                    if ($doctor[0]->id == decrypt($request->id)) {

                        $return =  true;
                        echo json_encode($return);
                        exit;
                    }
                }
                $return =  false;
            } else {
                $return = true;
            }
            echo json_encode($return);
            exit;
        } catch (QueryException $e) {


            echo json_encode(false);
        }
    }


    public function check_email_is_already(Request $request)
    {


        try {
            $user = User::where(['email' => $request->email])->get();


            if (count($user) > 0) {
                if (isset($request->id) && !empty($request->id)) {

                    if ($user[0]->id == decrypt($request->id)) {

                        $return =  true;
                        echo json_encode($return);
                        exit;
                    }
                }
                $return =  false;
            } else {
                $return = true;
            }
            echo json_encode($return);
            exit;
        } catch (QueryException $e) {
            Log::error('Database query error' . $e->getMessage());
            echo json_encode(false);
        }
    }

    public function checkDoctorIsAvailable(Request $request)
    {

        // dd($request);
        $group_id = $request->group_id;
        $doctor_id = decrypt($request->doctor_id);
        $start_time = explode(':', $request->start_time);
        $end_time = explode(':', $request->end_time);

        $groupSessionDate = Group_session::where('session_date', '<=', date('Y-m-d'))->with(['group' => function ($query) {
            $query->where('end_session_date', '>=', date('Y-m-d'));
        }])->pluck('session_date')->toArray();


        $doctorAvail = GroupDoctorAssignment::where('doctor_id', $doctor_id)
            ->get();

        $assignedDate = [];
        $assignedStartTime = [];
        $assignedEndTime = [];
        foreach ($doctorAvail as $slot) {

            $assigned_start_time = explode(':', $slot->start_time);
            $assigned_end_time = explode(':', $slot->end_time);
            $assignedStartTime[] = $assigned_start_time[0];
            $assignedEndTime[] = $assigned_end_time[0];

            $doctorGroups  = Group_session::where('group_id', $slot->group_id)->get();
            foreach ($doctorGroups as $sessDateVal) {

                $assignedDate[] = $sessDateVal->session_date;
            }
        }

        foreach ($groupSessionDate as $val) {
            if (in_array($val, $assignedDate)) {
                if (in_array($start_time[0], $assignedStartTime) || in_array($end_time[0], $assignedEndTime)) {
                    return "false";
                }
            }
        }

        return "true";
    }
}
