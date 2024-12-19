<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Website Name -->
    <title>Gradebook</title>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Press+Start+2P&display=swap"
        rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-list.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-dashboard.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/components/main.css') }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body class="main-body">
    <header>
        <nav class="navbar navbar-expand-lg nav-design">
            <div class="container-fluid nav-body">

                <div class="logo-text">
                    <a class="logo-text" href="#">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-img">
                        GGclass
                    </a>
                </div>

                <div class="user-text">

                    <!-- Button for creating a class -->
                    @if (auth()->user()->user_type === 'teacher')
                        <button type="button" id="create-class-option" class="addbtn create-class-btn">
                            <img src="{{ asset('img/create.png') }}" alt="create-class" class="create-button">
                        </button>
                    @endif

                    <!-- Button for joining a class -->
                    @if (auth()->user()->user_type === 'student')
                        <button type="button" id="join-class-option" class="addbtn join-class-btn">
                            <img src="{{ asset('img/join.png') }}" alt="join-class" class="join-button">
                        </button>
                    @endif

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

        <!-- Join Class Modal -->
        <div class="modal fade" id="joinClassModal" tabindex="-1" aria-labelledby="joinClassModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered"> <!-- Center the modal -->
                <div class="modal-content p-4"> <!-- Add padding for proper spacing -->
                    <!-- Close button aligned to the top-right -->
                    <button type="button" class="btn-close position-absolute" style="right: 1rem; top: 1rem;"
                        data-bs-dismiss="modal" aria-label="Close"></button>

                    <!-- Modal title -->
                    <div class="text-center mb-4">
                        <h2 class="modal-title" id="joinClassModalLabel">Join Class</h2>
                    </div>

                    <!-- Form Content -->
                    <form method="POST" action="{{ route('join.class') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="classCode" class="form-label">Class Code</label>
                            <input type="text" class="form-control" id="classCode" name="class_code"
                                placeholder="Enter class code" aria-required="true">
                        </div>
                        <div class="text-end"> <!-- Align button to the right -->
                            <button type="submit" class="join-button">Join</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <main>

        @yield('landing')
        @yield('data')
        @yield('gradecomponents')

    </main>

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

</body>

</html>
