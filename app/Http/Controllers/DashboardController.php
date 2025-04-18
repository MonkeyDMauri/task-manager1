<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function takeUserToRightPage() {
        $role = auth()->user()->role;

        return match ($role) {
            'manager' => redirect()->route('manager.dashboard'),
            'employee' => redirect()->route('employee.dashboard'),
            default => abort(403)
        };
    }
}
