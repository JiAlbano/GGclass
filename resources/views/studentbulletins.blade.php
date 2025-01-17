<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Bulletins</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('student-view/bulletins-student.css') }}">
    <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('student-view/bulletins-student.css') }}">
</head>

<body>

<!-- navbar -->
@extends('layouts.app')

@section('title', 'Bulletins')

@section('content')

@endsection

    <div class="top-buttons containers" style=" margin-top: 84px;">
        <div class="row justify-content-center"> <!-- Added justify-content-center class -->
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
                <button class="btn challenge-btn active"
                    onclick="window.location.href='{{ route('studentbulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style=" width: 100%; "
                    onclick="window.location.href='{{ route('tutorials-student', ['classId' => $class->id]) }}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="width: 100%;"
                    onclick="window.location.href='{{ route('challenges-student', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style=" width: 100%;"
                    onclick="window.location.href='{{ route('players-student', ['classId' => $class->id]) }}'">Players</button>
            </div>
        </div>
    </div>

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
                    <h2>{{ $class->subject }}</h2>
                    <p>Schedule: {{ $class->schedule_day }} - {{ $class->start_time }} - {{ $class->end_time }}</p>
                    <p>Room: {{ $class->room }}</p>
                </div>
                <div class="class-buttons">
                    <button
                        onclick="window.location.href='{{ route('attendance-student', ['classId' => $class->id]) }}'">Attendance</button>
                    <button
                        onclick="window.location.href='{{ route('feedback-student', ['classId' => $class->id]) }}'">Feedback</button>
                    <button
                        onclick="window.location.href='{{ route('profile-student', ['classId' => $class->id]) }}'">Badge</button>
                        <button onclick="window.location.href='{{ route('grade-student', ['classId' => $class->id]) }}'">Grade</button>
                </div>
            </div>

            <!-- Bulletin List -->
            <div class="bulletin-list">
                <div class="bulletin-item">
                    <div class="bulletin-icon">
                        <img src="{{ asset('megaphone.png') }}" />
                    </div>
                    <div class="bulletin-content">
                        <p class="bulletin-title"> bulletin(#): Title</p>
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
