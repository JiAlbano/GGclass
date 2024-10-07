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
    <link rel="stylesheet" href="{{ asset('student-view/quiz-take-student.css') }}"> <!-- New CSS file for the container -->
</head>
<body>

<div class="navbar">
    <div class="left-section">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass ></h1>
        <h2 class="section-font">{{ $class->section }}</h2>
    </div>

    <div class="right-section">
        <!-- Back Button -->
        <button class="back-button"onclick="window.location.href='{{ route('classroom.index') }}'">Back to Classroom</button>
        <img class="profile-img" src="{{ asset('ainz.jpg') }}" alt="Create">
    </div>
</div>

    <!-- Bootstrap container for responsiveness -->
<div class="container d-flex justify-content-center align-items-center">
    <!-- Timer container in the center -->
    <div class="timer-container text-center p-3">
        <!-- Time display -->
        <div class="time-display" id="time-display">00:00</div>
    </div>
</div>

<div class="question-container">
    <div class="question-header">
        <span id="question-text">What is the capital of France?</span>
    </div>

    <div id="question-type-container">
        <!-- Multiple choice question (default) -->
        <div class="options-container">
            <button class="option-btn" onclick="selectOption(1)">Paris</button>
            <button class="option-btn" onclick="selectOption(2)">Berlin</button>
            <button class="option-btn" onclick="selectOption(3)">Madrid</button>
            <button class="option-btn" onclick="selectOption(4)">Rome</button>
        </div>

        <!-- True/False question -->
        <div class="true-false-container" style="display:none;">
            <button class="option-btn" onclick="selectOption(1)">True</button>
            <button class="option-btn" onclick="selectOption(2)">False</button>
        </div>

        <!-- Identification question -->
        <div class="identification-container" style="display:none;">
            <div class="form-group">
                <label for="identification-answer">Answer:</label>
                <input type="text" class="form-control" id="identification-answer" placeholder="Enter answer">
            </div>
        </div>
    </div>

    <div class="col-12 d-flex justify-content-between">
        <!-- Back button on the left -->
        <button id="back-btn" class="btn-bn" onclick="previousQuestion()">Back</button>
        <!-- Next button on the right -->
        <button id="next-btn" class="btn-bn" onclick="nextQuestion()">Next</button>
        <!-- Submit button (initially hidden) -->
        <button id="submit-btn" class="btn-bn" style="display:none;" onclick="submitQuiz()">Submit</button>
    </div>
</div>

<div class="question-numbers">
    <button class="question-number" onclick="switchQuestion(1)">1</button>
    <button class="question-number" onclick="switchQuestion(2)">2</button>
    <button class="question-number" onclick="switchQuestion(3)">3</button>
</div>

<script>
    let currentQuestion = 1;
    const totalQuestions = 3;

    function selectOption(option) {
        let questionType = document.querySelector('#question-type-container').children[0].style.display;
        let buttons;

        if (questionType === 'block') {
            buttons = document.querySelectorAll('.options-container .option-btn');
        } else {
            buttons = document.querySelectorAll('.true-false-container .option-btn');
        }

        buttons.forEach(btn => btn.classList.remove('active'));
        buttons[option - 1].classList.add('active');
    }

    function nextQuestion() {
        if (currentQuestion < totalQuestions) {
            currentQuestion++;
            switchQuestion(currentQuestion);
        }

        // Show the submit button on the last question
        if (currentQuestion === totalQuestions) {
            document.getElementById('next-btn').style.display = 'none';
            document.getElementById('submit-btn').style.display = 'block';
        }
    }

    function previousQuestion() {
        if (currentQuestion > 1) {
            currentQuestion--;
            switchQuestion(currentQuestion);

            // If moving back from the last question, hide the submit button
            if (currentQuestion < totalQuestions) {
                document.getElementById('submit-btn').style.display = 'none';
                document.getElementById('next-btn').style.display = 'block';
            }
        }
    }

    function switchQuestion(number) {
        currentQuestion = number;

        let questionText = document.getElementById('question-text');
        let multipleChoice = document.querySelector('.options-container');
        let trueFalse = document.querySelector('.true-false-container');
        let identification = document.querySelector('.identification-container');

        let questions = [
            { type: 'multiple', text: "What is the capital of France?", options: ["Paris", "Berlin", "Madrid", "Rome"] },
            { type: 'truefalse', text: "The sky is blue.", options: ["True", "False"] },
            { type: 'identification', text: "Identify the chemical symbol for water.", options: [] }
        ];

        questionText.innerText = questions[number - 1].text;

        multipleChoice.style.display = 'none';
        trueFalse.style.display = 'none';
        identification.style.display = 'none';

        if (questions[number - 1].type === 'multiple') {
            multipleChoice.style.display = 'block';
            let optionButtons = multipleChoice.querySelectorAll('.option-btn');
            optionButtons.forEach((btn, idx) => {
                btn.innerText = questions[number - 1].options[idx];
                btn.classList.remove('active');
            });
        } else if (questions[number - 1].type === 'truefalse') {
            trueFalse.style.display = 'block';
            let trueFalseButtons = trueFalse.querySelectorAll('.option-btn');
            trueFalseButtons.forEach(btn => {
                btn.classList.remove('active');
            });
        } else if (questions[number - 1].type === 'identification') {
            identification.style.display = 'block';
            document.getElementById('identification-answer').value = '';
        }

        let questionNumbers = document.querySelectorAll('.question-number');
        questionNumbers.forEach((btn, idx) => {
            btn.classList.remove('active');
            if (idx === number - 1) {
                btn.classList.add('active');
            }
        });

        // If on the last question, show the submit button
        if (currentQuestion === totalQuestions) {
            document.getElementById('next-btn').style.display = 'none';
            document.getElementById('submit-btn').style.display = 'block';
        } else {
            document.getElementById('submit-btn').style.display = 'none';
            document.getElementById('next-btn').style.display = 'block';
        }
    }

    function submitQuiz() {
        // Handle quiz submission logic here
        alert("Quiz submitted!");
    }

    // Initialize the first question
    switchQuestion(1);
</script>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


</body>
</html>
