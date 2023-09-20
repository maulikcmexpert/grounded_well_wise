<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;


class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    protected $redirectTo = '/';

    protected function broker()
    {
        return Password::broker('users'); // Use the correct broker name (default is 'users')
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? back()->with('status', __($response))
            : back()->withErrors(['email' => __($response)]);
    }
}
