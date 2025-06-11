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
            <td>${task.id}</td>
            <td>${task.name}</td>
            <td>${task.project.name}</td>
            <td>${task.description}</td>
            <td>${task.priority}</td>
            <td>${task.status}</td>
            <td>${task.author}</td>
            <td>${task.created_at_formatted}</td>
            <td>${task.last_update}</td>
        `;

        tasksListCon.append(taskCard);
    })
}


// CODE TO FILTER TASKS BY NAME USING SEARCH BAR.

const searchBar = document.querySelector('#search-task'); //grabbing search bar itself
searchBar.addEventListener('keyup', displayFilteredTasks); // making it call a function when somthng is being typed.

function displayFilteredTasks() {
    
    let searchBarContent = searchBar.value;

    // looping thru every task looking for a task name that matches whats inside the search bar and returning the task that passess this condition.
    let filteredTasks = tasks.filter(task => task.name.includes(searchBarContent));

    // displaying filtered tasks.
    displayTasks(filteredTasks);
}

// when the clear button is clicked, we set the value of the search bar to an empty string and display all tasks.
_('.clear-search-btn').addEventListener('click', clearSearch);

function clearSearch() {
    searchBar.value = ''
    displayTasks(tasks);
}