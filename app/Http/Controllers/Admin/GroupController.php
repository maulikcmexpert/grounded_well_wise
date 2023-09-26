<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\GroupPostRequest;
use App\Http\Requests\GroupUpdatePostRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin\Group;
use App\Models\Admin\GroupDoctorAssignment;
use App\Models\GroupPatientAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\Admin\Group_session;
use App\Models\Admin\Attendance;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\CoreController;

class GroupController extends CoreController
{
    /**
     * Display a listing of the resource.
     * 
     */


    public function index(Request $request)
    {

        // Get the current time in the local timezone

        $data['page'] = 'admin.group.list';
        $data['js'] = ['group'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        if ($request->ajax()) {
            $data = Group::orderBy('id', 'DESC')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    static $count = 1;
                    return $count++;
                })
                ->addColumn('action', function ($row) {

                    $cryptId = encrypt($row->id);
                    $edit_url = route('group.edit', $cryptId);
                    $delete_url = route('group.destroy', $cryptId);
                    $view = route('group.show', $cryptId);
                    $attendance = route('group.attendance', $cryptId);
                    // $sessions = route('group.session_list', $cryptId);
                    $checkLastDate =  Group_session::where('group_id', $row->id)->orderBy('id', 'desc')->take(1)->get();
                    $checkTime = GroupDoctorAssignment::select('end_time')->where('group_id', $row->id)->orderBy('end_time', 'desc')->take(1)->get();
                    $actionBtn = ' <div class="action-icon">';


                    if (Auth::guard('web')->user()->can('create', Group::class)) {


                        if ($checkLastDate[0]->session_date >= date('Y-m-d')) {

                            if (@$checkTime[0]->endtime < session()->get('currentTime')) {
                                $actionBtn .=  '<a class="updateGroup" href="' . $edit_url . '"><i class="fas fa-edit" ></i></a>';
                            }
                        }
                        $actionBtn .= '<a class="" href="javascript:;"   data-url="' . $delete_url . '"  id="delete_group" ><i class="fas fa-trash" ></i></a>';
                    }
                    $actionBtn .= '<a class="" href="' . $view . '" role="button">
                 <i class="fa fa-eye" ></i>
                 </a>';
                    $actionBtn .= '<a class="" href="' . $attendance . '"><i class="fa fa-clock-o" aria-hidden="true"></i></a>
                </div>';
                    return $actionBtn;
                })
                ->rawColumns(['number', 'action'])
                ->make(true);
        }

