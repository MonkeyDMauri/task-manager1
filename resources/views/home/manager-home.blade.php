<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>home page</title>
    @vite('resources/js/app.js')
</head>
<body class="manager-page">
    <nav class="nav-bar">
        <div>
            <h1>Manager Center</h1>
            <h2>Welcome {{auth()->user()->name}}!</h2>
        </div>

        <ul class="nav-links">
            <li><a href="#teams">Teams</a></li>
            <li><a href="#projects">Projects</a></li>
            <li><a href="{{route('settings.view')}}">Settings</a></li>
            <li class="logout-btn">Logout</li>
        </ul>
    </nav>

    <div class="intro">
        <p>Create and manage your projects with ease and increase your productivity like never before! created by Mauricio Rodriguez.</p>
    </div>

    <section class="create-project-section">
        <h1>Create a new project</h1>
        <p>(Do not forget to create a team in case you don't have one)</p>
        <form action="{{route('project.create')}}" method="POST">
            @csrf
            <div class="create-project-form">
                <div class="create-project-inputs">
                    <div>
                        <label for="name">Project Name</label>
                        <br>
                        <input type="text" name="name" id="name" placeholder="Type something...">
                    </div>
    
                    <div>
                        <label for="desc">Description</label>
                        <br>
                        <textarea name="description" id="desc" class="project-description" placeholder="Add a description..."></textarea>
                    </div>
    
                    <div>
                        <label for="start-date">Start Date</label>
                        <br>
                        <input type="date" name="start_date" id="start-date" min={{date('Y-m-d')}}>
                    </div>
    
                    <div>
                        <label for="due-date">Due Date</label>
                        <br>
                        <input type="date" name="due_date" id="due-date" min={{date('Y-m-d')}}>
                    </div>

                    <div>
                        <label for="team-id">Team</label>
                        <br>
                        <select name="team_id" id="team-id" class="team-id-select">
                            {{-- manager's teams go here --}}
                        </select>
                    </div>
    
                    <div>
                        <label for="priority">Priority</label>
                        <br>
                        <select name="priority" id="priority" class="project-select">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="medium">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
    
                    <div>
                        <label for="auto-complete">Auto complete</label>
                        <br>
                        <select name="auto_complete" id="auto-complete" class="project-select">
                            <option value=1>true</option>
                            <option value=0>false</option>
                        </select>
                    </div>
                </div>
                <button class="create-project-btn">create</button>
                @if ($errors->any())
                <div class="errors">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li class="error">{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('project-success'))
                <p>{{session('project-success')}}</p>
            @endif
            </div>
            
        </form>
    </section>

    <section id="teams" class="teams-section">
        <h1 class="projects-title">Teams</h1>
        <div class="teams-wrapper">
            <ul class="teams-option-wrapper">
                <li><a href="/manager-dashboard/create-team">+ New Team</a></li>
                <li><a href="">- Delete Team</a></li>
            </ul>
            <hr>
            <br>
            <div class="teams-list-wrapper">
                <h1 style="font-size: 1.8rem;">Your teams</h1>
                <div class="teams-list-wrap">
                    {{-- list of teams go here --}}
                </div>
            </div>
        </div>
    </section>

    <section class="projects-section" id="projects">
        <h1 class="projects-title">Your Projects</h1>
        <ul class="projects-wrapper">
            {{-- projects go here --}}
        </ul>
    </section>

    <div class="logout-popup-wrapper">
        <div class="logout-popup-wrap">
            <h1>Do you wanna logout?</h1>
            <div style="display: flex; justify-content:center; gap:2rem;">
                <form action="{{route('logout')}}" method="GET">
                    <button class="logout-yes logout-btn-op">Yes</button>
                </form>
                
                <button class="logout-no logout-btn-op">No</button>
            </div>
        </div>
    </div>
</body>
</html>