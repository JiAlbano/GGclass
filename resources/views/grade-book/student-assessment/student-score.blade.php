@extends('components.layout')

@section('landing')
    {{-- Custom CSS --}}

    <link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-list.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-dashboard.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/components/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/main.css') }}">
    <link rel="stylesheet" href="{{ asset('grade-book/student-data/left-corner.css') }}">
    <link rel="stylesheet" href="{{ asset('grade-book/student-data/table.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('grade-book/student-data/left-corner.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('grade-book/student-data/table.css') }}">

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


        .back-button button {
            background-color: transparent;
            color: #002171;
            border: none;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
            margin-left: 20px;
            margin-top: -40px;
        }

        .back-button button:hover {
            text-decoration: underline;
        }


        </style>

    <header>
<!--         <div class="header container-sm text-center mt-2">
            <a href="#">Bulletin</a>
            <a href="#">Tutorials</a>
            <a href="#">Challenges</a>
            <a href="#">Players</a>
        </div> -->


        <div class="container-sm first-line">
            <div class="row justify-content-between">
                <div class="col-md-4 mt-4">
                    <h1 class="text" style="margin-top: 45px; margin-left: 15px;">Assessment Scores</h1>
                </div>
                <div class="col-md-4 mt-4">
                    <a href="{{ route('student-list.export') }}">
                        <button type="button" class="export">Export</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- <div class="custom-line-2 container-sm container-md container-lg"></div> -->
    </header>
    <div class="back-button">
        <button onclick="window.history.back()">&#8592; Back</button>
    </div>
    <main>
        <div class="left-right container mt-4">

            <div class="left-container" style="margin-top: -75px; width: 400px; height: 440px; border: 2px solid #050834; margin-left: 20px;">

                <div class ="class-theme" style="padding: 15px;">
                    <h6>In Game Name:{{ $student[0]->ign }} </h6>
                    <h6>Course: {{ $student[0]->course_name }}</h6>
                   <h6 >Name: {{ $student[0]->first_name}} {{ $student[0]->last_name}}</h6> 
               </div>

               <div class="">
                    <h6 class="mt-3 class">ID number:{{ $student[0]->id_number }} </h6>
                   <h6 class="mt-3 schedule">Email: {{ $student[0]->email }}</h6>
                   <h6 class="mt-3 room">Grading System:{{ $student[0]->grading_system }} </h6>
               </div>

                <!-- <div class="line-between"></div> -->

                <div class="first-button">
                    <a href="" class="btns">Attendance</a>
                </div>

                <div class="second-button">
                    <a href="" class="btns">Feedback</a>
                </div>

            </div>

            <div class="right-container">
                <table class="styled-table" style="margin-top: -80px; margin-left: -10px;">
                    <thead>
                        <tr class="table-head">
                            <th>
                                <p class="challenge">Challenge Title</p>
                            </th>
                            <th>
                                <p class="total-points">Total Points</p>
                            </th>
                            <th>
                                <p class="individual-points">Points Obtained</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Handle Assessments -->
    
                            @foreach ($quizData as $quiz) 
                                <tr class="table-row">
                                    <td>
                                        <p class="challenge">{{ $quiz->title }}</p>
                                    </td>
                                    <td>
                                        {{-- <p class="total-points">{{ $assessmentType->total_scores }}</p> --}}
                                    </td>
                                    <td>
                                        <p class="individual-points">
                                            {{-- {{ $scores->firstWhere('assessment_type_id', $assessmentType->assessment_type_id)->score ?? 'No Score' }} --}}
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
      
                    </tbody>


                </table>
            </div>

        </div>
    </main>
@endsection

{{-- <div class="challenge-type">
                    <img src="{{ asset('img/icon.png') }}" alt="icon" class="icon">
                    <h4 class="assessment">Quiz</h4>
                    <h4 class="score">Score: 50</h4>
                </div>

                <div class="challenge-type">
                    <img src="{{ asset('img/icon.png') }}" alt="icon" class="icon">
                    <h4 class="assessment">Quiz</h4>
                    <h4 class="score">Score: 50</h4>
                </div>

                <div class="challenge-type">
                    <img src="{{ asset('img/icon.png') }}" alt="icon" class="icon">
                    <h4 class="assessment">Quiz</h4>
                    <h4 class="score">Score: 50</h4>
                </div> --}}