        return view('admin.main_layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Group::class);



        $data['page'] = 'admin.group.add';
        $data['js'] = ['group'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['doctors'] = User::where('status', '1')->whereIn('role_id', ['3', '4'])
            // ->doesntHave('groupDoctorAssignments')
            ->get();

        return view('admin.main_layout', $data);
    }


    public function addDoctor()
    {
        $data['doctors'] = User::where('status', '1')->whereIn('role_id', ['3', '4'])
            // ->doesntHave('groupDoctorAssignments')
            ->get();
        return view('admin.group.ajaxcall', $data);
    }


    public function updateAjaxDoctor(Request $request)
    {

        $groupId = decrypt($request->group_id);

        $data['doctors'] = User::whereDoesntHave('groupDoctorAssignments', function ($query) use ($groupId) {
            $query->where('group_id', $groupId);
        })->where('status', '1')->whereIn('role_id', ['3', '4'])->get();

        return view('admin.group.updateajaxCall', $data);
    }

    public function addSession(Request $request)
    {
        $data['total_sessoin'] = $request->totalSession;
        return view('admin.group.ajaxsession', $data);
    }


    public function externalAddSession(Request $request)
    {
        $data['total_sessoin'] = $request->totalSession;
        return view('admin.group.externalajaxsession', $data);
    }

    public function groupTypeInternalExternal(Request $request)
    {
        $data['group_type'] = $request->group_type;
        $data['doctors'] = User::where('status', '1')->whereIn('role_id', ['3', '4'])->get();
        return view('admin.group.grouptypeajax', $data);
    }

    public function checkDoctorIsAvailable(Request $request)
    {
        $startDate = $request->startDate;
        $total_session = $request->total_session;


        $startDate = strtotime($startDate);
        $daysCount = 0;

        $sessionDate = [];

        while ($daysCount < $total_session) {
            $dayOfWeek = date('N', $startDate); // 1 (Monday) to 7 (Sunday)
            if ($dayOfWeek != 6 && $dayOfWeek != 7) { // Check if it's not Saturday or Sunday
                $sessionDate[] = date('Y-m-d', $startDate);
                $daysCount++;
            }
            $startDate = strtotime("+1 day", $startDate);
        }

        $doctor_id = $request->doctor_id;
        $start_time = explode(':', $request->start_time);
        $end_time = explode(':', $request->end_time);
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

            $doctorGroups  = Group_session::where('group_id', $slot->group_id)->with(['group' => function ($query) {
                $query->where('end_session_date', '>=', date('Y-m-d'));
            }])->get();
            foreach ($doctorGroups as $sessDateVal) {

                $assignedDate[] = $sessDateVal->session_date;
            }
        }

        foreach ($sessionDate as $val) {
            if (in_array($val, $assignedDate)) {
                if (in_array($start_time[0], $assignedStartTime) || in_array($end_time[0], $assignedEndTime)) {
                    return "false";
                }
            }
        }

        return "true";
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(GroupPostRequest $request)
    {

        try {
            DB::beginTransaction();
            $total_session = $request->total_session;
            $group_type = $request->group_type;

            if ($group_type == 'internal') {

                $start_session_date = $request->start_session_date;

                $startDate = strtotime($start_session_date);
                $daysCount = 0;

                $sessionDate = [];

                while ($daysCount < $total_session) {
                    $dayOfWeek = date('N', $startDate); // 1 (Monday) to 7 (Sunday)
                    if ($dayOfWeek != 6 && $dayOfWeek != 7) { // Check if it's not Saturday or Sunday
                        $sessionDate[] = date('Y-m-d', $startDate);
                        $daysCount++;
                    }
                    $startDate = strtotime("+1 day", $startDate);
                }

                $groups =   Group::create([
                    'group_name' => $request->group_name,
                    'group_details' => $request->group_details,
                    'start_session_date' => $start_session_date,
                    'end_session_date' =>   end($sessionDate),
                    'group_type' => $request->group_type,
                    'total_session' => $total_session
                ]);


                $group_id =  $groups->id;

                $groups = Group::find($group_id);

                if (!empty($groups)) {

                    for ($i = 0; $i < count($request->session_name); $i++) {
                        Group_session::create([
                            'group_id' => $group_id,
                            'session_name' => $request->session_name[$i],
                            'session_date' => $sessionDate[$i]
                        ]);
                    }
                    if (is_array($request->doctor_id) && count($request->doctor_id) != 0 && !is_null($request->doctor_id[0])) {


                        for ($d = 0; $d < count($request->doctor_id); $d++) {

                            GroupDoctorAssignment::create([
                                'doctor_id' => $request->doctor_id[$d],
                                'group_id' => $group_id,
                                'start_time' =>  $request->start_time[$d],
                                'end_time' =>  $request->end_time[$d],
                            ]);
                        }
                    }
                }
            } else {

                $sessionDates = $request->start_session_date;

                $start_session_date = $request->start_session_date[0];
                if (count($request->start_session_date) == 1) {
                    $end_session_date = $request->start_session_date[0];
                } else {

                    $end_session_date = end($sessionDates);
                }


                $groups =   Group::create([
                    'group_name' => $request->group_name,
                    'group_details' => $request->group_details,
                    'start_session_date' => $start_session_date,
                    'end_session_date' =>   $end_session_date,
                    'group_type' => $request->group_type,
                    'total_session' => $total_session
                ]);

                $group_id =  $groups->id;
                $groups = Group::find($group_id);
                if (!empty($groups)) {

                    foreach ($sessionDates as $key => $value) {

                        Group_session::create([
                            'group_id' => $group_id,
                            'session_name' => $request->session_name[$key],
                            'session_date' => $value
                        ]);

                        GroupDoctorAssignment::create([
                            'doctor_id' => $request->doctor_id,
                            'group_id' => $group_id,
                            'start_time' =>  $request->start_time[$key],
                            'end_time' =>  $request->end_time[$key],
                        ]);
                    }
                }
            }



            DB::commit();
            toastr()->success('Group Add successfully !');
            return redirect()->route('group.index');
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->route('group.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $group_id = decrypt($id);
        $data['page'] = 'admin.group.view';
        $data['js'] = ['group'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['groupDetail'] = Group::with(['groupDoctorAssignments.doctor', 'groupPatientAssignments.patient', 'group_session'])->where('id', $group_id)->get();
        $data['groupId'] = $id;
        return view('admin.main_layout', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $group_id =  decrypt($id);
        $data['page'] = 'admin.group.edit';
        $data['js'] = ['group'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['groupDetail'] = Group::with('group_session')->where('id', $group_id)->get();
        $data['assignDoctors'] = GroupDoctorAssignment::with('doctor')->where('group_id', $group_id)->get();

        $data['doctors'] = User::where('status', '1')->whereIn('role_id', ['3', '4'])->get();

        $data['groupId'] = $id;
        return view('admin.main_layout', $data);
    }


    public function updateSession(Request $request)
    {
        $group_id = decrypt($request->groupId);

        $data['totalSession'] = $request->totalSession;
        $data['group_session'] = Group_session::where('group_id', $group_id)->get();
        $data['startDatePerGroup'] = Group_session::select(\DB::raw('MIN(session_date) as start_date'))
            ->where('group_id', $group_id)
            ->get();
        return view('admin.group.ajaxUpdateSession', $data);
    }


    public function updateExternalSession(Request $request)
    {

        $group_id = decrypt($request->groupId);
        $data['group_session'] = Group_session::where('group_id', $group_id)->get();
        $data['groupTime'] = GroupDoctorAssignment::where('group_id', $group_id)->get();
        $data['startDatePerGroup'] = Group_session::select(\DB::raw('MIN(session_date) as start_date'))
            ->where('group_id', $group_id)
            ->get();
        $data['totalSession'] = $request->totalSession;

        return view('admin.group.update_external_ajax_session', $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(GroupUpdatePostRequest $request, $id)
    {

        try {
            DB::beginTransaction();
            $groupId = decrypt($id);
            $total_session = $request->total_session;
            $totalInsertedSession = Group_session::where('group_id', $groupId)->count();
            $group_type = $request->group_type;
            if ($group_type == 'internal') {

                $group = Group::findOrFail($groupId);
                $PrevDate = $group->start_session_date;

                $group->group_name = $request->group_name;
                $group->group_details = $request->group_details;
                $group->total_session = $total_session;
                $group->start_session_date = ($request->start_session_date != $group->start_session_date) ? $request->start_session_date : $group->start_session_date;
                $group->save();

                if ($request->start_session_date == $PrevDate) {

                    if ($request->start_session_date >= date('Y-m-d')) {
                        $getDateOfStartNewSession = $group->start_session_date;
                        $start_session_date = $getDateOfStartNewSession;

                        $startDate = strtotime($start_session_date);
                    } else {
                        $getDateOfStartNewSession = Group_session::where('group_id', $groupId)->orderBy('id', 'desc')->take(1)->get();
                        $getDateOfStartNewSession = $getDateOfStartNewSession[0]->session_date;
                        $start_session_date = $getDateOfStartNewSession;

                        $startDate = strtotime($start_session_date);
                        $startDate =  strtotime("+1 day", $startDate);
                    }
                } else {
                    $start_session_date = $request->start_session_date;

                    $startDate = strtotime($start_session_date);
                }

                $daysCount = 0;
                $sessionDate = [];
                while ($daysCount < $total_session) {
                    $dayOfWeek = date('N', $startDate); // 1 (Monday) to 7 (Sunday)
                    if ($dayOfWeek != 6 && $dayOfWeek != 7) { // Check if it's not Saturday or Sunday
                        $sessionDate[] = date('Y-m-d', $startDate);
                        $daysCount++;
                    }
                    $startDate = strtotime("+1 day", $startDate);
                }

                if ($total_session > $totalInsertedSession) {


                    if ($start_session_date >= date('Y-m-d')) {
                        $sessioninc = 0;

                        if (!empty($request->session_name)) {
                            Group_session::where('group_id', $groupId)->delete();
                            foreach ($request->session_name as $value) {
                                Group_session::create([
                                    'group_id' => $groupId,
                                    'session_name' => $value,
                                    'session_date' => $sessionDate[$sessioninc]
                                ]);
                                $sessioninc++;
                            }
                        }
                    } else {
                        foreach ($request->session_id as $key => $value) {
                            $group_session =  Group_session::where('id', $value)->first();
                            $group_session->session_name = $request->session_name[$key];
                            $group_session->save();
                        }
                        $newSessionArray = array_slice($request->session_name, $totalInsertedSession);
                        $j = 0;
                        foreach ($newSessionArray as $value) {
                            Group_session::create([
                                'group_id' => $groupId,
                                'session_name' => $value,
                                'session_date' => $sessionDate[$j]
                            ]);
                            $j++;
                        }
                    }
                } else {

                    if ($start_session_date >= date('Y-m-d')) {
                        $sessioninc = 0;
                        if (!empty($request->session_name)) {
                            Group_session::where('group_id', $groupId)->delete();
                            foreach ($request->session_name as $value) {
                                Group_session::create([
                                    'group_id' => $groupId,
                                    'session_name' => $value,
                                    'session_date' => $sessionDate[$sessioninc]
                                ]);
                                $sessioninc++;
                            }
                        }
                    } else {
                        foreach ($request->session_id as $key => $value) {
                            $group_session =  Group_session::where('id', $value)->first();
                            $group_session->session_name = $request->session_name[$key];
                            $group_session->save();
                        }
                    }
                }

                if (is_array($request->doctor_id) && count($request->doctor_id) != 0 && !is_null($request->doctor_id[0])) {

                    GroupDoctorAssignment::where('group_id', $groupId)->delete();

                    for ($d = 0; $d < count($request->doctor_id); $d++) {

                        GroupDoctorAssignment::create([
                            'doctor_id' => $request->doctor_id[$d],
                            'group_id' => $groupId,
                            'start_time' =>  $request->start_time[$d],
                            'end_time' =>  $request->end_time[$d],
                        ]);
                    }
                }

                $group = Group::findOrFail($groupId);
                $group->end_session_date = end($sessionDate);
                $group->save();
            } else {

                $group = Group::findOrFail($groupId);
                $PrevDate = $group->start_session_date;
                $requestDate = $request->start_session_date;
                $lastDate = end($requestDate);
                $group->group_name = $request->group_name;
                $group->group_details = $request->group_details;
                $group->total_session = $total_session;
                $group->start_session_date = ($request->start_session_date[0] != $group->start_session_date) ? $request->start_session_date[0] : $group->start_session_date;
                $group->end_session_date = ($lastDate != $group->end_session_date) ? $lastDate : $group->end_session_date;
                $group->save();

                if ($total_session > $totalInsertedSession) {

                    if ($request->start_session_date[0] >= date('Y-m-d')) {
                        $sessioninc = 0;

                        if (!empty($request->session_name)) {
                            Group_session::where('group_id', $groupId)->delete();
                            foreach ($request->session_name as $value) {
                                Group_session::create([
                                    'group_id' => $groupId,
                                    'session_name' => $value,
                                    'session_date' => $request->start_session_date[$sessioninc]
                                ]);
                                $sessioninc++;
                            }
                        }
                    } else {
                        foreach ($request->session_id as $key => $value) {
                            $group_session =  Group_session::where('id', $value)->first();
                            $group_session->session_name = $request->session_name[$key];
                            $group_session->save();
                        }
                        $newSessionArray = array_slice($request->session_name, $totalInsertedSession);
                        $newSessionArrays = array_slice($request->start_session_date, $totalInsertedSession);


                        $j = 0;
                        foreach ($newSessionArray as $value) {
                            Group_session::create([
                                'group_id' => $groupId,
                                'session_name' => $value,
                                'session_date' => $newSessionArrays[$j]
                            ]);
                            $j++;
                        }
                    }


                    GroupDoctorAssignment::where('group_id', $groupId)->delete();
                    dd($request);
                    for ($d = 0; $d < count($request->start_session_date); $d++) {

                        GroupDoctorAssignment::create([
                            'doctor_id' => $request->doctor_id,
                            'group_id' => $groupId,
                            'start_time' =>  $request->start_time[$d],
                            'end_time' =>  $request->end_time[$d],
                        ]);
                    }
                }
            }
            DB::commit();
            toastr()->success('Group updated successfully !');
            return redirect()->route('group.index');
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->route('group.edit', $id);
        }
    }


    public function removeAssignedDoctor(Request $request)
    {
        try {
            DB::beginTransaction();
            GroupDoctorAssignment::where(['doctor_id' => $request->doctor_id, 'group_id' => $request->group_id])->delete();
            DB::commit();

            return response()->json(true);
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error("db error");
            return response()->json(false);
        }
    }



    //  Attendance //



    public function attendanceList($id)
    {
        $group_id = decrypt($id);
        $data['page'] = 'admin.group.attendance';
        $data['js'] = ['group', 'attendance'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['patientDetails'] = GroupPatientAssignment::with(['patient.patientDetails'])->where('group_id', $group_id)->get();
        $data['group_name'] = Group::select('group_name')->where('id', $group_id)->first();
        $data['groupSession'] = Group_session::where('group_id', $group_id)->get();
        $data['getAttendancepatient'] = Attendance::where('group_id', $group_id)->pluck('patient_id')->toArray();
        $data['getAttendancesession'] = Attendance::where('group_id', $group_id)->pluck('session_id')->toArray();
        $data['groupId'] = $id;
        return view('admin.main_layout', $data);
    }
    public function storePatientAttendance(Request $request)
    {

        try {
            DB::beginTransaction();
            $patient_id = $request->patient_id;
            $session_id = $request->session_id;
            $group_id = decrypt($request->group_id);
            $checked = $request->checked;

            if ($checked == '1') {
                $take_attendance = new Attendance;
                $take_attendance->patient_id = $patient_id;
                $take_attendance->session_id = $session_id;
                $take_attendance->group_id = $group_id;
                $take_attendance->attendance_time = date('Y-m-d H:i:s');
                $take_attendance->save();
            } else {
                Attendance::where(['patient_id' => $patient_id, 'session_id' => $session_id])->delete();
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error("db error");
            return response()->json(false);
        }
    }

    // Attendance // 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        try {
            DB::beginTransaction();
            $id = decrypt($id);
            $group =  Group::find($id)->delete();

            DB::commit();
            return response()->json(true);
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error("db error");
            return response()->json(false);
        }
    }

    public function removeAssignDoctor(Request $request)
    {
        $doctor_id = $request->doctor_id;
        $group_id = $request->group_id;

        // try {
        //     DB::beginTransaction();
        //     $group =  GroupDoctorAssignment::where(['doctor_id' => $doctor_id])->delete();
        //     DB::commit();
        //     return response()->json(true);
        // } catch (QueryException $e) {
        //     DB::rollBack();
        //     toastr()->error("db error");
        //     return response()->json(false);
        // }
    }

    public function check_group_is_already(Request $request)
    {
        try {

            $group = Group::where(['group_name' => $request->group_name])->get();

            if (count($group) > 0) {
                if (isset($request->id) && !empty($request->id)) {

                    if ($group[0]->id == decrypt($request->id)) {

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
            DB::rollBack();
            toastr()->error("db error");
            return response()->json(false);
        }
    }

    public function searchDoctors(Request $request)
    {

        $searchTerm = $request->search;
        $doctors = User::where(function ($query) use ($searchTerm) {
            $query->where('first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('last_name', 'like', '%' . $searchTerm . '%');
        })
            ->where('status', '1')->whereIn('role_id', ['3', '4'])
            ->get();

        return response()->json($doctors);
    }
}
