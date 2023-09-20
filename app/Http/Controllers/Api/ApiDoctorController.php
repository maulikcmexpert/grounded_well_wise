<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Group;
use App\Models\Admin\GroupDoctorAssignment;
use App\Models\Admin\Group_session;
use App\Models\GroupPatientAssignment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;
use App\Http\Requests\groupPatientList;
use App\Http\Requests\groupAssignToPatient;
use App\Http\Requests\AssignGroupToPatient;
use App\Http\Requests\PatientDetails;
use App\Http\Requests\PatientAllDetails;
use Laravel\Passport\Token;
use App\Models\Api\Note;
use App\Models\Admin\Attendance;
use App\Models\Admin\PatientRasMaster;
use App\Models\Admin\PatientApoms;
use App\Models\doctorReferral;

class ApiDoctorController  extends BaseController
{

    public function home()
    {

        $doctor_id  = Auth::guard('api')->user()->id;

        $groups = GroupDoctorAssignment::with(['group' => function ($query) {
            $query->withCount(['groupPatientAssignments' => function ($query) {
                $query->where('in_out', 'in');
            }]);
        }])->where(['doctor_id' => $doctor_id])->get();

        $groupData = [];
        foreach ($groups as $value) {
            $groupDetail['id'] = $value->group_id;
            $groupDetail['group_name'] = $value->group->group_name;
            $groupDetail['total_patients'] = $value->group->group_patient_assignments_count;
            $groupData[] = $groupDetail;
        }
        return $this->sendResponse($groupData, 'Home');
    }

    public function doctorDetails()
    {
        $doctor_id = Auth::guard('api')->user()->id;
        $doctor =  User::with(['doctorDetails', 'Role'])->where('id', $doctor_id)->get();

        $doctorProfile = [];

        $doctorData['id'] = $doctor[0]->id;
        $doctorData['name'] = $doctor[0]->first_name . ' ' . $doctor[0]->last_name;
        $doctorData['image'] =  asset('storage/doctor/' . $doctor[0]->image);;
        $doctorData['contact_number'] = $doctor[0]->doctorDetails->contact_number;
        $doctorData['date_of_birth'] = $doctor[0]->doctorDetails->date_of_birth;
        $doctorData['identity_number'] = $doctor[0]->identity_number;
        $doctorData['profession'] = $doctor[0]->doctorDetails->profession;
        $doctorData['doctor_type'] = $doctor[0]->Role->role_name;
        $doctorData['profession'] = $doctor[0]->doctorDetails->profession;
        $doctorData['Email'] = $doctor[0]->email;
        $doctorData['Gender'] = $doctor[0]->doctorDetails->gender;
        $doctorProfile[] = $doctorData;

        return $this->sendResponse($doctorProfile, 'Doctor Information.');
    }

    public function groupPatientList(groupPatientList $request)
    {

        $group_id = $request->group_id;

        $group_patient_list = GroupPatientAssignment::with('patient')->where('group_id', $group_id)->get();

        $patientList = [];

        foreach ($group_patient_list as $value) {
            $patientdetail['patient_id'] = $value->patient_id;
            $patientdetail['patient_name'] = $value->patient->first_name . ' ' . $value->patient->last_name;
            $patientList[] = $patientdetail;
        }
        return $this->sendResponse($patientList, 'group patient list');
    }

    public function groupAssignToPatient(groupAssignToPatient $request)
    {

        $doctor_id  = Auth::guard('api')->user()->id;
        $patientAssignGroup = GroupDoctorAssignment::with(['group' => function ($query) {
            $query->withCount(['groupPatientAssignments' => function ($query) {
                $query->where('in_out', 'in');
            }]);
        }])->get();


        $patient_id = $request->patient_id;
        $selected_group = GroupPatientAssignment::select('group_id')->where(['patient_id' => $patient_id, 'in_out' => 'In'])->get();
        $selected_groups = $selected_group->pluck('group_id')->toArray();

        $assignGroupList = [];
        foreach ($patientAssignGroup as $value) {
            if (!in_array($value->group_id, $selected_groups)) {
                $groupData['group_id'] =  $value->group_id;
                $groupData['group_name'] =  $value->group->group_name;
                $groupData['total_patient'] =  $value->group->group_patient_assignments_count;

                $assignGroupList[] = $groupData;
            }
        }

        return $this->sendResponse($assignGroupList, ' Group list to assign patient');
    }

