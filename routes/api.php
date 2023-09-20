<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    ApiAuthController,
    ApiPatientController,
    ApiDoctorController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(ApiAuthController::class)->group(function () {

    Route::post('register', 'register');
    Route::post('login', 'userLogin');
    Route::get('reffering_provider', 'refferingProvider');
    Route::post('forgot_password', 'forgotPassword');
});

Route::middleware('isPatient')->group(function () {

    Route::get('userInfo', [ApiPatientController::class, 'userInfo']);
    Route::get('home', [ApiPatientController::class, 'home']);
    Route::post('group_detail', [ApiPatientController::class, 'groupDetail']);
    Route::post('group_ot_session', [ApiPatientController::class, 'getOtAndSession']);

    Route::post('add_note', [ApiPatientController::class, 'addNote']);
    Route::post('note_lists', [ApiPatientController::class, 'noteLists']);
    Route::get('ras_interview_question', [ApiPatientController::class, 'rasInterviewQuestion']);
    Route::post('ras_question_answer', [ApiPatientController::class, 'rasQuestionAnswer']);
    Route::get('logout', [ApiPatientController::class, 'logout']);
});


Route::prefix('doctor')->middleware('isDoctor')->group(function () {

    Route::get('home', [ApiDoctorController::class, 'home']);
    Route::post('group_patient_list', [ApiDoctorController::class, 'groupPatientList']);
    Route::post('group_assign_to_patient', [ApiDoctorController::class, 'groupAssignToPatient']);
    Route::post('assign_group', [ApiDoctorController::class, 'assignGroup']);
    Route::get('doctor_profile', [ApiDoctorController::class, 'doctorDetails']);
    Route::post('patient_details', [ApiDoctorController::class, 'patientDetails']);
    Route::post('patient_all_details', [ApiDoctorController::class, 'patientAllDetails']);
    Route::post('patient_notes_details', [ApiDoctorController::class, 'patientNoteDetails']);
    Route::get('logout', [ApiDoctorController::class, 'logout']);
    // Route::post('group_patient_detail', [ApiDoctorController::class, 'groupPatientDetail']);
    // Route::get('logout', [ApiPatientController::class, 'logout']);
});
