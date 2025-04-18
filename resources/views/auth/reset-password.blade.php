<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/js/app.js')
</head>
<body class="forgot-password">
    <div class="forgot-password-wrapper">
        <div class="forgot-password-wrap">
            <form action="{{route('password.update')}}" method="POST">
                <h1 style="font-size:2rem;">Enter your new password</h1>
                <div class="registration-form">
                    @csrf

                    <input type="hidden" name="token" value="{{$token}}">

                    <input type="text" name="email" placeholder="Enter Email" class="registration-input" required>
                    @error('email')
                        <p class="error-flash-mssg">{{$message}}</p>
                    @enderror

                    <br>

                    <input type="password" name="password" placeholder="Enter new password" class="registration-input" required>
                    @error('new_password')
                        <p class="error-flash-mssg">{{$message}}</p>
                    @enderror

                    <br>

                    <input type="password" name="password_confirmation" placeholder="Confirm password" class="registration-input" required>
                    @error('new_password_confirmation')
                        <p class="error-flash-mssg">{{$message}}</p>
                    @enderror
                    <br>
                    <div style="display:flex; justify-content:center; margin:1rem 0">
                        <button class="register-btn">Update</button>
                    </div>
                    {{-- <a href="/login" style="margin-top:.5rem;"><p>Go back</p></a> --}}
                </div>
                {{-- @if(session('status'))
                    <p>{{session('status')}}</p>
                @endif
                @error('email')
                    <p>{{$message}}</p>
                @enderror --}}
            </form>
        </div>
    </div>
</body>
</html>