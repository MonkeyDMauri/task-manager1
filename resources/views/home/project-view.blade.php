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
    
    <div class="project-container">
        <div class="project-view-header">
            <h1 style="font-size: 2.5rem;">Project overview</h1>
            <form action="{{route('redirect.user')}}" method="GET">
                <button><-back</button>
            </form>
        </div>
        <form action="/update-project/{{$project['id']}}" method='GET'>
            <div class="project-details">            
                

                <div>
                    <label for="">Project name</label><br>
                    <input type="text" name="name" value="{{$project['name']}}">
                </div>
                <div>
                    <label for="">Description</label><br>
                    <input type="text" name="description" value="{{$project['description']}}">
                </div>
                <div>
                    <label for="">Status</label><br>
                    <input type="text" name="status" value="{{$project['status']}}">
                </div>
                <div>
                    <label for="">Priority</label><br>
                    <input type="text" name="priority" value="{{$project['priority']}}">
                </div>
                <div>
                    <label for="">Creation date:</label><br>
                    <input type="date" name="created_at" value="{{$project['created_at']->format('Y-m-d')}}">
                </div>
                <div>
                    <label for="">Start date:</label><br>
                    <input type="date" name="start_date" value="{{$project['start_date']}}">
                </div>
                <div>
                    <label for="">Due date:</label><br>
                    <input type="date" name="due_date" value="{{$project['due_date']}}">
                </div>
                
                @if(!$project['completed_at'])
                    <p><b>Completed at:</b> <br>Not yet</p>
                @else
                    <p><b>Completed at:</b> <br>{{$project['completed_at']}}</p>
                @endif
            </div>

            <button class="project-update-btn">Save</button>
        </form>
    </div>
</body>
</html>