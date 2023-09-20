<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Group_session;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Admin\Group;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\GroupSessionPostRequest;
use App\Http\Requests\GroupUpdateSessionPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Alert;

class GroupSessionsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index($group_id, Request $request)
    {

        $groupID  = decrypt($group_id);
        $data['page'] = 'admin.group_sessions.list';
        $data['js'] = ['group_session'];
        $data['groupId'] = $group_id;
        $data['totalCount'] = Group_session::where('group_id', $groupID)->count();
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        if ($request->ajax()) {

            $data = Group_session::with('group')->where('group_id', $groupID)->orderBy('id', 'DESC')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    static $count = 1;
                    return $count++;
                })
                ->addColumn('group_name', function ($row) {
                    return $row->group->group_name;
                })
                ->addColumn('action', function ($row) {

                    $cryptId = encrypt($row->id);
                    $edit_url = route('group_session.edit', $cryptId);
                    $delete_url = route('group_session.destroy', $cryptId);
                    $actionBtn = ' <div class="dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                       Action
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="' . $edit_url . '">Edit</a>
                    <a class="dropdown-item" href="javascript:;"   data-url="' . $delete_url . '"  id="delete_session" >Delete</a>
                  
                    </div>
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

        $data['page'] = 'admin.group_sessions.add';
        $data['js'] = ['group_session'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        return view('admin.main_layout', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $validated = $request->validate([
                'total_session' => 'required|numeric',
            ]);

            //     dd($request);

            if (!empty($request)) {

                $group_id = decrypt($request->group_id);
                $total_session = $request->total_session;


                // if ($request->totalCount != 0) {
                //     Group_session::where('group_id', $group_id)->delete();
                // }
                $group_session =  Group_session::where('group_id', $group_id)->count();


                for ($i = $group_session + 1; $i <= $total_session + $group_session; $i++) {
                    Group_session::create([
                        'group_id' => $group_id,
                        'session_name' => "Session " . $i

                    ]);
                }
                toastr()->success('Sessions Add successfully !');
            } else {
                toastr()->error('Group Sessions are not create !');
            }
            DB::commit();
            return redirect()->route('group.session_list', $request->group_id);
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error("db error");
            return redirect()->route('group_session.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Group_session $group_session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $session_id =  decrypt($id);
        $data['page'] = 'admin.group_sessions.edit';
        $data['js'] = ['group_session'];
        $data['sessionDetails'] = Group_session::where('id', $session_id)->get();
        $data['sessionId'] = $id;
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        return view('admin.main_layout', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GroupUpdateSessionPostRequest $request, $id)
    {


        try {
            DB::beginTransaction();
            $sessionId = decrypt($id);

            $session = Group_session::findOrFail($sessionId);

            $requestData = [
                'group_id' => $request->group_id,
                'session_name' => $request->session_name,
                'session_details' => $request->session_details

            ];

            $session->update($requestData);
            DB::commit();
            toastr()->success('Session updated successfully !');
            return redirect()->route('group.session_list', encrypt($request->group_id));
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->route('group_session.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {

        try {
            DB::beginTransaction();
            $id = decrypt($id);
            $group_session = Group_session::find($id)->delete();
            DB::commit();
            return response()->json(true);
        } catch (QueryException $e) {

            DB::rollBack();
            return response()->json(false);
        }
    }

    public function check_session_is_already(Request $request)
    {

        try {
            $group_sesson = Group_session::where(['session_name' => $request->session_name, 'group_id' => $request->group_id])->get();

            if (count($group_sesson) > 0) {
                if (isset($request->id) && !empty($request->id)) {

                    if ($group_sesson[0]->id == decrypt($request->id)) {

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
            return response()->json(false);
        }
    }
}
