<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function viewManagerPage() {
        return view('home.manager-home');
    }

    public function ViewCreateTeamForm() {
        return view('home.create-team-page');
    }
}
