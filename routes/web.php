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

// Public Routes
Route::get('/', function () {
    return view('home');
});

Route::post('/auth.view', [AuthController::class, 'login'])->name('login');

Route::get('/auth.view', function () {
    return view('welcome');
})->name('welcome');

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
    Route::post('/create-class', [ClassController::class, 'createClass'])->name('create.class')->middleware('check.user.type:teacher');
    Route::post('/join-class', [ClassController::class, 'joinClass'])->name('join.class');

    Route::get('/bulletins/{classId}', [BulletinsController::class, 'show'])->name('bulletins');

    // Challenges Routes
    Route::get('/challenges/{classId}', [ChallengesController::class, 'index'])->name('challenges');
    Route::post('/challenges/{classId}/create', [ChallengesController::class, 'create'])->name('challenges.create');

// Routes for different types of challenges
// Display quizzes for a class (GET request)
Route::get('/quiz/{classId}', [QuizController::class, 'show'])->name('quiz.show');

// Store a newly created quiz (POST request)
Route::post('/quiz', [QuizController::class, 'store'])->name('quiz.store');
Route::get('/quiz/{classId}/quiz/{quizId}', [QuizController::class, 'displayQuiz'])->name('quiz.showQuiz');
// Route for showing quiz titles for a specific class (GET request)
Route::get('/quiz/{classId}/quiz-titles', [QuiztitleController::class, 'show'])->name('quiz.titles');
// Route for updating quiz
Route::post('/quiz/{quizId}/update', [QuizController::class, 'update'])->name('quiz.update');
// Route to display the quiz-taking interface
Route::get('/class/{classId}/quiz/{quizId}/take', [QuizController::class, 'showQuiz'])->name('quiz.take');

Route::get('/exam/{classId}', [ExamController::class, 'show'])->name('exam.show');
Route::get('/activity/{classId}', [ActivityController::class, 'show'])->name('activity.show');

});

// Static Page Routes
Route::view('/tutorials', 'tutorials')->name('tutorials');
Route::view('/players.view', 'players')->name('players');
Route::view('/attendance.view', 'attendance')->name('attendance');
Route::view('/grade.view', 'grade')->name('grade');
Route::view('/feedback.view', 'feedback')->name('feedback');
Route::view('/gradebook.view', 'gradebook')->name('gradebook');


// Class Update and Delete Routes
Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');
