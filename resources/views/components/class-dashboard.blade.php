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
    {{-- <link rel="stylesheet" href="{{ asset('css/components/main.css') }}"> --}}

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg nav-design">
            <div class="container-fluid nav-body">

                <div class="logo-text">
                    <a class="logo-text" href="#">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-img">
                        GGclass
                    </a>
                </div>

                <div class="logo-user-text">

                    <!-- User Image -->
                    <div class="user-image">
                        <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="User Image"
                            class="user-img d-inline-block" align-text-top id="logout-btn" aria-expanded="false" />

                        <!-- Logout Dropdown -->
                        <div class="user-settings" id="logout-dropdown">
                            <ul class="user-menu">
                                <li class="user-item"> <a class="dropdown-item" href="#"
                                        onclick="handleArchiveClass(event)"> <img src="{{ asset('img/archieve.png') }}"
                                            alt="archieve-icon" class="user-icon"> Archive Class</a> </li>
                                <li class="user-item"> <a class="dropdown-item" href="#"
                                        onclick="handleProfileSettings(event)">
                                        <img src="{{ asset('img/settings.png') }}" alt="settings-icon"
                                            class="user-icon">
                                        Profile Settings</a> </li>
                                <li class="user-item">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf </form>
                                    <a class="dropdown-item" href="#" onclick="handleLogout(event)">
                                        <img src="{{ asset('img/logout.png') }}" alt="logout-icon" class="user-icon">
                                        Log out</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="text-container">
                        <p class="in-game-name">{{ $user->ign }} </p>
                        <p class="user-type">{{ $user->user_type }}</p>
                    </div>

                </div>


            </div>
        </nav>

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

                        <button class="btns"
                        onclick="window.location.href='{{ route('grade-components', ['classId' => $class->id]) }}'">Gradebook</button>
                    
                </div>

            </div>

            @yield('landing')

        </div>



    </main>

    <!-- JavaScript for Logout Dropdown -->
    <script>
        // Toggle Dropdown Visibility
        document.getElementById('logout-btn').addEventListener('click', () => {
            const dropdown = document.getElementById('logout-dropdown');
            dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' :
                'none';
        });

        // Close Dropdown When Clicking Outside
        document.addEventListener('click', (event) => {
            const dropdown = document.getElementById('logout-dropdown');
            const logoutBtn = document.getElementById('logout-btn');

            if (!logoutBtn.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Handle Logout Action
        function handleLogout(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modals using Bootstrap's API
            const createClassModal = new bootstrap.Modal(document.getElementById('createClassModal'));
            const joinClassModal = new bootstrap.Modal(document.getElementById('joinClassModal'));

            // Open Create Class Modal
            document.querySelectorAll('.create-class-btn').forEach(button => {
                button.addEventListener('click', () => {
                    createClassModal.show(); // Use Bootstrap's .show()
                });
            });

            // Open Join Class Modal
            document.getElementById('join-class-option')?.addEventListener('click', (event) => {
                event.preventDefault();
                joinClassModal.show();
            });

            // Clean up modal-backdrop after any modal is closed
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', () => {
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop
                        .remove());
                });
            });
        });
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
