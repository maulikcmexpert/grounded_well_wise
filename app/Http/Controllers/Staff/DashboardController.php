<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Group;
use App\Models\Admin\Patient_discharge_master;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['page'] = 'staff.dashboard';
        $data['totalDoctor'] = User::where('role_id', 3)->count();
        $data['totalPatient'] = User::where('role_id', 5)->count();
        $data['totalGroup'] = Group::count();
        $data['totalStaff'] = User::where('role_id', 2)->count();
        $data['total_admited'] = User::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total_admit')->groupBy('year', 'month')->where('role_id', 5)->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
        $data['total_discharges'] = Patient_discharge_master::selectRaw('YEAR(discharge_date) as year, MONTH(discharge_date) as month, COUNT(*) as total_discharges')
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();


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
    public function store(Request $request)
    {
        //
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
