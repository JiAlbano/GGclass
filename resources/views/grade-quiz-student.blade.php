<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Grade</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('student-view/grade-quiz-student.css') }}">
    <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('student-view/grade-quiz-student.css') }}">
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
                    <button  class="btn1 challenge-btn1 active"
                        onclick="window.location.href='{{ route('grade.show', ['classId' => $class->id]) }}'">Grade</button>
                </div>
            </div>

<div class="container-sm my-4 d-flex flex-column justify-content-start align-items-center position-relative">
    <div class="table-container w-100">
        <table class="table table-bordered table-striped table-blue">
            <thead>
                <tr>
                    <th>Test and Quizzes</th>
                    <th>Exam</th>
                    <th>Project</th>
                    <th>Term Paper</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 1 - <span style="color: black; font-weight: normal;">10/15</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 2 - <span style="color: black; font-weight: normal;">15/15</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 3 - <span style="color: black; font-weight: normal;">20/20</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 4 - <span style="color: black; font-weight: normal;">18/20</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 5 - <span style="color: black; font-weight: normal;">17/20</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 6 - <span style="color: black; font-weight: normal;">14/20</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 7 - <span style="color: black; font-weight: normal;">19/20</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 8 - <span style="color: black; font-weight: normal;">16/20</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 9 - <span style="color: black; font-weight: normal;">20/20</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Quiz 10 - <span style="color: black; font-weight: normal;">13/15</span></p>
                    </td>
                    <td>
                        <p style="color: #2e3667; font-weight: bold;">Prelim - <span style="color: black; font-weight: normal;">90/100</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Midterm - <span style="color: black; font-weight: normal;">100/100</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Prefinals - <span style="color: black; font-weight: normal;">85/100</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Finals - <span style="color: black; font-weight: normal;">95/100</span></p>
                    </td>
                    <td>
                        <p style="color: #2e3667; font-weight: bold;">Project 1 - <span style="color: black; font-weight: normal;">100/100</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Project 2 - <span style="color: black; font-weight: normal;">90/100</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Project 3 - <span style="color: black; font-weight: normal;">85/100</span></p>
                    </td>
                    <td>
                        <p style="color: #2e3667; font-weight: bold;">Term Paper 1 - <span style="color: black; font-weight: normal;">20/20</span></p>
                        <p style="color: #2e3667; font-weight: bold;">Term Paper 2 - <span style="color: black; font-weight: normal;">30/30</span></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

        </div>
    </div>

</body>

</html>
