<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>
<body class="login-signin-page">

    <h1 style="color: aliceblue; font-size:2rem; text-align:center; margin-top:2rem;">Project Manager Platform</h1>
    
    @yield('signin')
    @yield('login')
    @yield('reset_password')
</body>
</html>