    public function assignGroup(AssignGroupToPatient $request)
    {

        $doctor_id  = Auth::guard('api')->user()->id;
        $checkGroupIsAssign = GroupPatientAssignment::where(['group_id' => $request->group_id, 'patient_id' => $request->patient_id])->get();

        $doctorAssign = GroupDoctorAssignment::where('group_id', $request->group_id)->first();

        if (count($checkGroupIsAssign) == 0) {

            $assigGroup = new GroupPatientAssignment;
            $assigGroup->group_id = $request->group_id;
            $assigGroup->patient_id = $request->patient_id;
            $assigGroup->doctor_id = $doctorAssign->doctor_id;
            $assigGroup->AssignmentDate = date('Y-m-d,h:i:s');
            $assigGroup->in_out = "In";
            $assigGroup->save();
        } else {
            if ($checkGroupIsAssign[0]->in_out != "Out") {
                $checkGroupIsAssign[0]->in_out = "In";
                $checkGroupIsAssign[0]->AssignmentDate = date('Y-m-d,h:i:s');
                $checkGroupIsAssign[0]->save();
            }
        }
        // $referDoctor = new doctorReferral;
        // $referDoctor->referring_doctor_id = $doctorAssign->doctor_id;
        // $referDoctor->referred_doctor_id = $doctor_id;

        // $referDoctor->patient_id = $request->patient_id;
        // $referDoctor->referral_date = date('Y-m-d');
        // $referDoctor->save();
        return $this->sendResponse("assigned succesfully", 'Group is assign Succesfully');
    }

    public function patientDetails(PatientDetails $request)
    {
        $patient_id = $request->patient_id;

        $patientGroups = GroupPatientAssignment::with('group')->where(['patient_id' => $patient_id, 'in_out' => 'in'])->get();
        $patientGroupData = [];

        foreach ($patientGroups as $value) {
            $patientGroupDetails['group_id'] = $value->group_id;
            $patientGroupDetails['group_name'] = $value->group->group_name;
            $patientGroupData[] = $patientGroupDetails;
        }
        return $this->sendResponse($patientGroupData, ' patient Details');
    }

