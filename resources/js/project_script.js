
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
        const taskWrap = document.createElement('li');
        taskWrap.classList = 'task-wrap';

        taskWrap.innerHTML = `
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
            
        `;

        tasksContainer.appendChild(taskWrap);
    });
}