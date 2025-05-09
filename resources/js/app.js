import './bootstrap';
import '../css/app.css';

if (document.querySelector('body.login-signin-page')) {
    import('../css/login_signin.css');
}

if (document.querySelector('body.forgot-password')) {
    import('../css/reset_password.css');
}

if (document.querySelector('body.manager-page')) {
    import('../css/manager-page.css');
    import('./manager-page.js');
}

if (document.querySelector('body.project-view')) {
    import('../css/project-view.css');
    import('./project_script.js');
}

if (document.querySelector('body.team-view')) {
    import('../css/manager-page.css');
    import('./team-view.js');
}
