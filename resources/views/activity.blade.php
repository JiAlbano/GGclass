<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>activity</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('quiz.css') }}"> <!-- CSS file for styling -->
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

    <div class="quiz" style="position: fixed">Quiz</div>


    <!-- quiz.blade.php -->

    <div class="create-quiz" style="position: fixed">
        <button type="submit" class="btn create-btn" id="createQuizButton">Add</button>
    </div>



    <div class="half-line2">
        <hr>
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
    <hr>
    <div class="container-buttons">
        <button class="btn" onclick="window.location.href='{{ route('attendance') }}'">Attendance</button>
        <button class="btn" onclick="window.location.href='{{ route('grade') }}'">Grade</button>
        <button class="btn" onclick="window.location.href='{{ route('feedback') }}'">Feedback</button>
        <button class="btn" onclick="window.location.href='{{ route('gradebook') }}'">Gradebook</button>
    </div>
</div>
        <hr>
        <div class="container-buttons">
            <button class="btn" onclick="window.location.href='{{ route('attendance') }}'">Attendance</button>
            <button class="btn" onclick="window.location.href='{{ route('grade') }}'">Grade</button>
            <button class="btn" onclick="window.location.href='{{ route('feedback') }}'">Feedback</button>
            <button class="btn" onclick="window.location.href='{{ route('gradebook') }}'">Gradebook</button>
        </div>
    </div>

    <div class="quiz-title">
    <button class="quiz-button" onclick="window.location.href='{{ route('quiz-title') }}'">Quiz Title</button>
    </div>


<!-- Modal Structure -->
<div id="quizModal" class="modal">
    <div class="modal-content">
        <!-- Close Button -->
        <span class="close-button" onclick="closeModal()">&times;</span>

        <h2>Create Quiz</h2>

        <!-- Scrollable Container -->
        <div class="modal-body">
            <!-- Quiz Title and Description -->
            <label for="quizTitle">Quiz Title:</label>
            <input type="text" id="quizTitle" placeholder="Enter Quiz Title">

            <label for="quizDescription">Quiz Description:</label>
            <textarea id="quizDescription" placeholder="Enter Quiz Description"></textarea>

            <!-- Questions Container -->
            <div id="questionsContainer">
                <!-- Initial Question Form will be dynamically added here -->
            </div>

            <!-- Add Initial Question Button -->
            <button type="button" id="addQuestionButton" onclick="addQuestion()">Add Question</button>
        </div>

        <!-- Modal Footer with Create Quiz Button -->
        <div class="modal-footer">
            <button type="button" onclick="submitQuiz()">Create</button>
        </div>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('quizModal').style.display = 'none';
    }

    document.getElementById('createQuizButton').onclick = function() {
        document.getElementById('quizModal').style.display = 'flex';
    };

    let questionCount = 0;
    let mcOptionCount = 0;

    function showQuestionForm(questionNumber) {
        const selectedType = document.getElementById(`questionType-${questionNumber}`).value;
        const questionForm = document.getElementById(`question-${questionNumber}`);
        const optionsContainer = questionForm.querySelector('.options-container');
        optionsContainer.innerHTML = ''; // Clear previous options

        if (selectedType === 'multipleChoice') {
            optionsContainer.innerHTML = `
                <label for="mcAnswerKey-${questionNumber}">Answer Key:</label>
                <select id="mcAnswerKey-${questionNumber}">
                    <!-- Options will be dynamically populated -->
                </select>
                <div id="mcOptions-${questionNumber}">
                    <!-- Dynamic option input fields will appear here -->
                </div>
                <button type="button" onclick="addMCOption(${questionNumber})">Add Option</button>
            `;
        } else if (selectedType === 'trueFalse') {
            optionsContainer.innerHTML = `
                <label for="tfAnswer-${questionNumber}">Answer:</label>
                <select id="tfAnswer-${questionNumber}">
                    <option value="true">True</option>
                    <option value="false">False</option>
                </select>
            `;
        } else if (selectedType === 'identification') {
            optionsContainer.innerHTML = `
                <label for="idAnswer-${questionNumber}">Answer Key:</label>
                <input type="text" id="idAnswer-${questionNumber}" placeholder="Enter Answer Key">
            `;
        }
    }

    function addMCOption(questionNumber) {
        mcOptionCount++;
        const mcOptionsDiv = document.getElementById(`mcOptions-${questionNumber}`);
        const answerKeySelect = document.getElementById(`mcAnswerKey-${questionNumber}`);
        const optionHTML = `
            <div id="mcOption-${questionNumber}-${mcOptionCount}">
            <label for="mcOption-${questionNumber}-${mcOptionCount}">Option ${mcOptionCount}:</label>
            <input type="text" id="mcOption-${questionNumber}-${mcOptionCount}" placeholder="Enter Option">
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

    function addQuestion() {
        questionCount++;
        const questionHTML = `
            <div id="question-${questionCount}" class="question-form">
                <label for="questionType-${questionCount}">Question Type:</label>
                <select id="questionType-${questionCount}" onchange="showQuestionForm(${questionCount})">
                    <option value="" disabled selected>Select Question Type</option>
                    <option value="multipleChoice">Multiple Choice</option>
                    <option value="trueFalse">True/False</option>
                    <option value="identification">Identification</option>
                </select>

                <div class="options-container">
                    <!-- Options will be dynamically populated here -->
                </div>

                <label for="questionText-${questionCount}">Question ${questionCount}:</label>
                <input type="text" id="questionText-${questionCount}" placeholder="Enter Question">

                <!-- File Upload Button for Each Question -->
                <label for="uploadFile-${questionCount}">Upload File:</label>
                <input type="file" id="uploadFile-${questionCount}">
            </div>
        `;
        document.getElementById('questionsContainer').insertAdjacentHTML('beforeend', questionHTML);
    }

    function submitQuiz() {
        const quizTitle = document.getElementById("quizTitle").value;
        const quizDescription = document.getElementById("quizDescription").value;

        const questions = [];
        for (let i = 1; i <= questionCount; i++) {
            const questionText = document.getElementById(`questionText-${i}`).value;
            const selectedType = document.getElementById(`questionType-${i}`).value;
            let questionData = { question: questionText };

            if (selectedType === 'multipleChoice') {
                const mcOptions = [];
                const mcAnswerKey = document.getElementById(`mcAnswerKey-${i}`).value;
                for (let j = 1; j <= mcOptionCount; j++) {
                    const optionValue = document.getElementById(`mcOption-${i}-${j}`).value;
                    if (optionValue) {
                        mcOptions.push(optionValue);
                    }
                }
                questionData = { question: questionText, options: mcOptions, answerKey: mcAnswerKey };
            } else if (selectedType === 'trueFalse') {
                const tfAnswer = document.getElementById(`tfAnswer-${i}`).value;
                questionData = { question: questionText, answer: tfAnswer };
            } else if (selectedType === 'identification') {
                const idAnswer = document.getElementById(`idAnswer-${i}`).value;
                questionData = { question: questionText, answer: idAnswer };
            }

            // Handle file upload
            const uploadFile = document.getElementById(`uploadFile-${i}`).files[0];
            if (uploadFile) {
                questionData.uploadFile = uploadFile.name; // Just storing the file name for now
            }

            questions.push(questionData);
        }

        // Now you can send quizTitle, quizDescription, and questions to the server
        console.log({
            quizTitle,
            quizDescription,
            questions,
        });

        // Close the modal after submitting
        closeModal();
    }
</script>

</body>
</html>
