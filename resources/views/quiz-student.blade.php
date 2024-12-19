<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Challenges</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('student-view/quiz-student.css') }}"> <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('student-view/quiz-student.css') }}"> <!-- New CSS file for the container -->

</head>
<body>

    <div class="navbar">
        <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('studentbulletins', ['classId' => $class->id]) }}'">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass</h1>
            <!-- <h2 class="section-font">{{ $class->section }}</h2> -->
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
            <button class="btn" style="font-size: 16px; border:none; width: 100%;" onclick="window.location.href='{{ route('studentbulletins', ['classId' => $class->id]) }}'">Bulletins</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" style="font-size: 16px; width: 100%; " onclick="window.location.href='{{ route('tutorials-student', ['classId' => $class->id]) }}'">Tutorials</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn challenge-btn active" style="font-size: 16px; width: 100%;" onclick="window.location.href='{{ route('challenges-student', ['classId' => $class->id]) }}'">Challenges</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" style="font-size: 16px; width: 100%;" onclick="window.location.href='{{ route('players-student', ['classId' => $class->id]) }}'">Players</button>
        </div>
    </div>
</div>

    <!-- Back Button -->
    <div class="back-button">
        <button onclick="window.history.back()">&#8592; Back</button>
    </div>

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

    <div class="container-q">
        @foreach($quizzes as $quiz)
            <?php $disable = in_array($quiz->id, $studentChallengesTaken->toArray()); ?>
            <div class="container quiz-container">
                <button type="button" class="{{ $disable > 0 ? 'disabled-btn' : 'quiz-button'}}" {{ $disable > 0 ? 'disabled' : '' }} onclick="window.location.href='{{  route('quiz-title-student', ['classId' => $class->id, 'quizId' => $quiz->id]) }}'">
                    {{ $quiz->title }}
                </button>
            </div>
        @endforeach
    </div>

    <div class="challenge-list">
    @foreach($quizzes as $quiz)
    <?php $disable = in_array($quiz->id, $studentChallengesTaken->toArray()); ?>
    <button type="button" class="{{ $disable > 0 ? 'disabled-btn' : 'quiz-button'}}" {{ $disable > 0 ? 'disabled' : '' }} onclick="window.location.href='{{  route('quiz-title-student', ['classId' => $class->id, 'quizId' => $quiz->id]) }}'">
            <div class="challenge-icon">
            <img src="{{ asset('megaphone.png') }}"/>
            </div>
            <div class="challenge-content">
                <p class="challenge-title">
                    Challenge type:{{ $quiz->title }}
                </p>
                <p class="challenge-date">{{ $challenge->created_at->format('M d, Y') }}</p>
            </div>
            <div class="challenge-options">
                <span class="options-btn">•••</span>
            </div>
        </button>
    @endforeach
</div>
    </div>
    

<style>
    /* Individual challenge Item */
.challenge-list {
    display: flex;
    flex-direction: column; /* Stack items vertically */
    gap: 10px; /* Add spacing between items */
}

.challenge-item {
    display: flex;
    align-items: center; /* Align content vertically */
    justify-content: flex-start; /* Align content to the left */
    width: 230%;
    padding: 5px;
    border: 1px solid #151414e6;
    border-radius: 5px;
    background-color: #fff;
    cursor: pointer;
    text-align: left; /* Ensure text aligns to the left */
    transition: background-color 0.3s ease;
}


.challenge-icon {
    margin-right: 15px;
}

.challenge-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    filter: brightness(1.2); /* Slightly brighten icons */
}

.challenge-content {
    flex-grow: 1;
    font-family: Arial, sans-serif;
}

.challenge-item:hover {
    transform: scale(1.02); /* Subtle scaling for hover effect */
    background-color: #a8a4a4b8;
  
}

.challenge-title {
    font-size: 14px;
    font-weight: bold;
    color: #2b52b2;
    margin: 0;
    padding: 3px;
}

.challenge-date {
    font-size: 12px;
    color: #888;
    margin: 5px 0 0 0;
}

.challenge-options {
    display: flex;
    align-items: center;
}/* challenge List Container */
.challenge-list {
    display: flex;
    flex-direction: column;
    gap: 2px; /* Spacing between items */
    width: 120%;
    max-width: 600px;
    margin: 0px auto;
    margin-left: 10px;
}

/* Individual challenge Item */
.challenge-list {
    display: flex;
    flex-direction: column; /* Stack items vertically */
    gap: 10px; /* Add spacing between items */
}

.challenge-item {
    display: flex;
    align-items: center; /* Align content vertically */
    justify-content: flex-start; /* Align content to the left */
    width: 230%;
    padding: 5px;
    border: 1px solid #151414e6;
    border-radius: 5px;
    background-color: #fff;
    cursor: pointer;
    text-align: left; /* Ensure text aligns to the left */
    transition: background-color 0.3s ease;
}


.challenge-icon {
    margin-right: 15px;
}

.challenge-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    filter: brightness(1.2); /* Slightly brighten icons */
}

.challenge-content {
    flex-grow: 1;
    font-family: Arial, sans-serif;
}

.challenge-item:hover {
    transform: scale(1.02); /* Subtle scaling for hover effect */
    background-color: #a8a4a4b8;
  
}

.challenge-title {
    font-size: 14px;
    font-weight: bold;
    color: #2b52b2;
    margin: 0;
    padding: 3px;
}

.challenge-date {
    font-size: 12px;
    color: #888;
    margin: 5px 0 0 0;
}
</style>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
