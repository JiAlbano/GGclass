<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GGclass</title>

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <!--Bootstrap CSS-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!--Custom CSS-->
    <link rel="stylesheet" href="{{ secure_asset('components/class-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('components/class-dashboard.css') }}">

</head>

<body>

    <header>
        <div class="navbar">
            <div class="left-section"
                onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
                <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
                <h1 class="ggclass-font">GGclass</h1>
            </div>

            <!-- User Profile -->
            <div class="profile-container">
                <img class="profile-img" src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Profile"
                    id="logout-btn" aria-expanded="false">
                <div class="text-container">
                    <p class="in-game-name">{{ $user->ign }}</p>
                    <p class="user-type">{{ $user->user_type }}</p>
                </div>
                <!-- Logout Dropdown -->
                <div class="logout-container"
                    style="display: none; position: absolute; top: 100%; right: 0; z-index: 1000;">
                    <ul class="logout-menu" style="margin: 0; padding: 0; list-style: none;">
                        <li class="logout-item" style="padding: 8px 12px;">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#" onclick="handleLogout(event)">Log out</a>
                        </li>
                        <li class="logout-item" style="padding: 8px 12px;">
                            <button class="dropdown-item" onclick="window.location.href='{{ route('class-list') }}'"
                                style="border: none; background: none; text-decoration: none; color: #333; cursor: pointer;">Class-List</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <nav>
        <div class="top-buttons container mt-3">
            <div class="hyperlink">

                <div class="bulletins">
                    <button class="btn {{ request()->routeIs('bulletins') ? 'active' : '' }}"
                        onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
                </div>

                <div class="tutorials">
                    <button class="btn {{ request()->routeIs('tutorials') ? 'active' : '' }}"
                        onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id]) }}'">Tutorials</button>
                </div>

                <div class="challenges">
                    <button class="btn {{ request()->routeIs('challenges') ? 'active' : '' }}"
                        onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
                </div>

                <div class="players">
                    <button class="btn {{ request()->routeIs('players') ? 'active' : '' }}"
                        onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
                </div>


            </div>
        </div>
    </nav>

    <main>

        <div class="dashboard-container container-sm mt-5">

            <div class="left-container">

                <div class="class-header">
                    <p class="sy">School Year: <span class="uppercase">{{ $class->school_year }}</span></p>
                    <p class="sem">Semester: <span class="uppercase">{{ $class->semester }}</span></p>
                    <p class="sec">Section: <span class="uppercase">{{ $class->section }}</span></p>
                    <p class="cc">Class Code: <span class="uppercase">{{ $class->class_code }} </span></p>
                </div>

                <div class="class-details">
                    <p class="sub"> Subject: <span class="uppercase">{{ $class->subject }} </span></p>
                    <p class="sched">Schedule: <span class="uppercase">{{ $class->schedule_day }} </span>
                        {{ date('h:iA', strtotime($class->start_time)) }} -
                        {{ date('h:iA', strtotime($class->end_time)) }}
                    </p>
                    <p class="rm">Room: <span class="uppercase">{{ $class->room }}</span></p>
                </div>

                <div class="custom-line container-sm container-md container-lg"></div>

                <div class="class-buttons">
                    <button class="btns"
                        onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">Attendance</button>
                    <button class="btns"
                        onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">Feedback</button>
                    <button class="btns" href="#">Gradebook</button>
                </div>

            </div>

            @yield('landing')

        </div>



    </main>

    <!-- JavaScript for Logout Dropdown -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutButton = document.querySelector('#logout-btn');
            const logoutDropdown = document.querySelector('.logout-container');

            // Toggle the dropdown when the profile image is clicked
            logoutButton.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevents the click from bubbling up
                logoutDropdown.style.display = logoutDropdown.style.display === 'none' ? 'block' :
                    'none'; // Toggle visibility of the dropdown
            });

            // Close the dropdown when clicking outside
            document.addEventListener('click', function(event) {
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

<!-- Bulletin List -->
{{-- <div class="dashboard-container">
                    <!-- Add Challenge Button -->
                    <div class="add-challenge-container">
                        <button type="button" class="add-challenge-btn" data-bs-toggle="modal" id="addBtn"
                            data-bs-target="#addMemberModal">
                            <div class="icon">
                                <img src="{{ asset('challenge.png') }}" alt="Add Challenge Icon" class="icon-img">
                            </div>
                            <div class="text">Create a new tutorial to your class</div>
                        </button>
                    </div>
    
                    <!-- Bulletin List -->
                    <div class="bulletin-list">
                        <div class="bulletin-item">
                            <div class="bulletin-icon">
                                <img src="{{ asset('megaphone.png') }}" />
                            </div>
                            <div class="bulletin-content">
                                <p class="bulletin-title">You posted new bulletin to your class.</p>
                                <p class="bulletin-date">Dec 21, 2024</p>
                            </div>
                            <div class="bulletin-options">
                                <button class="options-btn">•••</button>
                            </div>
                        </div>
                  
                    </div>
                </div> --}}

</html>
