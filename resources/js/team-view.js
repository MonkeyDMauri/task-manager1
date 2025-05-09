// funciton for grabbing HTML elements.
function _(element) {
    return document.querySelector(element);
}

const csrfToken = _('meta[name="csrf-token"]').getAttribute('content'); //variable containing csrf-token.
const teamId = _('meta[name="team_id"]').getAttribute('content');


// CODE TO GET AND DISPLAY EMPLOYEES TO ADD THEM TO A TEAM.
const viewMembersBtn = _('.add-members');
const employeesWrapper = _('.employees-wrapper');

viewMembersBtn.addEventListener('click', getEmployees);

let employees;

function getEmployees() {
    console.log('clicked')
    fetch('/get-employees')
    .then(res => {
        if (!res.ok) {
            throw new Error('Network response was not ok:', res.status);
        } else {
            return res.json();
        }
    })
    .then(data => {
        
        employeesWrapper.classList.add('show')
        employees = data.employees; 
        console.log("Employees xdxd", employees);
        displayEmployees(employees)
    })
    .catch(err => console.error(err));
}

function displayEmployees(employees) {
    // grabbing and clearing the element where employees will be shown, then filling it up with employees' information.
    const employeesList = _('.employees-list');
    employeesList.innerHTML = '';

    employees.forEach(emp => {

        let empInThisTeam = false; // this flag will change to true if this employee is already part of current team.

        const teams = emp.teams;

        //this loop here is to check if the ID of the current team is already inside the array of this employee.
        teams.forEach(team => {
            if (team.id == teamId) {
                empInThisTeam = true;
                console.log(`${emp.name} is already in this team with ID ${teamId}`);
            }
        })

        if (!empInThisTeam) {
            const employeeCard = document.createElement('li');
            employeeCard.classList = 'employee-card';

            employeeCard.innerHTML = `
                        <form method="POST" action="/add-user-to-team">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <input type="hidden" name="emp_id" value="${emp.id}">
                            <input type="hidden" name="team_id" value="${teamId}">

                            <h2>ID: ${emp.id}</h2>
                            <h2>Name: ${emp.name}</h2>
                            <h2 style="text-wrap:wrap; max-width:fit-content;">Email: ${emp.email}</h2>

                            <button>Add (Laravel)</button>
                            <button type="button">Add (JS)</button>
                        `;

            employeesList.appendChild(employeeCard);
        }
    })
}

// CODE TO GET TEAMS MEMBERS (EMPLOYEES PART OF THE TEAM IN QUESTION).

let teamMembers;

function getTeamMembers() {
    console.log('clicked')
    fetch(`/get-team-members/${teamId}`)
    .then(res => {
        if (!res.ok) {
            throw new Error('Network response was not ok:', res.status);
        } else {
            return res.json();
        }
    })
    .then(data => {
        console.log('Current team id:', teamId);
        teamMembers = data.members; 
        console.log(teamMembers);
        displayMembers(teamMembers)
    })
    .catch(err => console.error(err));
}

function displayMembers(members) {
    // grabbing and clearing the element where employees will be shown, then filling it up with employees' information.
    const membersList = _('.team-members-list');
    membersList.innerHTML = '';

    // if members is an array and is higher than 0 we will display members, otherwise, a message will be displayed.
    if(Array.isArray(members) && members.length > 0) {
        members.forEach(emp => {

            const employeeCard = document.createElement('li');
            employeeCard.classList = 'employee-card';

            employeeCard.innerHTML = `
                    <form method="POST" action="/add-user-to-team">
                        <input type="hidden" name="_token" value="${csrfToken}">
                        <input type="hidden" name="emp_id" value="${emp.id}">
                    <input type="hidden" name="team_id" value="${teamId}">

                        <h2>ID: ${emp.id}</h2>
                        <h2>Name: ${emp.name}</h2>
                        <h2 style="text-wrap:wrap; max-width:fit-content;">Email: ${emp.email}</h2>
                        <button class="remove-member-btn">remove</button>
            `;

            membersList.appendChild(employeeCard);
        })
    } else {
        console.log('no team members');
        membersList.innerHTML = `
            <h2>No team members yet</h2>
        `;
    }

    
}

getTeamMembers();

// CODE TO GET PROJECTS AND THEN DISPLAY THEM(PROJECT BELONGING TO CURRENT TEAM).

let projects;

function getProjects() {
    fetch(`/get-team-projects/${teamId}`)
    .then(res => {
        if (!res.ok) {
            throw new Error('Network response was not ok:', res.status);
        } else {
            return res.json();
        }
    })
    .then(data => {
        projects = data.projects;
        console.log('Team projects:', projects);
        displayTeamProjects(projects);
    })
    .catch(err => {
        console.error(err);
    })
}


getProjects();


function displayTeamProjects(projects) {

    const projectsList = _('.team-projects-list');
    projectsList.innerHTML = '';

    projects.forEach(pro => {
        const projectCard = document.createElement('li');
        projectCard.classList = 'project-card';

        projectCard.innerHTML = `
            <h2>ID: ${pro.id}</h2>
            <h2>Name: ${pro.name}</h2>
            <h2>Tasks: ${pro.number_of_tasks}</h2>

            <a href="/project/${pro.id}">view project</a>
        `;

        projectsList.appendChild(projectCard);
    })
}
