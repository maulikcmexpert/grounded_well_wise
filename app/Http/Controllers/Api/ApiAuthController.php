<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\registerPostRequest;
use App\Http\Requests\loginPostRequest;
use App\Http\Requests\ForgotPassword;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\User;
use App\Models\doctorReferral;
use App\Models\Api\patientDetails;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Token;
use App\Models\Admin\PatientRasMaster;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

class ApiAuthController extends BaseController
{
    public function register(registerPostRequest $request)
    {

        try {
            DB::beginTransaction();

            $Patients = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'identity_number' => $request->identity_number,
                'role_id' => '5',
                'password' => bcrypt($request->password),
                'status' => '1'
            ]);

            $Patient_id =  $Patients->id;

            $patient = User::find($Patient_id);

            if (!empty($Patient_id)) {

                $contactDetail = new patientDetails;

                $contactDetail->user_id = $Patient_id;
                $contactDetail->passport_SAID = $request->passport_SAID;
                $contactDetail->date_of_birth =  $request->date_of_birth;
                $contactDetail->referring_provider = $request->referring_provider;
                $contactDetail->next_of_kin = $request->next_of_kin;
                $contactDetail->name = $request->name;
                $contactDetail->surname = $request->surname;
                $contactDetail->gender = $request->gender;
                $contactDetail->EZMed_number = $request->EZMed_number;
                $contactDetail->contact_number = $request->contact_number;
                $contactDetail->alternative_contact_number = $request->alternative_contact_number;
                $contactDetail->physical_address = $request->physical_address;
                $contactDetail->complex_name = $request->complex_name;
                $contactDetail->unit_no = $request->unit_no;
                $contactDetail->city = $request->city;
                $contactDetail->country = $request->country;
                $contactDetail->postal_code = $request->postal_code;

                $patient->patientDetails()->save($contactDetail);
                DB::commit();
            }
            $token = $Patients->createToken('token')->accessToken;
            $success['token'] =  $token;
            $success['name'] =  $Patients->first_name . ' ' . $Patients->last_name;


            return $this->sendResponse($success, 'User register successfully.');
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database query error: ' . $e->getMessage());
            toastr()->error($e->getMessage());
            return $this->sendErrorResponse("something went wrong", $e->getMessage());
        }
    }

    public function refferingProvider()
    {
        $doctor = User::whereIn('role_id', [3, 4])->get();
        if (count($doctor) != 0) {

            return $this->sendResponse($doctor, 'Refering provider');
        }
    }

    public function userLogin(loginPostRequest $request)
    {

        if ($request->user_type == '1') {

            if (Auth::attempt(['identity_number' => $request->identity_number, 'password' => $request->password])) {
                $doctors = Auth::user();

                if ($doctors->status == '1') {
                    Token::where('user_id', $doctors->id)->delete();

                    $success['token'] =  $doctors->createToken('token')->accessToken;
                    $success['id'] = $doctors->id;
                    $success['name'] = $doctors->first_name . ' ' . $doctors->last_name;
                    return $this->sendResponse($success, 'User login successfully.');
                } else {
                    return $this->sendErrorResponse('inactive', 'Your account is inactive please contact to admin');
                }
            } else {
                return $this->sendErrorResponse('Unauthorised', 'Your identity number or password is wrong');
            }
        } else {
            $role = 5; // Client
            if (Auth::attempt(['identity_number' => $request->identity_number, 'password' => $request->password, 'role_id' => $role])) {

                $patient = Auth::user();
                $checkRASComplated = PatientRasMaster::where(['patient_id' => $patient->id, 'test_type' => '0'])->count();
                if ($patient->status == '1') {
                    Token::where('user_id', $patient->id)->delete();
                    if ($checkRASComplated == 0) {
                        $iscompleted = false;
                    } else {

                        $iscompleted = true;
                    }
                    $success['token'] =  $patient->createToken('token')->accessToken;
                    $success['id'] = $patient->id;
                    $success['name'] = $patient->first_name . ' ' . $patient->last_name;
                    $success['ras_complated'] = $iscompleted;
                    return $this->sendResponse($success, 'User login successfully.');
                } else {
                    if ($patient->status == '0') {
                        return $this->sendErrorResponse('inactive', 'Your account is inactive please contact to admin');
                    }
                    return $this->sendErrorResponse('inactive', 'Your RAS submited and under review please contact to admin');
                }
            } else {
                return $this->sendErrorResponse('Unauthorised', 'Your identity number or password is wrong');
            }
        }
    }

    public function forgotPassword(ForgotPassword $request)
    {
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $mailIs = Mail::send('email.forgetPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });


        if ($mailIs) {
            return $this->sendResponse('successfully', 'We have e-mailed your password reset link!');
        }
        return $this->sendErrorResponse('error', 'Something went wrong');
    }
}
