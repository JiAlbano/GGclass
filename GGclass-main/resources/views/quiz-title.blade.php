<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Quiz</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('quiz-title.css') }}"> <!-- CSS file for styling -->
</head>
<body>

    <div class="navbar">
        <div class="left-section">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass ></h1>
            <h2 class="section-font">Section</h2>
        </div>

        <div class="back-container">
            <button class="back-button" onclick="goBack()">Back</button>
        </div>
        
        <script>
            function goBack() {
                window.history.back();
            }
        </script>

        <div class="right-section">
            <img class="profile-img" src="{{ asset('ainz.jpg') }}" alt="Create">
        </div>
    </div>

    <div class="top-buttons" style="position: fixed">
        <button class="btn" onclick="window.location.href='{{ route('bulletins') }}'">Bulletins</button>
        <button class="btn" onclick="window.location.href='{{ route('tutorials') }}'">Tutorials</button>
        <button class="btn challenge-btn active" onclick="window.location.href='{{ route('challenges') }}'">Challenges</button>
        <button class="btn" onclick="window.location.href='{{ route('players') }}'">Players</button>
    </div>

    <div class="half-line">
        <hr>
    </div>

    <div class="quiz-title" style="position: fixed">Quiz - Title</div> 
    

    <div class="half-line2">
        <hr>
    </div>

    <div class="info-container">
        <img src="{{ asset('ainz.jpg') }}" alt="Picture" class="container-picture">
        <div class="container-name">Jirvs</div>
        <hr>
        <div class="container-info-section">
            <p>Section</p>
        </div>
        <div class="container-info-name">
            <p>John Irvin Panganiban</p>
        </div>
        <div class="container-info-email">
            <p>jipanganiban@gbox.adnu.edu.ph</p>
        </div>
        <hr>
        <div class="container-buttons">
            <button class="btn" onclick="window.location.href='{{ route('attendance') }}'">Attendance</button>
            <button class="btn" onclick="window.location.href='{{ route('grade') }}'">Grade</button>
            <button class="btn" onclick="window.location.href='{{ route('feedback') }}'">Feedback</button>
            <button class="btn" onclick="window.location.href='{{ route('gradebook') }}'">Gradebook</button>
        </div>
    </div>

    <div class="quiz-container">
        <button id="edit-button" class="edit-button">Edit</button>
        <h1 id="quiz-title2">Quiz Title</h1>
        <p id="quiz-description">This is the quiz description.</p>
        <button class="open-button" id="open-button" onclick="window.location.href='{{ route('take-quiz') }}'">Open</button>
    </div>


    <!-- Modal for editing -->
    <div id="edit-modal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="close-modal">&times;</span>
            <h2 class="edit-quiz">Edit Quiz</h2>
            <label class="edit-title" for="new-title">Quiz Title:</label>
            <input type="text" id="new-title" placeholder="Enter new title">
            <br>
            <label for="new-description" class="quiz-description">Quiz Description:</label>
            <br>
            <textarea id="new-description" placeholder="Enter new description"></textarea>
            <button class="save" id="save-button">Save</button>
        </div>
    </div>

<script>
    // Show the modal when the Edit button is clicked
        document.getElementById('edit-button').addEventListener('click', () => {
            document.getElementById('edit-modal').style.display = 'flex';
        });

    // Close the modal when the close button is clicked
        document.getElementById('close-modal').addEventListener('click', () => {
            document.getElementById('edit-modal').style.display = 'none';
        });

        // Save the new title and description
        document.getElementById('save-button').addEventListener('click', () => {
            const newTitle = document.getElementById('new-title').value;
            const newDescription = document.getElementById('new-description').value;

            // Check if new title and description are provided
            if (newTitle) {
                document.getElementById('quiz-title2').textContent = newTitle;
            }

            if (newDescription) {
                document.getElementById('quiz-description').textContent = newDescription;
            }

            // Close the modal after saving
            document.getElementById('edit-modal').style.display = 'none';
        });
</script>


</body>
</html>
