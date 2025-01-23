$(document).ready(function() {

    // Set the date picker default value to today's date
    const today = new Date().toISOString().split('T')[0];

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
        const saveButton = $(this).next('.save-note');
        
        // Check if the input is empty or not
        if (noteInput.val().trim() !== "") {
            saveButton.show();  // Show the save button if there is text
        } else {
            saveButton.hide();  // Hide the save button if the input is empty
        }
    });
});

// Handle the save button click
$(document).off('click').on('click', '.save-note', function() {
    const saveButton = $(this);
    const noteInput = saveButton.prev('.note-input');
    const status = saveButton.closest('.student-note').next('.attendance-dropdown').find('select');
    const noteValue = noteInput.val().trim();
    if (noteValue !== "") {
        saveAttendance(noteInput, noteValue, status);
        // Hide the save button after saving the note
        saveButton.hide();
    }
});


$(document).on('change', '.status', function(){
    const status = $(this);
    const noteInput = $(this).closest('.attendance-dropdown').prev('.student-note').find('.note-input');
    const noteValue = noteInput.val().trim();
    saveAttendance(noteInput, noteValue, status);
});

$(document).on('change', '#attendance-date', function() {
    const date = $(this).val();
    const url = window.location.pathname
    // console.log(url)
    location.href = url+`?date=${date}`;
});

const saveAttendance = (noteInput, noteValue, status) => {
    const data = [{
        id: noteInput.data('id'),
        user_id: noteInput.data('userid'),
        note: noteValue,
        status: status.val(),
        date: $("#attendance-date").val()
    }];
    $.ajax({
        url: '/attendance/save',  // URL where you want to send the PUT request
        type: 'POST',           // Laravel uses POST to handle PUT requests
        data: {data: data},
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            location.reload();
            console.log('Success:', response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}