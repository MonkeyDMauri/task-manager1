<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Project View</title>
    @vite('resources/js/app.js')
</head>
<body class="project-view">
    <input type="hidden" class="project-id" value="{{$project['id']}}">
    
    <div class="project-container">
        @if(session('task-created'))
            <p>{{session('task-created')}}</p>

        @endif
        <div class="project-view-header">
            <h1 style="font-size: 2.5rem;">Project overview</h1>
            <form action="{{route('redirect.user')}}" method="GET">
                <button><-back</button>
            </form>
        </div>
        <div class="project-view-flex">
            <form action="/update-project/{{$project['id']}}" method='POST'>
                @csrf
                <div class="project-details">            
                    
                    <h1>Edit project</h1>
                    <hr>
                    <div>
                        <label for="">Project name</label><br>
                        <input type="text" name="name" value="{{$project['name']}}">
                    </div>
                    <div>
                        <label for="">Description</label><br>
                        <input type="text" name="description" value="{{$project['description']}}">
                    </div>
                    <div>
                        <label for="status">Status</label><br>
                        {{-- <input type="text" name="status" value="{{$project['status']}}"> --}}
                        <select name="status" id="status">
                            <option value="done">done</option>
                            <option value="pending">pending</option>
                        </select>
                    </div>
                    <div>
                        <label for="">Priority</label><br>
                        {{-- <input type="text" name="priority" value="{{$project['priority']}}"> --}}
                        <select name="priority" id="priority">
                            <option value="low">low</option>
                            <option value="medium">medium</option>
                            <option value="high">high</option>
                            <option value="urgent">urgent</option>
                        </select>
                    </div>
                    <div>
                        <p><b>Created at:</b> <br>{{$project['created_at']}}</p>
                    </div>
                    <div>
                        <label for="">Start date:</label><br>
                        <input type="date" name="start_date" value="{{$project['start_date']}}" min="{{date('Y-m-d')}}">
                    </div>
                    <div>
                        <label for="">Due date:</label><br>
                        <input type="date" name="due_date" value="{{$project['due_date']}}" min="{{date('Y-m-d')}}">
                    </div>
                    
                    @if(!$project['completed_at'])
                        <p><b>Completed at:</b> <br>Not yet</p>
                    @else
                        <p><b>Completed at:</b> <br>{{$project['completed_at']}}</p>
                    @endif

                    <button class="project-update-btn">Save</button>
                </div> 
            </form>

            <div class="tasks-wrapper">
                <h1 class="header-name">Tasks</h1>
                <hr>
                <ul class="tasks-container">
                    {{-- tasks will go here and get collected using javascript API fetch request --}}
                </ul>
            </div>
        </div>
        {{-- success or error messages --}}
        @if(session('success'))
            <p class="success">{{session('success')}}</p>
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="error">{{$error}}</p>
            @endforeach
        @endif
    </div>

    <div class="preview-view-flex" style="padding:2rem;">
        <div class="create-task-form-container">
            <form action="{{route('create.task')}}" method="POST">
                @csrf
                <input type="hidden" name="project_id" value="{{$project['id']}}">
                <h1 class="header-name">Create a task</h1>
                <hr>
                <div>
                    <label for="task-name">Name</label>
                    <br>
                    <input type="text" name="name" id="task-name" placeholder="Give your project a name">
                </div>
                <div>
                    <label for="task-description">Description</label>
                    <br>
                    <textarea name="description" id="task-description">this is an easy task</textarea>
                </div>
                <div>
                    <label for="task-priority">Priority</label>
                    <br>
                    <select name="priority" id="task-priority">
                        <option value="low">low</option>
                        <option value="medium">medium</option>
                        <option value="high">high</option>
                        <option value="urgent">urgent</option>
                    </select>
                    <br>
                    <button>Create Task</button>
                </div>
            </form>
        </div>
        <div class="assign-task-form-container">
            <form action="">
                <h1 class="header-name">Assign task</h1>
                <hr>
                <div>
                    <label for="task-id">Task ID</label>
                    <br>
                    <input type="number" name="task_id" id="task-id" min=1>
                </div>
                <div>
                    <label for="employee-id">Employee ID</label>
                    <br>
                    <input type="number" name="employee_id" id="employee-id" min=1>
                </div>
                <button>Assign Task</button>
                <br><br>
                
                <a href="{{route('view.employees')}}"><p class="view-employees-link">View Employees</p></a>
            </form>
        </div>
    </div>
    
</body>
</html>