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
        console.log(employees);
        displayEmployees(employees)
    })
    .catch(err => console.error(err));
}

function displayEmployees(employees) {
    // grabbing and clearing the element where employees will be shown, then filling it up with employees' information.
    const employeesList = _('.employees-list');
    employeesList.innerHTML = '';

    employees.forEach(emp => {

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
