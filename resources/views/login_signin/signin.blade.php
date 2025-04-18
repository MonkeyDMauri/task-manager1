
@extends('layouts/registration_layout')

@section('signin')
<div class="ls-wrapper">
    <div class="ls-wrap">
        <h1>Sign In</h1>
        <form action="/signin" method="POST">
            <div class="registration-form">
                @csrf
                <input type="text" name="name" placeholder="Username" class="registration-input" required>
                @error('name')
                    <p class="error-flash-mssg">{{$message}}</p>
                @enderror
                <br>

                <input type="text" name="email" placeholder="Email" class="registration-input" required>
                @error('email')
                    <p class="error-flash-mssg">{{$message}}</p>
                @enderror
                <br>
                <label for="role">Pick a role</label><br>
                <select name="role" id="role">
                    <option value="admin">Admin</option>
                    <option value="employee">Employee</option>
                </select>
                <br>
                <input type="password" name="password" placeholder="Password" class="registration-input" required>
                @error('password')
                    <p class="error-flash-mssg">{{$message}}</p>
                @enderror
                <br>
                <div style="display:flex; justify-content:center; margin:1rem 0">
                    <button class="register-btn">Sign In</button>
                </div>
                <a href="/login" style="margin-top:.5rem;"><p>Already have an account?</p></a>
            </div>
        </form>
    </div>
    @if(session('success'))
        <p class="succes-flash-mssg">{{session('success')}}</p>
    @endif
</div>
@endsection