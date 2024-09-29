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

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('take-quiz.css') }}"> <!-- New CSS file for the container -->
</head>
<body>

    <div class="navbar">
        <div class="left-section">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass</h1>
            <h1 class="arrow" style="font-size: 20px">></h1>
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

        <div class="timer-container">
            <div class="time-display" id="time-display">00:00</div>
            <input type="number" id="minutes-input" placeholder="Enter minutes" min="0">
        </div>

        <script>
            //Get references to the DOM elements: the timer display and the minutes input field
            const timeDisplay = document.getElementById('time-display');
            const minutesInput = document.getElementById('minutes-input');

            // Add an event listener that triggers whenever the user changes the value in the input field
            minutesInput.addEventListener('input', () => {

            // Parse the input value to get the number of minutes, or set to 0 if invalid
            let minutes = parseInt(minutesInput.value) || 0;
            let seconds = 0; // Set the seconds to 0 since we're only updating minutes

            // Call the function to update the timer display
            updateDisplay(minutes, seconds);
            });

            // Function to update the time display with formatted minutes and seconds
            function updateDisplay(minutes, seconds) {
            let minutesDisplay = minutes < 10 ? "0" + minutes : minutes;
            let secondsDisplay = seconds < 10 ? "0" + seconds : seconds;

            // Update the timeDisplay element with the formatted time (MM:SS)
            timeDisplay.textContent = `${minutesDisplay}:${secondsDisplay}`;
            }
        </script>

<div class="question-container">
    <div class="question-header">
        <span id="question-text">{{ $questions[0]->question }}</span>
        <button id="edit-btn" class="edit-btn">Edit</button>
    </div>

    <div id="question-type-container">
        <!-- Multiple choice question (default) -->
        <div class="options-container" style="display: {{ $questions[0]->type === 'multipleChoice' ? 'block' : 'none' }};">
            @if(is_array($questions[0]->options))
                @foreach($questions[0]->options as $key => $option)
                    <button class="option-btn" onclick="selectOption({{ $key + 1 }})">{{ $option }}</button>
                @endforeach
            @endif
        </div>


        <!-- True/False question -->
        <div class="true-false-container" style="display: {{ $questions[0]->type === 'trueFalse' ? 'block' : 'none' }};">
            <button class="option-btn" onclick="selectOption(1)">True</button>
            <button class="option-btn" onclick="selectOption(2)">False</button>
        </div>

        <!-- Identification question -->
        <div class="identification-container" style="display: {{ $questions[0]->type === 'identification' ? 'block' : 'none' }};">
            <span id="identification-answer">Correct Answer: {{ $questions[0]->correct_answer }}</span>
            <input type="text" placeholder="Enter your answer here" class="identification-input" style="border: 1px solid grey; padding: 5px;">
        </div>
    </div>

    <div class="navigation-container">
        <button id="back-btn" class="nav-btn" onclick="previousQuestion()">Back</button>
        <button id="next-btn" class="nav-btn" onclick="nextQuestion()">Next</button>
    </div>
</div>

<div class="question-numbers">
    @foreach($questions as $key => $question)
        <button class="question-number" onclick="switchQuestion({{ $key + 1 }})">{{ $key + 1 }}</button>
    @endforeach
</div>

<script>
    let currentQuestion = 1;
    const totalQuestions = {{ count($questions) }};

    function selectOption(option) {
        let questionType = document.querySelector('.options-container').style.display;
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
    }

    function previousQuestion() {
        if (currentQuestion > 1) {
            currentQuestion--;
            switchQuestion(currentQuestion);
        }
    }

    function switchQuestion(number) {
        currentQuestion = number;
        let question = @json($questions);

        document.getElementById('question-text').innerText = question[number - 1].question;

        let multipleChoice = document.querySelector('.options-container');
        let trueFalse = document.querySelector('.true-false-container');
        let identification = document.querySelector('.identification-container');

        multipleChoice.style.display = 'none';
        trueFalse.style.display = 'none';
        identification.style.display = 'none';

   // Check the question type and display the correct one
   if (question[number - 1].type === 'multipleChoice') {
        multipleChoice.style.display = 'block';

        // Update multiple-choice options
        let optionButtons = multipleChoice.querySelectorAll('.option-btn');
        let options = question[number - 1].options || [];

        // Update button text with the options and reset active class
        optionButtons.forEach((btn, idx) => {
            if (options[idx]) {
                btn.innerText = options[idx];  // Set the option text
                btn.style.display = 'inline-block';  // Show button
            } else {
                btn.style.display = 'none';  // Hide extra buttons
            }
            btn.classList.remove('active');  // Remove active class
        });

        } else if (question[number - 1].type === 'trueFalse') {
            trueFalse.style.display = 'block';
        } else if (question[number - 1].type === 'identification') {
            identification.style.display = 'block';
             // Set the correct answer and prepare the identification input
        document.getElementById('identification-answer').innerText = `Correct Answer: ${question[number - 1].correct_answer}`;
    }
    }

    switchQuestion(1);
</script>

</body>
</html>
