<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function signin(Request $request) {
        $input = $request->validate([
            'name' => 'required|string|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:4'
        ]);

        $user = User::create($input);

        return back()->with('success', 'your account has been created, Welcome ' . $input['name'] . '!');
    }

    public function login(Request $request) {
        $input = $request->validate([
            'name' => 'required|string',
            'password' => 'required'
        ]);

        if (auth()->attempt(['name' => $input['name'], 'password' => $input['password']])) {
            // $request->session()->regenerateId(); function is already called undet the hood.

            return redirect()->route('redirect.user');
        } else {
            return back()->with('error', 'your username or password is wrong, please try again.');
        }
    }

    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return view('login_signin.login');
    }
    public function getTeams() {
        
        $user = User::findOrFail(auth()->user()->id);

        $teams = $user->teams()->get();

        return response()->json(['teams' => $teams]);
    }
}
