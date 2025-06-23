<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // create team
    public function createTeam(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'required'
        ]);

        $data['manager_id'] = auth()->user()->id;

        Team::create($data);

        return back()->with('team created', 'new team created successfully');
    }

    // retreive teams.
    public function getTeams() {
        $teams = Team::where('manager_id', auth()->user()->id)->get();

        foreach($teams as $team) {
            $team->owner = $team->manager ? $team->manager->name : NULL;
        }

        return response()->json(['teams' => $teams]);
    }

    // view a team.
    public function viewTeam(Team $team) {

        return $team->manager_id != auth()->user()->id ? abort(403, 'you dont have permission to see this team') : view('home.team-view', ['team' => $team]);
    }

    // function to add a new team member.
    public function addTeamMember(Request $request) {
        $request->validate([
            'emp_id' => 'required',
            'team_id' => 'required',
            '_token' => 'required' //for some reason laravel expects the csrf token to be named _token.
        ]);

        $teamId = $request->input('team_id');

        // getting user instance model.
        $employee = User::findOrFail($request->input('emp_id'));

        //chcking if user is not part of a team already.
        if ($employee->teams()->where('team_id', $teamId)->exists()){
            return back()->with('message', 'Sorry, this user is already part of this team');
        } else {
            $employee->teams()->attach($teamId);
        }

        return back()->with('message', 'you added a new team member!');
    }

    public function removeMember(Request $request) {
        $member = User::findOrFail($request->memberId);

        $member->teams()->detach($request->teamId);

        return response()->json(['success' => true, 'member' => $request->memberId]);
    }

    public function getMembers(Team $team) {

        $members = $team->members;

        return response()->json(['members' => $members]);
    }

    public function getMembersByProject(Project $project) {
        // team instance this project belongs to.
        $team = Team::findOrFail($project->team_id);

        // getting team members.
        $members = $team->members;

        // returning a response.
        return response()->json(['members' => $members]);
    }

    public function getTeamProjects(Team $team) {

        //Accessing 2 relationships at once.
        //This way each project instance has an attribute which is a colletion of tasks(if any).
        $projects = $team->projects()->with('tasks')->get();

        //Adding an extra attribute to each project instance to see how many 
        //tasks it has a return the number of tasks.
        foreach($projects as $project) {
            $project->number_of_tasks = $project->tasks->count();
        }

        return response()->json(['projects' => $projects]);
    }

    //delete team.
    public function deleteTeam(Request $request) {

        $request->validate([
            'team_id' => 'required'
        ]);

        $team = Team::findOrFail($request->team_id);

        $team->delete();

        return redirect('/manager-dashboard');
    }

    // when this function is called, the user is redeirected to a team overiew but from the perspective of an employee meaning
    // they have less options unlike a manager.
    function teamOverviewEmployeeView(Team $team) {
        
        // Checking if current user belongs to the team they wanna check out.

        // First we grab current user.
        $user = auth()->user();

        // checking if the team they wanna visit is part of the teams the current user is part of.
        if ($user->teams->contains($team)) {

            $team->manager = $team->manager ? $team->manager->name : 'undefined';

            return view('employee_view.team-overview', ['team' => $team]);
        }

        // if the previous if statement was not true (checking if user is part of the team they wanna see) then it means they dont
        // have access to see this team so we send an abort message.
        return abort('403', 'you dont have access to this team');
    }
}
