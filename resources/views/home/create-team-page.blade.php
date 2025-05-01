<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Team</title>
    @vite('resources/js/app.js')
</head>
<body class="manager-page">
    <div class="create-team-wrapper">
        <span style="font-size: 2rem; margin:0;"><a href="{{route('manager.dashboard')}}"><-</a></span>
        <h1>Create new team</h1>
        <form action="{{route('team.create')}}" method="POST" class="create-team-form">
            @csrf
            <div>
                <label for="team-name">Name</label>
                <br>
                <input type="text" name="name" placeholder="Enter a name..." id="team-name">
            </div>
            <div>
                <label for="team-description">Description</label>
                <br>
                <textarea name="description" id="team-description">SC team</textarea>
            </div>
            <button class="create-team-btn">Create</button>
        </form>
        @if(session('team created'))
            <p>{{session('team created')}}</p>
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
        @endif
    </div>
</body>
</html>