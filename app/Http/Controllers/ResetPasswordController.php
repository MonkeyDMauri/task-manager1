<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    public function create() {
        return view('auth.forgot-password');
    }

    
    public function store(Request $request) {
        $input = $request->validate([
            'email' => 'required|email'
        ]);

        // trying to send the email using Password::reset(email_to_send_reset_lint_to) then $status 
        // will be equal to what the function returns which could be an error message or a success message.
        $status = Password::sendResetLink($request->only('email'));

        // if $status is equal to the Password::RESET_LINK_SENT success message they're redirected to the login
        // page otherwise they are being sent back with error messages.
        return $status === Password::RESET_LINK_SENT ? back()->with('status', __($status)) : back()->withErrors((['email'=> __($status)]));
    }
}
