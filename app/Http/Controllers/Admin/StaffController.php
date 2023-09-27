<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StaffPostRequest;
use App\Http\Requests\StaffPostUpdateRequest;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class StaffController extends Controller
{
    public function index(Request $request)
    {

        $data['page'] = 'admin.staff.list';
        $data['js'] = ['staff'];

        $data['role_id'] = Auth::guard('web')->user()->role_id;
        if ($request->ajax()) {
            $data = User::where('role_id', 2)->orderBy('id', 'desc');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    static $count = 1;
                    return $count++;
                })

                ->addColumn('name', function ($row) {
                    $image = Storage::disk('public')->url('staff/' . $row->image);


                    $name = '<div class="symbol-label">
                    <img src="' . $image . '" alt="No Image" class="w-50">
                </div>' . $row->first_name . ' ' . $row->last_name;
                    return $name;
                })


                ->addColumn('action', function ($row) {

                    $cryptId = encrypt($row->id);

                    $edit_url = route('staff.edit', $cryptId);
                    $delete_url = route('staff.destroy', $cryptId);
                    $view = route('staff.show', $cryptId);
                    $actionBtn = '
                    <div class="action-icon">
                  
                    <a class="" href="' . $edit_url . '"  title="Edit"><i class="fa fa-edit"></i></a>
                    <a class="" href="javascript:;"   title="Delete"  data-url="' . $delete_url . '"  id="delete_staff" ><i class="fas fa-trash"></i></a>
                    <a class="" href="' . $view . '"  title="view"><i class="fas fa-eye" title="View" ></i></a>
                    </div>
              ';
                    return $actionBtn;
                })
                ->rawColumns(['number', 'name', 'action'])
                ->make(true);
        }

        return view('admin.main_layout', $data);
    }

    public function create()
    {
        $data['page'] = 'admin.staff.add';
        $data['js'] = ['staff'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        return view('admin.main_layout', $data);
    }

    public function store(StaffPostRequest $request)
    {
        try {

            DB::beginTransaction();

            $image = $request->file('avatar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            Storage::disk('public')->putFileAs('staff', $image, $imageName);

            User::create([
                'first_name' => $request->first_name,
                'email' => $request->email,
                'role_id' => '2',
                'image' => $imageName,
                'password' => bcrypt($request->password),
            ]);


            DB::commit();
            toastr()->success('Staff Add successfully !');
            return redirect()->route('staff.index');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            toastr()->error("db error");
            return redirect()->route('staff.create');
        }
    }

    public function show($id)
    {
        $staff_id =  decrypt($id);
        $data['page'] = 'admin.staff.view';
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['js'] = ['staff'];
        $data['staffData'] =  User::find($staff_id);

        return view('admin.main_layout', $data);
    }

    public function edit($id)
    {
        $staff_id =  decrypt($id);
        $data['page'] = 'admin.staff.edit';
        $data['js'] = ['staff'];
        $data['staffDetail'] = User::where('id', $staff_id)->get();
        $data['staffId'] = $id;

        $data['role_id'] = Auth::guard('web')->user()->role_id;
        return view('admin.main_layout', $data);
    }




    public function update(StaffPostUpdateRequest $request, string $id)
    {

        try {
            DB::beginTransaction();
            $staffId = decrypt($id);

            $user = User::findOrFail($staffId);

            $requestData = [
                'first_name' => $request->first_name,
                'email' => $request->email,

            ];
            if ($request->hasFile('avatar')) {



                if (Storage::disk('public')->exists('staff/' . $user->image)) {
                    Storage::disk('public')->delete('staff/' . $user->image);
                }

                $image = $request->file('avatar');
                $imageName = time() . '_' . $image->getClientOriginalName();
                Storage::disk('public')->putFileAs('staff', $image, $imageName);

                $requestData['image'] = $imageName;
            }


            $user->update($requestData);
            DB::commit();
            toastr()->success('Staff updated successfully !');
            return redirect()->route('staff.index');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            toastr()->error("db error");
            return redirect()->route('staff.edit', $id);
        }
    }



    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $id = decrypt($id);
            $user = User::select('image')->find($id);
            if (Storage::disk('public')->exists('staff/' . $user->image)) {
                Storage::disk('public')->delete('staff/' . $user->image);
            }


            $user = User::find($id)->delete();
            DB::commit();
            return response()->json(true);
        } catch (QueryException $e) {

            DB::rollBack();
            return response()->json(false);
        }
    }

    public function check_email_is_already(Request $request)
    {

        try {
            $user = User::where(['email' => $request->email, 'role_id' => '2'])->get();


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
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            echo json_encode(false);
        }
    }
}
