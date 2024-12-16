<!DOCTYPE html>
<html>
<head>
    <!-- Title of the page -->
    <title>Login</title>
    <!-- Link to favicon (small icon in browser tab) -->
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <!-- Link to external CSS stylesheet for styling the login page -->
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('login.css') }}">
</head>

<body>

    {{-- Display errors if any occurred during login --}}
    @if ($errors->any())
        <div class="alert alert-danger" style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 80%; text-align: center; color: white; font-family: 'Press Start 2P', cursive;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li> <!-- List each error message -->
                @endforeach
            </ul>
        </div>

    @endif

    {{-- Display a success message if any --}}
    @if(session()->has('message'))
    <div class="alert alert-success" style="position: absolute; top: 30px; left: 50%; transform: translateX(-50%); width: 80%; text-align: center; color:white; font-family: 'Press Start 2P', cursive;">
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
        <div class="position-relative">
            <!-- Existing logo and university name at the top-left -->
            <div class="position-absolute top-0 start-0">
                <img src="{{asset('img/Ateneo_de_Naga_University_logo.png')}}" alt="Adnu logo" class="adnu-logo">
                <span class="university-name">Ateneo de Naga University</span>
            </div>
        </div>

        <!-- Centered greeting, logo, and login button -->
        <div class="center-content">
            <span class="greeting">Hello, Ateneans</span>
            <img src="{{asset('FinalLogo.png')}}" alt="Final Logo" class="final-logo">

            <div class="login-label">
                <span>Log-in your account</span>
            </div>

            <!-- Login button below the logo -->
            <div class="content-container">
                <div class="login-container">
                    <a href="{{ route('googleRedirect') }}" class="login-button">
                        <img src="{{ asset('googlelogo.png') }}" alt="Google Logo" class="google-icon">
                        Login with Gbox account
                    </a>
                </div>
            </div>
        </div>
    </div>


</body>
</html>
