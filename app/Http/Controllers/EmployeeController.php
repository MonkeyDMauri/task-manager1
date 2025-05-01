<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function viewEmployees(){
        return view('home.view-employees');
    }
}
