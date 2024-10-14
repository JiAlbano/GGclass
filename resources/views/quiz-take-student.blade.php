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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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
        <img class="profile-img" src="{{ asset('ainz.jpg') }}" alt="Create">
    </div>
</div>

    <div class="top-right">
        <input type="text" id="token-used" placeholder="Insert Token">
        <img class="img-token" src="{{ asset('token.png') }}" alt="Image">
        <span class="text-number">123</span>
    </div>

    <!-- Bootstrap container for responsiveness -->
<div class="container d-flex justify-content-center align-items-center">
    <!-- Timer container in the center -->
    <div class="timer-container text-center p-3">
        <!-- Time display -->
        <div class="time-display" id="time-display">{{$quiz->time_duration}}:00</div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="question-container">
    <div class="question-header">
        <span id="question-text"></span>
    </div>

    <div id="question-type-container">
        <input type="hidden" id="answer-holder">
        <div class="options-container"></div>
        <!-- True/False question -->
        <div class="true-false-container" style="display:none;"></div>
            <!-- Identification question -->
        <div class="identification-container" style="display:none;"></div>
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
@for($i = 1; $i <= count($questions); $i++)
<button class="question-number" onclick="switchQuestion({{$i}})">{{$i}}</button>
@endfor
</div>

<script>
let currentQuestion = 1;
const totalQuestions = <?php echo count($questions); ?>;
let answer = [];
let questions = <?php echo $questions; ?>;
let runningScore = 0;
let studentScore = [];

function selectOption(option) {
    let questionType = document.querySelector('#question-type-container').children[0].style.display;
    let buttons;
    $(".option-btn").removeClass('active');
    $(`#option-btn-${option}`).addClass('active');
    $("#answer-holder").val(option);
}

function nextQuestion() {
    if (currentQuestion < totalQuestions) {
        if (questions[currentQuestion - 1].type === 'identification') {
            $("#answer-holder").val($("#identification-answer").val());
        }
        recordAnswer()
        currentQuestion++;
        switchQuestion(currentQuestion);
    }

    // Show the submit button on the last question
    if (currentQuestion === totalQuestions) {
        document.getElementById('next-btn').style.display = 'none';
        document.getElementById('submit-btn').style.display = 'block';
    }
}

function recordAnswer() {
    const is_correct = $("#answer-holder").val().toLowerCase() === questions[currentQuestion - 1].correct_answer.toLowerCase() ? 1 : 0;
    const studentAnswer = answer.find(q => q.question_id === questions[currentQuestion - 1].id);
    if(studentAnswer) {
        const prevAnswer =studentAnswer.answer;
        studentAnswer.answer = $("#answer-holder").val();
        studentAnswer.is_correct = is_correct;
        if(studentAnswer.answer !== prevAnswer) {
            is_correct ? runningScore++ :runningScore--;
        }
    } else {
        answer.push({
            question_id: questions[currentQuestion-1].id,
            challenge_id: questions[currentQuestion-1].quiz_id,
            answer: $("#answer-holder").val(),
            is_correct:is_correct,
        })
        if(is_correct)
            runningScore++;
    }
    const token_used = $("#token-used").val() !== "" ? $("#token-used").val() : 0;
    studentScore = [{
        challenge_id: questions[currentQuestion-1].quiz_id,
        score: runningScore,
        token_used: token_used,
        total_score: parseFloat(token_used) +parseFloat(runningScore),
    }]
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

questionText.innerText = questions[number - 1].question;

multipleChoice.style.display = 'none';
trueFalse.style.display = 'none';
identification.style.display = 'none';

if (questions[number - 1].type === 'multipleChoice') {
    multipleChoice.style.display = 'block';
    const options = questions[number - 1].options;
    let optionHtml = ``;
    options.map(item => {
        optionHtml += `<button class="option-btn" id="option-btn-${item}" onclick="selectOption('${item}')">${item}</button>`;
    })
    $(".options-container").html(optionHtml)
} else if (questions[number - 1].type === 'trueFalse') {
    trueFalse.style.display = 'block';
    $(".true-false-container").html(
        `<button class="option-btn" id="option-btn-true" onclick="selectOption(true)">True</button>
        <button class="option-btn" id="option-btn-false" onclick="selectOption(false)">False</button>`
    )
    let trueFalseButtons = trueFalse.querySelectorAll('.option-btn');
    trueFalseButtons.forEach(btn => {
        btn.classList.remove('active');
    });
} else if (questions[number - 1].type === 'identification') {
    identification.style.display = 'block';
    $(".identification-container").html(
        `<div class="form-group">
            <label for="identification-answer">Answer:</label>
            <input type="text" class="form-control" id="identification-answer" placeholder="Enter answer">
        </div>`
    );
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

async function submitQuiz() {
    recordAnswer();
    await $.ajax({
            url: '/challenges/record-score',  // URL where you want to send the PUT request
            type: 'POST',           // Laravel uses POST to handle PUT requests
            data: {answer: answer, studentScore: studentScore},
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Add CSRF token in headers
            },
            success: function(response) {
                if(response == 1) {
                    alert("You have successfully submitted your answers.");
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
}

// Initialize the first question
switchQuestion(1);
</script>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


</body>
</html>
