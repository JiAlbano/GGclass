<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Bulletins</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600&display=swap" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('challenges.css') }}"> 
    <link rel="stylesheet" href="{{ asset('challenges.css') }}"> <!-- New CSS file for the container -->
</head>


<body>

<div class="navbar">
    <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass</h1>
        <!-- <h2 class="section-font">{{ $class->section }}</h2> -->
    </div>
    
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
                <button class="btn" style="font-size: 16px; border:none; width: 100%;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 16px; width: 100%; " onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id])}}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn  challenge-btn active" style="font-size: 16px; width: 100%;" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 16px; width: 100%;" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
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
        </div> -->

       <div class="dashboard-container">
    <!-- Back Button -->
<!--     <div class="back-button">
    <button onclick="window.history.back()" class="btn btn-secondary">
        &#8592; Back
    </button> -->
    </div>

    <div class="content-container">
        <!-- Class Card -->
        <div class="class-card">
            <div class="class-header">
                <p>School Year: {{ $class->school_year }}</p>
                <p>Semester: {{ $class->semester }}</p>
                <p>Section: {{ $class->section }}</p>
                <p>Class Code: {{ $class->class_code }}   </p>
            </div>
            <div class="class-details">
                <h2>{{ $class->subject }}</h2>
                <p>Schedule: {{ $class->schedule_day }} - {{ $class->start_time }} - {{ $class->end_time }}</p>
                <p>Room: {{ $class->room }}</p>
            </div>
            <div class="class-buttons">
                <button onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">Attendance</button>
                <button onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">Feedback</button>
                <button href="#">Gradebook</button>
            </div>
        </div>
        <div class="dashboard-container">
  <!-- Add Challenge Button -->
  <div class="add-challenge-container">
        <button type="button" class="add-challenge-btn" data-bs-toggle="modal" id="addBtn" data-bs-target="#addMemberModal">
            <div class="icon">
            <img src="{{ asset('challenge.png') }}" alt="Add Challenge Icon" class="icon-img">
            </div>
            <div class="text">Create a new challenge to your class</div>
        </button>
    </div>
            <!-- Modal Structure -->
            <div id="challengeModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 class="modal-title">Create Challenge</h2>
        <form id="challengeForm" method="POST" action="{{ route('challenges.create', ['classId' => $class->id]) }}">
            @csrf
            <!-- <div class="form-group">
                <label for="challengeTitle" class="form-label">Challenge Title</label>
                <input 
                    type="text" 
                    id="challengeTitle" 
                    name="challengeTitle" 
                    class="form-input" 
                    placeholder=" " 
                    required 
                />
            </div> -->
            <div class="form-group">
    <label for="challengeType" class="form-label">Challenge Type</label>
    <select id="challengeType" name="challengeType" class="form-input" required>
        <option value="" disabled selected>Select a challenge type</option>
        <option value="exam">Exam</option>
        <option value="test_and_quizzes">Test and Quizzes</option>
    </select>
</div>
            <button type="submit" id="createBtn" class="form-button">Create</button>
        </form>
    </div>
</div>
        <!-- Display Challenges -->

        <!-- <div class="container1">
        <div class="grid-container">
            @foreach($challenges as $challenge)
                @if(in_array($challenge->type, ['test_and_quizzes', 'exam', 'activity']))
                <button class="box" onclick="window.location.href='{{ route($challenge->type .'.show', ['classId' => $class->id]) }}'">
                    {{ str_replace('_', ' ', ucfirst($challenge->type)) }}
                </button>
                @endif
            @endforeach
        </div>
    </div> -->
           <!-- Display Challenges -->

        <div class="challenge-list">
    @foreach($challenges as $challenge)
        @if(in_array($challenge->type, ['test_and_quizzes', 'exam', 'activity']))
        <button class="challenge-item" onclick="window.location.href='{{ route($challenge->type .'.show', ['classId' => $class->id]) }}'">
            <div class="challenge-icon">
            <img src="{{ asset('megaphone.png') }}"/>
            </div>
            <div class="challenge-content">
                <p class="challenge-title">
                    Challenge type: {{ ucfirst(str_replace('_', ' ', $challenge->type)) }}
                </p>
                <p class="challenge-date">{{ $challenge->created_at->format('M d, Y') }}</p>
            </div>
            <div class="challenge-options">
                <span class="options-btn">•••</span>
            </div>
        </button>
        @endif
    @endforeach
</div>

    <script>
        const modal = document.getElementById("challengeModal");
        const addBtn = document.getElementById("addBtn");
        const closeBtn = document.getElementsByClassName("close")[0];

        addBtn.onclick = function() {
            modal.style.display = "block";
        };

        closeBtn.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>

    <!-- challenge List -->
    <!-- <div class="challenge-list">
        <div class="challenge-item">
            <div class="challenge-icon">
                <img src="megaphone-icon.png" alt="Icon">
            </div>
            <div class="challenge-content">
                <p class="challenge-title">You posted a new type of challenge: Quiz</p>
                <p class="challenge-date">Dec 21, 2024</p>
            </div>
            <div class="challenge-options">
                <button class="options-btn">•••</button>
            </div>
        </div> -->

    </div>
    </div>

</div>



                <!-- Action buttons -->
                <!-- <div class="container-buttons">
                    <button class="btn1"onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">ATTENDANCE</button>
                    <button class="btn1"onclick="window.location.href='{{ route('grade', ['classId' => $class->id]) }}'">GRADE</button>
                    <button class="btn1"onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">FEEDBACK</button>
                    <button class="btn1"onclick="window.location.href='{{ route('student-list', ['classId' => $class->id]) }}'">GRADEBOOK</button>
                </div>
</div> -->

                    <!-- Modal trigger button -->
   
        
                    <!-- Modal Structure -->
    <!-- <div id="challengeModal" class="modal">
        <div class="modal-content">      
       
            <h2 class="gamified-title">Add Challenge</h2>
            <form id="challengeForm" method="POST" action="{{ route('challenges.create', ['classId' => $class->id]) }}">
                @csrf
                {{-- <label for="challengeType" class="gamified-label">Challenge Type:</label> --}}
                <select id="challengeType" name="challengeType" class="gamified-input" required>
                    <option value="test_and_quizzes">Test and Quizzes</option>
                    <option value="exam">Exam</option>
                    <option value="activity">Activity</option>

                </select>
                <button type="submit" id="createBtn" class="btn create-btn gamified-button">Create</button>
            </form>
        </div>
    </div> -->






    </body>
    </html>
