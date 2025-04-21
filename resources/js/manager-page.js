
function _(element) {
    return document.querySelector(element);
}


// LOGOUT CODE.

// event listensers to call the function in charge of making logout popup show up or go away.
_('.logout-btn').addEventListener('click', showLogoutPopup);
_('.logout-no').addEventListener('click', showLogoutPopup);

// this event listener here is for when the user clicks outside the logout prompt so then they close the popup.
document.addEventListener('click', e => {
    if (e.target.matches('.logout-popup-wrapper')) {
        showLogoutPopup();
    }
});

// function to toggle the active classlist for the logout popup.
function showLogoutPopup() {
    // grabbing logout wrapper element.
    const logoutWrapper = _('.logout-popup-wrapper');

    // toggling active class.
    logoutWrapper.classList.toggle('active');
}


// CODE TO DISPLAY PROJECTS.
let projects = [];
const csrfToken = _('meta[name="csrf-token"]').getAttribute('content');

function getProjects() {
    fetch('/get-projects')
    .then(res => {
        if (!res.ok) {
            throw new Error('Network response was not ok:', res.status);
        } else {
            return res.json();
        }
    })
    .then(data => {
        if (data.success) {
            projects = data.projects;
            projects.forEach(project => {
                console.log(project);
            })
            displayProjects(projects);
        } else {
            console.log(data.error);
        }
    })
    .catch(err => {
        console.error(err);
    });
}

getProjects();

function displayProjects(projects) {
    const projectsHolder = _('.projects-wrapper');
    projectsHolder.innerHTML = '';

    projects.forEach(project => {
        const projectWrap = document.createElement('li');
        projectWrap.classList = 'project-wrap';

        projectWrap.innerHTML = `
            <h1>${project.name}</h1>
            <hr>
            <p>${project.description}</p>
            
            <p>status: ${project.status}</p>

            <form action="/project/${project.id}" method="GET">
                <input type="hidden" name="token" value="${csrfToken}">
                <button>view</button>
            </form>
        `;

        projectsHolder.appendChild(projectWrap);
    });
}

