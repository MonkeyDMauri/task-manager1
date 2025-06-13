<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
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
        $input['created_by'] = auth()->user()->id;


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
            $task->assigned_employee = $task->assignedUser ? $task->assignedUser->name : 'unassigned';
            $task->who_completed_it = $task->completedByUser ? $task->completedByUser->name : 'unassigned';

            $task->creator = $task->owner ? $task->owner->name : NULL; 
        }

        return response()->json(['success' => true, 'tasks' => $tasks]);
    }

    // assign a task to a user.
    public function assignTask(Request $request) {
        $request->validate([
            'task_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        $task = Task::findOrFail($request->task_id);

        // trying to retreive model intance of the task.
        $task = Task::where('id', $request->task_id)->first();

        // if it's NULL then we will redirect the user back with errors.
        if (!$task) {
            return back()->withErrors(['message' => 'No task with ID', $request->user_id ,'was found']);
        }
        // trying to retreive model intance of the user.
        $user = User::where('id', $request->user_id)->first();

        // if it's NULL then we will redirect the user back with errors.
        if (!$user) {
            return back()->withErrors(['message' => 'No user with ID', $request->user_id ,'was found']);
        }

        // if the task and user were able to be found then we update the task.
        $task->update([
            'assigned_to' => $request->user_id
        ]);


        // save update.
        $task->save();

        return back();
    }

    public function viewTask(Task $task) {

        // checking to see if the current logged in user should be able to see the task whose ID is being
        // retreived from URL
        if ($task->created_by !== auth()->user()->id) {
            // returning error message in case user is not supposed to be able to see task.
            return abort('403', 'you dont have permissions to see this');
        }

        $task->creator = $task->owner->name;

        return view('home.view-task', ['task' => $task]);
    }

    public function openTaskFromEmployeePage(Task $task) {

        // checking to see if the current logged in user should be able to see the task whose ID is being
        // retreived from URL
        if ($task->assigned_to != auth()->user()->id) {
            // returning error message in case user is not supposed to be able to see task.
            return abort('403', 'you dont have permissions to see this task');
        }

        return view('employee_view.task-view-emp', ['task' => $task]);
    }
}
