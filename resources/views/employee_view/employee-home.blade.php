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
            <li><a href="#tasks">Tasks</a></li>
            <li><a href="#teams">Teams</a></li>
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

    <div class="random-intro-container">
        <div class="random-intro-wrap">
            <h1>An easy way to manage your tasks</h1>
            <hr>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Mollitia ullam, repellat 
                ducimus perferendis officiis facilis culpa soluta voluptatibus quas deserunt suscipit aliquam repellendus minima impedit possimus provident
                 blanditiis illum dicta!
            </p>

            <img class="intro-img" src="{{asset('images/intro-img.jpeg')}}" alt="intro image">

        </div>
    </div>

    <section class="tasks-section" id="tasks">

        <div class="tasks-section-header">
                <h1>My Tasks</h1>
                <div class="search-bar-wrapper">
                    <label for="search-task">Search by name</label>
                    <input type="text" id="search-task" placeholder="Type something...">
                    <button class="clear-search-btn">X</button>

                    <div>
                        <label for="searchBy">search by</label>
                        <select id="searchBy">
                            <option value="name">name</option>
                            <option value="project">project</option>
                            <option value="author">author</option>
                        </select>
                    </div>
                    
                </div>

        </div>

        <hr>
        <div class="tasks-wrapper">

            <table class="tasks-list-table">
                <caption>Tasks Table</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Project</th>
                        <th>Description</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>Created at</th>
                        <th>Last Update</th>
                    </tr>
                </thead>
                <tbody class="tasks-table-body">
                {{-- this will be filled using JS --}}
                </tbody>
            </table>
        </div>

    </section>

    <section class="teams-section" id="teams">
        <div class="teams-section-header">
            <h1>Teams you are part of</h1>
        </div>

        <div class="search-teams-wrapper">
            <label for="search-team">Search</label>
            <input type="text" id="search-team" placeholder="Search team by name...">
            <button class="clear-search-team-bar">X</button>
        </div>
        <hr>
        <table class="teams-table">
            <caption>Teams</caption>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Owner</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody class="teams-table-body">
                {{-- teams go here and displayed using JS --}}
            </tbody>
        </table>
    </section>
</body>
</html>