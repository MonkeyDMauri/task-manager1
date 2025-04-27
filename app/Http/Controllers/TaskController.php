<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function createTask(Request $request) {

        $input = $request->validate([
            'name' => 'required',
            'priority' => ['required', Rule::in('low', 'medium', 'high', 'urgent')],
            'project_id' => 'required'
        ]);

        $input['description'] = $request->input('description');


        Task::create($input);

        // return redirect('/project', ['id' => $input['project_id']])->with('success', 'Task was created successfully');
        return back()->with('task-created', 'new task created successfully');
    }

    public function getTasksUsingModelRelationship(Request $request) {

        // grabbing project ID from the request object.
        $projectId = $request->input('projectId');

        // getting the project intance model based on the project id.
        $project = Project::findOrFail($projectId);

        // using the model relationship method in the project model to access 
        // the one-to-many relationship to get all tasks.
        $tasks = $project->tasks;

        return response()->json(['success' => true, 'tasks' => $tasks]);
    }

    public function getTasks(Request $request) {

        // grabbing project ID from the request object.
        $projectId = $request->input('projectId');

        // getting all task intances depending on the project ID
        $tasks = Task::where('project_id', $projectId)->get();

        // formatting the created at data value for each retreived instance.
        foreach($tasks as $task) {
            //getting formatted data and storing it in a new variable inside the task instance we are sending as a response.
            $task->formatted_created_at = $task->createdAt();
            //getting the name of the employee assigned to do this task and storing it in a new variable inside the task instance we are sending as a response.
            $task->assigned_employee = $task->assignedUser ? $task->assignedUser->name : NULL;
        }

        return response()->json(['success' => true, 'tasks' => $tasks]);
    }
}
