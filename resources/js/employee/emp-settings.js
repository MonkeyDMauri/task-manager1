

// DROPDOWN FORMS CODE GO HERE

// this event listener triggers when the user clicks anywhere on the screen
document.addEventListener('click', e => {
    // this variable will be equal to a clicked dropdown element (if they clicked a dropdown).
    const isDropdown = e.target.closest('.option-dropdown');

    // if isDropdown is NULL then we will select all elements with the class "option-dropdown" and in case a dropdown was already active then we close it,
    // and then return so nothing else happens.
    if (!isDropdown) {
        document.querySelectorAll('.option-dropdown').forEach(dropdown => {
            dropdown.classList.remove('active');
        })
        return;
    }

    console.log("it's dropdown!!");

    // this will be equal to the clicked dropdown element.
    const currentDropdown = isDropdown;
    // add the active class to the element.
    currentDropdown.classList.add('active');

    // after adding the "active" class to the dropdown element we will remove it from all other dropdown elements, so that
    // only one of them is visible.
    document.querySelectorAll('.option-dropdown').forEach(dropdown => {
        if (dropdown == currentDropdown) {
            return;
        } else {
            dropdown.classList.remove('active');
        }
    })
})