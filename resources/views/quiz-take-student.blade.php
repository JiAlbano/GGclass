<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Challenge</title>
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!--CSS-->
    <link rel="stylesheet" href="{{ asset('student-view/quiz-take-student.css') }}"> <!-- New CSS file for the container -->
</head>

<body>
    <div class="navbar">
        <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass</h1>
            <!-- <h2 class="section-font">{{ $class->section }}</h2> -->
        </div>
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

    <div class="top-right">
        <input type="hidden" id="user" value="{{Auth::user()->token_count}}">
        <input type="text" {{$quiz->enable_token === 0 ? 'disabled' : ''}} id="token-used" placeholder="Insert Token">
        <img class="img-token" src="{{ asset('token.png') }}" alt="Image">
        <span class="text-number">{{Auth::user()->token_count}}</span>
    </div>

    <!-- Bootstrap container for responsiveness -->
<div class="container d-flex justify-content-center align-items-center">
    <!-- Timer container in the center -->
    <div class="timer-container text-center p-3">
        <!-- Time display -->
        <div class="time-display" id="time-display">{{$quiz->time_duration}}:00</div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get the time from the HTML content (in the format 'minutes:seconds')
    let timeDisplay = document.getElementById('time-display');
    let time = timeDisplay.innerText.split(":");
    
    // Convert the time to total seconds
    let minutes = parseInt(time[0]);
    let seconds = parseInt(time[1]);
    let totalSeconds = minutes * 60 + seconds;

    // Function to update the timer display
    function updateTimer() {
        // Calculate minutes and seconds from totalSeconds
        let mins = Math.floor(totalSeconds / 60);
        let secs = totalSeconds % 60;

        // Add leading zero if seconds are less than 10
        if (secs < 10) {
            secs = "0" + secs;
        }

        // Update the display
        timeDisplay.innerText = `${mins}:${secs}`;

        // Stop the timer at 0
        if (totalSeconds > 0) {
            totalSeconds--;
        } else {
            clearInterval(timer);
            // You can add any action you want when the timer ends, e.g., form submission
            submitQuiz()
        }
    }

    // Update the timer every second
    let timer = setInterval(updateTimer, 1000);
});

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="question-container">
    <div class="question-header">
        <span id="question-text"></span>
    </div>
    <div style="text-align: center;" >
        <img id="question-image" src="" alt="image" width="100" height="100">
    </div><br>

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
    let token_count = $("#user").val();
    const tokenIsEnabled = <?php echo ($quiz->enable_token === 1); ?>

