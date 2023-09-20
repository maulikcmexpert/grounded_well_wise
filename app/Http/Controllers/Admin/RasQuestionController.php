<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\RasQuestion;
use App\Http\Requests\RasPostQuestion;
use App\Models\Admin\rasQuestionCategories;
use PDO;

class RasQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $data['page'] = 'admin.ras_question.list';
        $data['js'] = ['ras_question'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        if ($request->ajax()) {
            $data = RasQuestion::orderBy('id', 'DESC')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('number', function ($row) {
                    static $count = 1;
                    return $count++;
                })
                ->addColumn('action', function ($row) {

                    $cryptId = encrypt($row->id);
                    $edit_url = route('ras_question.edit', $cryptId);
                    $delete_url = route('ras_question.destroy', $cryptId);
                    $actionBtn = ' 
                    <div class="action-icon">
                    <a class="" href="' . $edit_url . '"><i class="fa fa-edit"></i></a>
                    <a class="" href="javascript:;"   data-url="' . $delete_url . '"  id="delete_question" ><i class="fas fa-trash"></i></a>
                   
                  
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
        $data['page'] = 'admin.ras_question.add';
        $data['js'] = ['ras_question'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['questionCat'] = rasQuestionCategories::All();
        return view('admin.main_layout', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {
            DB::beginTransaction();

            foreach ($request->question as $value) {

                RasQuestion::create([
                    'subscale' => $request->subscale,
                    'question' => $value,
                ]);
            }
            DB::commit();
            toastr()->success('Questions Add successfully !');
            return redirect()->route('ras_question.index');
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->route('ras_question.create');
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
        $question_id =  decrypt($id);
        $data['page'] = 'admin.ras_question.edit';
        $data['js'] = ['ras_question'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['questionDetail'] = RasQuestion::where('id', $question_id)->get();
        $data['questionCat'] = rasQuestionCategories::All();
        $data['questionId'] = $id;
        return view('admin.main_layout', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            DB::beginTransaction();

            $questionId = decrypt($id);

            $rasQuestion = RasQuestion::findOrFail($questionId);

            $requestData = [
                'subscale' => $request->subscale,
                'question' => $request->question,
            ];
            DB::commit();
            $rasQuestion->update($requestData);
            toastr()->success('question updated successfully !');
            return redirect()->route('ras_question.index');
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error("db error");
            return redirect()->route('ras_question.create');
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

            RasQuestion::find($id)->delete();
            DB::commit();

            return response()->json(true);
        } catch (QueryException $e) {
            DB::rollBack();
            toastr()->error("db error");
            return response()->json(false);
        }
    }
}
