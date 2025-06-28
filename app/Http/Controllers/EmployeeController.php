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

        foreach($employees as $employee) {
            $employee->teams = $employee->teams ? $employee->teams : NULL;
        }

        return response()->json(['employees' => $employees]);
    }


    // go to employee settings (its different from the manager settings)
    public function openSettings() {
        return view('employee_view.emp-settings');
    }
}
