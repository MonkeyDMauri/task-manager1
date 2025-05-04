<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function viewEmployees(){
        return view('home.view-employees');
    }

    public function getEmployees() {
        $employees = User::where('role', 'employee')->get();

        return response()->json(['employees' => $employees]);
    }
}
