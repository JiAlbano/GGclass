<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Quiz</title>

    <!-- Google Fonts -->
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!--CSS-->
    <link rel="stylesheet" href="{{ secure_asset('take-quiz.css') }}"> <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('take-quiz.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="navbar">
    <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass</h1>
        <!-- <h2 class="section-font">{{ $class->section }}</h2> -->
    </div>

    <div class="profile-container" style="display: flex; position: relative;">
        <img class="profile-img"
            src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}"
            alt="Profile"
            id="logout-btn"
            aria-expanded="false">
        <div class="text-container">
            <p class="in-game-name">{{ $user->ign }}</p>
            <p class="user-type">{{ $user->user_type }}</p>
        </div>
        <!-- Logout Dropdown -->
        <div class="logout-container" style="display: none; position: absolute; top: 100%; right: 0; z-index: 1000;">
            <ul class="logout-menu" style="margin: 0; padding: 0; list-style: none;">
                <li class="logout-item" style="padding: 8px 12px;">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#" onclick="handleLogout(event)">Log out</a>
                </li>
                <li class="logout-item" style="padding: 8px 12px;">
                    <button class="dropdown-item" onclick="window.location.href='{{ route('class-list') }}'" style="border: none; background: none; text-decoration: none; color: #333; cursor: pointer;">Class-List</button>
                </li>
            </ul>
        </div>
    </div>
</div>

    <div class="back">
        <button onclick="window.history.back()">&#8592; Back</button>
    </div>

    <!-- Bootstrap container for responsiveness -->
<div class="container d-flex justify-content-center align-items-center">
    <!-- Timer container in the center -->
    <div class="timer-container text-center p-3">
        <!-- Time display -->
        <div class="time-display" id="time-display">{{$quiz->time_duration}}:00</div>
        
        <!-- Input for minutes (initially hidden) -->
        <input type="number" id="minutes-input" class="form-control mt-3" placeholder="Enter minutes" min="0" style="display:none;">
        
        <!-- Button container for centering -->
        <div class="button-container mt-3 d-flex justify-content-center">
            <!-- Edit button (initially shown) -->
            <button id="edit-button" class="edit-button">Edit</button>
            
            <!-- Save button (initially hidden) -->
            <button id="save-button" class="save-button" style="display:none;">Save</button>
        </div>
    </div>
</div>

    <script>
        // Get references to the buttons and input field
        const editButton = document.getElementById('edit-button');
        const saveButton = document.getElementById('save-button');
        const minutesInput = document.getElementById('minutes-input');
        const timeDisplay = document.getElementById('time-display');

        // Edit button click event
        editButton.addEventListener('click', function() {
            // Hide the Edit button and show the input field and Save button
            editButton.style.display = 'none';
            minutesInput.style.display = 'block';
            saveButton.style.display = 'block';
        });

        // Save button click event
        saveButton.addEventListener('click', function() {
            // Get the value from the input field
            const minutes = minutesInput.value;
            
            // Update the time display (simple example showing minutes in "mm:00" format)
            timeDisplay.textContent = `${minutes.padStart(2, '0')}:00`;

            // Hide the input field and Save button, show the Edit button again
            minutesInput.style.display = 'none';
            saveButton.style.display = 'none';
            editButton.style.display = 'block';
        });
    </script>


<div class="switch-container">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" data-quizid = {{$quiz->id}} id="flexSwitchCheckChecked1" {{$quiz->enable_token ? 'checked' : ''}}>
        <label class="form-check-label" for="flexSwitchCheckChecked1">Token</label>
    </div>
