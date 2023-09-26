<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\{DashboardController, SubAdminController, DoctorController, StaffController, GroupController, GroupSessionsController, RasQuestionController, CompanyController};
use App\Http\Controllers\Controller;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\CoreController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\CSVController;
use App\Http\Controllers\Staff\DashboardController as StaffDashboardController;
use App\Http\Controllers\doctor\DashboardController as doctorDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::get('forgot_password', [AuthController::class, 'forgot_password'])->name('forgot.password.get');
    Route::post('check_email_is_registered', [AuthController::class, 'check_email_is_registered'])->name('check_email_is_registered');
    Route::post('forgot_password', [AuthController::class, 'forgot_password_post'])->name('forgot.password.post');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

Route::get('about_us', [CompanyProfileController::class, 'about_us']);
Route::get('privacy_policy', [CompanyProfileController::class, 'privacy_policy']);
Route::get('terms_and_condition', [CompanyProfileController::class, 'terms_and_condition']);
Route::post('current_server_time', [CoreController::class, 'currentServertime']);


Route::middleware('auth')->group(function () {



    Route::get('logout', [AuthController::class, 'logout'])->name('logout');



    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware(['isAdmin'])->prefix('admin');


    Route::prefix('admin')->middleware('dynamic')->group(function () {

        // RAS , Company  module //

        Route::resource('ras_question', RasQuestionController::class)->middleware(['isAdmin']);
        Route::resource('company', companyController::class)->middleware('isAdmin');

        Route::resource('subadmin', SubAdminController::class)->middleware('isAdmin');
        Route::post('subadmin/check_email_is_already', [SubAdminController::class, 'check_email_is_already'])->middleware(['isAdmin']);

        // staff  module //

        Route::resource('staff', StaffController::class)->middleware('isAdmin');
        Route::post('staff/check_email_is_already', [StaffController::class, 'check_email_is_already'])->middleware(['isAdmin']);

        // group module //

        Route::resource('group', GroupController::class);
        Route::get('group', [GroupController::class, 'index'])->name('group.index');
        Route::get('group/{group}', [GroupController::class, 'show'])->name('group.show');

        Route::post('group/check_group_is_already', [GroupController::class, 'check_group_is_already'])->middleware(['isAdmin']);
        Route::post('group/search_doctors', [GroupController::class, 'searchDoctors'])->middleware(['isAdmin']);
        Route::post('group/ajax_doctor_call', [GroupController::class, 'addDoctor'])->middleware(['isAdmin']);
        Route::post('group/ajax_update_doctor_call', [GroupController::class, 'updateAjaxDoctor'])->middleware(['isAdmin']);
        Route::post('group/ajax_session_call', [GroupController::class, 'addSession'])->middleware(['isAdmin']);
        Route::post('group/external_ajax_session_call', [GroupController::class, 'externalAddSession'])->middleware(['isAdmin']);
        Route::post('group/update_external_ajax_session_call', [GroupController::class, 'updateExternalSession'])->middleware(['isAdmin']);
        Route::post('group/group_type_internal_external', [GroupController::class, 'groupTypeInternalExternal'])->middleware(['isAdmin']);

        Route::post('group/ajax_update_session', [GroupController::class, 'updateSession'])->middleware(['isAdmin']);
        Route::post('group/is_doctor_available', [GroupController::class, 'checkDoctorIsAvailable'])->middleware(['isAdmin']);
        Route::post('group/remove_assign_doctor', [GroupController::class, 'removeAssignedDoctor'])->middleware(['isAdmin']);
        Route::get('group/attendance_list/{group_id}', [GroupController::class, 'attendanceList'])->name('group.attendance');
        Route::post('group/store_patient_attendance', [GroupController::class, 'storePatientAttendance']);

        Route::get('group/session_list/{group_id}', [GroupSessionsController::class, 'index'])->name('group.session_list')->middleware(['isAdmin']);

        Route::post('group/check_session_is_already', [GroupSessionsController::class, 'check_session_is_already'])->middleware(['isAdmin']);
        Route::post('group/check_session_is_already', [GroupSessionsController::class, 'check_session_is_already'])->middleware(['isAdmin']);

        // doctor module //
        Route::resource('doctor', DoctorController::class);
        Route::get('doctor/group_assignment/{id}', [DoctorController::class, 'group_assignment'])->name('doctor.groupAssign');
        Route::post('doctor/assign_group_to_doctor', [DoctorController::class, 'assignGroupToDoctor'])->name('doctor.assignGroup');
        Route::post('doctor/check_identity_number_is_already', [DoctorController::class, 'check_identity_number_is_already']);
        Route::post('doctor/check_email_is_already', [DoctorController::class, 'check_email_is_already']);
        Route::post('doctor/remove_from_group', [DoctorController::class, 'removeFromGroup']);

        Route::post('doctor/is_doctor_available', [DoctorController::class, 'checkDoctorIsAvailable'])->name('doctor.checkdoctor');
    });

    Route::prefix('staff')->middleware('isStaff')->group(function () {

        Route::get('dashboard', [StaffDashboardController::class, 'index'])->name('staff.dashboard');
    });



    Route::prefix('doctor')->middleware(['isAdminDoctor'])->group(function () {

        Route::get('dashboard', [doctorDashboardController::class, 'index'])->name('doctor.dashboard');
    });


    Route::resources([
        'patient' => PatientController::class
    ]);
    Route::post('patient/change_status', [PatientController::class, 'change_status']);

    Route::post('patient/check_ezmed_number_is_already', [PatientController::class, 'check_ezmed_number_is_already']);
    Route::post('patient/check_identity_number_is_already', [PatientController::class, 'check_identity_number_is_already']);

    Route::get('/export-csv', [CSVController::class, 'export'])->name('export.csv');
    Route::get('patient/group_assignment/{id}', [PatientController::class, 'group_assignment'])->name('patient.groupAssign');
    Route::post('patient/assign_group_to_patient', [PatientController::class, 'assignGroupToPatient'])->name('patient.assignGroup');
    Route::get('patient/patient_recovery_assessment/{id}/{test_type}', [PatientController::class, 'recoveryAssessment'])->name('patient.recoveryAssessment');
    Route::post('patient/recovery_assessment_of_patient', [PatientController::class, 'recoveryAssessmentPatient'])->name('patient.recoveryAssessmentPatient');

    Route::get('patient/patient_apom/{id}/{test_type}', [PatientController::class, 'patientApom'])->name('patient.patientApom');
    Route::post('patient/store_patient_apom', [PatientController::class, 'storePatientAPOM'])->name('patient.storepatientApom');
    Route::get('patient/discharge_report/{patient_id}', [PatientController::class, 'deschargeReport'])->name('patient.discharge_report');
    Route::post('patient/discharge_report_pdf', [PatientController::class, 'dischargeReportPdf'])->name('patient.discharge_report_pdf');
    Route::post('patient/remove_patient_from_group', [PatientController::class, 'removePatientFromGroup'])->name('patient.remove_patient_from_group');
    Route::get('patient/apom_assessment_report/{patient_id}', [PatientController::class, 'apomAssessmentReport'])->name('patient.apom_assessment_report');
    Route::post('patient/apom_assessment_pdf_genarate', [PatientController::class, 'apomAssessmentPdfGenarate'])->name('patient.apom_assessment_pdf_genarate');
});
