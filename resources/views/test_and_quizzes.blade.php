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
    <link rel="stylesheet" href="{{ secure_asset('quiz.css') }}"> <!-- New CSS file for the container -->
</head>

<body>

    <div class="navbar">
        <div class="left-section" style="cursor: pointer;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">
            <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
            <h1 class="ggclass-font">GGclass ></h1>
            <h2 class="section-font">{{ $class->section }}</h2>
    </div>

{{-- <div class="navbar">
    <div class="left-section">
        <img class="logo-img" src="{{ asset('finalLogo.png') }}" alt="GGclass Logo">
        <h1 class="ggclass-font">GGclass ></h1>
        <h2 class="section-font">{{ $class->section }}</h2>
    </div> --}}

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
                <button class="btn" style="font-size: 12px; border:none; width: 100%;" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%; " onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id])}}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn challenge-btn active" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" style="font-size: 12px; width: 100%;" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
            </div>
        </div>
    </div>

    <!-- <div class="d-flex justify-content-end">
    <button type="button" class="btn-add2" 
        onclick="window.location.href='{{ route('createquiz', ['classId' => $class->id]) }}'">
        Create
    </button>
</div> -->


    <div class="dashboard-container">
    <!-- Back Button -->
    <div class="back-button">
    <button onclick="window.history.back()" class="btn btn-secondary">
        &#8592; Back
    </button>
    </div>

    <div class="content-container">
        <!-- Class Card -->
        <div class="class-card">
            <div class="class-header">
                <p>School Year: 2024 - 2025</p>
                <p>Semester: 1st</p>
                <p>Section: {{ $class->section }}</p>
            </div>
            <div class="class-details">
                <h2>CSDC101</h2>
                <p>TTH 09:00AM - 10:30AM</p>
                <p>AL411B</p>
            </div>
            <div class="class-buttons">
                <button onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">Attendance</button>
                <button onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">Feedback</button>
                <button onclick="window.location.href='{{ route('gradebook', ['classId' => $class->id]) }}'">Gradebook</button>
            </div>
        </div>
        <div class="dashboard-container">



<!-- Add Quiz Modal Button -->
<div class="add-challenge-container">
    <button type="button" class="add-challenge-btn" 
            onclick="window.location.href='{{ route('createquiz', ['classId' => $class->id]) }}'">
        <div class="icon">
            <img src="{{ asset('challenge.png') }}" alt="Add Quiz Icon" class="icon-img">
        </div>
        <div class="text">Create a new quiz for your class</div>
    </button>
</div>
           

           <!-- Display Challenges -->

           <div class="challenge-list">
    @foreach($quizzes as $quiz)
        <button class="challenge-item"  onclick="window.location.href='{{ route('test_and_quizzes.showQuiz', ['classId' => $class->id, 'quizId' => $quiz->id]) }}'">
            <div class="challenge-icon">
                <img src="{{ asset('megaphone.png') }}" />
            </div>
            <div class="challenge-content">
                <p class="challenge-title">
                    Quiz Title: {{ $quiz->title }}
                </p>
                <p class="challenge-date">{{ $quiz->created_at->format('M d, Y') }}</p>
            </div>
            <div class="challenge-options">
                <span class="options-btn">•••</span>
            </div>
        </button>
    @endforeach
</div>

    <script>
        const modal = document.getElementById("challengeModal");
        const addBtn = document.getElementById("addBtn");
        const closeBtn = document.getElementsByClassName("close")[0];

        addBtn.onclick = function() {
            modal.style.display = "block";
        };

        closeBtn.onclick = function() {
            modal.style.display = "none";
        };

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };
    </script>

    </div>
    </div>

</div>

  <!-- Display profile picture -->


        <!-- <div class="info-container">
            <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Profile Picture" class="container-picture">
    
            <div class="container-name">{{ $user->first_name }} {{ $user->last_name }}</div>
            <div class="container-info-section">
                <p class="class-name">Class Name: <span>{{ $class->class_name }}</span></p>
                <p class="subject">Subject: <span>{{ $class->subject }}</span></p>
                <p class="section">Section: <span>{{ $class->section }}</span></p>
                <p class="section">Class Code: <span>{{ $class->class_code }}</span></p>
            </div>
            <div class="container-info-email">
                <p>{{ $user->email }}</p>
            </div>

                    <div class="container-buttons">
                        <button class="btn1"onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">ATTENDANCE</button>
                        <button class="btn1"onclick="window.location.href='{{ route('grade', ['classId' => $class->id]) }}'">GRADE</button>
                        <button class="btn1"onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">FEEDBACK</button>
                        <button class="btn1"onclick="window.location.href='{{ route('student-list', ['classId' => $class->id]) }}'">GRADEBOOK</button>
                    </div>
            </div> -->



