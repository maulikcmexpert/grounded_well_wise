<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CompanyAbout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyPostDetails;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data['page'] = 'admin.company.details';
        $data['js'] = ['company_details'];
        $data['role_id'] = Auth::guard('web')->user()->role_id;
        $data['companyData'] = CompanyAbout::first();
        return view('admin.main_layout', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyPostDetails $request)
    {

        try {
            DB::beginTransaction();

            $checkExist = CompanyAbout::first();
            if (empty($checkExist)) {
                $companyAbout = new CompanyAbout;
                $companyAbout->title = $request->title;
                $companyAbout->about_us = $request->about_us;
                $companyAbout->t_c_title = $request->t_c_title;
                $companyAbout->term_and_condition = $request->term_and_condition;
                $companyAbout->p_p_title = $request->p_p_title;
                $companyAbout->privacy_policy = $request->privacy_policy;
                $companyAbout->save();
                toastr()->success('Detail add successfully !');
            } else {
                $checkExist->title = $request->title;
                $checkExist->about_us = $request->about_us;
                $checkExist->t_c_title = $request->t_c_title;
                $checkExist->term_and_condition = $request->term_and_condition;
                $checkExist->p_p_title = $request->p_p_title;
                $checkExist->privacy_policy = $request->privacy_policy;
                $checkExist->update();
                toastr()->success('Detail updated successfully !');
            }
            DB::commit();
            return redirect()->route('company.index');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error' . $e->getMessage());
            toastr()->error("db error");
            return redirect()->route('company.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
