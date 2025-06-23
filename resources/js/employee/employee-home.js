function _(element) {
    return document.querySelector(element);
}

const csrf_token = _('meta[name="csrf-token"]').getAttribute('content');

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

// CODE TO GET ALL TASK AND DO THINGS WITH THEM.

let tasks;

function getTasks() {
    fetch('/get-tasks-from-employee-view',{
        method:"POST",
        headers : {
            'Content-Type' : 'application/json',
            'X-CSRF-TOKEN' : csrf_token
        },
        
    })
    .then(res => {
        if (!res.ok) {
            throw new Error('Network response was not ok:', res.status);
        } else {
            return res.json()
        }
    })
    .then(data => {
        tasks=data.tasks
        console.log('Tasks:', tasks);
        displayTasks(tasks);
    })
    .catch(err => {
        console.log(err);
    })
}

getTasks();

function displayTasks(tasks) {
    const tasksListCon = document.querySelector('.tasks-table-body');
    tasksListCon.innerHTML = '';

    tasks.forEach(task => {
        const taskCard = document.createElement('tr');
        taskCard.classList = 'task-card';

        taskCard.innerHTML = `
            <td class="task-id check-task">${task.id}</td>
            <td class="task-name check-task"><a href="/open-task/${task.id}"></a>${task.name}</td>
            <td class="task-project-name check-task">${task.project.name}</td>
            <td class="task-description check-task">${task.description}</td>
            <td class="task-priority check-task">${task.priority}</td>
            <td class="task-status check-task">${task.status}</td>
            <td class="task-author check-task">${task.author}</td>
            <td class="task-created_at check-task">${task.created_at_formatted}</td>
            <td class="task-updated_at check-task">${task.last_update}</td>
        `;

        tasksListCon.append(taskCard);
    })
}


// CODE TO FILTER TASKS BY FILTER USING SEARCH BAR.

// first we need to see what filter the user has selected.
const searchBy = _('#searchBy');
let searchByValue;

// if the user changes filter then we clear search bar to start from scratch
searchBy.addEventListener('change', clearSearch);

const searchBar = document.querySelector('#search-task'); //grabbing search bar itself

// when the search bar is selected and a key is pressed we first check the filter and then call the respective search function.
searchBar.addEventListener('keyup', () => {

    searchByValue = searchBy.value; // getting filter value.

    if (searchByValue === 'name') {
        displayFilteredTasksByName();
    } else if (searchByValue === 'project') {
        displayFilteredTasksByProject();
    } else if(searchByValue === 'author') {
        displayFilteredTasksByAuthor();
    }
    
}); // making it call a function when somthng is being typed.

function displayFilteredTasksByName() {
    console.log('Filter:', searchByValue);
    
    let searchBarContent = searchBar.value;

    // looping thru every task looking for a task name that matches whats inside the search bar and returning the task that passess this condition.
    let filteredTasks = tasks.filter(task => task.name.includes(searchBarContent));

    // displaying filtered tasks.
    displayTasks(filteredTasks);
}

function displayFilteredTasksByProject() {

    let searchBarContent = searchBar.value;

    let filteredTasks = tasks.filter(task => task.project.name.includes(searchBarContent));

    displayTasks(filteredTasks);
}

function displayFilteredTasksByAuthor() {
    let searchBarContent = searchBar.value;

    let filteredTasks = tasks.filter(task => task.author.includes(searchBarContent));

    displayTasks(filteredTasks);
}

// when the clear button is clicked, we set the value of the search bar to an empty string and display all tasks.
_('.clear-search-btn').addEventListener('click', clearSearch);

function clearSearch() {
    searchBar.value = ''
    displayTasks(tasks);
}

// the following code is for when the user clicks on a task attribute, when they do, they will get redirected to a new page
// where they can see the task details.

_('.tasks-list-table').addEventListener('click', e => {
    if (e.target.matches('.check-task')) {
        getTaskID(e);
    }
});

function getTaskID(e){
    console.log('a task was clicked');

    const taskRow = e.target.closest('.task-card');
    const taskId = taskRow.querySelector('.task-id').textContent;

    console.log('task ID:', taskId);

    // calling function in charge of redirecting user to the task the wanna see depending on the task ID.
    openTask(taskId);
}

// redirecting user to another URL which belongs to a route taht then redirects them to the task page.
function openTask(taskId) {
    window.location.href = `/view-task/${taskId}`;
}

// CODE FOR TEAMS SECTION IN EMPLOYEES HOME PAGE.

let teams;

function getTeams() {
    fetch('/get-teams-employee')
    .then(res => {
        if (!res.ok) {
            throw new Error('Network connection was not good:', res.status);
        } else{ 
            return res.json()
        }
    })
    .then(data => {
        teams = data.teams;
        console.log('Teams:', teams);
        displayTeams(teams);
    })
}

getTeams();

function displayTeams(teams) {
    const teamsTableBody = _('.teams-table-body');
    teamsTableBody.innerHTML = "";

    teams.forEach(team => {
        const teamRow = document.createElement('tr');
        teamRow.classList = `team-row ${team.name}`;

        teamRow.innerHTML = `
            <td class="team-row-data team-id">${team.id}</td>
            <td class="team-row-data team-name">${team.name}</td>
            <td class="team-row-data team-description-cell">
                <div class="team-description">
                    ${team.description}
                </div>
            </td>
            <td class="team-row-data team-owner">${team.owner}</td>
            <td class="team-row-data team-created-at">${team.formatted_created_at}</td>
        `
        teamsTableBody.appendChild(teamRow);
    })
}


// Checking to see if user clicks a cell to open the team overview
_('.teams-table-body').addEventListener("click", e => {
    // after is confirmed they did click a cell, we need to know what team overview
    // they are trying to see, so we need to cal another function that'll get the closest element with the class
    // "team-row-data", when calling that function we pass as a parameter the clicked cell.
    if (e.target.matches('.team-row-data') || e.target.matches('.team-description')) {
        console.log('row clicked');
        getClickedTeam(e.target);
    }
})

function getClickedTeam(cell) {
    // Selecting the whole arrow element belonging to the clicked cell
    const rowElement = cell.closest('.team-row');
    // within the previously selected cell we now select the cell containing the team ID and grab its text content
    const teamdId = rowElement.querySelector('.team-id').textContent;

    // redirecting user to the team overview page and passing the team id as a parameter in the URL.
    window.location.href = `/team-overview/${teamdId}`;
}

// CODE FOR SEARCH TEAM BY NAME

// search bar input element
const searchTeamBar = _('#search-team');

searchTeamBar.addEventListener('keyup', filterTeams);

function filterTeams() {
    const searchTeamBarContent = searchTeamBar.value;

    let filteredTeams = teams.filter(team => team.name.toLowerCase().includes(searchTeamBarContent.toLowerCase()));

    displayTeams(filteredTeams);
}

_('.clear-search-team-bar').addEventListener('click', clearSearchBarTeams);

function clearSearchBarTeams() {
    searchTeamBar.value = '';
    displayTeams(teams);
}