<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class NewPasswordController extends Controller
{
    public function create($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function store(Request $request) {

        // validating input fields.
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4|confirmed'
        ]);

        // if validatio is successful then we use the Password::reset function to reset password.
        // first paramater is to verify that the reset password token is there, that theres a user in the users table matching 
        // the entered email address which will then return the user instance
        // it also verifies that password and password_confirmation match.
        $status = Password::reset(
            $request->only('token', 'email', 'password', 'password_confirmation'),
            function($user, $password) { // $user is equal to a user instance matching the email address.
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                // saving changes.
                $user->save();
            }

        );

        return $status === Password::PASSWORD_RESET ?
            redirect('/login')->with('success', __($status))
            : back()->withError(['email' => __($status)]);
    }
}
