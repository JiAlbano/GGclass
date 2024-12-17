<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Quiz</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('createquiz.css') }}">
    <link rel="stylesheet" href="{{ asset('createquiz.css') }}">
</head>

<body>

<div class="navbar">
        <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass ></h1>
            <h2 class="section-font">{{ $class->section }}</h2>
    </div>

{{-- <div class="navbar">
    <div class="left-section">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass ></h1>
        <h2 class="section-font">{{ $class->section }}</h2>
    </div> --}}

<!-- 
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
    {{-- <div class="right-section">
        <button class="back-button"onclick="window.location.href='{{ route('classroom.index') }}'">Back to Classroom</button>
        <img class="profile-img" src="{{ asset('ainz.jpg') }}" alt="Create">
    </div>
</div> --}} -->

    
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
                <button class="btn challenge-btn active" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
            </div>
        </div>
    </div>


    <div class="dashboard-container">
    <div class="back-button">
        <button onclick="window.history.back()" class="btn btn-secondary">
            &#8592; Back
        </button>
    </div>

    <div class="content-container">
        <h2>Create Quiz</h2>
        
        <form method="POST" action="{{ route('test_and_quizzes.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="class_id" value="{{ $class->id }}">

            <div class="form-group">
                <label for="quizTitle">Quiz Title</label>
                <input type="text" id="quizTitle" name="title" class="form-control" placeholder="Untitled Quiz" required>
            </div>

            <div class="form-group">
                <label for="quizDescription">Quiz Description</label>
                <textarea id="quizDescription" name="description" class="form-control" placeholder="Quiz Description"></textarea>
            </div>

            <div class="question-section">
                <h3>Questions</h3>
                <div id="questionsContainer">
                <button type="button" class="btn btn-primary add-question">Add Question</button>
            </div>

            <button type="submit" class="btn btn-success mt-3">Create</button>
        </form>
    </div>
</div>

<script>
    let questionCount = 0;
    let mcOptionCount = 0;

    // Show dynamic question form based on the question type
    function showQuestionForm(questionNumber) {
        const selectedType = document.getElementById(`questionType-${questionNumber}`).value;
        const questionForm = document.getElementById(`question-${questionNumber}`);
        const optionsContainer = questionForm.querySelector('.options-container');
        optionsContainer.innerHTML = ''; // Clear previous options

        if (selectedType === 'multipleChoice') {
            mcOptionCount = 0; // Reset mcOptionCount for each question
            optionsContainer.innerHTML = `
                <label for="mcAnswerKey-${questionNumber}">Answer Key:</label>
                <select id="mcAnswerKey-${questionNumber}" name="questions[${questionNumber}][correct_answer]">
                    <!-- Options will be dynamically populated -->
                </select>
                <div id="mcOptions-${questionNumber}" class="options-container">
                    <!-- Dynamic option input fields will appear here -->
                </div>
                <button type="button" onclick="addMCOption(${questionNumber})">Add Option</button>
            `;
        } else if (selectedType === 'trueFalse') {
            optionsContainer.innerHTML = `
                <label for="tfAnswer-${questionNumber}">Answer:</label>
                <select id="tfAnswer-${questionNumber}" name="questions[${questionNumber}][correct_answer]">
                    <option value="true">True</option>
                    <option value="false">False</option>
                </select>
            `;
        } else if (selectedType === 'identification') {
            optionsContainer.innerHTML = `
                <label for="idAnswer-${questionNumber}">Answer Key:</label>
                <input type="text" id="idAnswer-${questionNumber}" name="questions[${questionNumber}][correct_answer]" placeholder="Enter Answer Key">
            `;
        }
    }

    // Add multiple-choice options dynamically
    function addMCOption(questionNumber) {
        mcOptionCount++;
        const mcOptionsDiv = document.getElementById(`mcOptions-${questionNumber}`);
        const answerKeySelect = document.getElementById(`mcAnswerKey-${questionNumber}`);
        const optionHTML = `
            <div id="mcOption-${questionNumber}-${mcOptionCount}">
                <label for="mcOption-${questionNumber}-${mcOptionCount}">Option ${mcOptionCount}:</label>
                <input type="text" id="mcOption-${questionNumber}-${mcOptionCount}" name="questions[${questionNumber}][options][]" placeholder="Enter Option">
                <button type="button" onclick="deleteMCOption(${questionNumber}, ${mcOptionCount})">Delete</button>
            </div>
        `;
        mcOptionsDiv.insertAdjacentHTML('beforeend', optionHTML);

        // Update the answer key select options
        const optionElement = document.createElement("option");
        optionElement.value = mcOptionCount;
        optionElement.textContent = `Option ${mcOptionCount}`;
        answerKeySelect.appendChild(optionElement);
    }

    // Delete a multiple-choice option
    function deleteMCOption(questionNumber, optionNumber) {
        const optionDiv = document.getElementById(`mcOption-${questionNumber}-${optionNumber}`);
        optionDiv.remove();
        // Remove the corresponding answer key option
        const answerKeySelect = document.getElementById(`mcAnswerKey-${questionNumber}`);
        for (let i = 0; i < answerKeySelect.options.length; i++) {
            if (answerKeySelect.options[i].value == optionNumber) {
                answerKeySelect.remove(i);
                break;
            }
        }
    }

    // Add a new question form dynamically
    function addQuestion() {
        questionCount++;
        const questionHTML = `
            <div id="question-${questionCount}" class="question-form">
                <label for="questionType-${questionCount}">Question Type:</label>
                <select id="questionType-${questionCount}" name="questions[${questionCount}][type]" onchange="showQuestionForm(${questionCount})">
                    <option value="" disabled selected>Select Question Type</option>
                    <option value="multipleChoice">Multiple Choice</option>
                    <option value="trueFalse">True/False</option>
                    <option value="identification">Identification</option>
                </select>

                <label for="questionText-${questionCount}">Question ${questionCount}:</label>
                <input type="text" id="questionText-${questionCount}" name="questions[${questionCount}][question]" placeholder="Enter Question" required>

                <div class="options-container">
                    <!-- Options will be dynamically populated here -->
                </div>

                <!-- File Upload Button for Each Question -->
                <label for="uploadFile-${questionCount}">Upload File:</label>
                <input type="file" id="uploadFile-${questionCount}" name="questions[${questionCount}][uploadFile]">
            </div>
        `;
        document.getElementById('questionsContainer').insertAdjacentHTML('beforeend', questionHTML);
    }

    // Submit the quiz and gather the quiz and questions data
    function submitQuiz() {
        document.getElementById('quizForm').submit();
    }

    // Event listener for adding a new question
    document.querySelector('.add-question').addEventListener('click', addQuestion);
</script>

