<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Team Overview</title>
    @vite('resources/js/app.js')
</head>
<body class="manager-page">
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
            <a href="">Add members</a>
            <a href="">Delete team</a>
        </div>
    </div>
</body>
</html>