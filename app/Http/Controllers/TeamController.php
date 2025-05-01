<?php

namespace App\Http\Controllers;

use App\Models\Team;
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
}
