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
    <link rel="stylesheet" href="{{ asset('challenges.css') }}"> <!-- New CSS file for the container -->
</head>


<body>

    <div class="navbar">
        <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass ></h1>
            <h2 class="section-font">{{ $class->section }}</h2>
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
                <button class="btn" style="font-size: 12px; border:none; width: 100%;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%; " onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id])}}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn  challenge-btn active" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
            </div>
        </div>
    </div>




    <!-- Display profile picture -->
    <div class="info-container ">
        <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Picture" class="container-picture">
        <div class="container-name">{{ $user->first_name }} {{ $user->last_name }}</div>
        <div class="container-info-section">
            <p class="class-name">Class Name: <span>{{ $class->class_name }}</span></p>
            <p class="subject">Subject: <span>{{ $class->subject }}</span></p>
            <p class="section">Section: <span>{{ $class->section }}</span></p>
            <p class="section">Class Code: <span>{{ $class->class_code }}</span></p>
        </div>
        <div class="container-info-email">
            <p>{{ $user->email }}</p>
        </div>

        <hr>
                <!-- Action buttons -->
                <div class="container-buttons">
                    <button class="btn"onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">ATTENDANCE</button>
                    <button class="btn"onclick="window.location.href='{{ route('grade', ['classId' => $class->id]) }}'">GRADE</button>
                    <button class="btn"onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">FEEDBACK</button>
                    <button class="btn"onclick="window.location.href='{{ route('student-list', ['classId' => $class->id]) }}'">GRADEBOOK</button>
                </div>
</div>

                    <!-- Modal trigger button -->
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-add2" data-bs-toggle="modal" id="addBtn" data-bs-target="#addMemberModal">Add</button>
        </div>

                    <!-- Modal Structure -->
    <div id="challengeModal" class="modal">
        <div class="modal-content">
            <span class="close"></span>
            <h2 class="gamified-title">Add Challenge</h2>
            <form id="challengeForm" method="POST" action="{{ route('challenges.create', ['classId' => $class->id]) }}">
                @csrf
                <label for="challengeType" class="gamified-label">Challenge Type:</label>
                <select id="challengeType" name="challengeType" class="gamified-input" required>
                    <option value="quiz">Quiz</option>
                    <option value="exam">Exam</option>
                    <option value="activity">Activity</option>
                </select>
                <button type="submit" id="createBtn" class="btn create-btn gamified-button">Create</button>
            </form>
        </div>
    </div>


    <!-- Display Challenges -->

    <div class="container1">
        <div class="grid-container">
            @foreach($challenges as $challenge)
                @if(in_array($challenge->type, ['quiz', 'exam', 'activity']))
                <button class="box" onclick="window.location.href='{{ route($challenge->type .'.show', ['classId' => $class->id]) }}'">
                    {{ ucfirst($challenge->type) }}
                </button>
                @endif
            @endforeach
        </div>
    </div>

    <script>
        const modal = document.getElementById("challengeModal");
        const addBtn = document.getElementById("addBtn");
        const closeBtn = document.getElementsByClassName("close")[0];

        addBtn.onclick = function() {
            modal.style.display = "block";
        };

        closeBtn.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>

    </body>
    </html>
