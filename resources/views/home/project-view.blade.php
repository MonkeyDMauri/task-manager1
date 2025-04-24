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
        <div class="project-view-flex">
            <form action="/update-project/{{$project['id']}}" method='POST'>
                @csrf
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
                    </div>
                    <div>
                        <p><b>Created at:</b> <br>{{$project['created_at']}}</p>                
                        <select name="priority" id="priority">
                            <option value="low">low</option>
                            <option value="medium">medium</option>
                            <option value="high">high</option>
                            <option value="urgent">urgent</option>
                        </select>
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

            <div class="comments-container">

            </div>
        </div>
        @if(session('success'))
            <p class="success">{{session('success')}}</p>
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p class="error">{{$error}}</p>
            @endforeach
        @endif
    </div>
</body>
</html>