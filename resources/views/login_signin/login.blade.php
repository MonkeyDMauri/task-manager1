@extends('layouts/registration_layout')

@section('login')
<div class="ls-wrapper">
    <div class="ls-wrap">
        <h1>Log In</h1>
        <form action="/login" method="POST">
            <div class="registration-form">
                @csrf
                <input type="text" name="name" placeholder="Username" class="registration-input" required>
                @error('name')
                    <p class="error-flash-mssg">{{$message}}</p>
                @enderror
                <br>
                <input type="password" name="password" placeholder="Password" class="registration-input" required><br>
                
                <div style="display:flex; justify-content:center; margin:1rem 0">
                    <button class="register-btn">Login</button>
                </div>
                <a href="{{route('password.request')}}"><p>Forgot password?</p></a>
                <a href="/" style="margin-top:.5rem;"><p>Don't have an account?</p></a>
            </div>
        </form>
    </div>
    @if(session('error'))
        <p class="error-flash-mssg">{{session('error')}}</p>
    @endif
</div>
@endsection