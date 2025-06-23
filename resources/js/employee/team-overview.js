function _(element) {
    return document.querySelector(element);
}

// Global Variables
const teamId = _('meta[name="current-team-id"]').getAttribute('content');
const csrfToken = _('meta[name="csrf-token"]').getAttribute('content');

// LEAVE TEAM CONFIRMATION POPUP.

// this event is triggered when the user clicks the "leave" button.
// the confirmation popup to leave the team will show up.
_('.leave-team-btn').addEventListener('click', togglePopup);
_('.leave-no').addEventListener('click', togglePopup);

// with the popup active, if they click the yes button then the function to leave the team will be executed.
_('.leave-yes').addEventListener('click', leaveTeam);


function togglePopup() {
    // popup element
    const popup = _('.leave-team-popup-wrapper');

    popup.classList.toggle('show');
}



function leaveTeam() {
    console.log('Team ID:', teamId);

    // JS object that'll be turned to JSON
    const jsJson = {
        'teamId' : teamId
    };

    fetch('/leave-team', {
        method: 'POST',
        headers:{
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : csrfToken
        },
        body: JSON.stringify(jsJson) //sending the team id to know what team they are tryna leave.
    })
    .then(res => {
        if (!res.ok) {
            throw new Error('Promise response was not ok:', res.status);
        } else {
            return res.json();
        }
    })
    .then(data => {
        // if it is successfull then they get redirected to the home page since they no longer have permissions to see this team.
        if (data.success) {
            window.location.href = "/employee-dashboard";
        } else {
            console.error('Something went wrong when tryna leave this team');
        }
    })
    .catch(err => {
        console.error(err);
    })
}