</div>


    <div class="question-container">
        <div class="question-header">
            <span id="question-text">{{ $questions[0]->question }}</span>
            <button id="edit-btn" class="edit-btn" onclick="openEditModal()">Edit</button>
        </div>

        <div id="question-type-container">
            <!-- Multiple choice question (default) -->
            <div style="text-align: center;" >
                <img id="question-image" src="" alt="image" width="100" height="100">
            </div><br>
            <div class="options-container"
                style="display: {{ $questions[0]->type === 'multipleChoice' ? 'block' : 'none' }};">
                @if(is_array($questions[0]->options))
                    @foreach($questions[0]->options as $key => $option)
                        <button class="option-btn" onclick="selectOption({{ $key + 1 }})">{{ $option }}</button>
                        <br>
                    @endforeach
                @endif
            </div>
            <!-- True/False question -->
            <div class="true-false-container"
                style="display: {{ $questions[0]->type === 'trueFalse' ? 'block' : 'none' }};">
                <button class="option-btn" onclick="selectOption(1)">True</button>
                <button class="option-btn" onclick="selectOption(2)">False</button>
                <input type="hidden" id="true-false-value">
            </div>

            <!-- Identification question -->
            <div class="identification-container"
                style="display: {{ $questions[0]->type === 'identification' ? 'block' : 'none' }};">
                <span id="identification-answer">Correct Answer: {{ $questions[0]->correct_answer }}</span>
                <input type="hidden" id="identification-value">
            </div>
            <!-- Navigation buttons aligned using Bootstrap flex utilities -->
            <div class="navigation-container d-flex justify-content-between mt-4">
                <button id="back-btn" class="btn-bn" onclick="previousQuestion()">Back</button>
                <button id="next-btn" class="btn-bn" onclick="nextQuestion()">Next</button>
            </div>
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
            document.getElementById('question-image').src = `/storage/${question[number - 1].image}`
            if(question[number - 1].image === null) {
                document.getElementById('question-image').style.display = 'none';
            } else {
                document.getElementById('question-image').style.display = 'center';
            }
            let multipleChoice = document.querySelector('.options-container');
            let trueFalse = document.querySelector('.true-false-container');
            let identification = document.querySelector('.identification-container');

            multipleChoice.style.display = 'none';
            trueFalse.style.display = 'none';
            identification.style.display = 'none';

            // Check the question type and display the correct one
            if (question[number - 1].type === 'multipleChoice') {
                multipleChoice.style.display = 'block';

                let optionButtons = multipleChoice.querySelectorAll('.option-btn');
                let options = question[number - 1].options ?? [];

                optionButtons.forEach((btn, idx) => {
                    if (options[idx]) {
                        btn.innerText = options[idx]; // Set the option text
                        btn.style.display = 'inline-block'; // Show button
                    } else {
                        btn.style.display = 'none'; // Hide extra buttons
                    }
                    btn.classList.remove('active'); // Remove active class
                });
            } else if (question[number - 1].type === 'trueFalse') {
                trueFalse.style.display = 'block';
                document.getElementById('true-false-value').value = question[number - 1].correct_answer;
            } else if (question[number - 1].type === 'identification') {
                identification.style.display = 'block';
                document.getElementById('identification-answer').innerText = `Correct Answer: ${question[number - 1].correct_answer}`;
                document.getElementById('identification-value').value = question[number - 1].correct_answer;
            }

            // Update active question number button
            const questionButtons = document.querySelectorAll('.question-number');
            questionButtons.forEach(btn => btn.classList.remove('active'));
            questionButtons[number - 1].classList.add('active');
        }

        // Call switchQuestion(1) to initialize
        switchQuestion(1);
    </script>

    <!-- Edit Question Modal -->
    <div id="edit-modal" class="modal" style="display:none;">
        <div class="modal-content " style="background-color: #283891">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h3>Edit Question</h3>
            <div class="question-text">
                <label for="edit-question-text" class="question" style="color: white; padding: 10px;">Question:</label>
                <input type="text" class="input-question" id="edit-question-text" />
            </div>
            <!-- Options for Multiple Choice -->
            <div id="edit-options-container" style="display:none;">
                <label for="edit-option-1" class="option-text">Option 1:</label>
                <input type="text" id="edit-option-1" />
                <br>
                <label for="edit-option-2" class="option-text">Option 2:</label>
                <input type="text" id="edit-option-2" />
                <br>
                <label for="edit-option-3" class="option-text">Option 3:</label>
                <input type="text" id="edit-option-3" />
                <br>
                <label for="edit-option-4" class="option-text">Option 4:</label>
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
                <label for="edit-identification-answer" class="identification-label">Correct Answer:</label>
                <input type="text" id="edit-identification-answer" class="identification-input" />
            </div>
            <div class="button-container">

                <button class="save-btn" id="save-btn" onclick="saveChanges()">Save</button>
            </div>
        </div>
    </div>

