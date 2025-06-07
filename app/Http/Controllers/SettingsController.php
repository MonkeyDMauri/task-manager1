<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function viewSettings() {
        return view('home.settings-view');
    }

    public function viewUpdateNamePage() {
        return view('home.update-info.update-name-view');
    }

    public function viewUpdateEmailPage() {
        return view('home.update-info.update-email-view');
    }

    public function updateName(Request $req) {
        $input = $req->validate([
            'name' => 'required|unique:users,name'
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $input['name']
        ]);

        return back()->with('success', 'your name has been updated');
    }

    public function updateEmail(Request $request) {
        $input = $request->validate([
            'email' => 'required|unique:users,email'
        ]);

        $user = auth()->user();

        $user->update([
            'email' => $input['email']
        ]);

        return back()->with('success', 'your email has been updated');
    }

    public function viewUpdatePassword() {
        return view('home.update-info.update-password-view');
    }

    public function updatePassword(Request $request) {
        $input = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $user = auth()->user();

        // verifying current password.
        if (!Hash::check($input['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'wrong password']);
        }


        $user->forceFill([
            'password' => Hash::make($input['new_password'])
        ]);

        $user->save();

        return back()->with('success', 'your password has changed');
    }
}

