<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Players</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('student-view/players-student.css') }}">
    <link rel="stylesheet" href="{{ asset('student-view/players-student.css') }}"> <!-- New CSS file for the container -->
</head>


<body>

<!-- Navbar -->
@extends('layouts.app')

@section('title', 'Players')

@section('content')

@endsection

<div class="top-buttons containers" style=" margin-top: 84px; margin-left: 240px; margin-right: 240px;">
    <div class="row justify-content-center"> <!-- Added justify-content-center class -->
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
            <button class="btn" onclick="window.location.href='{{ route('studentbulletins', ['classId' => $class->class_id]) }}'">Bulletins</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn"  onclick="window.location.href='{{ route('tutorials-student', ['classId' => $class->class_id])}}'">Tutorials</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" onclick="window.location.href='{{ route('challenges-student', ['classId' => $class->class_id]) }}'">Challenges</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn challenge-btn active" onclick="window.location.href='{{ route('players-student', ['classId' => $class->class_id]) }}'">Players</button>
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
            <p class="sub"> Subject: <span class="uppercase">{{ $class->subject }} </span></p>
                <p class="sched">Schedule: <span class="uppercase">{{ $class->schedule_day }} </span>
                    {{ date('h:iA', strtotime($class->start_time)) }} -
                    {{ date('h:iA', strtotime($class->end_time)) }}
                </p>
            <p>Room: {{ $class->room }}</p>
        </div>
        <div class="class-buttons">
            <button onclick="window.location.href='{{ route('attendance-student', ['classId' => $class->class_id]) }}'">Attendance</button>
            <!-- <button onclick="window.location.href='{{ route('feedback-student', ['classId' => $class->class_id]) }}'">Feedback</button> -->
            <button onclick="window.location.href='{{ route('profile-student', ['classId' => $class->class_id]) }}'">Badge</button>
            <button onclick="window.location.href='{{ route('grade.show', ['classId' => $class->class_id]) }}'">Grade</button>
        </div>
    </div>

    <div class="dashboard-container">
        <div class="container d-flex justify-content-between align-items-center custom adviser">
            <div class="d-flex align-items-center">
                <img src="{{ asset($class->google_profile_image) }}" alt="Profile Picture" class="profile-pic">
                <div class="profile-name">{{ucfirst($class->ign)}}</div>
            </div>
            <div class="profile-role">Adviser</div>
        </div>

        <div class="container-sm my-4 d-flex flex-column justify-content-start align-items-center">
            <!-- First container2 -->
            <div class="d-flex justify-content-between align-items-start w-100">
                <!-- Profile Member on the left -->
                <div class="profile-member">Players</div>
                <!-- Profile Rank on the right -->
                <div class="profile-rank">Rank</div>
            </div>

        <!-- First Member Container -->
            @foreach($class_player as $player)
                @php
                    // Check if total_items is greater than zero to avoid division by zero
                    $percentage = 0;
                    if ($player->total_items > 0) {
                        // Calculate the percentage of total_score based on total_items
                        $percentage = ($player->total_score / $player->total_items) * 100;
                    }
                    
                    // Determine the badge based on the thresholds
                    $badge = '';
                    if ($percentage >= 76) {
                        $badge = 'gold.png'; // Gold badge
                    } elseif ($percentage >= 51) {
                        $badge = 'silver.png'; // Silver badge
                    } elseif ($percentage >= 26) {
                        $badge = 'bronze.png'; // Bronze badge
                    } else {
                        $badge = 'NO BADGE'; // No badge
                    }
                @endphp

                <div class="container2 d-flex justify-content-between align-items-center w-100">    
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($player->google_profile_image) }}" alt="Profile Picture" class="profile-pic">
                        <div class="profile-players">{{ ucfirst($player->ign) }}</div>
                    </div>

                    <div class="score-badge-section d-flex align-items-center">
                        <span class="total-score" style="color:gold; margin-right: 5px; font-family: georgia;">{{ $player->total_score ?? 0 }} pts</span>
                        <div class="rank-section">
                            @if($badge === 'NO BADGE')
                                <span class="no-badge">{{ $badge }}</span> <!-- Apply class for NO BADGE -->
                            @else
                                <img src="{{ url($badge) }}" alt="{{ $badge }} Badge" class="badge-img">
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

    

</body>
</html>
