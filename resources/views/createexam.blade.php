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
        <h2>Create Exam</h2>
        
        <form method="POST" action="{{ route('exam.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="class_id" value="{{ $class->id }}">

            <div class="form-group">
                <label for="quizTitle">Exam Title</label>
                <input type="text" id="quizTitle" name="title" class="form-control" placeholder="Untitled Exam" required>
            </div>

            <div class="form-group">
                <label for="quizDescription">Exam Description</label>
                <textarea id="quizDescription" name="description" class="form-control" placeholder="Exam Description"></textarea>
            </div>
            
            <div class="form-group">
                <label for="quizDescription">Exam Type</label>
                <select id="quizDescription" name="exam_type" class="form-control">
                    <option value="" disabled>Select Exam Type</option>
                    <option value="prelim" {{ old('exam_type', $exam->exam_type ?? '') === 'prelim' ? 'selected' : '' }}>Prelim</option>
                    <option value="midterm" {{ old('exam_type', $exam->exam_type ?? '') === 'midterm' ? 'selected' : '' }}>Midterm</option>
                    <option value="prefinal" {{ old('exam_type', $exam->exam_type ?? '') === 'prefinal' ? 'selected' : '' }}>Pre-Final</option>
                    <option value="final" {{ old('exam_type', $exam->exam_type ?? '') === 'final' ? 'selected' : '' }}>Final</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quizDescription">Exam Type</label>
                <select id="quizDescription" name="exam_type" class="form-control">
                    <option value="" disabled>Select Exam Type</option>
                    <option value="prelim" {{ old('exam_type', $exam->exam_type ?? '') === 'prelim' ? 'selected' : '' }}>Prelim</option>
                    <option value="midterm" {{ old('exam_type', $exam->exam_type ?? '') === 'midterm' ? 'selected' : '' }}>Midterm</option>
                    <option value="prefinal" {{ old('exam_type', $exam->exam_type ?? '') === 'prefinal' ? 'selected' : '' }}>Pre-Final</option>
                    <option value="final" {{ old('exam_type', $exam->exam_type ?? '') === 'final' ? 'selected' : '' }}>Final</option>
                </select>
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
        let mcOptionsHTML = `
            <div id="mcOptions-${questionNumber}">
                <div id="mcOption-${questionNumber}-1" class="option">
                    <label for="mcOption-${questionNumber}-1">Option 1:</label>
                    <input type="text" id="mcOption-${questionNumber}-1" name="questions[${questionNumber}][options][]" placeholder="Enter Option" required
                        oninput="updateAnswerKeyDropdown(${questionNumber})">
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteOption(${questionNumber}, 1)">Delete</button>
                </div>
                <div id="mcOption-${questionNumber}-2" class="option">
                    <label for="mcOption-${questionNumber}-2">Option 2:</label>
                    <input type="text" id="mcOption-${questionNumber}-2" name="questions[${questionNumber}][options][]" placeholder="Enter Option" required
                        oninput="updateAnswerKeyDropdown(${questionNumber})">
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteOption(${questionNumber}, 2)">Delete</button>
                </div>
                <div id="mcOption-${questionNumber}-3" class="option">
                    <label for="mcOption-${questionNumber}-3">Option 3:</label>
                    <input type="text" id="mcOption-${questionNumber}-3" name="questions[${questionNumber}][options][]" placeholder="Enter Option" required
                        oninput="updateAnswerKeyDropdown(${questionNumber})">
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteOption(${questionNumber}, 3)">Delete</button>
                </div>
                <div id="mcOption-${questionNumber}-4" class="option">
                    <label for="mcOption-${questionNumber}-4">Option 4:</label>
                    <input type="text" id="mcOption-${questionNumber}-4" name="questions[${questionNumber}][options][]" placeholder="Enter Option" required
                        oninput="updateAnswerKeyDropdown(${questionNumber})">
                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteOption(${questionNumber}, 4)">Delete</button>
                </div>
            </div>
            <button type="button" id="addOption-${questionNumber}" class="btn btn-secondary mt-2" onclick="addOption(${questionNumber})">Add Option</button>
            <label for="mcAnswerKey-${questionNumber}" class="mt-2 d-flex">Answer Key:</label>
            <select id="mcAnswerKey-${questionNumber}" name="questions[${questionNumber}][correct_answer]">
                <option value="1">Option 1</option>
                <option value="2">Option 2</option>
                <option value="3">Option 3</option>
                <option value="4">Option 4</option>
            </select>
        `;

        optionsContainer.innerHTML = mcOptionsHTML;

        // Ensure the dropdown is updated with any changes
        updateAnswerKeyDropdown(questionNumber);
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

