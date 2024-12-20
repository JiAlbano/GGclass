<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Grade</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('grade-quiz.css') }}"> <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('grade-quiz.css') }}"> <!-- New CSS file for the container -->
</head>
<body>

    <div class="navbar">
        <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass ></h1>
            <h2 class="section-font">{{ $class->section }}</h2>
    </div>

    <button class="back-button" onclick="goBack()">Back</button>
    
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    
    <!-- User Profile -->
    <div class="profile-container" style="position: relative;">
        <img class="profile-img"
             src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}"
             alt="Profile"
             id="logout-btn"
             aria-expanded="false">

        <!-- Logout Dropdown -->
        <div class="logout-container" style="display: none; position: absolute; right: 0; z-index: 1000;">
            <ul class="logout-menu">
                <li class="logout-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#" onclick="handleLogout(event)">Log out</a>
                </li>
                <li class="logout-item">
                    <button class="dropdown-item" onclick="window.location.href='{{ route('classroom.index') }}'">Class-List</button>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- JavaScript for Logout Dropdown -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoutButton = document.querySelector('#logout-btn');
        const logoutDropdown = document.querySelector('.logout-container');

        // Toggle the dropdown when the profile image is clicked
        logoutButton.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevents the click from bubbling up
            logoutDropdown.style.display = logoutDropdown.style.display === 'none' ? 'block' : 'none'; // Toggle visibility of the dropdown
        });

        // Close the dropdown when clicking outside
        document.addEventListener('click', function (event) {
            if (!logoutButton.contains(event.target) && !logoutDropdown.contains(event.target)) {
                logoutDropdown.style.display = 'none'; // Hide the dropdown
            }
        });
    });

    function handleLogout(event) {
        event.preventDefault();
        document.getElementById('logout-form').submit(); // Submit the Laravel logout form
    }
</script>

    <div class="top-buttons containers" style=" margin-top: 84px;">
        <div class="row justify-content-center"> <!-- Added justify-content-center class -->
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
                <button class="btn" style="font-size: 12px; border:none; width: 100%;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%; " onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id])}}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
            </div>
        </div>
    </div>

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
        <div class="container-buttons">
            <button class="btn"onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">ATTENDANCE</button>
            <button class="btn  challenge-btn active"onclick="window.location.href='{{ route('grade', ['classId' => $class->id]) }}'">GRADE</button>
            <button class="btn"onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">FEEDBACK</button>
            <button class="btn"onclick="window.location.href='{{ route('student-list', ['classId' => $class->id]) }}'">GRADEBOOK</button>
        </div>
    </div>

<div class="container-adviser my-4">
    <div class="container-sm d-flex flex-column justify-content-start align-items-center">
        @foreach($grades as $grade)
            <div class="row justify-content-center">
                <div class="student-container">
                    <div class="student-name">
                        <h5>{{$grade->first_name}} {{$grade->last_name}}</h5>
                    </div>
                    <div class="student-score">
                        <p id="current-score">{{$grade->total_score}}/{{$grade->number_of_items}}</p>
                    </div>
                    <div>
                        <!-- Button to trigger modal -->
                        <button class="quiz-button btn" data-bs-toggle="modal" data-bs-target="#editScoreModal" data-name="{{$grade->first_name}} {{$grade->last_name}}" data-score="{{$grade->total_score}}" data-items="{{$grade->number_of_items}}" data-id="{{$grade->id}}">Edit</button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editScoreModal" tabindex="-1" aria-labelledby="editScoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editScoreModalLabel">Edit Score</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editScoreForm">
                    <div class="mb-3">
                        <label for="studentName" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="studentName" value="John Ignacious" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="newScore" class="form-label">New Score</label>
                        <input type="number" class="form-control" id="newScore" value="19">
                    </div>
                    <div class="mb-3">
                        <label for="totalScore" class="form-label">Total Score</label>
                        <input type="number" disabled class="form-control" id="totalScore" value="20">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn" id="saveScore">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS and dependencies -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap JS and Popper.js -->

<script>
    // JavaScript to handle saving the new score
    document.getElementById('saveScore').addEventListener('click', function() {
        const newScore = document.getElementById('newScore').value;
        const totalScore = document.getElementById('totalScore').value;
        const id = $(this).data('id')
        // Update the score in the student container
        $.ajax({
                url: '/grade-quiz/edit-score',  // URL where you want to send the PUT request
                type: 'POST',           // Laravel uses POST to handle PUT requests
                data: {newScore: newScore, id: id},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Add CSRF token in headers
                },
                success: function(response) {
                    if(response == 1) {
                        document.getElementById('current-score').innerText = `${newScore}/${totalScore}`;
                        alert("You have successfully updated the score.");
                    }
                    setTimeout(() => {
                        location.reload()
                    }, 1500)
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        // Close the modal after saving the changes
        // const editScoreModal = new bootstrap.Modal(document.getElementById('editScoreModal'));
        // editScoreModal.hide();
        // $('#editScoreModal').modal('show');
    });

    $(".quiz-button").click(function() {
        const name = $(this).data('name')
        const items = $(this).data('items')
        const score = $(this).data('score')
        const id = $(this).data('id');

        $("#saveScore").attr('data-id', id)
        $("#studentName").val(name)
        $("#newScore").val(score)
        $("#totalScore").val(items)
    })
</script>

</body>
</html>
