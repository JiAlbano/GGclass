<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Attendance</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">


    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('attendance.css') }}"> <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('attendance.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/attendance-teacher.js') }}"></script>

</head>


<body>

<div class="navbar">
    <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass</h1>
        <!-- <h2 class="section-font">{{ $class->section }}</h2> -->
    </div>
    
    <!-- User Profile -->
      <div class="left-section">
    <div class="profile-container" style="display:flex">
        <img class="profile-img"
            src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}"
            alt="Profile"
            id="logout-btn"
            aria-expanded="false">
            <div class="text-container ">
                    <p class="in-game-name">{{ $user-> ign }}  </p>
                    <p class="user-type">{{ $user-> user_type }}</p>
                </div>
                </div>
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


<div class="top-buttons containers" style="margin-left: 240px; margin-right: 240px;">
    <div class="row justify-content-center"> <!-- Added justify-content-center class -->
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
            <button class="btn" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id])}}'">Tutorials</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
        </div>
    </div>
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
                <p class="sub"> Subject: <span class="uppercase">{{ $class->subject }} </span></p>
                <p class="sched">Schedule: <span class="uppercase">{{ $class->schedule_day }} </span>
                    {{ date('h:iA', strtotime($class->start_time)) }} -
                    {{ date('h:iA', strtotime($class->end_time)) }}
                </p>
                <p>Room: {{ $class->room }}</p>
            </div>
            <div class="class-buttons">
                <button class="btn challenge-btn active" onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">Attendance</button>
                <!-- <button onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">Feedback</button> -->
                <button class="btns"
                onclick="window.location.href='{{ route('students-list', ['classId' => $class->id]) }}'">Gradebook</button>
            </div>
        </div>

        <div class="dashboard-container">
            <!-- Attendance label, date picker, and search input -->
            <div class="attendance-header">
                <label class="attendance-label">Student's Attendance</label>
                <input type="date" class="attendance-date-picker" id="attendance-date" value="{{ request()->query('date', Date('Y-m-d')) }}">
                <!-- Search Input Added -->
                <!-- <input type="text" class="attendance-search" id="student-search" placeholder="Search Student"> -->
            </div>

            <!-- Main content container -->
            <div class="container-sm my-4 d-flex flex-column justify-content-start align-items-center">
                <!-- Student Containers -->
                <div class="student-container d-flex flex-column justify-content-start align-items-center w-100">
                    @foreach ($classUsers as $classUser)
                    <div class="container2 d-flex justify-content-between align-items-center w-100">
                        <!-- Left side: Student's picture and name -->
                        <div class="student-info d-flex align-items-center">
                            <img src="{{ $classUser->google_profile_image }}" alt="Student Picture" class="student-image">
                            <span class="student-name">{{ $classUser->first_name }} {{ $classUser->last_name }} ({{ $classUser->ign }})</span>
                        </div>
                        <!-- Middle: Input note -->
                        <div class="student-note">
                            <input type="text" class="form-control note-input" placeholder="Enter note here" data-id="{{$classUser->id}}" data-userid="{{$classUser->student_id}}" value="{{$classUser->note}}">
                            <button class="btn btn-save-note save-note" style="display: none;">Save</button>
                        </div>

                        <!-- Right side: Dropdown button -->
                        <div class="attendance-dropdown">
                            <select class="status">
                                <option value="">Status</option>
                                <option value="Present" {{$classUser->status == 'Present' ? 'selected' : ''}}>Present</option>
                                <option value="Absent" {{$classUser->status == 'Absent' ? 'selected' : ''}}>Absent</option>
                                <option value="Late" {{$classUser->status == 'Late' ? 'selected' : ''}}>Late</option>
                                <option value="Excused" {{$classUser->status == 'Excused' ? 'selected' : ''}}>Excused</option>
                            </select>
                        </div>
                    </div>
                    @endforeach     
                </div>
            </div>
        </div>
    </div>

<script src="/js/attendance-teacher.js"></script>

</body>
</html>