function addOption(questionNumber) {
    const optionsContainer = document.getElementById(`mcOptions-${questionNumber}`);
    const currentOptions = optionsContainer.getElementsByClassName('option');
    const optionCount = currentOptions.length;

    if (optionCount < 4) {
        const newOptionNumber = optionCount + 1;
        const newOptionHTML = `
            <div id="mcOption-${questionNumber}-${newOptionNumber}" class="option">
                <label for="mcOption-${questionNumber}-${newOptionNumber}">Option ${newOptionNumber}:</label>
                <input type="text" id="mcOption-${questionNumber}-${newOptionNumber}" name="questions[${questionNumber}][options][]" placeholder="Enter Option" required
                    oninput="updateAnswerKeyDropdown(${questionNumber})">
                <button type="button" class="btn btn-danger btn-sm" onclick="deleteOption(${questionNumber}, ${newOptionNumber})">Delete</button>
            </div>
        `;
        optionsContainer.insertAdjacentHTML('beforeend', newOptionHTML);

        // Update dropdown after adding a new option
        updateAnswerKeyDropdown(questionNumber);

        // Hide "Add Option" button if max options are reached
        if (newOptionNumber === 4) {
            const addOptionButton = document.getElementById(`addOption-${questionNumber}`);
            addOptionButton.style.display = 'none';
        }
    }
}



function deleteOption(questionNumber, optionNumber) {
    const optionDiv = document.getElementById(`mcOption-${questionNumber}-${optionNumber}`);
    if (optionDiv) {
        optionDiv.remove();

        const optionsContainer = document.getElementById(`mcOptions-${questionNumber}`);
        const remainingOptions = optionsContainer.getElementsByClassName('option');

        // Re-order options and update IDs, names, and event handlers
        for (let i = 0; i < remainingOptions.length; i++) {
            const optionDiv = remainingOptions[i];
            const newOptionNumber = i + 1;

            optionDiv.id = `mcOption-${questionNumber}-${newOptionNumber}`;
            const label = optionDiv.querySelector('label');
            const input = optionDiv.querySelector('input');
            const button = optionDiv.querySelector('button');

            label.textContent = `Option ${newOptionNumber}:`;
            label.setAttribute('for', `mcOption-${questionNumber}-${newOptionNumber}`);
            input.id = `mcOption-${questionNumber}-${newOptionNumber}`;
            input.setAttribute('oninput', `updateAnswerKeyDropdown(${questionNumber})`);
            button.setAttribute('onclick', `deleteOption(${questionNumber}, ${newOptionNumber})`);
        }

        // Update dropdown after deletion
        updateAnswerKeyDropdown(questionNumber);

        // Show the "Add Option" button if less than 4 options remain
        if (remainingOptions.length < 4) {
            const addOptionButton = document.getElementById(`addOption-${questionNumber}`);
            addOptionButton.style.display = 'inline-block';
        }
    }
}




function updateAnswerKeyDropdown(questionNumber) {
    const optionsContainer = document.getElementById(`mcOptions-${questionNumber}`);
    const inputs = optionsContainer.getElementsByTagName('input');
    const answerKeySelect = document.getElementById(`mcAnswerKey-${questionNumber}`);

    // Clear existing dropdown options
    answerKeySelect.innerHTML = '';

    // Populate dropdown with updated option values
    for (let i = 0; i < inputs.length; i++) {
        const optionValue = inputs[i].value.trim();
        const option = document.createElement('option');
        option.value = i + 1;
        option.textContent = optionValue || `Option ${i + 1}`;
        answerKeySelect.appendChild(option);
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
    const addQuestionContainer = document.getElementById('addQuestionContainer');
    questionsContainer.insertAdjacentHTML('beforeend', questionHTML);

    const newQuestionElement = document.getElementById(`question-${questionCount}`);
    newQuestionElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function deleteQuestion(questionNumber) {
    if (confirm('Are you sure you want to delete this question?')) {
        const questionDiv = document.getElementById(`question-${questionNumber}`);
        questionDiv.remove();
    }
}

document.querySelector('.add-question').addEventListener('click', addQuestion);


</script>

