<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Tutorials</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('student-view/tutorials-student.css') }}">
    <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('student-view/tutorials-student.css') }}">
    <!-- New CSS file for the container -->
</head>

<body>

    <!-- navbar -->
    @extends('layouts.app')

    @section('title', 'Bulletins')

    @section('content')

    @endsection


    <div class="top-buttons containers" style=" margin-top: 84px; margin-left: 240px; margin-right: 240px;">
        <div class="row justify-content-center"> <!-- Added justify-content-center class -->
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
                <button class="btn" style=" border:none; width: 100%;"
                    onclick="window.location.href='{{ route('studentbulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn challenge-btn active" style=" width: 100%; "
                    onclick="window.location.href='{{ route('tutorials-student', ['classId' => $class->id]) }}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style=" width: 100%;"
                    onclick="window.location.href='{{ route('challenges-student', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style=" width: 100%;"
                    onclick="window.location.href='{{ route('players-student', ['classId' => $class->id]) }}'">Players</button>
            </div>
        </div>
    </div>


    <!-- <div class="info-container ">
    <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Picture" class="container-picture">
    <div class="container-name">{{ $user->first_name }} {{ $user->last_name }}</div>
    <div class="rank-section">
            <img src="{{ asset('bronze.png') }}" alt="Rank Picture" class="rank-pic">
        </div>
    <div class="container-info-section">
        <p class="class-name">Class Name: <span>{{ $class->class_name }}</span></p>
        <p class="subject">Subject: <span>{{ $class->subject }}</span></p>
        <p class="section">Section: <span>{{ $class->section }}</span></p>
    </div>
    <div class="container-info-email">
        <p>{{ $user->email }}</p>
    </div>

        <div class="container-buttons">
            <button class="btn1"onclick="window.location.href='{{ route('profile-student', ['classId' => $class->id]) }}'">PROFILE</button>
            <button class="btn1"onclick="window.location.href='{{ route('attendance-student', ['classId' => $class->id]) }}'">ATTENDANCE</button>
            <button class="btn1"onclick="window.location.href='{{ route('grade-student', ['classId' => $class->id]) }}'">GRADE</button>
            <button class="btn1"onclick="window.location.href='{{ route('feedback-student', ['classId' => $class->id]) }}'">FEEDBACK</button>
        </div>
    </div> -->

    <div class="dashboard-container">
        <div class="content-container">
            <!-- Class Card -->
            <div class="class-card">
                <div class="class-header">
                    <p>School Year: {{ $class->school_year }}</p>
                    <p>Semester: {{ $class->semester }}</p>
                    <p>Section: {{ $class->section }}</p>
                </div>
                <div class="class-details">
                    <p class="sub"> Subject: <span class="uppercase">{{ $class->subject }} </span></p>
                    <p class="sched">Schedule: <span class="uppercase">{{ $class->schedule_day }} </span>
                        {{ date('h:iA', strtotime($class->start_time)) }} -
                        {{ date('h:iA', strtotime($class->end_time)) }}
                    </p>
                    <p>Room: {{ $class->room }}</p>
                </div>
                <div class="class-buttons">
                    <button
                        onclick="window.location.href='{{ route('attendance-student', ['classId' => $class->id]) }}'">Attendance</button>
                    <!-- <button
                        onclick="window.location.href='{{ route('feedback-student', ['classId' => $class->id]) }}'">Feedback</button> -->
                    <button
                        onclick="window.location.href='{{ route('profile-student', ['classId' => $class->id]) }}'">Badge</button>
                    <button
                        onclick="window.location.href='{{ route('grade.show', ['classId' => $class->id]) }}'">Grade</button>
                </div>
            </div>

            <!-- Bulletin List -->
            <div class="bulletin-list">
                <div class="bulletin-item">
                    <div class="bulletin-icon">
                        <img src="{{ asset('megaphone.png') }}" />
                    </div>
                    <div class="bulletin-content">
                        <p class="bulletin-title"> Tutorial (#): Title </p>
                        <p class="bulletin-date">Dec 21, 2024</p>
                    </div>
                    <div class="bulletin-options">
                        <button class="options-btn">•••</button>
                    </div>
                </div>
                <!-- Repeat other bulletin items -->
            </div>
        </div>
    </div>



</body>

</html>
