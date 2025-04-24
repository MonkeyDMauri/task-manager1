<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


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
        if (auth()->user()->id != $project['created_by']) {
            return abort(403, 'You dont have permissions to see this project');
        }
        return view('home.project-view', ['project' => $project]);
    }

    public function updateProject(Project $project, Request $request) {

        $input = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => ['required', Rule::in('done', 'pending')],
            'priority' => ['required', Rule::in('low', 'medium', 'high', 'urgent')],
            'start_date' => ['required', 'date'],
            'due_date' => 'required|date'
        ]);

        $project->update($input);
        $project->save();

        return back()->with('success', 'This project has been updated');
    }
}
