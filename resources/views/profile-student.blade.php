<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Badge</title>
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
    <link rel="stylesheet" href="{{ secure_asset('student-view/profile-student.css') }}">
    <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('student-view/profile-student.css') }}">
    <script src="/js/profile-badge.js"></script>
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
                    <button class="btn challenge-btn active"
                        onclick="window.location.href='{{ route('profile-student', ['classId' => $class->id]) }}'">Badge</button>
                    <button onclick="window.location.href='{{ route('grade.show', ['classId' => $class->id]) }}'">Grade</button>
                </div>
            </div>

            <div class="container-sm my-4 d-flex flex-column justify-content-center align-items-center position-relative">
                <!-- Points and Badges Progress Section -->
                <div class="d-flex flex-column align-items-center w-100">
                    <div class="progress-container" style="color: #ffffff;">
                        <h2>Points and Badges Progress</h2>
                        <div class="progress-info text-center" style="color: #ffffff;">
                            <p>
                                <span id="current-badge"></span>
                            </p>
                            <p>Current Points: <span id="current-points" style="color: gold; font-weight: bolder; font-size: 24px; margin-left: 5px;">{{ $sumOfScores }}</span></p>
                            <p>Points to Next Badge: 
                                <span id="points-to-next" style="color: gold; font-weight: bolder; font-size: 24px; margin-left: 5px;"></span>
                            </p>
                            <p>Next Badge: 
                                <span id="next-badge" style="color: gold; font-weight: bolder; font-size: 16px; margin-left: 5px;"></span>
                            </p>
                        </div>
                        <!-- Pass sumOfScores to JavaScript -->
                        <input type="hidden" id="number-of-items" value="{{ $numberOfItems }}">
                        <input type="hidden" id="sum-of-scores" value="{{ $sumOfScores }}">

                        <div class="progress-bar-container">
                            <div class="progress-bar">
                                <div class="badge bronze-badge"></div>
                                <div class="badge silver-badge"></div>
                                <div class="badge gold-badge"></div>
                                <div class="progress" id="progress"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- "Available Badges" Button -->
                <button id="available-badges-btn" class="btn btn-primary position-absolute" style="top: 10px; right: 10px;">
                    Available Badges
                </button>
            </div>


            <!-- Modal for Available Badges -->
            <div class="modal" tabindex="-1" id="badges-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Available Badges</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Here are your available badges that you can get!</p>

                            <!-- Badge List -->
                            <div class="badge-list d-flex justify-content-around">
                                <!-- Bronze Badge -->
                                <div class="badge-item text-center">
                                    <img src="{{ asset('bronze.png') }}" alt="Bronze Badge" class="badge-img">
                                    <h5>1st Pillar-Bronze Medallion</h5>
                                    <p class="badge-description">Awarded for completing your first challenge.</p>
                                </div>

                                <!-- Silver Badge -->
                                <div class="badge-item text-center">
                                    <img src="{{ asset('silver.png') }}" alt="Silver Badge" class="badge-img">
                                    <h5>2nd Pillar-Silver Medallion</h5>
                                    <p class="badge-description">Earned for consistent performance across multiple challenges.</p>
                                </div>

                                <!-- Gold Badge -->
                                <div class="badge-item text-center">
                                    <img src="{{ asset('gold.png') }}" alt="Gold Badge" class="badge-img">
                                    <h5>3rd Pillar-Gold Medallion</h5>
                                    <p class="badge-description">Given for completing expert-level challenges with excellence.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
