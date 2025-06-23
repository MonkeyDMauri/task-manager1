<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewPasswordController;


use App\Http\Controllers\ResetPasswordController;
use PhpParser\NodeVisitor\CommentAnnotatingVisitor;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// To return to sign in page.
Route::get('/', function () {
    return view('login_signin.signin');
});

// Go to login page.
Route::get('/login', function() {
    return view('login_signin.login');
});

Route::get('/logout-from-employee', [UserController::class, 'logoutFromEmployeePage']);

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

// Go to manager home page.
Route::get('/manager-dashboard', [ManagerController::class, 'viewManagerPage'])->name('manager.dashboard');

//Route to go to create team form.
Route::get('/manager-dashboard/create-team', [ManagerController::class, 'ViewCreateTeamForm']);

Route::get('/employee-dashboard', function () {
    return view('employee_view.employee-home');
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

// View tasks.
Route::get('/view-task/{task}', [TaskController::class, 'viewTask'])->name('view.task');

//Route to start task assignment process.
Route::post('/assign-task', [TaskController::class, 'assignTask']);

//Route to create team.
Route::post('/create-team-request', [TeamController::class, 'createTeam'])->name('team.create');

//Route to get al teams belonging to current manager.
Route::get('/get-teams', [TeamController::class, 'getTeams']);

//Route to view a team.
Route::get('/view-team/{team}', [TeamController::class, 'viewTeam']);

//Delete team.
Route::delete('/delete-team', [TeamController::class, 'deleteTeam']);

//Route to see users.
Route::get('/users-view', [EmployeeController::class, 'viewEmployees'])->name('users.employees');

//Route to get team members.
Route::get('/get-employees', [EmployeeController::class, 'getEmployees']);

//Route to get team members.
Route::get('/get-team-members/{team}', [TeamController::class, 'getMembers']);
Route::get('/get-members/{project}', [TeamController::class, 'getMembersByProject']);

//Route to add a user to a team.
Route::post('/add-user-to-team', [TeamController::class, 'addTeamMember']);

// This route will be for checking if a user is already in a team.
Route::get('/user-in-team/{user}', [UserController::class, 'checkIfUserAlreadyInTeam']);

Route::get('/get-team-projects/{team}', [TeamController::class, 'getTeamProjects']);

//Remove team member.
Route::post('/remove-member', [TeamController::class, 'removeMember']);

//Get comments for a task
Route::get('/get-comments/{task}', [CommentsController::class, 'getTaskComments']);

//Publish a comment.
Route::post('/publish-comment', [CommentsController::class, 'publishComment'])->name('comment.publish');

// Delete a comment.
Route::post('/delete-comment', [CommentsController::class, 'deleteComment']);


// Settings view.
Route::get('/settings-view', [SettingsController::class, 'viewSettings'])->name('settings.view');

// Update username view.
Route::get('/settings-view/update-name-view', [SettingsController::class, 'viewUpdateNamePage'])->name('settings.update.name');

// Update name.
Route::post('/settings-view/update-name-view/update-name', [SettingsController::class, 'updateName'])->name('name.update');

// Update email view
Route::get('/settings-view/update-email-view', [SettingsController::class, 'viewUpdateEmailPage'])->name('settings.update.email');

// update email.
Route::post('/settings-view/update-name-view/update-email', [SettingsController::class, 'updateEmail'])->name('email.update');

// update password view.
Route::get('/setings-view/update-password-view', [SettingsController::class, 'viewUpdatePassword'])->name('settings.update.password');

Route::post('/settings-view/update-name-view/update-password', [SettingsController::class, 'updatePassword'])->name('password.update');

/// ---

// EMPLOYEE RELATED ROUTES.

// Get tasks belonging to the currently logged in employee, so not all tasks will be retreived.
Route::post('/get-tasks-from-employee-view', [UserController::class, 'getTasks']);

// update task status using Laravel.
Route::get('/update-task-status', [TaskController::class, 'updateClassStatus'])->name('update.task.status');

// update task status using JS.
Route::get('/update-task-status-js/{task}', [TaskController::class, 'updateClassStatusUsingJS']);

// Get teams the current logged in employee is part of.
Route::get('/get-teams-employee', [UserController::class, 'getTeams']);

// Call method to see Team overview page.
Route::get('/team-overview/{team}', [TeamController::class, 'teamOverviewEmployeeView']);

Route::post('/leave-team', [UserController::class, 'leaveTeam']);

