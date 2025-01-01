<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\SignupTeacherController;
use App\Http\Controllers\Auth\SignupStudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\BulletinsController;
use App\Http\Middleware\CheckUserType;  // Corrected Typo
use App\Http\Controllers\ChallengesController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\QuiztitleController;
use App\Http\Controllers\TutorialsController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GradebookController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\GradequizController;
use App\Http\Controllers\GradequiztitleController;
use App\Http\Controllers\GradecomponentsController;
use App\Http\Controllers\GradedataController;
use App\Http\Controllers\GradeclassrecordController;
use App\Http\Controllers\StudentBulletinsController;
use App\Http\Controllers\StudentchallengesController;
use App\Http\Controllers\StudenttutorialsController;
use App\Http\Controllers\StudentplayersController;
use App\Http\Controllers\StudentprofilestudentController;
use App\Http\Controllers\StudentattendanceController;
use App\Http\Controllers\StudentgradeController;
use App\Http\Controllers\StudentfeedbackController;
use App\Http\Controllers\StudentgradequiztitleController;
use App\Http\Controllers\StudentquizController;
use App\Http\Controllers\StudentquiztitleController;
use App\Http\Controllers\StudentquiztakeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CreateQuizController;
use App\Http\Controllers\CreateExamController;
// autorun

Route::get('/migrate', function () {
    Artisan::call('migrate --force');
    return 'Migrations completed!';
});

Route::get('/seed', function () {
    Artisan::call('db:seed --force');
    return 'Seeders executed!';
});

// Public Routes
Route::get('/', function () {
    return view('home');
});

Route::post('/auth.view', function () {
    return view('login');
})->name('login');

Route::post('/logout', [GoogleController::class, 'logout'])->name('logout');

Route::get('/auth.view', function () {
    return view('welcome');
})->name('welcome');

Route::get('/basic-info-teacher.view', function () {
    return view('basic-info-teacher');
})->name('basic.info.teacher');

Route::get('/basic-info-student.view', function () {
    return view('basic-info-student');
})->name('basic.info.student');

Route::get('/signup-teacher', function () {
    return view('signup_teacher');
})->name('signup.teacher');

// Use the controller method for signup student
Route::get('/signup-student', [SignupStudentController::class, 'showSignupForm'])->name('signup.student');

// Google Authentication Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('googleRedirect');
Route::get('auth/callback/google', [GoogleController::class, 'handleGoogleCallback']);

// Signup Form Handling
Route::post('signup-teacher', [SignupTeacherController::class, 'handleSignup']);
Route::post('signup-student', [SignupStudentController::class, 'handleSignup']);

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Classroom Routes
    Route::get('/classroom', [ClassController::class, 'index'])->name('classroom.index');

    Route::get('basic-info-teacher', [GoogleController::class, 'basicInfoTeacher'])->name('basic-info-teacher');
    Route::get('basic-info-student', [GoogleController::class, 'basicInfoStudent'])->name('basic-info-student');
    Route::post('/basic-info-student/update', [GoogleController::class, 'updateBasicInfo'])->name('basic-info-student.update');
    Route::post('/basic-info-teacher/update', [GoogleController::class, 'updateBasicInfoTeacher'])->name('basic-info-teacher.update');
    Route::post('/create-class', [ClassController::class, 'createClass'])->name('create.class');

    Route::get('/bulletins/{classId}', [BulletinsController::class, 'show'])->name('bulletins');
    Route::get('/tutorials/{classId}', [TutorialsController::class, 'show'])->name('tutorials');
    Route::get('/players/{classId}', [PlayersController::class, 'show'])->name('players');
    Route::get('/attendance/{classId}', [AttendanceController::class, 'show'])->name('attendance');
    Route::get('/grade/{classId}', [GradeController::class, 'show'])->name('grade');
    Route::get('/feedback/{classId}', [FeedbackController::class, 'show'])->name('feedback');
    Route::get('/gradebook/{classId}', [GradebookController::class, 'show'])->name('gradebook');
    Route::get('/grade/{classId}/grade-quiz-title', [GradequiztitleController::class, 'show'])->name('grade-quiz-title');
    Route::get('/grade/{classId}/grade-quiz-title/grade-quiz/{quizId}', [GradequizController::class, 'show'])->name('grade-quiz');
    Route::get('/gradebook/{classId}/grade-components', [GradecomponentsController::class, 'show'])->name('grade-components');
    Route::get('/gradebook/{classId}/data', [GradedataController::class, 'show'])->name(name: 'data');
    Route::get('/gradebook/{classId}/class-record', [GradeclassrecordController::class, 'show'])->name(name: 'class-record');

    // Class Dashboard Routes
    Route::get('/create-class', [ClassController::class, 'create'])->name('create-class');
    Route::post('/class-list', [ClassController::class, 'joinClass'])->name('join.class');
    Route::get('/class-list', [ClassController::class, 'index'])->name('class-list');
    Route::get('/create-list', [ClassController::class, 'user'])->name('create-user');
    Route::post('/classes/store', [ClassController::class, 'store'])->name('classes.store');
 

    //Student routes
    Route::get('/studentbulletins/{classId}', [StudentBulletinsController::class, 'show'])->name('studentbulletins');
     //Student quiz routes
    Route::get('/studentchallenges/{classId}', [StudentchallengesController::class, 'show'])->name('challenges-student');
    Route::get('/studentchallenges/{classId}/studentquiz', [StudentquizController::class, 'show'])->name('quiz-student');
    Route::get('/studentchallenges/{classId}/studentquiz/quiz-title-student/{quizId}', [StudentquiztitleController::class, 'show'])->name('quiz-title-student');
    Route::get('/studentchallenges/{classId}/quiz-title-student/quiz-take-student/{quizId}', [StudentquiztakeController::class, 'show'])->name('quiz-take-student');


    Route::get('/studenttutorials/{classId}', [StudenttutorialsController::class, 'show'])->name('tutorials-student');
    Route::get('/studentplayers/{classId}', [StudentplayersController::class, 'show'])->name('players-student');
    //Student Info routes
    Route::get('/profile/{classId}', [StudentprofilestudentController::class, 'show'])->name('profile-student');
    Route::get('/studentattendance/{classId}', [StudentattendanceController::class, 'show'])->name('attendance-student');
    //student grades
    Route::get('/studentgrade/{classId}', [StudentgradeController::class, 'show'])->name('grade-student');
    Route::get('/studentgradequiz/{classId}', [StudentgradeController::class, 'showQuiz'])->name('test_and_quizzes_student.show');
    Route::get('/studentfeedback/{classId}', [StudentfeedbackController::class, 'show'])->name('feedback-student');

    // Challenges Routes
    Route::get('/challenges/{classId}', [ChallengesController::class, 'index'])->name('challenges');
    Route::post('/challenges/{classId}/create', [ChallengesController::class, 'create'])->name('challenges.create');

