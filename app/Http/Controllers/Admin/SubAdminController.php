<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SubAdminRequestPost;
use App\Http\Requests\SubAdminUpdateRequestPost;

class SubAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['page'] = 'admin.subadmin.list';
        $data['js'] = ['subadmin'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        if ($request->ajax()) {
            $totalRows = User::where('role_id', '1')->count();
            $offset = $totalRows - 1;
            $data = User::where('role_id', '1')->orderBy('id', 'DESC')->take($offset)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    static $count = 1;
                    return $count++;
                })
                ->addColumn('action', function ($row) {

                    $cryptId = encrypt($row->id);
                    $edit_url = route('subadmin.edit', $cryptId);
                    $delete_url = route('subadmin.destroy', $cryptId);
                    $actionBtn = ' 
                    <div class="action-icon">
                    <a class="" href="' . $edit_url . '"  title="Edit"><i class="fa fa-edit"></i></a>
                    <a class="" href="javascript:;"  title="Delete"   data-url="' . $delete_url . '"  id="delete_subadmin" ><i class="fas fa-trash"></i></a>
                   
                  
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
        $data['page'] = 'admin.subadmin.add';
        $data['js'] = ['subadmin'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        return view('admin.main_layout', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubAdminRequestPost $request)
    {
        try {

            DB::beginTransaction();

            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'role_id' => 1,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'status' => '1'
            ]);


            DB::commit();
            toastr()->success('Subadmin Add successfully !');
            return redirect()->route('subadmin.index');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            toastr()->error("db error");
            return redirect()->route('subadmin.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subadmin_id =  decrypt($id);
        $data['page'] = 'admin.subadmin.edit';
        $data['js'] = ['subadmin'];
        $data['subadminDetail'] = User::where('id', $subadmin_id)->get();
        $data['subadminId'] = $id;
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        return view('admin.main_layout', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubAdminUpdateRequestPost $request, string $id)
    {


        try {

            DB::beginTransaction();

            $subadminId = decrypt($id);
            $subadmin = User::findOrFail($subadminId);

            if (!empty($subadmin)) {


                $subadmin->first_name = $request->first_name;
                $subadmin->last_name = $request->last_name;
                $subadmin->email = $request->email;
                $subadmin->save();

                DB::commit();
                toastr()->success('Subadmin  updated successfully !');
                return redirect()->route('subadmin.index');
            } else {
                toastr()->error('Subadmin not found');
                return redirect()->route('subadmin.edit', $id);
            }
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            toastr()->error($e->getMessage());
            return redirect()->route('subadmin.create');
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
            $user = User::where(['email' => $request->email, 'role_id' => '1'])->get();


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