<script>
    function openEditModal() {
        // Get the current question
        let question = @json($questions)[currentQuestion - 1];

        // Open the modal
        document.getElementById('edit-modal').style.display = 'block';

        // Set the question text in the modal input field
        document.getElementById('edit-question-text').value = document.getElementById('question-text').textContent;

        // Handle different question types
        if (question.type === 'multipleChoice') {
            document.getElementById('edit-options-container').style.display = 'block';
            document.getElementById('edit-truefalse-container').style.display = 'none';
            document.getElementById('edit-identification-container').style.display = 'none';

            // Populate options
            let options = [];
            var buttons = document.querySelectorAll('.option-btn');
        
            // Loop through each button and get the text
            buttons.forEach(function(button) {
                options.push(button.textContent);
            });

            for (let i = 0; i < options.length; i++) {
                document.getElementById('edit-option-' + (i + 1)).value = options[i] || '';
            }

        } else if (question.type === 'trueFalse') {
            document.getElementById('edit-options-container').style.display = 'none';
            document.getElementById('edit-truefalse-container').style.display = 'block';
            document.getElementById('edit-identification-container').style.display = 'none';

            // Set true/false radio buttons
            let trueFalseValue = document.getElementById('true-false-value').value.toLowerCase() === 'true' ? 'True' : 'False';
            console.log(trueFalseValue)
            document.querySelector(`input[name="edit-truefalse"][value="${trueFalseValue}"]`).checked = true;

        } else if (question.type === 'identification') {
            document.getElementById('edit-options-container').style.display = 'none';
            document.getElementById('edit-truefalse-container').style.display = 'none';
            document.getElementById('edit-identification-container').style.display = 'block';

            // Set the identification correct answer
            document.getElementById('edit-identification-answer').value = document.getElementById('identification-value').value;
        }
    }

    function closeModal() {

        document.getElementById('edit-modal').style.display = 'none';
    }
    function saveChanges() {

        // Get the updated question text and options from the modal
        let updatedQuestion = document.getElementById('edit-question-text').value;
        let question = @json($questions)[currentQuestion - 1]; // Ensure this variable is correctly defined

        // Prepare the data to be sent
        let data = {
            id: question.id,
            question: updatedQuestion,
            options: [], // This will hold the updated options
            correct_answer: ''
        };

        // Update for multiple choice options
        if (question.type === 'multipleChoice') {
            for (let i = 0; i < 4; i++) {
                let optionValue = document.getElementById('edit-option-' + (i + 1)).value;
                data.options.push(optionValue);
            }
            question.options = data.options;

        } else if (question.type === 'trueFalse') {
            // Get the updated true/false value
            let updatedTrueFalse = document.querySelector('input[name="edit-truefalse"]:checked').value;
            data.correct_answer = updatedTrueFalse;

        } else if (question.type === 'identification') {
            // Get the updated identification answer
            let updatedAnswer = document.getElementById('edit-identification-answer').value;
            data.correct_answer = updatedAnswer;
        }   

        let questionId = question.id; // Get the question ID

    // Make the AJAX request to save changes
    fetch("{{ route('exam.updateQuestion', ['classId' => $class->id, 'quizId' => $quiz->id]) }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token for security
        },
        body: JSON.stringify(data),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the UI with the new question text
            document.getElementById('question-text').innerText = data.updatedQuestion;
            document.getElementById('identification-answer').innerText = `Correct Answer: ${data.updatedAnswer}`;

            //true false
            document.getElementById('true-false-value').value = data.updatedAnswer;

            // identification
            document.getElementById('identification-value').value = data.updatedAnswer;

            //options
            let options = ``;
            if(data.options.length > 0) {
                data.options.map((option, index) => {
                    options += `<button class="option-btn" onclick="selectOption( ${index + 1})">${option}</button><br>`;
                })
                document.getElementsByClassName('options-container')[0].innerHTML = options;
            }
            closeModal();
        } else {
            console.error('Error updating question:', data);
        }
    })
    .catch(error => console.error('Error:', error))
}

// token
$("#flexSwitchCheckChecked1").change(function() {
    const tokenStatus = ($(this).prop('checked')) ? 1 : 0;
    const quizId = $(this).data('quizid');
    $.ajax({
            url: '/quiz/edit-token',  // URL where you want to send the PUT request
            type: 'POST',           // Laravel uses POST to handle PUT requests
            data: {tokenStatus: tokenStatus, quizId: quizId},
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Add CSRF token in headers
            },
            success: function(response) {
                console.log('Success:', response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
});

$("#save-button").click(function(){
    const timer = $("#minutes-input").val();
    const quizId = $("#flexSwitchCheckChecked1").data('quizid');
    $.ajax({
        url: '/quiz/edit-timer',  // URL where you want to send the PUT request
        type: 'POST',           // Laravel uses POST to handle PUT requests
        data: {timer: timer, quizId: quizId},
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Add CSRF token in headers
        },
        success: function(response) {
            console.log('Success:', response);
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
})
</script>

</body>

</html>
