<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Bulletins</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('bulletins.css') }}"> <!-- New CSS file for the container -->
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
            <button class="btn challenge-btn active" style="font-size: 12px; border:none; width: 100%;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" style="font-size: 12px; width: 100%; " onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id])}}'">Tutorials</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
        </div>
    </div>
</div>


<!-- Display profile picture -->



<!-- <div class="info-container ">
    <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Picture" class="container-picture">
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
                <button onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">Feedback</button>
                <button onclick="window.location.href='{{ route('gradebook', ['classId' => $class->id]) }}'">Gradebook</button>
            </div>
        </div>
        <div class="dashboard-container">
          <!-- Add Challenge Button -->
  <div class="add-challenge-container">
        <button type="button" class="add-challenge-btn" data-bs-toggle="modal" id="addBtn" data-bs-target="#addMemberModal">
            <div class="icon">
                <img src="path_to_your_icon.png" alt="Add Challenge Icon" class="icon-img">
            </div>
            <div class="text">Create a new challenge to your class</div>
            <div class="plus-icon">+</div>
        </button>
    </div>

        <!-- Bulletin List -->
        <div class="bulletin-list">
            <div class="bulletin-item">
                <div class="bulletin-icon">
                    <img src="megaphone-icon.png" alt="Icon" />
                </div>
                <div class="bulletin-content">
                    <p class="bulletin-title">You posted a new type of challenge: Quiz</p>
                    <p class="bulletin-date">Dec 21, 2024</p>
                </div>
                <div class="bulletin-options">
                    <button class="options-btn">•••</button>
                </div>
            </div>
            <!-- Repeat other bulletin items -->
        </div>
        </div>
    </div>


{{-- <div class="info-container">
        <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Profile Picture" class="container-picture">


    <div class="container-name">{{ $user->first_name }} {{ $user->last_name }}</div>
    <div class="container-info-section">
        <p class="class-name">Class Name: <span>{{ $class->class_name }}</span></p>
        <p class="subject">Subject: <span>{{ $class->subject }}</span></p>
        <p class="section">Section: <span>{{ $class->section }}</span></p>
    </div>
    <div class="container-info-email">
        <p>{{ $user->email }}</p>
    </div>
@endforeach


<hr>
        <div class="container-buttons">
            <button class="btn"onclick="window.location.href='{{ route('attendance') }}'">Attendance</button>
            <button class="btn"onclick="window.location.href='{{ route('grade') }}'">Grade</button>
            <button class="btn"onclick="window.location.href='{{ route('feedback') }}'">Feedback</button>
            <button class="btn"onclick="window.location.href='{{ route('gradebook') }}'">Gradebook</button>
        </div>
    </div> --}}
</body>
</html>
