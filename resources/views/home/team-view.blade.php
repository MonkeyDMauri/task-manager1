<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="team_id" content="{{$team->id}}">
    <title>Team Overview</title>
    @vite('resources/js/app.js')
</head>
<body class="team-view">
    <div class="team-overview-wrapper">
        <span onclick="window.location.href='/manager-dashboard#teams'"><-</span>
        <h1>Team Overview</h1>
        <div style="display:flex; gap:2rem; padding:1rem;">
            <div>
                <label for="">ID</label>
                <h2>{{$team->id}}</h2>
            </div>
            <div>
                <label for="">Name</label>
                <h2>{{$team->name}}</h2>
            </div>
            <div>
                <label for="">Description</label>
                <p>{{$team->description}}</p>
            </div>
            <div>
                <label for="">Manager</label>
                <h2>{{$team->manager->name}}</h2>
            </div>
            <div>
                <label for="">Created on</label>
                <h2>{{$team->created_at}}</h2>
            </div>
            <div>
                <label for="">Last updated on</label>
                <h2>{{$team->updated_at}}</h2>
            </div>
        </div>
        
        <div class=team-option>
            <button class="add-members">Add Members</button>

            <form action="/delete-team" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name='team_id' value="{{$team->id}}">
                <button>Delete Team</button>
            </form>
            
        </div>
        @if(session('message'))
            <p style="font-size: 1.5rem; font-weight:500;">{{session('message')}}</p>
        @endif
    </div>

    <div class="employees-wrapper">
        <div class="employees-wrap">
            <h1>Employees</h1>
            <hr>
            <ul class="employees-list">
                {{-- employees go here --}}
            </ul>
        </div>
    </div>

    <div class="team-members-wrapper">
        <div class="team-members-wrap">
            <h1>Team Members</h1>
            <hr>
            <ul class="team-members-list">
                {{-- team members go here --}}
            </ul>
        </div>
    </div>

    <div class="team-projects-wrapper">
        <div class="team-projects-wrap">
            <h1>Team Projects</h1>
            <hr>
            <ul class="team-projects-list">
                {{-- team projects members go here --}}
            </ul>
        </div>
    </div>
</body>
</html>