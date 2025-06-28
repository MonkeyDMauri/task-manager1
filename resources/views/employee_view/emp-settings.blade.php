<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings</title>
    @vite('resources/js/app.js')
</head>
<body class="employee-settings">
    <header>
        <div class="header-title-container">
            <span><a href="/employee-dashboard"><-</a></span>
            <h1>Employee Settings</h1>
        </div>
    </header>

    <div class="settings-title-container">
        <h1>My Info</h1>
        <p>update my info</p>
    </div>

    <div class="update-info-option-container">
        <div class="option-dropdown">
            <h1>Name:</h1>
            <h2>{{auth()->user()->name}}</h2>
            <button class="update-info-btn">update</button>
            <div class="option-dropdown-form">
                <form action="">
                    <h1>Update your name</h1>
                    <div class="input-fields-container">
                        <input type="text" name="new_name" placeholder="New name..">
                        <br>
                        <button class="save-btn">save</button>
                    </div>
                    
                </form>
                
            </div>
        </div>
        <div class="option-dropdown">
            <h1>Email:</h1>
            <h2>{{auth()->user()->email}}</h2>
            <button class="update-info-btn">update</button>
            <div class="option-dropdown-form">
                <form action="">
                    <h1>Update your email</h1>
                    <div class="input-fields-container">
                        <input type="email" name="new_email" placeholder="New email..">
                    
                        <button class="save-btn">save</button>
                    </div>
                    
                </form>
                
            </div>
        </div>
        <div class="option-dropdown">
            <h1>Password:</h1>
            <h2>*****</h2>
            <button class="update-info-btn">update</button>
            <div class="option-dropdown-form">
                <form action="">
                    <h1>Update your password</h1>
                    <div class="input-fields-container">
                        <input type="email" name="password" placeholder="Current password">
                    
                        <input type="email" name="new_password" placeholder="New password">
                        
                        <input type="email" name="new_password_confirmation" placeholder="Confirm new password ">

                        <button class="save-btn">save</button>
                    </div>
                    
                </form>
                
            </div>
        </div>
    </div>
</body>
</html>