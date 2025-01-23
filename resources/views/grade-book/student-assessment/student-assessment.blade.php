@extends('components.layout2')


@section('landing')
{{-- Custom CSS --}}
<link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-list.css') }}">
<link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-dashboard.css') }}">
<link rel="stylesheet" href="{{ secure_asset('css/components/main2.css') }}">
<link rel="stylesheet" href="{{ asset('css/class-dashboard/class-list.css') }}">
<link rel="stylesheet" href="{{ asset('css/class-dashboard/class-dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/components/main2.css') }}">

<link rel="stylesheet" href="{{ secure_asset('grade-book/student-assessment/left-corner.css') }}">
<link rel="stylesheet" href="{{ secure_asset('grade-book/student-assessment/table.css') }}">
<link rel="stylesheet" href="{{asset('grade-book/student-assessment/student-assessment.css')}}">
<style>
    .nav-design {
        height: 65px;
        background: #283891;
    }
    
    .navbar-brand.logo-text {
        color: white;
        display: flex;
        align-items: center;
        font-family: "Georgia";
        font-weight: bold;
        font-size: 30px;
    }
    
    .navbar-brand.user-text {
        color: white;
        display: flex;
        align-items: center;
        position: relative;
        right: 20px;
    }
    
    .in-game-name {
        position: relative;
        top: 20px;
        font-family: "Georgia";
        font-weight: bold;
        font-size: 18px;
    }
    .navbar-brand.user-text:hover {
        color: white;
        cursor: default;
    }
    
    .user-type {
        position: relative;
        top: 2px;
        font-family: "Georgia";
        font-weight: normal;
        font-size: 15px;
    }
    
    .navbar-brand.logo-text:hover {
        color: #ffd700;
    }
    
    .logo-img {
        height: 60px;
        margin-right: 10px;
    }
    
    .user-img {
        height: 45px;
        width: 45px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 12px;
    }
    
    .create-button {
        height: 30px;
        width: 30px;
        object-fit: cover;
        margin-right: 12px;
    }
    
    .header a {
        font-family: "Georgia";
        color: #2e3667;
        font-size: 25px;
        font-weight: bold;
        margin-right: 160px;
        text-decoration: none;
        position: relative;
        left: 130px;
    }
    
    .header a:hover {
        color: #ffd700;
    }
    
    .header {
        position: relative;
        left: 120px;
        top: 5px;
    }
    
    .custom-line {
        height: 2px;
        background-color: #283891;
        position: relative;
        left: 330px;
        top: 13px;
    }
    
    .first-line {
        position: relative;
        left: 320px;
        top: 10px;
    }
    
    .text {
        font-family: "Georgia";
        font-size: 25px;
        color: #2e3667;
        font-weight: bold;
        position: relative;
        top: -5px;
    }
    
    .export {
        background-color: #283891;
        color: white;
        height: 45px;
        width: 120px;
        border-radius: 10px;
        border-color: #ffd700;
        font-family: "Roboto", serif;
        font-size: 18px;
        font-weight: 500;
        font-style: normal;
        text-align: center;
        position: relative;
        left: -10px;
        top: -10px;
    }
    
    .export:hover {
        transform: scale(1.03);
        transition: transform 0.2s ease;
        background-color: #4a90e2;
        cursor: pointer;
    }
    
    .custom-line-2 {
        height: 2px;
        background-color: #283891;
        position: relative;
        left: 330px;
        top: 10px;
    }
    
    body::-webkit-scrollbar {
        display: none;
    }
    
    .main-body {
        background-color: #f5f5f5;
        padding-bottom: 30px;
    }
    </style>
<header>
    <div class="header container-md text-center mt-2">
        <a href="#">Bulletin</a>
        <a href="#">Tutorials</a>
        <a href="#">Challenges</a>
        <a href="#">Players</a>
    </div>
</header>

<div class="custom-line container-sm container-md container-lg"></div>

<header>
    <div class="container first-line">
        <div class="row justify-content-between">
            <div class="col-md-4 mt-4">
                <h1 class="text">{{ $assessment->assessment_name }}</h1>
            </div>
            <div class="col-md-4 mt-4">
                <button type="button" class="export">Export</button>
            </div>
        </div>
    </div>
</header>

<div class="custom-line-2 container-sm container-md container-lg"></div>



<main>
  <div class="left-right container-fluid mt-5">
      <div class="left-container">
          <div class="mt-2">
              <img class="profile-img " src="{{ asset('img/ainz.jpg') }}" alt="Profile">
              <h3 class="in-game-name mt-5">{{ $student_data->in_game_name }}</h3>
              <p class="course ">{{ $student_data->course }}</p>

              <div class="custome-line-3"></div>

              <p class="student-name fw-bold mt-3">{{ $student_data->full_name }}</p>
              <p class="school-id">Grading System: {{ $assessment->grading_system }}</p>
              <p class="email">{{ $student_data->email }}</p>
              <div class="custome-line-3"></div>

              <div class="buttons">
              
                <div class="first-button">
                    <a href="" class="btns">Attendance</a>
                </div>

                <div class="second-button">
                    <a href="" class="btns">Feedback</a>
                </div>

                <div class="third-button">
                    <a href="" class="btns">Grade</a>
               </div>

              </div>
          </div>
      </div>
      
      <div class="container right-container">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($assessment_types as $type)
                    <div class="col-6 assessment">
                        <!-- Display the assessment type name, e.g., Quiz 1, Quiz 2 -->
                        <p class="h3 title">{{ $type->assessment_type_name }}</p>
                        
                        <!-- Display the student's score for this assessment type -->
                        <p class="h5 score">
                            Score: 
                            @if(isset($scores[$type->assessment_type_id]))
                                {{ $scores[$type->assessment_type_id]->score }}
                            @else
                                No Grade
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    

  </div>
</main>



@endsection