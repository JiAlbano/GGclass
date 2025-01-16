$(document).ready(function() {

    // Set the date picker default value to today's date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('attendance-date').value = today;

    // Handle dropdown item selection
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const statusButton = document.getElementById('status-btn');
    
    dropdownItems.forEach(item => {
        item.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent default link behavior

            // Get the status from the selected dropdown item
            const status = this.getAttribute('data-status');
            
            // Change the button text to the selected status
            statusButton.innerText = status;
        });
    });

    // Monitor the note input field for changes
    $('.note-input').on('input', function() {
        const noteInput = $(this);
        const saveButton = $(this).next('.btn-save-note');
        
        // Check if the input is empty or not
        if (noteInput.val().trim() !== "") {
            saveButton.show();  // Show the save button if there is text
        } else {
            saveButton.hide();  // Hide the save button if the input is empty
        }
    });

    // Handle the save button click
    $('.btn-save-note').on('click', function() {
        const saveButton = $(this);
        const noteInput = saveButton.prev('.note-input');
        const noteValue = noteInput.val().trim();

        if (noteValue !== "") {
            // Implement the logic to save the note (e.g., send it to the server or store it locally)
            console.log("Note saved: " + noteValue);

            // Hide the save button after saving the note
            saveButton.hide();
        }
    });

});
