<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Players</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('players.css') }}"> <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('players.css') }}">
</head>


<body>

    <div class="navbar">
        <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->class_id]) }}'">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass</h1>
            {{-- <h2 class="section-font">{{ $class->section }}</h2> --}}
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


    <div class="top-buttons containers" style="margin-left: 240px; margin-right: 240px;">
        <div class="row justify-content-center"> <!-- Added justify-content-center class -->
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
                <button class="btn" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->class_id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" onclick="window.location.href='{{ route('tutorials', ['classId' => $class->class_id])}}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" onclick="window.location.href='{{ route('challenges', ['classId' => $class->class_id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn challenge-btn active" onclick="window.location.href='{{ route('players', ['classId' => $class->class_id]) }}'">Players</button>
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
                <p>Class Code: {{ $class->class_code }} </p>
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
                 <button onclick="window.location.href='{{ route('attendance', ['classId' => $class->class_id]) }}'">Attendance</button>
                <!-- <button onclick="window.location.href='{{ route('feedback', ['classId' => $class->class_id]) }}'">Feedback</button> -->
                <button href="#">Gradebook</button>
            </div>
        </div>

        <div class="dashboard-container">
            <div class="container d-flex justify-content-between align-items-center custom adviser">
                <div class="d-flex align-items-center">
                    <img src="{{ asset($class->google_profile_image) }}" alt="Profile Picture" class="profile-pic">
                    <div class="profile-name">{{ucfirst($class->ign)}}</div>
                </div>
                <div class="profile-role">Adviser</div>
            </div>

            <div class="container-sm my-4 d-flex flex-column justify-content-start align-items-center">
                <!-- First container2 -->
                <div class="d-flex justify-content-between align-items-start w-100">
                    <!-- Profile Member on the left -->
                    <div class="profile-member">Players</div>
                    <!-- Profile Rank on the right -->
                    <div class="profile-rank">Rank</div>
                </div>

            <!-- First Member Container -->
                @foreach($class_player as $player)
                    @php
                        // Check if total_items is greater than zero to avoid division by zero
                        $percentage = 0;
                        if ($player->total_items > 0) {
                            // Calculate the percentage of total_score based on total_items
                            $percentage = ($player->total_score / $player->total_items) * 100;
                        }
                        
                        // Determine the badge based on the thresholds
                        $badge = '';
                        if ($percentage >= 76) {
                            $badge = 'gold.png'; // Gold badge
                        } elseif ($percentage >= 51) {
                            $badge = 'silver.png'; // Silver badge
                        } elseif ($percentage >= 26) {
                            $badge = 'bronze.png'; // Bronze badge
                        } else {
                            $badge = 'NO BADGE'; // No badge
                        }
                    @endphp

                    <div class="container2 d-flex justify-content-between align-items-center w-100">    
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($player->google_profile_image) }}" alt="Profile Picture" class="profile-pic">
                            <div class="profile-players">{{ucfirst($player->first_name)}} {{ucfirst($player->last_name)}} - {{ ucfirst($player->ign) }}</div>
                        </div>

                        <div class="rank-section">
                            @if($badge === 'NO BADGE')
                                <span class="no-badge">{{ $badge }}</span> <!-- Apply class for NO BADGE -->
                            @else
                                <img src="{{ url($badge) }}" alt="{{ $badge }} Badge" class="badge-img">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    

</body>
</html>
