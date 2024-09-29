<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Bulletins</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('bulletins.css') }}"> <!-- New CSS file for the container -->
 <!--JS-->


</head>
<body>

<div class="navbar">
    <div class="left-section">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass ></h1>
        <h2 class="section-font">{{ $class->section }}</h2> <!-- Display class section -->
    </div>

    <div class="right-section">
        <!-- Back Button -->
        <button class="back-button"onclick="window.location.href='{{ route('classroom.index') }}'">Back to Classroom</button>
        <img class="profile-img" src="{{ asset('ainz.jpg') }}" alt="Create">
    </div>

</div>

    <div class="top-buttons" style="position: fixed">
        <button class="btn challenge-btn active">Bulletins</button>
        <button class="btn"onclick="window.location.href='{{ route('tutorials') }}'">Tutorials</button>
        <button class="btn" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
        <button class="btn"onclick="window.location.href='{{ route('players') }}'">Players</button>
    </div>

    <div class="half-line">
        <hr>
    </div>

<!-- Display profile picture -->
<div class="info-container">
        <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Profile Picture" class="container-picture">

<!-- Display user info -->
    @foreach($users as $user)
         <div class="container-name">{{ $user->first_name }} {{ $user->last_name }}</div>
                <div class="container-info-section">
                <p>{{ $class->class_name }} - {{ $class->subject }} - {{ $class->section }}</p>
    </div>
    <div class="container-info-email">
        <p>{{ $user->email }}</p>
    </div>
@endforeach


<hr>
        <div class="container-buttons">
            <button class="btn"onclick="window.location.href='{{ route('attendance') }}'">Attendance</button>
            <button class="btn"onclick="window.location.href='{{ route('grade') }}'">Grade</button>
            <button class="btn"onclick="window.location.href='{{ route('feedback') }}'">Feedback</button>
            <button class="btn"onclick="window.location.href='{{ route('gradebook') }}'">Gradebook</button>
        </div>
    </div>
</body>
</html>
