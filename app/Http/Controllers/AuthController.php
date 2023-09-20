<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use  App\Http\Requests\AdminLoginPost;
use Illuminate\Contracts\Session\Session;
use Carbon\Carbon;
use DB;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function index()
    {

        $data['js'] = ['login'];
        return view('auth.login', $data);
    }

    public function authenticate(AdminLoginPost $request)
    {

        $postData = [
            'email' => $request->email,
            'password' => $request->password
        ];


        if (Auth::attempt($postData)) {

            $user = Auth::user();

            if ($user->role_id == 1) {

                $sessionAdmin = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'role_id' => $user->role_id
                ];

                $request->session()->put(['admin' => $sessionAdmin]);
                toastr()->success('Login successfully !');
                return redirect()->route('admin.dashboard');
            } else if ($user->role_id == 2) {


                $sessionAdmin = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'image' => $user->image,
                    'role_id' => $user->role_id
                ];

                $request->session()->put(['admin' => $sessionAdmin]);
                toastr()->success('Login successfully !');
                return redirect()->route('staff.dashboard');
            } else if ($user->role_id == 3 || $user->role_id == 4) {


                $sessionAdmin = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'image' => $user->image,
                    'role_id' => $user->role_id
                ];

                $request->session()->put(['admin' => $sessionAdmin]);
                toastr()->success('Login successfully !');
                return redirect()->route('doctor.dashboard');
            }
        } else {
            toastr()->error('Email or password invalid !');

            return redirect()->route('login');
        }
    }



    public function forgot_password()
    {
        $data['js'] = ['forgot_password'];
        return view('auth.forgot_password', $data);
    }

    public function forgot_password_post(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

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

            toastr()->success('We have e-mailed your password reset link!');
            return redirect()->route('login');
        }
        toastr()->error('Something went wrong');
        return redirect()->route('forgot.password.get');
    }

    public function showResetPasswordForm($token)
    {
        $data['js'] = ['forgot_password'];
        $data['token'] = $token;
        return view('auth.forgetPasswordLink', $data);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);


        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => bcrypt($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        toastr()->success('Your password has been changed!');
        return redirect()->route('login');
    }

    public function check_email_is_registered(Request $request)
    {
        $user = User::where(['email' => $request->email])->get();

        if (count($user) > 0) {

            $return =  true;
        } else {
            $return = false;
        }
        echo json_encode($return);
        exit;
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toastr()->info('You have logged out successfully!');
        return redirect()->route('login');
    }
}
