<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GGclass</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link href="home.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
        <!-- Brand Logo -->
        <a class="navbar-brand me-auto" href="#">
        <img class="ggclass-logo" src="finalLogo.png" alt="GGclass Logo"/>
        </a>

        <!-- Offcanvas Menu -->
        <div class="offcanvas offcanvas-end" style="background-color: #000; border-color: white;" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
        <!-- Offcanvas Logo and Title -->
            <img class="ggclass-logo" src="finalLogo.png" alt="GGclass Logo"/>
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel" style="font-family: 'Press Start 2P', cursive; color: white;">GGclass</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <!-- Navigation Links -->
            <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="#">Contact Us</a>
                </li>
            </ul>
        </div>
        </div>

        <!-- Sign In Button -->
        <button class="login-button"onclick="window.location.href='{{ route('welcome') }}'">Signin/Signup</button>
        <!-- Navbar Toggler for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        </div>
    </nav>
    <!-- End Navbar -->
    </header>

    <!-- Hero Section  -->

    <!-- End Hero Section  -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>