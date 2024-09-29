document.addEventListener('DOMContentLoaded', function() {
    function showSection(sectionToShow) {
        document.querySelectorAll('.modal-form-sections > div').forEach(section => {
            section.style.display = 'none';
        });
        sectionToShow.style.display = 'block';
    }
  
    function validateSection(fields) {
        let valid = true;
        fields.forEach(({ id, errorId }) => {
            const value = document.getElementById(id).value.trim();
            const errorMessage = document.getElementById(errorId);
            if (!value) {
                errorMessage.style.display = 'block';
                valid = false;
            } else {
                errorMessage.style.display = 'none';
            }
        });
        return valid;
    }
  
    function resetForm() {
        document.getElementById('createClassForm').reset();
        document.querySelectorAll('.modal-form-sections > div').forEach(section => {
            section.style.display = 'none';
        });
        document.getElementById('section-1').style.display = 'block';
        document.querySelectorAll('.text-danger').forEach(errorMessage => {
            errorMessage.style.display = 'none';
        });
    }
  
    document.addEventListener('click', function(event) {
        if (event.target.matches('#next-to-2')) {
            if (validateSection([
                { id: 'className', errorId: 'error-message-1' },
                { id: 'section', errorId: 'error-message-1' }
            ])) {
                showSection(document.getElementById('section-2'));
            }
        } else if (event.target.matches('#back-to-1')) {
            showSection(document.getElementById('section-1'));
        } else if (event.target.matches('#next-to-3')) {
            if (validateSection([
                { id: 'subject', errorId: 'error-message-2' },
                { id: 'room', errorId: 'error-message-2' }
            ])) {
                showSection(document.getElementById('section-3'));
            }
        } else if (event.target.matches('#back-to-2')) {
            showSection(document.getElementById('section-2'));
        }
    });
  
    document.getElementById('createClassForm').addEventListener('submit', function(event) {
        if (!validateSection([
            { id: 'schedule', errorId: 'error-message-3' }
        ])) {
            event.preventDefault(); // Prevent form submission
        }
    });
  
    const createClassModal = new bootstrap.Modal(document.getElementById('createClassModal'));
    const joinClassModal = new bootstrap.Modal(document.getElementById('joinClassModal'));
  
    document.getElementById('create-class-option').addEventListener('click', function() {
        createClassModal.show();
    });
  
    document.getElementById('join-class-option').addEventListener('click', function() {
        joinClassModal.show();
    });
  
    // Reset form fields when the modal is hidden
    document.getElementById('createClassModal').addEventListener('hidden.bs.modal', function () {
        resetForm();
    });
  });

  // JavaScript logic for Edit Class Modal

document.addEventListener("DOMContentLoaded", function () {
    // Function to handle navigation to Section 2
    function goToEditSection2(classId) {
        // Hide Section 1 and show Section 2
        document.getElementById(`edit-section-1-${classId}`).style.display = "none";
        document.getElementById(`edit-section-2-${classId}`).style.display = "block";
    }

    // Function to handle navigation to Section 3
    function goToEditSection3(classId) {
        // Hide Section 2 and show Section 3
        document.getElementById(`edit-section-2-${classId}`).style.display = "none";
        document.getElementById(`edit-section-3-${classId}`).style.display = "block";
    }

    // Function to handle navigation back to Section 1 from Section 2
    function goToEditSection1(classId) {
        // Hide Section 2 and show Section 1
        document.getElementById(`edit-section-2-${classId}`).style.display = "none";
        document.getElementById(`edit-section-1-${classId}`).style.display = "block";
    }

    // Function to handle navigation back to Section 2 from Section 3
    function goToEditSection2From3(classId) {
        // Hide Section 3 and show Section 2
        document.getElementById(`edit-section-3-${classId}`).style.display = "none";
        document.getElementById(`edit-section-2-${classId}`).style.display = "block";
    }

    // Attach event listeners for Next and Back buttons in Edit Class modal
    document.querySelectorAll('[id^="edit-next-to-2-"]').forEach(function (button) {
        button.addEventListener("click", function () {
            var classId = this.id.split("-").pop();
            // Validate Section 1 inputs before proceeding
            var className = document.getElementById(`editClassName${classId}`).value.trim();
            var section = document.getElementById(`editSection${classId}`).value.trim();

            if (className === "" || section === "") {
                document.getElementById(`edit-error-message-1-${classId}`).style.display = "block";
            } else {
                document.getElementById(`edit-error-message-1-${classId}`).style.display = "none";
                goToEditSection2(classId);
            }
        });
    });

    document.querySelectorAll('[id^="edit-next-to-3-"]').forEach(function (button) {
        button.addEventListener("click", function () {
            var classId = this.id.split("-").pop();
            // Validate Section 2 inputs before proceeding
            var subject = document.getElementById(`editSubject${classId}`).value.trim();
            var room = document.getElementById(`editRoom${classId}`).value.trim();

            if (subject === "" || room === "") {
                document.getElementById(`edit-error-message-2-${classId}`).style.display = "block";
            } else {
                document.getElementById(`edit-error-message-2-${classId}`).style.display = "none";
                goToEditSection3(classId);
            }
        });
    });

    document.querySelectorAll('[id^="edit-back-to-1-"]').forEach(function (button) {
        button.addEventListener("click", function () {
            var classId = this.id.split("-").pop();
            goToEditSection1(classId);
        });
    });

    document.querySelectorAll('[id^="edit-back-to-2-"]').forEach(function (button) {
        button.addEventListener("click", function () {
            var classId = this.id.split("-").pop();
            goToEditSection2From3(classId);
        });
    });
});
