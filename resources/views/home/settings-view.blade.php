<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manager Settings</title>
    @vite('resources/js/app.js')
</head>
<body class="manager-settings">
    <div class="settings-header-wrapper">
        <div style="display:flex; align-items:center; gap:.8rem;">
            <a href="{{route('manager.dashboard')}}"><h2><-</h2></a>
            <h1>Settings</h1>
        </div><hr>
    </div>

    <div class="personal-info-wrapper">

        <div class="personal-info-title-wrapper">
            <div>
                <h1>Personal Info</h1>
                <p>Information about you and your account</p>
            </div>
        </div>

        <div class="basic-personal-info-wrapper">
            <div class="basic-personal-info-title">
                <h1>Basic Info</h1>
                <p>Some of this information might be visible to other people using this platform</p>
            </div>

            <div class="info-piece-wrapper">
                <div class="info-piece ip1">
                    <span>
                        <h1>ID</h1>
                    </span>
                    <span>
                        <h1>{{auth()->user()->id}}</h1>
                    </span>
                    <span class="click-2-see-info">
                        {{-- <a href=""><h1>-></h1></a> --}}
                    </span>
                </div>
                <div class="info-piece ip1">
                    <span>
                        <h1>Name</h1>
                    </span>
                    <span>
                        <h1>{{auth()->user()->name}}</h1>
                    </span>
                    <span class="click-2-see-info">
                        <a href="{{route('settings.update.name')}}"><h1>-></h1></a>
                    </span>
                </div>
                <hr>
                <div class="info-piece ip2">
                    <span>
                        <h1>Email</h1>
                    </span>
                    <span>
                        <h1>{{auth()->user()->email}}</h1>
                    </span>
                    <span class="click-2-see-info">
                        <a href="{{route('settings.update.email')}}"><h1>-></h1></a>
                    </span>   
                </div>
                <hr>
                <div class="info-piece ip3">
                    <span>
                        <h1>Password</h1>
                    </span>
                    <span>
                        <h1>****</h1>
                    </span>
                    <span class="click-2-see-info">
                        <a href="{{route("settings.update.password")}}"><h1>-></h1></a>
                    </span>
                </div>
                <div class="info-piece ip3">
                    <span>
                        <h1>Role</h1>
                    </span>
                    <span>
                        <h1>{{auth()->user()->role}}</h1>
                    </span>
                    <span class="click-2-see-info">
                        
                    </span>
                </div>

                <div class="info-piece ip3">
                    <span>
                        <h1>created on</h1>
                    </span>
                    <span>
                        <h1>{{auth()->user()->formattedCreatedAt()}}</h1>
                    </span>
                    <span class="click-2-see-info">
                        
                    </span>
                </div>

                <div class="info-piece ip3">
                    <span>
                        <h1>last updated</h1>
                    </span>
                    <span>
                        <h1>{{auth()->user()->formattedUpdateAt()}}</h1>
                    </span>
                    <span class="click-2-see-info">
                        
                    </span>
                </div>
            </div>
            
        </div>
    </div>
    
</body>
</html>