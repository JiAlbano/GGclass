let currentQuestion = 0;
let answerContainer;
let studentAnswers = [];
let score = 0;
let totalScore = 0;
let tokenUsed = 0;
let studentScore = [];
$(document).ready(function() {
    // initialize first question
    switchQuestion(currentQuestion);

    // next question click
    $("#next-btn").click(function() {
        currentQuestion < (totalQuestions - 1) ? currentQuestion++ : currentQuestion;
        if(currentQuestion == (totalQuestions - 1)) {
            $("#submit-btn").show();
            $(this).hide();
        } else {
            $("#submit-btn").hide();
            $(this).show();
        }
        switchQuestion(currentQuestion);
    });

    // back button
    $("#back-btn").click(function() {
        currentQuestion > 0 ? currentQuestion-- : currentQuestion;
        $("#submit-btn").hide();
        $("#next-btn").show();
        $("#submit-btn").prop('disabled', false);
        $("#submit-btn").css('background-color', '#283891'); 
        switchQuestion(currentQuestion);
    });

// Submit button
$("#submit-btn").click(function () {
    $(this).prop("disabled", true); // Disable the submit button
    $(this).css("background-color", "grey");

    // Disable the back button and style it as locked
    $("#back-btn").prop("disabled", true);
    $("#back-btn").css("background-color", "grey");

    tokenUsed = $("#token-used").val() !== "" ? $("#token-used").val() : 0;
    const score = studentAnswers.filter((item) => item.is_correct === 1).length;
    totalScore = parseInt(tokenUsed) + parseInt(score);

    studentScore = [
        {
            challenge_id: questions[currentQuestion].quiz_id ?? questions[currentQuestion].exam_id,
            score: score,
            token_used: tokenUsed,
            total_score: totalScore,
            challenge_type: questions[currentQuestion].quiz_id ? "quiz" : "exam",
            number_of_items: questions.length,
        },
    ];

    submitQuiz();
});

// Back button
$("#back-btn").click(function () {
    if (currentQuestion > 0) {
        currentQuestion--;
        $("#submit-btn").hide();
        $("#next-btn").show();
        switchQuestion(currentQuestion);
    }
});

    $('#scoreModal').modal({
        backdrop: 'static',
        keyboard: false
    });

    $('#scoreModal').on('hidden.bs.modal', function (e) {
        e.preventDefault(); // Prevent modal from closing
    });

    $('#scoreModal .close').on('click', function (e) {
        e.preventDefault(); // Prevent the modal from closing
    });
    
});

// traverse to each questions
const switchQuestion = (index) => {
    const question = questions[index];
    currentQuestion = index;
    $("#question-text").html(question.question);
    $(`.question-number`).removeClass('active');
    $(`#question-number-${parseInt(index) + 1}`).addClass('active');

    if(question.type === 'multipleChoice')
        renderMultipleChoice(question);
    else if(question.type === 'trueFalse')
        renderTrueOrFalse(question);
    else 
        renderIndetification(question);
}

// render multiple choice questions
const renderMultipleChoice = (question) => {
    let optionHtml = ``;
    const correctanswer = studentAnswers.find(q => q.question_id === questions[currentQuestion].id) ?? {answer: null};
    question.options.map((item, index) => {
        optionHtml += `<button 
                            class="option-btn ${correctanswer.answer == parseInt(index)+1 ? 'active' : ''}" 
                            ${correctanswer.answer == parseInt(index)+1 ? 'disabled' : ''} 
                            id="option-btn-${parseInt(index)+1}" 
                            onClick='selectAnswer(this, ${parseInt(index)+1})' 
                            data-question='${JSON.stringify(question)}'
                        >
                            ${item}
                        </button>`;
    });
    $("#options-container").html(optionHtml)
}

// render true or false questions
const renderTrueOrFalse = (question) => {
    const correctanswer = studentAnswers.find(q => q.question_id === questions[currentQuestion].id) ?? {answer: null};
    let optionHtml = `
                        <button class="option-btn ${correctanswer.answer == true ? 'active' : ''}" id="option-btn-true" onClick='selectAnswer(this, true)' data-question='${JSON.stringify(question)}'>True</button>
                        <button class="option-btn ${correctanswer.answer == false ? 'active' : ''}" id="option-btn-false" onClick='selectAnswer(this, false)' data-question='${JSON.stringify(question)}'>False</button>
                    `;
    $("#options-container").html(optionHtml)
}

// render identification questions
const renderIndetification = (question) => {
    const correctanswer = studentAnswers.find(q => q.question_id === questions[currentQuestion].id) ?? {answer: ''};
    let optionHtml = `
                        <div class="form-group">
                            <label for="identification-answer">Answer:</label>
                            <input type="text" class="form-control option-btn" id="identification-answer" placeholder="Enter your answer" value='${correctanswer.answer}' onBlur='selectAnswer(this)' data-question='${JSON.stringify(question)}'>
                        </div>
                    `;
    $("#options-container").html(optionHtml)
}

// select answer
const selectAnswer = (element, answer = '') => {
    let question = JSON.parse(element.getAttribute('data-question'));
    $(".option-btn").removeClass('active');
    $(".option-btn").removeAttr('disabled');
    $(element).addClass('active');
    $(element).attr('disabled', 'disabled');
    answerContainer = answer;

    let existing = false;
    if(question.type === 'identification') {
        $(".option-btn").removeAttr('disabled');
        answerContainer = $("#identification-answer").val();
    }

    const isCorrect = answerContainer.toString().toLowerCase() === questions[currentQuestion].correct_answer.toLowerCase() ? 1 : 0;

    const questionAnswer = {
        question_id: questions[currentQuestion].id,
        challenge_id: questions[currentQuestion].quiz_id ?? questions[currentQuestion].exam_id,
        answer: answerContainer,
        is_correct: isCorrect,
        challenge_type: questions[currentQuestion].quiz_id ? 'quiz' : 'exam',
    };

    if(studentAnswers[currentQuestion])
        existing = studentAnswers[currentQuestion].question_id === questionAnswer.question_id;

    if (existing) {
        studentAnswers[currentQuestion] = questionAnswer;
    } else {
        studentAnswers.push(questionAnswer);
    }
}

// submit answer to save to database
async function submitQuiz() {
    const mistakes = (parseFloat(score) / parseFloat(questions.length)) * 100;
    const classId = $("#user").data('classid');
    if (mistakes >= 90 || mistakes == 0) {
        token_count++;
    }
    if (tokenUsed > token_count) {
        alert("Invalid token count used.");
        return;
    }
    if (tokenIsEnabled) {
        token_count = token_count - tokenUsed;
    }
    $('#scoreText').html('Your score: ' + studentScore[0].total_score)
    await $.ajax({
        url: '/challenges/record-score', // URL where you want to send the PUT request
        type: 'POST', // Laravel uses POST to handle PUT requests
        data: {
            answer: studentAnswers,
            studentScore: studentScore,
            token_count
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response == 1) {
                $('#scoreText').html('Your score: ' + studentScore[0].total_score)
                $('#scoreModal').modal('show')
                $('#okayBtn').click(function() {
                    location.href = `/studentchallenges/${classId}`;
                })
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
}