// Routes for different types of challenges

// Display quizzes for a class (GET request)
Route::get('/quiz/{classId}', [QuizController::class, 'show'])->name('test_and_quizzes.show');
// Create quizzes for a class
Route::get('/class/{classId}/quiz/create', [CreateQuizController::class, 'create'])->name('createquiz');

// Store a newly created quiz (POST request)
Route::post('/quiz', [QuizController::class, 'store'])->name('test_and_quizzes.store');
Route::get('/test_and_quizzes/{classId}/{quizId}', [QuizController::class, 'displayQuiz'])->name('test_and_quizzes.showQuiz');
// Route for showing quiz titles for a specific class (GET request)
Route::get('/quiz/{classId}/quiz-titles', [QuiztitleController::class, 'show'])->name('test_and_quizzes.titles');
// Route for updating quiz
Route::post('/quiz/{quizId}/update', [QuizController::class, 'update'])->name('test_and_quizzes.update');
// Route to display the quiz-taking interface
Route::get('/test_and_quizzes/{classId}/{quizId}/take', [QuizController::class, 'showQuiz'])->name('test_and_quizzes.take');
// Route for saving changes to a question
Route::post('/class/{classId}/quiz/{quizId}/take/editQuestion', [QuizController::class, 'updateQuestion'])->name('test_and_quizzes.updateQuestion');

Route::get('/student/exam/{classId}', [ExamController::class, 'show'])->name('exam_student.show');

Route::get('/activity/{classId}', [ActivityController::class, 'show'])->name('activity.show');


Route::get('/exam/{classId}', [ExamController::class, 'show'])->name('exam.show');


Route::get('/class/{classId}/exam/create', [CreateExamController::class, 'create'])->name('createexam');

Route::post('/exam', [ExamController::class, 'store'])->name('exam.store');

Route::get('/exam/{classId}/exam/{examId}', [ExamController::class, 'displayExam'])->name('exam.showQuiz');
// Route for showing quiz titles for a specific class (GET request)
Route::get('/exam/{classId}/quiz-titles', [ExamController::class, 'show'])->name('exam.titles');
// Route for updating quiz
Route::post('/exam/{examId}/update', [ExamController::class, 'update'])->name('exam.update');
// Route to display the quiz-taking interface
Route::get('/class/{classId}/exam/{examId}/take', [ExamController::class, 'showExam'])->name('exam.take');
// Route for saving changes to a question
Route::post('/class/{classId}/exam/{examId}/take/editQuestion', [ExamController::class, 'updateQuestion'])->name('exam.updateQuestion');

    // Token management
    Route::post('/token/update', [ExamController::class, 'editToken'])->name('updateToken');
    
    // Timer management
    Route::post('/timer/update', [ExamController::class, 'editTimer'])->name('updateTimer');



Route::get('/student/activity/{classId}', [ActivityController::class, 'show'])->name('activity_student.show');

// Class Update and Delete Routes
Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');


//gradebook functionality

// students-list.blade.php
Route::get('/students-list', [StudentController::class, 'index'])->name('student-list');

// student-data.blade.php
// Route::view('/students-data', 'grade-book.student-data.student-data')->name('student-data');
Route::get('/student/{school_id}', [StudentController::class, 'show'])->name('student.show');

// student-assessment.blade.php
Route::get('/student-assessment/{school_id}/{assessment_id}', [StudentController::class, 'assessment'])->name('student-assessment');

// Route for exporting the Excel file
Route::get('/students-list/export', [StudentController::class, 'export'])->name('student-list.export');





// log out
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

//update token
Route::post('/quiz/edit-token', [QuizController::class, 'editToken']);
Route::post('/quiz/edit-timer', [QuizController::class, 'editTimer']);

// record student score for challenges
Route::post('/challenges/record-score', [ChallengesController::class, 'recordScore']);

});

Route::post('/grade-quiz/edit-score', [QuizController::class, 'editScore']);


// Static Page Routes




