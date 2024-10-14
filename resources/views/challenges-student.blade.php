<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Challenges</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('student-view/challenges-student.css') }}"> <!-- New CSS file for the container -->
</head>
<body>

    <div class="navbar">
        <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $challenges[0]->class_id]) }}'">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass ></h1>
            <h2 class="section-font">{{ $challenges[0]->section }}</h2>
    </div>




    <div class="right-section">
        <button class="back-button" onclick="goBack()">Back</button>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>
        <button class="back-button"onclick="window.location.href='{{ route('classroom.index') }}'">Class-List</button>
        <img class="profile-img" src="{{ asset('ainz.jpg') }}" alt="Create">
    </div>
</div>
    <div class="top-buttons containers" style=" margin-top: 84px;">
    <div class="row justify-content-center"> <!-- Added justify-content-center class -->
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
            <button class="btn " style="font-size: 12px; border:none; width: 100%;" onclick="window.location.href='{{ route('studentbulletins', ['classId' => $challenges[0]->class_id]) }}'">Bulletins</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" style="font-size: 12px; width: 100%; " onclick="window.location.href='{{ route('tutorials-student', ['classId' => $challenges[0]->class_id]) }}'">Tutorials</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn challenge-btn active" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('challenges-student', ['classId' => $challenges[0]->class_id]) }}'">Challenges</button>
        </div>
        <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
            <button class="btn" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('players-student', ['classId' => $challenges[0]->class_id]) }}'">Players</button>
        </div>
    </div>
</div>


<div class="info-container ">
    <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Picture" class="container-picture">
    <div class="container-name">{{ $user->first_name }} {{ $user->last_name }}</div>
    <div class="rank-section">
            <img src="{{ asset('bronze.png') }}" alt="Rank Picture" class="rank-pic">
        </div>
    <div class="container-info-section">
        <p class="class-name">Class Name: <span>{{ $challenges[0]->class_name }}</span></p>
        <p class="subject">Subject: <span>{{ $challenges[0]->subject }}</span></p>
        <p class="section">Section: <span>{{ $challenges[0]->section }}</span></p>
        <p class="section">Class Code: <span>{{ $challenges[0]->class_code }}</span></p>
    </div>
    <div class="container-info-email">
        <p>{{ $user->email }}</p>
    </div>


        <hr>
        <div class="container-buttons">
            <button class="btn"onclick="window.location.href='{{ route('profile-student', ['classId' => $challenges[0]->class_id]) }}'">PROFILE</button>
            <button class="btn"onclick="window.location.href='{{ route('attendance-student', ['classId' => $challenges[0]->class_id]) }}'">ATTENDANCE</button>
            <button class="btn"onclick="window.location.href='{{ route('grade-student', ['classId' => $challenges[0]->class_id]) }}'">GRADE</button>
            <button class="btn"onclick="window.location.href='{{ route('feedback-student', ['classId' => $challenges[0]->class_id]) }}'">FEEDBACK</button>
        </div>
    </div>

    <div class="container-q">
        @foreach ($challenges as $challenge)
            <div class="container quiz-container">
                <button type="button" class="quiz-button" onclick="window.location.href='{{ route('quiz-student', ['classId' => $challenge->class_id]) }}'">
                    {{$challenge->title}}
                </button>
            </div>
        @endforeach
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
