<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;


class ProjectController extends Controller
{
    public function createProject(Request $request) {
        $input = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
            'priority' => 'required',
            'auto_complete' => 'required'
        ]);

        // converting the auto_cpmplete value into a boolean value since thats what the table expects this column to be
        $input['auto_complete'] = (bool) $input['auto_complete'];
        $input['created_by'] = auth()->user()->id;

        $project = Project::create($input);
        
        return back()->with('project-success', 'project was successfully created');
    }

    // function to get all projects.
    public function getProjects()
    { 
        // getting all instances of the Project model.
        $projects = Project::where('created_by', auth()->user()->id)->get();

        return response()->json(['success' => true, 'projects' => $projects]);
    }

    public function viewProject(Project $project) {
        // if ($project['completed_at']) {
        //     $project->update([
        //         'completed_at' => 
        //     ]);
        // }
        return view('home.project-view', ['project' => $project]);
    }

    public function updateProject(Project $project) {
        return $project['name'];
    }
}
