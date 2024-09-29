<!DOCTYPE html>
<html>
<head>
    <!-- Title of the page -->
    <title>Login</title>
    <!-- Link to favicon (small icon in browser tab) -->
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <!-- Link to external CSS stylesheet for styling the login page -->
    <link rel="stylesheet" type="text/css" href="{{ asset('login.css') }}">
</head>

<body>

    {{-- Display errors if any occurred during login --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li> <!-- List each error message -->
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Display a success message if any --}}
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }} <!-- Show the success message -->
    </div>
    @endif

    <button onclick="goBack()" class="back-button">Back</button>

        <script>
        function goBack() {
            window.history.back();
        }
        </script>

    <div class="container">
        <div class="logo-container">
            <!-- Display the logo image -->
            <img src="{{ asset('finalLogo.png') }}" alt="Logo" class="logo">
            <!-- Text next to the logo -->
            <p>GGclass</p>
        </div>

        <div class="content-container">
            <div class="login-container" style="align-items: center;">
                <!-- Button to log in with Google account -->
                <a href="{{ route('googleRedirect') }}" class="login-button">
                    <!-- Google logo for the login button -->
                    <img src="{{ asset('googlelogo.png') }}" alt="Google Logo" class="google-icon">
                    Login with Gbox account
                </a>
            </div>
                <br>
                <div>
                    <center><a class="sign-up-text">Sign-up as:</a></center>
                </div>
                    <center>
                        <div class="signup-container">
                            <!-- Button for teacher signup -->
                            <a href="{{ route('signup.teacher') }}" class="signup-teacher-button">Teacher</a> 
                            <br>
                            <!-- Button for student signup -->
                            <a href="{{ route('signup.student') }}" class="signup-student-button">Student</a>
                        </div>
                    </center>
        </div>
    </div>

</body>
</html>
