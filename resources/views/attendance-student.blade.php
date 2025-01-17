<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Attendance</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('student-view/attendance-student.css') }}">
    <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('student-view/attendance-student.css') }}">
</head>

<body>

    
<!-- Navbar -->
@extends('layouts.app')

@section('title', 'Players')

@section('content')

@endsection


    <div class="top-buttons containers" style=" margin-top: 84px;">
        <div class="row justify-content-center"> <!-- Added justify-content-center class -->
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
                <button class="btn"
                    onclick="window.location.href='{{ route('studentbulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style=" width: 100%; "
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

        <div class="content-container">
            <!-- Class Card -->
            <div class="class-card">
                <div class="class-header">
                    <p>School Year: {{ $class->school_year }}</p>
                    <p>Semester: {{ $class->semester }}</p>
                    <p>Section: {{ $class->section }}</p>
                </div>
                <div class="class-details">
                    <h2>{{ $class->subject }}</h2>
                    <p>Schedule: {{ $class->schedule_day }} - {{ $class->start_time }} - {{ $class->end_time }}</p>
                    <p>Room: {{ $class->room }}</p>
                </div>
                <div class="class-buttons">
                    <button class="btn challenge-btn active" 
                        onclick="window.location.href='{{ route('attendance-student', ['classId' => $class->id]) }}'">Attendance</button>
                    <button
                        onclick="window.location.href='{{ route('feedback-student', ['classId' => $class->id]) }}'">Feedback</button>
                    <button
                        onclick="window.location.href='{{ route('profile-student', ['classId' => $class->id]) }}'">Badge</button>
                        <button onclick="window.location.href='{{ route('grade.show', ['classId' => $class->id]) }}'">Grade</button>
                </div>
            </div>

            <div class="dashboard-container">
                <!-- Attendance label, date picker, and search input -->
                <div class="attendance-header">
                    <label class="attendance-label">Attendance</label>
                </div>

                <!-- Main content container -->
                    <div class="container-sm my-4 d-flex flex-column justify-content-start align-items-center">
                        <!-- User profile section -->
                        <div class="user-profile d-flex align-items-center">
                            <img src="{{ asset('img/ainz.jpg') }}" alt="User" class="user-picture">
                            <span class="user-name">John Ignacious Albano</span>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="student-container d-flex flex-column justify-content-start align-items-center w-100">
                            <div class="container2 d-flex justify-content-between align-items-center w-100">
                                <!-- Left side: Student's picture and name -->
                                <div class="student-info d-flex align-items-center">
                                    <span class="date">15/01/2024</span>
                                </div>

                                <!-- Middle: Input note -->
                                <div class="student-note d-flex align-items-center">
                                    <span class="note">Note</span>
                                </div>

                                <!-- Right side: Dropdown button -->
                                <div class="attendance-dropdown">
                                    <span class="status">Present</span>
                                </div>
                            </div>
                        </div>
                        <div class="student-container d-flex flex-column justify-content-start align-items-center w-100">
                            <div class="container2 d-flex justify-content-between align-items-center w-100">
                                <!-- Left side: Student's picture and name -->
                                <div class="student-info d-flex align-items-center">
                                    <span class="date">15/03/2024</span>
                                </div>

                                <!-- Middle: Input note -->
                                <div class="student-note d-flex align-items-center">
                                    <span class="note">Fever</span>
                                </div>

                                <!-- Right side: Dropdown button -->
                                <div class="attendance-dropdown">
                                    <span class="status">Excuse</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</body>

</html>
