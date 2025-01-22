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
            <h1 class="ggclass-font">GGclass</h1>
            <!-- <h2 class="section-font">{{ $class->section }}</h2> -->
    </div>

<!-- {{-- <div class="navbar">
    <div class="left-section">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass ></h1>
        <h2 class="section-font">{{ $class->section }}</h2>
    </div> --}} -->

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
                <button class="btn" style="font-size: 16px; border:none; width: 100%;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 16px; width: 100%; " onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id])}}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn challenge-btn active" style="font-size: 16px; width: 100%;" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 16px; width: 100%;" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
            </div>
        </div>
    </div>


        <div class="back-button">
            <button onclick="window.history.back()"> &#8592; Back</button>
        </div>
        <div class="dashboard-container">
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
                    <!-- Dynamically created questions will appear here -->
                </div>
                <!-- Add Question Button -->
                <div id="addQuestionContainer" class="mt-3">
                    <button type="button" class="btn btn-primary add-question">Add Question</button>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Create</button>
        </form>
    </div>
</div>

<script>
let questionCount = 0;

function showQuestionForm(questionNumber) {
    const selectedType = document.getElementById(`questionType-${questionNumber}`).value;
    const questionForm = document.getElementById(`question-${questionNumber}`);
    const optionsContainer = questionForm.querySelector('.options-container');
    optionsContainer.innerHTML = ''; // Clear previous options

    if (selectedType === 'multipleChoice') {
        // Generate 4 options by default and hide the "Add Option" button
        let mcOptionsHTML = `
            <div id="mcOptions-${questionNumber}">
                ${[1, 2, 3, 4].map((num) => `
                    <div id="mcOption-${questionNumber}-${num}" class="option">
                        <label for="mcOption-${questionNumber}-${num}">Option ${num}:</label>
                        <input type="text" id="mcOption-${questionNumber}-${num}" name="questions[${questionNumber}][options][]" placeholder="Enter Option ${num}" required>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteOption(${questionNumber}, ${num})">Delete</button>
                    </div>
                `).join('')}
            </div>
            <button type="button" id="addOption-${questionNumber}" class="btn btn-secondary mt-2" onclick="addOption(${questionNumber})" style="display: none;">Add Option</button>
            <label for="mcAnswerKey-${questionNumber}" class="mt-2 d-flex">Answer Key:</label>
            <select id="mcAnswerKey-${questionNumber}" name="questions[${questionNumber}][correct_answer]">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
            </select>
        `;
        optionsContainer.innerHTML = mcOptionsHTML;
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
            <input type="text" id="idAnswer-${questionNumber}" name="questions[${questionNumber}][correct_answer]" placeholder="Enter Answer Key" required>
        `;
    }
}

function updateAnswerKeyDropdown(questionNumber) {
    const optionsContainer = document.getElementById(`mcOptions-${questionNumber}`);
    const inputs = optionsContainer.getElementsByTagName('input');
    const answerKeySelect = document.getElementById(`mcAnswerKey-${questionNumber}`);

    // Clear existing dropdown options
    answerKeySelect.innerHTML = '';

    // Track if valid options exist
    let hasValidOptions = false;

    // Populate dropdown with updated option values
    for (let i = 0; i < inputs.length; i++) {
        const optionValue = inputs[i].value.trim();

        if (optionValue) {
            const option = document.createElement('option');
            option.value = i + 1;
            option.textContent = optionValue;
            answerKeySelect.appendChild(option);
            hasValidOptions = true;
        }
    }

    // If no valid options, add a placeholder
    if (!hasValidOptions) {
        const placeholder = document.createElement('option');
        placeholder.value = '';
        placeholder.textContent = 'No valid options';
        answerKeySelect.appendChild(placeholder);
    }
}

function addQuestion() {
    questionCount++;
    const questionHTML = `
        <div id="question-${questionCount}" class="question-form mt-3">
            <label for="questionType-${questionCount}">Question Type:</label>
            <select id="questionType-${questionCount}" name="questions[${questionCount}][type]" onchange="showQuestionForm(${questionCount})" required>
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

            <button type="button" class="btn btn-danger mt-2" onclick="deleteQuestion(${questionCount})">Delete Question</button>
        </div>
    `;

    const questionsContainer = document.getElementById('questionsContainer');
    questionsContainer.insertAdjacentHTML('beforeend', questionHTML);
}

function deleteQuestion(questionNumber) {
    if (confirm('Are you sure you want to delete this question?')) {
        const questionDiv = document.getElementById(`question-${questionNumber}`);
        questionDiv.remove();
    }
}

document.querySelector('.add-question').addEventListener('click', addQuestion);


</script>