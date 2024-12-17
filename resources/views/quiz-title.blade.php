<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Quiz</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('quiz-title.css') }}"> <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('quiz-title.css') }}">
</head>

<body>
    <div class="navbar">
        <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass ></h1>
            <h2 class="section-font">{{ $class->section }}</h2>
    </div>

    
    <!-- User Profile -->
    <div class="profile-container" style="position: relative;">
        <img class="profile-img"
            src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}"
            alt="Profile"
            id="logout-btn"
            aria-expanded="false">

        <!-- Logout Dropdown -->
        <div class="logout-container" style="display: none; position: absolute; right: 0; z-index: 1000;">
            <ul class="logout-menu">
                <li class="logout-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#" onclick="handleLogout(event)">Log out</a>
                </li>
                <li class="logout-item">
                    <button class="dropdown-item" onclick="window.location.href='{{ route('classroom.index') }}'">Class-List</button>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- JavaScript for Logout Dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutButton = document.querySelector('#logout-btn');
        const logoutDropdown = document.querySelector('.logout-container');

        // Toggle the dropdown when the profile image is clicked
        logoutButton.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevents the click from bubbling up
            logoutDropdown.style.display = logoutDropdown.style.display === 'none' ? 'block' : 'none'; // Toggle visibility of the dropdown
        });

        // Close the dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (!logoutButton.contains(event.target) && !logoutDropdown.contains(event.target)) {
                logoutDropdown.style.display = 'none'; // Hide the dropdown
            }
        });
    });

    function handleLogout(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit(); // Submit the Laravel logout form
    }
</script>

    <div class="top-buttons containers" style=" margin-top: 84px;">
        <div class="row justify-content-center"> <!-- Added justify-content-center class -->
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
                <button class="btn" style="font-size: 12px; border:none; width: 100%;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%; " onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id])}}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn  challenge-btn active" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
            </div>
        </div>
    </div>


<!-- Display profile picture -->
    <!-- <div class="info-container">
        <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Profile Picture" class="container-picture">
         Display user info
        <div class="container-name">{{ $user->first_name }} {{ $user->last_name }}</div>
        <div class="container-info-section">
            <p class="class-name">Class Name: <span>{{ $class->class_name }}</span></p>
            <p class="subject">Subject: <span>{{ $class->subject }}</span></p>
            <p class="section">Section: <span>{{ $class->section }}</span></p>
            <p class="section">Class Code: <span>{{ $class->class_code }}</span></p>
        </div>
        <div class="container-info-email">
            <p>{{ $user->email }}</p>
        </div>
        <div class="container-buttons">
            <button class="btn1"onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">ATTENDANCE</button>
            <button class="btn1"onclick="window.location.href='{{ route('grade', ['classId' => $class->id]) }}'">GRADE</button>
            <button class="btn1"onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">FEEDBACK</button>
            <button class="btn1"onclick="window.location.href='{{ route('student-list', ['classId' => $class->id]) }}'">GRADEBOOK</button>
        </div>
    </div> -->

    <div class="dashboard-container">
    <!-- Back Button -->
    <div class="back-button">
        <button onclick="window.history.back()">&#8592; Back</button>
    </div>

    <div class="content-container">
        <!-- Class Card -->
        <div class="class-card">
            <div class="class-header">
                <p>School Year: 2024 - 2025</p>
                <p>Semester: 1st</p>
                <p>Section: {{ $class->section }}</p>
            </div>
            <div class="class-details">
                <h2>CSDC101</h2>
                <p>TTH 09:00AM - 10:30AM</p>
                <p>AL411B</p>
            </div>
            <div class="class-buttons">
                <button onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">Attendance</button>
                <button onclick="window.location.href='{{ route('feedback',  ['classId' => $class->id]) }}'">Feedback</button>
                <button onclick="window.location.href='{{ route('gradebook',  ['classId' => $class->id]) }}'">Gradebook</button>
            </div>
        </div>


    <div class="container-adviser my-4">
        <div class="container-sm d-flex flex-column justify-content-start align-items-start position-relative p-3 border">
            <button id="edit-button" class="edit-button">Edit</button>
            <h3 class="mb-2" id="quiz-title2">{{ $quiz->title }}</h3>
            <p class="mb-0" id="quiz-description">{{ $quiz->description }}</p>
            <!-- Open Button -->
            <button class="btn btn-open position-absolute" id="open-button" onclick="window.location.href='{{ route('test_and_quizzes.take', ['classId' => $class->id, 'quizId' => $quiz->id]) }}'">Open</button>
        </div>
    </div>


    {{-- <div class="quiz-container">
        <button id="edit-button" class="edit-button">Edit</button>
        <h1 id="quiz-title2">{{ $quiz->title }}</h1>
        <p id="quiz-description">{{ $quiz->description }}</p>
        <button class="open-button" id="open-button" onclick="window.location.href='{{ route('quiz.take', ['classId' => $class->id, 'quizId' => $quiz->id]) }}'">Open</button>
    </div> --}}

    <!-- Modal for editing -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="close-modal">&times;</span>
            <h2 class="edit-quiz">Edit Quiz</h2>
            <label class="edit-title" for="new-title">Quiz Title:</label>
            <input type="text" id="new-title" placeholder="Enter new title" value="{{ $quiz->title }}">
            <br>
            <label for="new-description" class="quiz-description">Quiz Description:</label>
            <br>
            <textarea id="new-description" placeholder="Enter new description">{{ $quiz->description }}</textarea>
            <button class="save" id="save-button">Save</button>
        </div>
    </div>

    <script>
        // Show the modal when the Edit button is clicked
        document.getElementById('edit-button').addEventListener('click', () => {
            document.getElementById('edit-modal').style.display = 'flex';
        });

        // Close the modal when the close button is clicked
        document.getElementById('close-modal').addEventListener('click', () => {
            document.getElementById('edit-modal').style.display = 'none';
        });

        // Save the new title and description
        document.getElementById('save-button').addEventListener('click', () => {
            const newTitle = document.getElementById('new-title').value;
            const newDescription = document.getElementById('new-description').value;

            // Check if new title and description are provided
            if (newTitle && newDescription) {
                // Send an AJAX request to update the quiz
                fetch("{{ route('test_and_quizzes.update', ['quizId' => $quiz->id]) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        title: newTitle,
                        description: newDescription,
                    }),
                }).then(response => {
                    if (response.ok) {
                        // Update the displayed title and description
                        document.getElementById('quiz-title2').textContent = newTitle;
                        document.getElementById('quiz-description').textContent = newDescription;
                        // Close the modal after saving
                        document.getElementById('edit-modal').style.display = 'none';
                    } else {
                        alert('Failed to update quiz');
                    }
                });
            }
        });
    </script>
</body>
</html>
