<?php

namespace App\Http\Controllers\doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Group;
use App\Models\Admin\GroupDoctorAssignment;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctor_id = session()->get('admin')['id'];
        $data['page'] = 'doctor.dashboard';
        $data['getGroups'] = GroupDoctorAssignment::with(['doctor', 'group' => function ($query) {
            $query->withCount(['groupPatientAssignments' => function ($query) {
                $query->where('in_out', 'in');
            }]);
        }])->where(['doctor_id' => $doctor_id])->get();
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
