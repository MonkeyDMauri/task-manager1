<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update password</title>
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
        <form action="{{route('password.update')}}" method="POST">
            @csrf
            <div class="tuf">
                <div>
                    <label for="password">Enter current password</label><br>
                    <input type="password" id="password" name="current_password">
                </div>
                <div>
                    <label for="new-password">New password</label><br>
                    <input type="password" id="new-password" name="new_password">
                </div>
                <div>
                    <label for="new-password">Confirm password</label><br>
                    <input type="password" id="new-password" name="new_password_confirmation">
                </div>
                
            </div>
            <button>save</button>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            @endif
            @if(session('success'))
                <p>{{session('success')}}</p>
            @endif
        </form>
    </div>
</body>
</html>