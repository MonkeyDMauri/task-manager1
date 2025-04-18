<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot password</title>
    @vite('resources/js/app.js')
</head>
<body class="forgot-password">
    
    <div class="forgot-password-wrapper">
        <div class="forgot-password-wrap">
            <form action="{{route('password.email')}}" method="POST">
                <h1 style="font-size:2rem;">Reset your password</h1>
                <div class="registration-form">
                    @csrf
                    <input type="text" name="email" placeholder="enter your email" class="registration-input" required>
                    @error('name')
                        <p class="error-flash-mssg">{{$message}}</p>
                    @enderror
                    <br>
                    <div style="display:flex; justify-content:center; margin:1rem 0">
                        <button class="register-btn">Send reset link</button>
                    </div>
                    <a href="/login" style="margin-top:.5rem;"><p>Go back</p></a>
                </div>
                @if(session('status'))
                    <p>{{session('status')}}</p>
                @endif
                @error('email')
                    <p>{{$message}}</p>
                @enderror
            </form>
        </div>
    </div>
</body>
</html>