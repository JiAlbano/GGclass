    <div class="navbar">
    <!-- Left Section -->
    <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('studentbulletins') }}'">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass</h1>
    </div>

    <!-- Right Section (Profile + Badge Progress) -->
    <div class="right-section">
        <!-- Badge Progress -->
        <div class="profile-section">
            <div class="badge-progress-container">
                <span id="currentBadge" alt="Current Badge"></span>
                <p class="current-points" id="currentPoints">{{ $sumOfScores }} pts</p>
                <span class="arrow">&rarr;</span>
                <p class="next-points" id="nextPoints"></p>
                <span id="nextBadge" alt="Next Badge" style="width: 35px; height: 35px;"></span>
            </div>
        </div>

        <!-- User Profile -->
        <div class="profile-container">
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
            <div class="logout-container">
                <ul class="logout-menu">
                    <li class="logout-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" class="dropdown-item" onclick="handleLogout(event)">Log out</a>
                    </li>
                    <li class="logout-item">
                        <button class="dropdown-item" onclick="window.location.href='{{ route('class-list') }}'">Class-List</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>



<!-- JavaScript for Logout Dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutButton = document.querySelector('#logout-btn');
        const logoutDropdown = document.querySelector('.logout-container');

        // Toggle dropdown on profile image click
        logoutButton.addEventListener('click', function (event) {
            event.stopPropagation();
            logoutDropdown.style.display = logoutDropdown.style.display === 'none' ? 'block' : 'none';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (!logoutButton.contains(event.target) && !logoutDropdown.contains(event.target)) {
                logoutDropdown.style.display = 'none';
            }
        });
    });

    function handleLogout(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit();
    }
</script>

<script src="{{ asset('js/navbar-badge.js') }}"></script>
<script>
    var sumOfScores = {{ $sumOfScores }};  // Pass sum of scores
    var numberOfItems = {{ $numberOfItems }};  // Pass number of items
</script>