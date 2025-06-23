<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="current-team-id" content="{{$team->id}}">
    <title>Team Overview</title>
    @vite('resources/js/app.js')
</head>
<body class="team-overview-employee">
    <header>
        <div>
            <div style="display: flex; gap:1.1rem;">
                <button style="cursor: pointer;" onclick="window.location.href='/employee-dashboard'"><-</button>
                <h1>Team Overview</h1>
            </div>
            
            <p>Welcome {{auth()->user()->email}}</p>
        </div>
    </header>

    <section class="team-info-wrapper">
        <div class="team-info-wrap">
            <div class="team-info-wrap-header">
                <div class="team-data-piece">
                    <h2>Name:</h2>
                    <p>{{$team->name}}</p>
                </div>
                <div class="team-data-piece">
                    <h2>ID:</h2>
                    <p>{{$team->id}}</p>
                </div>
                <div class="team-data-piece">
                    <h2>Manager:</h2>
                    <p>{{$team->manager}}</p>
                </div>
                <div class="team-data-piece">
                    <h2>Created on:</h2>
                    <p>{{$team->created_at}}</p>
                </div>
            </div>

            <div class="team-description-wrap">
                <h1>Description</h1>
                <span class="description">
                    {{$team->description}}
                </span>
            </div>

            <div class="actions-wrapper">
                <h1 style="font-size: 1.5rem; font-weight:500;">Actions</h1>
                <div class="actions-list">
                    <button class="action-btn leave-team-btn">Leave</button>
                </div>
                
            </div>

            <hr>

            <div class="team-members-wrapper">
                <h1 style="font-size:2rem; font-weight:500;">Members</h1>
                <div class="members-list">
                    @foreach($team->members as $member)
                    <div class="member-card">
                        <p>{{$member->name}}</p>
                        <p>{{$member->email}}</p>
                    </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="leave-team-popup-wrapper">
        <div class="leave-team-popup-wrap">
            <h1>Leave this team?</h1>
            <div class="leave-team-btns-wrapper">
                <button class="leave-yes">yes</button>
                <button class="leave-no">no</button>
            </div>
        </div>
    </div>
</body>
</html>