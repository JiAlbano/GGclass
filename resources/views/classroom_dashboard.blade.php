<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GGclass</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdownmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal-create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class-card.css') }}">
        <!-- JS -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Handle class card clicks for redirection
                document.querySelectorAll('.class-card').forEach(function (card) {
                    card.addEventListener('click', function (event) {
                        const isDropdownOrModal = event.target.closest('.dropdown') || event.target.closest('.modal');

                        if (!isDropdownOrModal && !document.querySelector('.dropdown-menu.show')) {
                            window.location.href = this.getAttribute('data-href');
                        }
                    });
                });


                // Enable dropdown functionality
                document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function (button) {
                    button.addEventListener('click', function (event) {
                        event.stopPropagation(); // Prevents the click from bubbling up and triggering other handlers
                        const target = document.querySelector(this.getAttribute('data-bs-target'));
                        if (target) {
                            target.classList.toggle('show');
                        }
                    });
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function (event) {
                    if (!event.target.matches('[data-bs-toggle="dropdown"]')) {
                        document.querySelectorAll('.dropdown-menu.show').forEach(function (menu) {
                            menu.classList.remove('show');
                        });
                    }
                });

                // Initialize Join Class modal
                const joinClassModal = new bootstrap.Modal(document.getElementById('joinClassModal'));
                document.getElementById('join-class-option').addEventListener('click', function (event) {
                    event.preventDefault();
                    joinClassModal.show();
                });

                // Initialize Create Class modal
                const createClassModal = new bootstrap.Modal(document.getElementById('createClassModal'));
                document.getElementById('create-class-option').addEventListener('click', function (event) {
                    event.preventDefault();
                    createClassModal.show();
                });

            });

            document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.querySelector('#logout-btn');
    const logoutDropdown = document.querySelector('.logout-container');

    // Toggle the dropdown when the profile image is clicked
    logoutButton.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevents the click from bubbling up
        logoutDropdown.classList.toggle('show'); // Toggle visibility of the dropdown
    });

    // Close the dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!logoutButton.contains(event.target)) {
            logoutDropdown.classList.remove('show'); // Hide the dropdown
        }
    });
});

function handleLogout(event) {
    event.preventDefault();
    document.getElementById('logout-form').submit(); // Submit the Laravel logout form

}
        </script>

</head>

<body>

        <!-- Checking -->

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <!-- Checking -->

    <!---Header-->
    <header>
        <div class="header">
            <!---Left Section-->
            <div class="left-section">
                <img class="logo-img" src="{{ asset('img/logo.png') }}" alt="GGclass Logo">
                <h1 class="logo-font">GGclass</h1>
            </div>
            <!---End Left Section-->

            <!---Right Section-->
            <div class="right-section">
                <img class="create-class" src="{{ asset('img/plus.png') }}" alt="Create" id="create-class-btn" data-bs-toggle="dropdown" aria-expanded="false">

                <!-- Dropdown Menu -->
                <div class="dropdown-container">
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        @if(auth()->user()->user_type === 'teacher')
                        <li class="dropdown-item-container">
                            <a class="dropdown-item" href="{{ route('create.class') }}" id="create-class-option">Create Class</a>
                        </li>
                    @endif
                        <li class="dropdown-item-container">

                            <a class="dropdown-item" href="{{ route('join.class') }}" id="join-class-option">Join Class</a>

                        </li>
                    </ul>
                </div>

                <!-- Modal for Create Class -->
                   <!-- Teacher can create and join classes -->

                <div class="modal fade" id="createClassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title" id="createClassModalLabel">Create Class</h5>

                                <button type="button" class="btn-close" style="background-color: rgb(246, 246, 246)" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="createClassForm" action="{{ route('create.class') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="modal-form-sections">
                                        <!-- Section 1: Class Name, Section, and Image Upload -->
                                        <div id="section-1">
                                            <div class="form-section">
                                                <div class="mb-3">
                                                    <label for="className" class="form-label">Class Name</label>
                                                    <input type="text" class="form-control" id="className" name="class_name" placeholder="Class Name"  aria-required="true">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="section" class="form-label">Section</label>
                                                    <input type="text" class="form-control" id="section" name="section" placeholder="Section" aria-required="true">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Class Image</label>
                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary" id="next-to-2">Next</button>
                                            <div id="error-message-1" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                                        </div>
                                        <!-- Section 2: Subject and Room -->
                                        <div id="section-2" style="display: none;">
                                            <div class="form-section">
                                                <div class="mb-3">
                                                    <label for="subject" class="form-label">Subject</label>
                                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" aria-required="true">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="room" class="form-label">Room</label>
                                                    <input type="text" class="form-control" id="room" name="room" placeholder="Room" aria-required="true">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" id="back-to-1">Back</button>
                                            <button type="button" class="btn btn-primary" id="next-to-3">Next</button>
                                            <div id="error-message-2" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                                        </div>
                                        <!-- Section 3: Schedule -->
                                        <div id="section-3" style="display: none;">
                                            <div class="mb-3">
                                                <label for="schedule" class="form-label">Schedule</label>
                                                <input type="text" class="form-control" id="schedule" name="schedule" placeholder="Schedule" aria-required="true">
                                            </div>
                                            <button type="button" class="btn btn-secondary" id="back-to-2">Back</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                            <div id="error-message-3" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Modal for Join Class -->

                <div class="modal fade" id="joinClassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="joinClassModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">

                                <h5 class="modal-title" id="joinClassModalLabel">Join Class</h5>

                                <button type="button" class="btn-close" style="background-color: rgb(246, 246, 246)" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('join.class') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="classCode" class="form-label">Class Code</label>
                                        <input type="text" class="form-control" id="classCode" name="class_code" aria-required="true">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Join</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Profile-->

                <img class="profile-img" src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Profile" id="logout-btn" aria-expanded="false">
                <p class="UsernameTop">
                    <span><strong>Username</strong></span>
                    <span>Faculty</span>
                </p>

           <!-- Logout Dropdown -->
           <div class="logout-container">
               <ul class="logout-menu">
                   <li class="logout-item">
                       <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                       <a class="dropdown-item" href="#"
                          onclick="handleLogout(event)">Log out</a>
                   </li>
               </ul>
           </div>


     
            </header>
        <!---End Header-->

        <!--ClassCard -->
<div class="container mt-5">
<div>
     <img class="adnu-img-center" src="{{ asset('img/Ateneo_de_Naga_University_logo_transparent.png') }}" alt="GGclass Logo">
     <p class="Intro-text"> Add a class to get started </p>
</div>

    <div class="row">
    @foreach($classes as $class)
            @component('components.class_card', ['class' => $class]) @endcomponent
    @endforeach
            </div>
        </div>
        <!--End ClassCard -->


        <script>
    let classIdToDelete;

    function showDeleteConfirmation(classId) {
        classIdToDelete = classId; // Store the class ID to be deleted
        const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        modal.show();
    }

    document.getElementById('confirmDeleteButton').addEventListener('click', function () {
        const form = document.getElementById('delete-form-' + classIdToDelete);
        if (form) {
            form.submit(); // Submit the form to delete the class
        } else {
            console.error('Form not found for class ID: ' + classIdToDelete);
        }
    });
</script>
    <!-- JavaScripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>

    <!----Custom JavaScripts -->
    <script src="{{ asset('js/modal-logic.js') }}" defer></script>
</body>


</html>
