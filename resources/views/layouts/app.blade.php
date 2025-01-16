<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'GGclass')</title>

    <!-- Include Styles -->
    <link rel="stylesheet" href="{{ secure_asset('student-view/navbar-student.css') }}">
    <link rel="stylesheet" href="{{ asset('student-view/navbar-student.css') }}"> <!-- New CSS file for the container -->
</head>
<body>
    <!-- Navbar -->
    @include('components.navbar-student')

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
