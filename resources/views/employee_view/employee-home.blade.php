<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Home page</title>
    @vite('resources/js/app.js')
</head>
<body class="employee-home">
    <nav class="employee-home-nav">
        <div>
            <h1>Welcome {{auth()->user()->name}}</h1>
            
            <p>{{auth()->user()->email}}</p>
        </div>

        <ul class="nav-links-wrapper">
            <li><a href="">Tasks</a></li>
            <li><a href="">something</a></li>
            <li><a href="">Settings</a></li>
            <li><button class="logout-btn">Logout</button></li>
        </ul>
    </nav>

    <div class="logout-popup-wrapper">
        <div class="logout-popup-wrap">
            <h1>Do you wanna logout?</h1>
            <div class="logout-btn-wrapper">
                <button class="logout-yes">Yes</button>
                <button class="logout-no">No</button>
            </div>
        </div>
    </div>

    <section class="tasks-section">

        <div class="tasks-section-header">
                <h1>My Tasks</h1>
                <div class="search-bar-wrapper">
                    <label for="search-task">Search by name</label>
                    <input type="text" id="search-task" placeholder="Type something...">
                    <button class="clear-search-btn">X</button>
                </div>
        </div>

<hr>
        <div class="tasks-wrapper">

            <ul class="tasks-list">
                {{-- this will be filled using JS --}}
            </ul>
        </div>

    </section>
</body>
</html>