<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Tutorials</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('student-view/tutorials-student.css') }}"> <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('student-view/tutorials-student.css') }}"> <!-- New CSS file for the container -->
</head>
<body>

<div class="navbar">
    <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass</h1>
        <!-- <h2 class="section-font">{{ $class->section }}</h2> -->
    </div>

        <!-- <div class="right-section">
            <button class="back-button" onclick="goBack()">Back</button>
            <script>
                function goBack() {
                    window.history.back();
                }
            </script>
            <button class="back-button"onclick="window.location.href='{{ route('classroom.index') }}'">Class-List</button>
            <img class="profile-img" src="{{ asset('ainz.jpg') }}" alt="Create">
        </div>
    </div> -->


    
    <!-- User Profile -->
    <div class="profile-container" style="display: flex; position: relative;">
        <img class="profile-img"
            src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}"
            alt="Profile"
            id="logout-btn"
            aria-expanded="false">
        <div class="text-container">
            <p class="in-game-name">{{ $user->ign }}</p>
            <p class="user-type">{{ $user->user_type }}</p>
        </div>
        <!-- Logout Dropdown -->
        <div class="logout-container" style="display: none; position: absolute; top: 100%; right: 0; z-index: 1000;">
            <ul class="logout-menu" style="margin: 0; padding: 0; list-style: none;">
                <li class="logout-item" style="padding: 8px 12px;">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#" onclick="handleLogout(event)">Log out</a>
                </li>
                <li class="logout-item" style="padding: 8px 12px;">
                    <button class="dropdown-item" onclick="window.location.href='{{ route('class-list') }}'" style="border: none; background: none; text-decoration: none; color: #333; cursor: pointer;">Class-List</button>
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
            <button class="btn" style="font-size: 16px; border:none; width: 100%;" onclick="window.location.href='{{ route('studentbulletins', ['classId' => $class->id]) }}'">Bulletins</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn challenge-btn active" style="font-size: 16px; width: 100%; " onclick="window.location.href='{{ route('tutorials-student', ['classId' => $class->id]) }}'">Tutorials</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" style="font-size: 16px; width: 100%;" onclick="window.location.href='{{ route('challenges-student', ['classId' => $class->id]) }}'">Challenges</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" style="font-size: 16px; width: 100%;" onclick="window.location.href='{{ route('players-student', ['classId' => $class->id]) }}'">Players</button>
        </div>
    </div>
</div>


<!-- <div class="info-container ">
    <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Picture" class="container-picture">
    <div class="container-name">{{ $user->first_name }} {{ $user->last_name }}</div>
    <div class="rank-section">
            <img src="{{ asset('bronze.png') }}" alt="Rank Picture" class="rank-pic">
        </div>
    <div class="container-info-section">
        <p class="class-name">Class Name: <span>{{ $class->class_name }}</span></p>
        <p class="subject">Subject: <span>{{ $class->subject }}</span></p>
        <p class="section">Section: <span>{{ $class->section }}</span></p>
    </div>
    <div class="container-info-email">
        <p>{{ $user->email }}</p>
    </div>

        <div class="container-buttons">
            <button class="btn1"onclick="window.location.href='{{ route('profile-student', ['classId' => $class->id]) }}'">PROFILE</button>
            <button class="btn1"onclick="window.location.href='{{ route('attendance-student', ['classId' => $class->id]) }}'">ATTENDANCE</button>
            <button class="btn1"onclick="window.location.href='{{ route('grade-student', ['classId' => $class->id]) }}'">GRADE</button>
            <button class="btn1"onclick="window.location.href='{{ route('feedback-student', ['classId' => $class->id]) }}'">FEEDBACK</button>
        </div>
    </div> -->

<div class="dashboard-container">
    <div class="content-container">
        <!-- Class Card -->
        <div class="class-card">
            <div class="class-header">
                <p>School Year: {{ $class->school_year }}</p>
                <p>Semester: {{ $class->semester }}</p>
                <p>Section: {{ $class->section }}</p>
            </div>
            <div class="class-details">
                <h2>{{ $class->subject }}</h2>
                <p>Schedule: {{ $class->schedule_day }} - {{ $class->start_time }} - {{ $class->end_time }}</p>
                <p>Room: {{ $class->room }}</p>
            </div>
            <div class="class-buttons">
                <button onclick="window.location.href='{{ route('attendance-student', ['classId' => $class->id]) }}'">Attendance</button>
                <button onclick="window.location.href='{{ route('feedback-student', ['classId' => $class->id]) }}'">Feedback</button>
                <button onclick="window.location.href='{{ route('profile-student', ['classId' => $class->id]) }}'">Badge</button>
            </div>
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



</body>
</html>
