<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>home page</title>
    @vite('resources/js/app.js')
</head>
<body class="manager-page">
    <nav class="nav-bar">
        <div>
            <h1>Manager Page</h1>
            <h2>Welcome {{auth()->user()->name}}!</h2>
        </div>

        <ul class="nav-links">
            <li>team</li>
            <li>projects</li>
            <li>settings</li>
            <li>Logout</li>
        </ul>
    </nav>

    <div class="logout-popup-wrapper">
        <div class="logout-popup-wrap">
            <h1>Do you wanna logout?</h1>
            <div style="display: flex; justify-content:center; gap:2rem;">
                <button class="logout-yes logout-btn-op">Yes</button>
                <button class="logout-no logout-btn-op">No</button>
            </div>
        </div>
    </div>
</body>
</html>