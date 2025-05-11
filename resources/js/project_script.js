
function _(element) {
    return document.querySelector(element);
}

// * CODE TO GET AND DISPLAY TASKS *

let tasks = []; // this variable will be equal to all tasks corresponding to the current project the user is looking at.
const projectId = _('.project-id').value;

const jsonData = {
    'projectId' : projectId
}

function getTasks() {
    fetch('/get-tasks', {
        method: 'POST',
        headers : {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(jsonData)
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(
                'Network response was not ok:', res.status
            );
        }
        else {
            return res.json();
        }
    })
    .then(data => {
        if (data.success) {
            console.log('tasks were retreived successfully');
            tasks = data.tasks;
            console.log(tasks);
            displayTasks(tasks);
        }
    })
    .catch(err => {
        console.error(err);
    })
}

getTasks();

function displayTasks(tasks) {
    const tasksContainer = _('.tasks-container');
    tasksContainer.innerHTML = '';

    tasks.forEach(task => {
        console.log('completed by:', task.who_completed_it);
        const taskWrap = document.createElement('li');
        taskWrap.classList = 'task-wrap';

        taskWrap.innerHTML = `
            <div>
                <label>ID</label>
                <h1>${task.id}</h1>
            </div>
            <div>
                <label>Name</label>
                <h1>${task.name}</h1>
            </div>
            <div>
                <label>Description</label>
                <p>${task.description}</p>
            </div>
            <div>
                <label>Priority</label>
                <p>${task.priority}</p>
            </div>
            <div>
                <label>Status</label>
                <p>${task.status}</p>
            </div>
            <div>
                <label>Assigned to</label>
                <p>${task.assigned_employee}</p>
            </div>
            <div>
                <label>Created at</label>
                <p>${task.formatted_created_at}</p>
            </div>
            <div>
                <label>Completed by</label>
                <p>${task.who_completed_it}</p>
            </div>
            
        `;

        tasksContainer.appendChild(taskWrap);
    });
}

// code for showing members in popup.

const membersDropdown = _('.view-members-dropdown');
let teamMembers;

_('.view-members-btn').addEventListener('click', showmembersDropdown);
_('.close-members-popup').addEventListener('click', showmembersDropdown);

function showmembersDropdown(){
    membersDropdown.classList.toggle('active');
    console.log('dropdown clicked');
    console.log('project ID', projectId);
    getMembers();
}

function getMembers() {
    fetch(`/get-members/${projectId}`)
    .then(res => {
        if (!res.ok) {
            throw new Error('Network response wasnot ok:', res.status);
        } else{ 
            return res.json();
        }
    })
    .then(data => {
        console.log('Team members', data.members);
        teamMembers = data.members;
        showMembers(teamMembers);
    })
}

function showMembers(members) {
    const membersList = _('.members-list');
    membersList.innerHTML = '';


    members.forEach(member => {
        const memberCard = document.createElement('li');
        memberCard.classList = 'member-card';

        memberCard.innerHTML = `
            ${member.name}
        `;

        membersList.appendChild(memberCard);
    }) 
}

// search member by name.

const searchBar = _('.search-member-bar');
searchBar.addEventListener('keyup', filterMembers);


function filterMembers() {
    const searchContent = searchBar.value;
    console.log(searchContent);

    let filteredMembers = teamMembers.filter(m => m.name.includes(searchContent));
    console.log(filteredMembers);

    showMembers(filteredMembers);
}