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
            <div class="container-fluid">
                <a class="navbar-brand logo-text" href="#">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo"
                        class=" logo-img d-inline-block align-text-top ">
                    GGclass
                </a>
            </div>
    
            <div class="navbar-brand user-text">
    @if (auth()->user()->user_type === 'teacher')
        <!-- Button for creating a class -->
        <button type="button" id="create-class-option" class="addbtn create-class-btn">
            <img src="{{ asset('img/create.png') }}" alt="create-class" class="create-button">
        </button>
        @endif
    @if (auth()->user()->user_type === 'student')
<!-- Button for joining a class -->
<button type="button" id="join-class-option" class="addbtn join-class-btn">
            <img src="{{ asset('img/join.png') }}" alt="join-class" class="join-button">
        </button>
    @endif
</div>

<!-- Join Class Modal -->
<div class="modal fade" id="joinClassModal" tabindex="-1" aria-labelledby="joinClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h2 class="modal-title">Join Class</h2>
            <form method="POST" action="{{ route('join.class') }}">
                @csrf
                <div class="mb-3">
                    <label for="classCode" class="form-label">Class Code</label>
                    <input type="text" class="form-control" id="classCode" name="class_code" aria-required="true">
                </div>
                <button type="submit" class="btn btn-primary">Join</button>
            </form>
        </div>
    </div>
</div>


 <!-- User Image -->
<div class="user-image-container" style="position: relative;">
    <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}"
         alt="User Image" 
         class="user-img d-inline-block" 
         align-text-top 
         id="logout-btn" 
         aria-expanded="false" />

    <!-- Logout Dropdown -->
    <div class="logout-container" id="logout-dropdown" style="display: none;">
        <ul class="logout-menu">
            <li class="logout-item">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="#" onclick="handleLogout(event)">Log out</a>
            </li>
        </ul>
    </div>
</div>
                <div class="text-container">
                    <p class="in-game-name">{{ $user-> ign }}  </p>
                    <p class="user-type">{{ $user-> user_type }}</p>
                </div>

            </div>

        </nav>
    </header>

    <main>

        @yield('landing')
        @yield('data')
        @yield('gradecomponents')

    </main>
<style>

.in-game-name {
    color: #f5f5f5;
    position: relative;
    top: 20px;
    font-family: "Georgia";
    font-weight: bold;
    font-size: 18px;
    margin-right: 50px !important;
}
.navbar-brand.user-text:hover {
    color: white;
    cursor: default;
}

.user-type {
    color: #f5f5f5;
    position: relative;
    top: 2px;
    font-family: "Georgia";
    font-weight: normal;
    font-size: 15px;
}


/* Join Class Button */
.join-class-btn {
    background-color:rgb(6, 22, 145); /* Green color for Join Class */
    border-color:rgb(198, 247, 1);
}

.join-class-btn:hover {
    background-color: #4caf50; /* Hover effect for Join Class */
}

/* Button Text Styles */
.create-class-text,
.join-class-text {
    color: white; /* Text color */
}

.create-class-btn img,
.join-class-btn img {
    width: 25px; /* Adjust the size of the icon */
    height: 25px;
}

/* Adjusting the alignment of icons and text */
.addbtn img {
    margin-right: 10px; /* Space between icon and text */
}



/* Parent Container for Positioning */
.user-image-container {
    display: inline-block; /* Ensures the image and dropdown align as one unit */
    position: relative; /* Enables dropdown to position relative to the image */
}

/* Dropdown Styling */
.logout-container {
    position: absolute;
    top: 100%; /* Places dropdown directly below the image */
    left: 50%; /* Center aligns the dropdown under the image */
    transform: translateX(-50%); /* Corrects horizontal centering */
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    z-index: 1000;
    width: 150px; /* Optional: Set dropdown width */
    text-align: center; /* Centers the menu items */
    display: none; /* Hidden by default */
}

/* Menu and Items */
.logout-menu {
    list-style: none;
    padding: 10px 0;
    margin: 0;
}

.logout-item {
    padding: 10px 15px;
    cursor: pointer;
    color: black;
}

.logout-item:hover {
    background-color: #f0f0f0;
}

/* Image Styling */
.user-img {
    cursor: pointer;
    width: 50px; /* Adjust size as needed */
    height: 50px;
    border-radius: 50%; /* Circular image */
}

    .create-class-btn {
    width: 120px !important;
}

.addbtn.create-class-btn {
    /* Styling for the image-based button */
    background: none;
    border: none;
    padding: 0;
    margin: 0;
}
</style>
    <script>

// Toggle Dropdown Visibility
document.getElementById('logout-btn').addEventListener('click', () => {
    const dropdown = document.getElementById('logout-dropdown');
    dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
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

     // create class Modal Logic
document.querySelectorAll('.create-class-btn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('createClassModal').style.display = 'flex';
    });
});

// Close modal
document.querySelector('.close-btn').addEventListener('click', () => {
    document.getElementById('createClassModal').style.display = 'none';
});

document.addEventListener('DOMContentLoaded', function () {
    const joinClassModal = new bootstrap.Modal(document.getElementById('joinClassModal'));

    document.getElementById('join-class-option')?.addEventListener('click', function (event) {
        event.preventDefault();
        joinClassModal.show(); // Open the Join Class Modal when the button is clicked
    });

    // Close modal logic for Join Class Modal
    document.querySelector('.btn-close')?.addEventListener('click', () => {
        joinClassModal.hide(); // Close Join Class Modal using Bootstrap method
    });
});

    </script>

    {{-- JS BOOTSTRAP --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>


</body>

</html>
