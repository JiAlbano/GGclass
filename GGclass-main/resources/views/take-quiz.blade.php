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
                <span id="question-text">What is the capital of France?</span>
                <button id="edit-btn" class="edit-btn">Edit</button>
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
                    <span id="identification-answer">H2O</span>
                </div>

            </div>

            <div class="navigation-container">
                <button id="back-btn" class="nav-btn" onclick="previousQuestion()">Back</button>
                <button id="next-btn" class="nav-btn" onclick="nextQuestion()">Next</button>
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
                // Determine the type of the current question
                let questionType = document.querySelector('#question-type-container').children[0].style.display;
                let buttons;

                if (questionType === 'block') {
                    buttons = document.querySelectorAll('.options-container .option-btn');
                } else {
                    buttons = document.querySelectorAll('.true-false-container .option-btn');
                }

                // Reset all option buttons for the current question
                buttons.forEach(btn => btn.classList.remove('active'));

                // Set the clicked button as active
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

                // Update the question text and type of question
                let questionText = document.getElementById('question-text');
                let multipleChoice = document.querySelector('.options-container');
                let trueFalse = document.querySelector('.true-false-container');
                let identification = document.querySelector('.identification-container');

                let questions = [
                    { type: 'multiple', text: "What is the capital of France?", options: ["Paris", "Berlin", "Madrid", "Rome"] },
                    { type: 'truefalse', text: "The sky is blue.", options: ["True", "False"] },
                    { type: 'identification', text: "Identify the chemical symbol for water.", options: [] }
                ];

                // Set question text
                questionText.innerText = questions[number - 1].text;

                // Hide all question types initially
                multipleChoice.style.display = 'none';
                trueFalse.style.display = 'none';
                identification.style.display = 'none';

                // Show the relevant question type based on the question
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

                // Update the question number buttons
                let questionNumbers = document.querySelectorAll('.question-number');
                questionNumbers.forEach((btn, idx) => {
                    btn.classList.remove('active');
                    if (idx === number - 1) {
                        btn.classList.add('active');
                    }
                });
            }

            // Initialize the first question
            switchQuestion(1);
        </script>

        <!-- Edit Question Modal -->
        <div id="edit-modal" class="modal" style="display:none;">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal()">&times;</span>
                <h3>Edit Question</h3>
                
                <div>
                    <label for="edit-question-text">Question:</label>
                    <input type="text" id="edit-question-text" />
                </div>

                <!-- Options for Multiple Choice -->
                <div id="edit-options-container" style="display:none;">
                    <label for="edit-option-1">Option 1:</label>
                    <input type="text" id="edit-option-1" />
                    <label for="edit-option-2">Option 2:</label>
                    <input type="text" id="edit-option-2" />
                    <label for="edit-option-3">Option 3:</label>
                    <input type="text" id="edit-option-3" />
                    <label for="edit-option-4">Option 4:</label>
                    <input type="text" id="edit-option-4" />
                </div>

                <!-- True/False Options -->
                <div id="edit-truefalse-container" style="display:none;">
                    <label>
                        <input type="radio" name="edit-truefalse" value="True" /> True
                    </label>
                    <label>
                        <input type="radio" name="edit-truefalse" value="False" /> False
                    </label>
                </div>

                <!-- Identification Answer -->
                <div id="edit-identification-container" style="display:none;">
                    <label for="edit-identification-answer">Correct Answer:</label>
                    <input type="text" id="edit-identification-answer" />
                </div>

                <button class="save-btn" onclick="saveChanges()">Save</button>
            </div>
        </div>


        <script>
            let questions = [
                { type: 'multiple', text: "What is the capital of France?", options: ["Paris", "Berlin", "Madrid", "Rome"] },
                { type: 'truefalse', text: "The sky is blue.", options: ["True", "False"] },
                { type: 'identification', text: "Identify the chemical symbol for water.", answer: "H2O" }
            ];

            document.getElementById('edit-btn').addEventListener('click', function() {
                openEditModal(currentQuestion);
            });

            function openEditModal(questionNumber) {
                const question = questions[questionNumber - 1];
                
                // Open the modal
                document.getElementById('edit-modal').style.display = 'block';

                // Populate the modal with the question data
                document.getElementById('edit-question-text').value = question.text;

                // Show/hide appropriate fields based on the question type
                if (question.type === 'multiple') {
                    document.getElementById('edit-options-container').style.display = 'block';
                    document.getElementById('edit-truefalse-container').style.display = 'none';
                    document.getElementById('edit-identification-container').style.display = 'none';

                    // Populate the options
                    document.getElementById('edit-option-1').value = question.options[0];
                    document.getElementById('edit-option-2').value = question.options[1];
                    document.getElementById('edit-option-3').value = question.options[2];
                    document.getElementById('edit-option-4').value = question.options[3];

                } else if (question.type === 'truefalse') {
                    document.getElementById('edit-options-container').style.display = 'none';
                    document.getElementById('edit-truefalse-container').style.display = 'block';
                    document.getElementById('edit-identification-container').style.display = 'none';

                    // Set the selected true/false option
                    document.querySelector(`input[name="edit-truefalse"][value="${question.options[0]}"]`).checked = true;

                } else if (question.type === 'identification') {
                    document.getElementById('edit-options-container').style.display = 'none';
                    document.getElementById('edit-truefalse-container').style.display = 'none';
                    document.getElementById('edit-identification-container').style.display = 'block';

                    // Set the correct answer
                    document.getElementById('edit-identification-answer').value = question.answer;
                }
            }

            function closeModal() {
                document.getElementById('edit-modal').style.display = 'none';
            }

            function saveChanges() {
                // Fetch edited values from the modal
                const editedQuestionText = document.getElementById('edit-question-text').value;

                // Update the current question
                let question = questions[currentQuestion - 1];
                question.text = editedQuestionText;

                if (question.type === 'multiple') {
                    question.options = [
                        document.getElementById('edit-option-1').value,
                        document.getElementById('edit-option-2').value,
                        document.getElementById('edit-option-3').value,
                        document.getElementById('edit-option-4').value
                    ];
                } else if (question.type === 'truefalse') {
                    const selectedTrueFalse = document.querySelector('input[name="edit-truefalse"]:checked').value;
                    question.options = [selectedTrueFalse];
                } else if (question.type === 'identification') {
                    question.answer = document.getElementById('edit-identification-answer').value;
                }

                // Update the displayed question and options with the edited values
                switchQuestion(currentQuestion);

                // Close the modal
                closeModal();
            }

            function switchQuestion(number) {
                currentQuestion = number;

                // Update the question text and type of question
                let questionText = document.getElementById('question-text');
                let multipleChoice = document.querySelector('.options-container');
                let trueFalse = document.querySelector('.true-false-container');
                let identification = document.querySelector('.identification-container');

                let question = questions[number - 1];

                // Set question text
                questionText.innerText = question.text;

                // Hide all question types initially
                multipleChoice.style.display = 'none';
                trueFalse.style.display = 'none';
                identification.style.display = 'none';

                // Show the relevant question type based on the question
                if (question.type === 'multiple') {
                    multipleChoice.style.display = 'block';
                    let optionButtons = multipleChoice.querySelectorAll('.option-btn');
                    optionButtons.forEach((btn, idx) => {
                        btn.innerText = question.options[idx];
                        btn.classList.remove('active');
                    });
                } else if (question.type === 'truefalse') {
                    trueFalse.style.display = 'block';
                    let trueFalseButtons = trueFalse.querySelectorAll('.option-btn');
                    trueFalseButtons.forEach(btn => {
                        btn.classList.remove('active');
                    });
                } else if (question.type === 'identification') {
                    identification.style.display = 'block';
                    document.getElementById('identification-answer').innerText = question.answer;
                }

                // Update the question number buttons
                let questionNumbers = document.querySelectorAll('.question-number');
                questionNumbers.forEach((btn, idx) => {
                    btn.classList.remove('active');
                    if (idx === number - 1) {
                        btn.classList.add('active');
                    }
                });
            }
            // Initialize the first question
            switchQuestion(1);
        </script>

</body>
</html>