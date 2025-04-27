<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\ResetPasswordController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// To return to sign in page.
Route::get('/', function () {
    return view('login_signin.signin');
});

// Go to login page.
Route::get('/login', function() {
    return view('login_signin.login');
});

// Route to sign user in.
Route::post('/signin', [UserController::class, 'signin']);

// to login user in and create session.
Route::post('/login', [UserController::class, 'login']);

//Logout route.
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// ** RESET PASSWORD ROUTES **
Route::get('/forgot-password', [ResetPasswordController::class, 'create'])->name('password.request');

Route::post('/forgot-password', [ResetPasswordController::class, 'store'])->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');

// Route to call method that will redirect user to correct page depending on their role.
Route::get('/redirect-user', [DashboardController::class, 'takeUserToRightPage'])->name('redirect.user');

Route::get('/manager-dashboard', function () {
    return view('home.manager-home');
})->name('manager.dashboard');

Route::get('/employee-dashboard', function () {
    return view('home.employee-home');
})->name('employee.dashboard');

// Create project routes.
Route::post('/create-project', [ProjectController::class, 'createProject'])->name('project.create');

// Get all projects route.
Route::get('/get-projects', [ProjectController::class, 'getProjects']);

// View project.
Route::get('/project/{project}', [ProjectController::class, 'viewProject']);


//Route to update project details.
Route::post('/update-project/{project}', [ProjectController::class, 'updateProject'])->name('project.update');

//Route to view employees.
Route::get('/view-employees', [EmployeeController::class, 'viewEmployees'])->name('view.employees');

//Route to create project.
Route::post('/create-task', [TaskController::class, 'createTask'])->name('create.task');

//Route to get a project's tasks.
Route::post('/get-tasks', [TaskController::class, 'getTasks']);