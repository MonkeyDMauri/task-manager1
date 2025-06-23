<?php

namespace App\Http\Controllers;

use App\Models\Team;
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

    // this logout is for when an employee logs out from employee home page.
    public function logoutFromEmployeePage(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'logout was successfull']);

    }
    public function getTeams() {
        
        $user = User::findOrFail(auth()->user()->id);

        $teams = $user->teams()->get();

        foreach($teams as $team) {
            $team->owner = $team->manager ? $team->manager->name : 'Not defined';
            $team->formatted_created_at = $team->formattedCreatedAt();
        }

        return response()->json(['teams' => $teams]);
    }

    public function getTasks() {
        $user = auth()->user();

        $tasks = $user->tasks;

        foreach($tasks as $task) {
            $task['project'] = $task->project;
            $task['created_at_formatted'] = $task->createdAt();
            $task['author'] = $task->owner ? $task->owner->name : 'Not Defined';
            $task['last_update'] = $task->formatedLastUpdate();
        }

        return response()->json(['tasks' => $tasks]);
    }

    public function leaveTeam(Request $request) {

        // getting json data
        $input = $request->json()->all();

        // getting current User instance model
        $user = auth()->user();

        

        // also deleting tasks that belong to any of this team's project.
        $tasks = $user->tasks;

        // Team model instance
        $team = Team::findOrFail($input['teamId']);

        // an array of the all project belongint to the team the user wants to leave.
        $projects = $team->projects;
        
        // looping thru every task and then thru every project,
        foreach($tasks as $task) {
            foreach($projects as $project) {
                // if the project id is equal to the id of the project that a task belongs to
                // then it means this task was part of a project belonging to the team they user is leaving therefore,
                // we have to change the assignation of this task, so the user does not have any tasks related to the team the are no longer
                // going to be part of.
                if ($task->project->id == $project->id) {
                    $task->update([
                        'assigned_to' => NULL,
                        'completed_by' => NULL
                    ]);

                    $task->save();
                }
            }
        }

        // removing the relationship between this user and the specified team by detaching the record from the team_user pivot table
        $user->teams()->detach($input['teamId']);

        // returning a response.
        return response()->json(['success' => true,
                                 'tasks' => $tasks, 
                                 'team' => $team->name, 
                                 'projects' => $projects
                                 ]);
    }
}
