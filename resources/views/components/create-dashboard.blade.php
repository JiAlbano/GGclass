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


    <main>

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



</html>