$(document).ready(function() {
    // Initialize the first question
    switchQuestion(1);
})
function switchQuestion(number) {
    currentQuestion = number;

    let questionText = document.getElementById('question-text');
    let multipleChoice = document.querySelector('.options-container');
    let trueFalse = document.querySelector('.true-false-container');
    let identification = document.querySelector('.identification-container');

    questionText.innerText = questions[number - 1].question;
    document.getElementById('question-image').src = `/storage/${questions[number - 1].image}`
    if(questions[number - 1].image === null) {
        document.getElementById('question-image').style.display = 'none';
    } else {
        document.getElementById('question-image').style.display = 'center';
    }

    multipleChoice.style.display = 'none';
    trueFalse.style.display = 'none';
    identification.style.display = 'none';
    const answerExist = answer.find(ans => ans.question_id === questions[number - 1].id && ans.answer !== "");
    if (questions[number - 1].type === 'multipleChoice') {
        multipleChoice.style.display = 'block';
        const options = questions[number - 1].options;
        let optionHtml = ``;
        options.map((item,index) => {
            if(answerExist !== undefined || answerExist != null) {
                if(answerExist.answer === item) {
                    optionHtml += `<button class="option-btn active" id="option-btn-${parseInt(index)+1}" onclick="selectOption('${parseInt(index)+1}')">${item}</button>`;
                    $("#answer-holder").val(item)
                } else {
                    optionHtml += `<button class="option-btn" id="option-btn-${parseInt(index)+1}" onclick="selectOption('${parseInt(index)+1}')">${item}</button>`;
                }
            } else {
                optionHtml += `<button class="option-btn" id="option-btn-${parseInt(index)+1}" onclick="selectOption('${parseInt(index)+1}')">${item}</button>`;
            }
        })
        $(".options-container").html(optionHtml)
    } else if (questions[number - 1].type === 'trueFalse') {
        trueFalse.style.display = 'block';
        let trueFalseAnswer = ``;
        if(answerExist !== undefined || answerExist != null) {
            if(answerExist.answer === 'true') {
                trueFalseAnswer += `<button class="option-btn active" id="option-btn-true" onclick="selectOption(true)">True</button>`;
                $("#answer-holder").val(true)
            } else {
                trueFalseAnswer += `<button class="option-btn" id="option-btn-true" onclick="selectOption(true)">True</button>`;
            }

            if(answerExist.answer === 'false') {
                trueFalseAnswer += `<button class="option-btn active" id="option-btn-false" onclick="selectOption(false)">False</button>`;
                $("#answer-holder").val(false)
            } else {
                trueFalseAnswer += `<button class="option-btn" id="option-btn-false" onclick="selectOption(false)">False</button>`;
            }
            $("#answer-holder").val(answerExist.answer)
        } else {
            trueFalseAnswer = `<button class="option-btn" id="option-btn-true" onclick="selectOption(true)">True</button>
            <button class="option-btn" id="option-btn-false" onclick="selectOption(false)">False</button>`;
        }
        $(".true-false-container").html(trueFalseAnswer)
    } else if (questions[number - 1].type === 'identification') {
        identification.style.display = 'block';
        if(answerExist !== undefined || answerExist != null) {
            $(".identification-container").html(
                `<div class="form-group">
                    <label for="identification-answer">Answer:</label>
                    <input type="text" class="form-control" id="identification-answer" value="${answerExist.answer}" placeholder="Enter your answer">
                </div>`
            );
            $("#answer-holder").val(answerExist.answer)
        } else {
            $(".identification-container").html(
                `<div class="form-group">
                    <label for="identification-answer">Answer:</label>
                    <input type="text" class="form-control" id="identification-answer" placeholder="Enter your answer">
                </div>`
            );
        }        
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
        const mistakes = (parseFloat(runningScore) / parseFloat(questions.length)) * 100;
        if(mistakes >= 90) {
            token_count++;
        }
        const token_used =  $("#token-used").val();
        if(token_used > token_count) {
            alert("Invalid token count used.");
            return;
        }
        if(tokenIsEnabled) {
            token_count = token_count -token_used;
        }

        console.log(answer, studentScore)

        await $.ajax({
                url: '/challenges/record-score',  // URL where you want to send the PUT request
                type: 'POST',           // Laravel uses POST to handle PUT requests
                data: {answer: answer, studentScore: studentScore, token_count},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Add CSRF token in headers
                },
                success: function(response) {
                    console.log(response)
                    if(response == 1) {
                            $('#scoreText').html('Your score: '+ studentScore[0].total_score)
                            console.log(studentScore)
                            $('#scoreModal').modal('show')
                            $('#okayBtn').click(function(){
                                location.href=`/studentchallenges/<?php echo $class->id; ?>/studentquiz`;
                            }) 
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
    }

    function selectOption(option) {
        let questionType = document.querySelector('#question-type-container').children[0].style.display;
        let buttons;
        $(".option-btn").removeClass('active');
        $(`#option-btn-${option}`).addClass('active');
        $("#answer-holder").val(option);
    }

    $(document).on('keyup', '#identification-answer', function(){
        $("#answer-holder").val($(this).val());
    })

    function nextQuestion() {
        if (currentQuestion < totalQuestions) {
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
            if(is_correct)
                runningScore++;
            // if(studentAnswer.answer !== prevAnswer) {
            //     is_correct ? runningScore++ :runningScore--;
            // }
        } else {
            answer.push({
                question_id: questions[currentQuestion-1].id,
                challenge_id: questions[currentQuestion-1].quiz_id,
                answer: $("#answer-holder").val(),
                is_correct:is_correct,
                challenge_type: 'quiz'
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
            challenge_type: 'quiz',
            number_of_items: questions.length
        }]
        console.log(studentScore)
    }

    function previousQuestion() {
        if (currentQuestion > 1) {
            recordAnswer()
            currentQuestion--;
            switchQuestion(currentQuestion);

            // If moving back from the last question, hide the submit button
            if (currentQuestion < totalQuestions) {
                document.getElementById('submit-btn').style.display = 'none';
                document.getElementById('next-btn').style.display = 'block';
            }
        }
    }
</script>

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Modal -->
<div class="modal" id="scoreModal" tabindex="-1" role="dialog" aria-labelledby="scoreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <p id="scoreText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="okayBtn">Okay</button>
            </div>
        </div>
    </div>
</div>



</body>
</html>
