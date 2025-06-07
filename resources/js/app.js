import './bootstrap';
import '../css/app.css';

// EMPLOYEE IMPORTS

//login & signin page
if (document.querySelector('body.login-signin-page')) {
    import('../css/login_signin.css');
}

// forgot password page
if (document.querySelector('body.forgot-password')) {
    import('../css/reset_password.css');
}

// manager page
if (document.querySelector('body.manager-page')) {
    import('../css/manager-page.css');
    import('./manager-page.js');
}

// project & task page
if (document.querySelector('body.project-view')) {
    import('../css/project-view.css');
    import('./project_script.js');
}


// team page
if (document.querySelector('body.team-view')) {
    import('../css/manager-page.css');
    import('./team-view.js');
}


if (document.querySelector('body.task-view')) {
    import('./task.js');
    import('../css/task_styling.css');
}


if (document.querySelector('body.manager-settings')) {
    import('../css/manager-settings.css');
}

// EMPLOYEE IMPORTS

if (document.querySelector('body.employee-home')) {
    import('../css/employee-styling/employee-home-page.css');
    import('./employee/employee-home.js');
}