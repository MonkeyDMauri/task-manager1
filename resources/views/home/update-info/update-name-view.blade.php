<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings</title>
    @vite('resources/js/app.js')
</head>
<body class="manager-settings">
    <div class="settings-header-wrapper">
        <div style="display:flex; align-items:center; gap:.8rem;">
            <a href="{{route('settings.view')}}"><h2><-</h2></a>
            <h1>Settings</h1>
        </div><hr>
    </div>

    <div class="update-name-form-container">
        <form action="{{route('name.update')}}" method="POST">
            @csrf
            <div>
                <label for="name">Name</label>

                <input type="text" id="name" name="name" value="{{auth()->user()->name}}">
            </div>
            <button>save</button>
            @error('name')
                <p>{{$message}}</p>
            @enderror
            @if(session('success'))
                <p>{{session('success')}}</p>
            @endif
        </form>
    </div>
</body>
</html>