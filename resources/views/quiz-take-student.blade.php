<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{ secure_asset('student-view/quiz-take-student.css') }}">
    <!-- New CSS file for the container -->
    <link rel="stylesheet" href="{{ asset('student-view/quiz-take-student.css') }}">
    <!-- New CSS file for the container -->
</head>

<body>


    @if($taken > 0)
        <div class="container d-flex justify-content-center align-items-center mt-4">
            <div class="timer-container text-center p-3" style="width: 100%; height: 500px;">
                <h2 class="mt-4">You have already taken this challenge</h2>
            </div>
        </div><br>
        <center><a href="/studentchallenges/{{$class->id}}" id="back-btn" class="btn-bn" >Back</a></center>
    @else
        <div class="top-right">
            <input type="hidden" id="user" value="{{ Auth::user()->token_count }}" data-classid = "{{$class->id}}">
            <input type="text" {{ $quiz->enable_token === 0 ? 'disabled' : '' }} id="token-used"
                placeholder="Insert Token">
            <img class="img-token" src="{{ asset('token.png') }}" alt="Image">
            <span class="text-number">{{ Auth::user()->token_count }}</span>
        </div>

        <!-- Bootstrap container for responsiveness -->
        <div class="container d-flex justify-content-center align-items-center">
            <!-- Timer container in the center -->
            <div class="timer-container text-center p-3">
                <!-- Time display -->
                <div class="time-display" id="time-display">{{ $quiz->time_duration }}:00</div>
            </div>
        </div>

        <div class="question-container">
            <div class="question-header">
                <span id="question-text"></span>
            </div>
            <div style="text-align: center;">
                <!-- <img id="question-image" src="" alt="image" width="100" height="100"> -->
            </div><br>

            <div id="question-type-container">
                <input type="hidden" id="answer-holder">
                <div id="options-container"></div>
            </div>
            <div class="col-12 d-flex">
                <!-- Back button on the left -->
                <button id="back-btn" class="btn-bn">Back</button>
                <!-- Next button on the right -->
                <button id="next-btn" class="btn-bn ml-auto">Next</button>
                <!-- Submit button (initially hidden) -->
                <button id="submit-btn" class="btn-bn ml-auto" style="display:none;">Submit</button>
            </div>
        </div>

        <div class="question-numbers">
            @for($i = 1; $i <= count($questions); $i++)
            <button class="question-number {{$i == 1 ? 'active' : ''}}" id="question-number-{{$i}}" onclick="switchQuestion({{$i - 1}})">{{$i}}</button>
            @endfor
        </div>
    @endif
    <script>
        const totalQuestions = <?php echo count($questions); ?>;
        let answer = [];
        let questions = <?php echo $questions; ?>;
        let runningScore = 0;
        let token_count = $("#user").val();
        const tokenIsEnabled = <?php echo $quiz->enable_token === 1; ?>

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
    <script src="{{ asset('js/take-quiz.js') }}" defer></script>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <div class="modal fade" id="scoreModal" tabindex="-1" role="dialog" aria-labelledby="scoreModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Challenge Completed</h5>
                </div>
                <div class="modal-body">
                    <p id="scoreText"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn1" id="okayBtn">Okay</button>
                </div>
            </div>
        </div>
    </div>



</body>

</html>