{{--
<!-- Modal Structure 
<div id="quizModal" class="modal">
    <div class="modal-content">
        <!-- Close Button -->
        <span class="close-button" onclick="closeModal()">&times;</span>

        <h2>Create Quiz</h2>

        <!-- Scrollable Container -->
        <div class="modal-body">
            <!-- Quiz Title and Description -->
            <form id="quizForm" method="POST" action="{{ route('test_and_quizzes.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="class_id" value="{{ $class->id }}"> <!-- Hidden field for class_id -->

                <label for="quizTitle">Quiz Title:</label>
                <input type="text" id="quizTitle" name="title" placeholder="Enter Quiz Title" required>

                <label for="quizDescription">Quiz Description:</label>
                <textarea id="quizDescription" name="description" placeholder="Enter Quiz Description"></textarea>

                <!-- Questions Container -->
                <div id="questionsContainer">
                    <!-- Initial Question Form will be dynamically added here -->
                </div>

                <!-- Add Initial Question Button -->
                <button type="button" id="addQuestionButton" onclick="addQuestion()">Add Question</button>

                <!-- Modal Footer with Create Quiz Button -->
                <div class="modal-footer">
                    <button type="button" onclick="submitQuiz()">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Modal and Dynamic Question Handling -->
<script>
    // Open the modal
    document.getElementById('createQuizButton').onclick = function() {
        document.getElementById('quizModal').style.display = 'flex';
    };

    // Close the modal
    function closeModal() {
        document.getElementById('quizModal').style.display = 'none';
    }

    let questionCount = 0;
    let mcOptionCount = 0;

    // Show dynamic question form based on the question type
    function showQuestionForm(questionNumber) {
        const selectedType = document.getElementById(`questionType-${questionNumber}`).value;
        const questionForm = document.getElementById(`question-${questionNumber}`);
        const optionsContainer = questionForm.querySelector('.options-container');
        optionsContainer.innerHTML = ''; // Clear previous options

        if (selectedType === 'multipleChoice') {
            mcOptionCount = 0; // Reset mcOptionCount for each question
            optionsContainer.innerHTML = `
                <label for="mcAnswerKey-${questionNumber}">Answer Key:</label>
                <select id="mcAnswerKey-${questionNumber}" name="questions[${questionNumber}][correct_answer]">
                    <!-- Options will be dynamically populated -->
                </select>
                <div id="mcOptions-${questionNumber}" class="options-container">
                    <!-- Dynamic option input fields will appear here -->
                </div>
                <button type="button" onclick="addMCOption(${questionNumber})">Add Option</button>
            `;
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
                <input type="text" id="idAnswer-${questionNumber}" name="questions[${questionNumber}][correct_answer]" placeholder="Enter Answer Key">
            `;
        }
    }

    // Add multiple-choice options dynamically
    function addMCOption(questionNumber) {
        mcOptionCount++;
        const mcOptionsDiv = document.getElementById(`mcOptions-${questionNumber}`);
        const answerKeySelect = document.getElementById(`mcAnswerKey-${questionNumber}`);
        const optionHTML = `
            <div id="mcOption-${questionNumber}-${mcOptionCount}">
                <label for="mcOption-${questionNumber}-${mcOptionCount}">Option ${mcOptionCount}:</label>
                <input type="text" id="mcOption-${questionNumber}-${mcOptionCount}" name="questions[${questionNumber}][options][]" placeholder="Enter Option">
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

    // Delete a multiple-choice option
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

    // Add a new question form dynamically
    function addQuestion() {
        questionCount++;
        const questionHTML = `
            <div id="question-${questionCount}" class="question-form">
                <label for="questionType-${questionCount}">Question Type:</label>
                <select id="questionType-${questionCount}" name="questions[${questionCount}][type]" onchange="showQuestionForm(${questionCount})">
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


                <!-- File Upload Button for Each Question -->
                <label for="uploadFile-${questionCount}">Upload File:</label>
                <input type="file" id="uploadFile-${questionCount}" name="questions[${questionCount}][uploadFile]">
            </div>
        `;
        document.getElementById('questionsContainer').insertAdjacentHTML('beforeend', questionHTML);
    }

    // Submit the quiz and gather the quiz and questions data
    function submitQuiz() {
        document.getElementById('quizForm').submit();
        closeModal();
    }
</script>
--}}
</body>
</html>