    public function patientAllDetails(PatientAllDetails $request)
    {
        $patient_id = $request->patient_id;
        $group_id = $request->group_id;


        $homeData = [];
        // program //
        $groups =  GroupPatientAssignment::with('group')->where(['patient_id' => $patient_id, 'group_id' => $group_id, 'in_out' => 'in'])->first();
        $group = [];



        $groupData['group_id'] = $groups->group_id;
        $groupData['group_name'] = $groups->group->group_name;


        // your OT //
        $ot_doctor = GroupDoctorAssignment::with(['doctor.doctorDetails', 'doctor.groupDoctorAssignments.group'])->where('group_id', $group_id)->get();
        $groupOTDoctor = [];
        foreach ($ot_doctor as $value) {
            $OTDoctor['id'] = $value->doctor_id;
            $OTDoctor['image'] =  asset('storage/doctor/' . $value->doctor->image);
            $OTDoctor['doctor_name'] = $value->doctor->first_name;
            $OTDoctor['profession'] = $value->doctor->doctorDetails->profession;
            $assignedGroup = [];
            foreach ($value->doctor->groupDoctorAssignments as $value) {

                array_push($assignedGroup, $value->group->group_name);
                $OTDoctor['groups'] = implode(',', $assignedGroup);
            }
            $groupOTDoctor[] = $OTDoctor;
        }
        $groupData['your_ot'] = $groupOTDoctor;
        // your OT //

        // Sessions //

        $group_session = Group_session::select('id', 'session_name', 'session_details', 'session_date')->where('group_id', $group_id)->get();
        $sessionData = [];

        $session_status = "";
        foreach ($group_session as $value) {
            $patientSessionStatus = Attendance::where('session_id', $value->id)->get();

            if ($value->session_date <= date('Y-m-d')) {

                if (count($patientSessionStatus) != 0) {
                    $session_status = 0;
                } else {
                    $session_status = 1;
                }
            } else {

                $session_status = 2;
            }



            $group_sessions['id'] = $value->id;
            $group_sessions['session_name'] = $value->session_name;
            $group_sessions['session_date'] = $value->session_date;
            $group_sessions['session_details'] = ($value->session_details == NULL) ? "" : $value->session_details;
            $group_sessions['session_status'] = $session_status;

            $sessionData[] = $group_sessions;
        }
        $groupData['sessions'] = $sessionData;

        //   $groupData['sessions'] = $group_session;

        $group[] = $groupData;

        // Sessions //

        $homeData['program'] = $group;

        $checkInitialRasComplated = PatientRasMaster::where(['test_type' => '0', 'patient_id' => $patient_id])->count();
        $checkFinalRasComplated = PatientRasMaster::where(['test_type' => '1', 'patient_id' => $patient_id])->count();
        $checkInitialAPOMComplated = PatientApoms::where(['test_type' => '0', 'patient_id' => $patient_id])->count();
        $checkFinalAPOMComplated = PatientApoms::where(['test_type' => '1', 'patient_id' => $patient_id])->count();
        if ($checkInitialRasComplated != 0 && $checkFinalRasComplated != 0 && $checkInitialAPOMComplated != 0 && $checkFinalAPOMComplated != 0) {
            $homeData['is_discharge'] = true;
            $patientReport =  User::where('id', $patient_id)->first();
            $homeData['discharge_report_url'] =  asset('storage/pdfs/' . $patientReport->first_name . '_' . $patientReport->last_name . '.pdf');
        } else {

            $homeData['is_discharge'] = false;
            $homeData['discharge_report_url'] = "";
        }
        // $homeData['sessions_completed'] = $this->checkSessionComplated($patient_id);

        return $this->sendResponse($homeData, 'Home');
    }

    public function patientNoteDetails(Request $request)
    {

        $patient_id = $request->patient_id;
        $session_id = $request->session_id;

        $noteDetails = Note::where(['patient_id' => $patient_id, 'session_id' => $session_id])->get();

        if (!$noteDetails->isEmpty()) {
            return $this->sendResponse($noteDetails, 'Note Details');
        } else {
            return $this->sendError('Data not found');
        }
    }

    public function checkSessionComplated($id)
    {
        $assignedGroups = GroupPatientAssignment::where(['patient_id' => $id, 'in_out' => 'in'])->pluck('group_id');
        if (count($assignedGroups) != 0) {
            $allSessionsCompletedForAllGroups = true;

            foreach ($assignedGroups as $groupId) {
                // Get the total number of sessions in the group
                $totalSessions = Group::findOrFail($groupId)->group_session()->count();

                // Get the number of sessions attended by the patient for this group
                $attendedSessions = Attendance::whereHas('group_session', function ($query) use ($groupId) {
                    $query->where('group_id', $groupId);
                })
                    ->where('patient_id', $id)
                    ->count();

                // Check if all sessions are completed for the patient in this group
                if ($attendedSessions !== $totalSessions) {
                    $allSessionsCompletedForAllGroups = false;
                    break; // No need to check other groups if any group has pending sessions
                }
            }
            return $allSessionsCompletedForAllGroups;
        } else {
            return  $allSessionsCompletedForAllGroups = false;
        }
    }

    public function logout()
    {
        if (Auth::guard('api')->check()) {
            $patient = Auth::guard('api')->user();
            Token::where('user_id', $patient->id)->delete();
            return $this->sendResponse('logout', 'logout succesfully');
        }
    }
}
