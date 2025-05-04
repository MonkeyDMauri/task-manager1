<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
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

    public function getMembers(Team $team) {

        $members = $team->members;

        return response()->json(['members' => $members]);
    }
}
