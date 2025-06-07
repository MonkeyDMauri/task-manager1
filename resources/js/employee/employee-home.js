function _(element) {
    return document.querySelector(element);
}

// LOGOUT CODE

//buttons that will trigger the toggle function to show/hide the logout popup.
_('.logout-btn').addEventListener('click', toggleLogoutWrapper);
_('.logout-no').addEventListener('click', toggleLogoutWrapper);

function toggleLogoutWrapper() {
    const logoutWrapper = _('.logout-popup-wrapper');
    logoutWrapper.classList.toggle('show');
}

//if user clicks the yes button then we'll send a fetch request to laravel to log the user out.
_('.logout-yes').addEventListener('click', logout);


function logout() {
    fetch('/logout-from-employee')
    .then(res => {
        if (!res.ok) {
            throw new Error('Netowkr response was not ok:', res.status);
        } else {
            return res.json();
        }
    })
    .then(data => {
        console.log('message:', data.message);
        window.location.href="/login";
    })
}
