<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SignupTeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SignupStudentController;


//route for welcome page
Route::get('/', function () {
    return view('home');
});

Route::get('/auth.view', function () {
    return view('welcome');
})->name('welcome');

//route for sign up page for teacher
Route::get('/signup-teacher', function () { //url link
    return view('signup_teacher'); //load view page
})->name('signup.teacher'); //name of the route page

Route::get('/bulletins.view', function () {
    return view('bulletins');
})->name('bulletins');

Route::get('/tutorials.view', function () {
    return view('tutorials');
})->name('tutorials');

Route::get('/challenges.view', function () {
    return view('challenges');
})->name('challenges');

// Define the route for the Quiz page
Route::get('/quiz.view', function () {
    return view('quiz'); // Return the 'quiz' view
})->name('quiz');

Route::get('/players.view', function () {
    return view('players');
})->name('players');

Route::get('/attendance.view', function () {
    return view('attendance');
})->name('attendance');

Route::get('/grade.view', function () {
    return view('grade');
})->name('grade');

Route::get('/feedback.view', function () {
    return view('feedback');
})->name('feedback');

Route::get('/gradebook.view', function () {
    return view('gradebook');
})->name('gradebook');

Route::get('/create-quiz.view', function () {
    return view('create-quiz');
})->name('create-quiz');

Route::get('/quiz-title.view', function () {
    return view('quiz-title');
})->name('quiz-title');

Route::get('/take-quiz.view', function () {
    return view('take-quiz');
})->name('take-quiz');


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('googleRedirect'); //route for redirecting to gbox login
Route::get('auth/callback/google', [GoogleController::class, 'handleGoogleCallback']); // route for handling acc after logging in
Route::post('signup-teacher', [SignupTeacherController::class, 'handleSignup']); // For handling form submission
Route::post('signup-student', [SignupStudentController::class, 'handleSignup']);
Route::get('signup-student', [SignupStudentController::class, 'showSignupForm'])->name('signup.student');



// Route::post('/teacher/signup', [TeacherController::class, 'signup'])->name('signup.teacher');
