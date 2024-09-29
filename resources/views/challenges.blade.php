    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
        <title>Challenges</title>

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

        <!--CSS-->
        <link rel="stylesheet" href="{{ asset('challenges.css') }}">
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
            <button class="back-button" onclick="window.location.href='{{ route('classroom.index') }}'">Back to Classroom</button>
            <img class="profile-img" src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Profile Image">
        </div>
    </div>

    <!-- Top buttons with classId route parameter -->
    <div class="top-buttons" style="position: fixed">
        <button class="btn" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
        <button class="btn" onclick="window.location.href='{{ route('tutorials') }}'">Tutorials</button>
        <button class="btn challenge-btn active">Challenges</button>
        <button class="btn" onclick="window.location.href='{{ route('players') }}'">Players</button>
    </div>

    <div class="half-line">
        <hr>
    </div>

    <!-- Modal trigger button -->
    <div class="create-quiz" style="position: fixed">
        <button type="button" class="btn create-btn" id="addBtn">Add</button>
    </div>

    <!-- User Information Block -->
    <div class="info-container">
    @foreach($users as $user)
            <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Profile Picture" class="container-picture">

            <div class="container-name">{{ $user->first_name }} {{ $user->last_name }}</div>
            <div class="container-info-section">
                <p>{{ $class->class_name }} - {{ $class->subject }} - {{ $class->section }}</p>
            </div>
            <div class="container-info-email">
                <p>{{ $user->email }}</p>
            </div>


    @endforeach
    <hr>
    <!-- Action buttons -->
    <div class="container-buttons">
        <button class="btn" onclick="window.location.href='{{ route('attendance') }}'">Attendance</button>
        <button class="btn" onclick="window.location.href='{{ route('grade') }}'">Grade</button>
        <button class="btn" onclick="window.location.href='{{ route('feedback') }}'">Feedback</button>
        <button class="btn" onclick="window.location.href='{{ route('gradebook') }}'">Gradebook</button>
    </div>

    </div>
    <div  class="quiz" style="position: fixed">Challenges</div>
    <!-- Modal Structure -->
    <div id="challengeModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
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
