@extends('components.layout2')

@section('landing')
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-list.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-dashboard.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/components/main2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/main2.css') }}">
    <link rel="stylesheet" href="{{ asset('grade-book/student-list/left-corner.css') }}">
    <link rel="stylesheet" href="{{ asset('grade-book/student-list/right-corner.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('grade-book/student-list/left-corner.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('grade-book/student-list/rightcorner.css') }}">
    <header>
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

            .row .btn {
                padding: 6px;
                border: none;
                border-radius: 10px;
                color: #283891;
                cursor: pointer;
                width: 100px;
                font-family: "Georgia";
                font-size: 20px;
                font-weight: bold;
                margin-top: 10px; 
                border:none; 
                width: 100px;
            }

            .challenge-btn.active {
                background-color: #2e3667;
                color: #ffffff;
            /*    transition: all 0.3s ease;*/
                font-size: 16px;
/*                font-family: "Georgia";*/
                font-weight: bold;
                border: none;
                width: 80%;
                transition: none;
            }

            .btn:hover {
                font-weight: bold;
                background-color: #283891;
                color: #ffffff;
                width: 80%;
                transition: none;
            }

            .container{
                margin-top: -10px;
            }

            .text{
                font-size: 22px;
                margin-left: 25px;
                margin-top: 8px;
            }

            .styled-table{
                margin-top: -60px;
                margin-left: -30px;
            }

            .left-container{
                width: 420px;
                height: 440px;
                border: 2px solid #050834;
                border-radius: 10px;
                overflow: hidden;
                background-color: #ffffff;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                font-family: Arial, sans-serif;
                margin: 20px auto;
                position: relative;
                margin-right: 50px;
                margin-top: -93px;
                margin-left: 22px;
            }

            .class-buttons {
                display: flex;
                flex-direction: column;
                gap: 10px;
                padding: 10px;
                align-items: center;
            }

            .class-buttons button {
                background-color: #283891;
                color: white;
                border: none;
                border-radius: 5px;
                width: 80%;
                padding: 10px 0;
                cursor: pointer;
                font-size: 14px;
                font-weight: bold;
                text-transform: uppercase;
                transition: background-color 0.3s ease;
            }

            .class-buttons button:hover {
                background-color: #1f3a8b;
                color: gold;
            }

            /* Optional: Add responsive behavior */
            @media (max-width: 400px) {
                .class-card {
                    width: 90%;
                }

                .class-buttons button {
                    width: 100%;
                }
            }

            header .export {
                margin-top: -40px; /* Adjust the value to move the button upward */
            }
            </style>
            
    <div class="top-buttons containers" style="margin-left: 240px; margin-right: 240px;">
        <div class="row justify-content-center"> <!-- Added justify-content-center class -->
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center"> <!-- Center buttons within the column -->
                <button class="btn" onclick="window.location.href='{{ route('bulletins', ['classId' => $class->id]) }}'">Bulletins</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" onclick="window.location.href='{{ route('tutorials', ['classId' => $class->id])}}'">Tutorials</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" onclick="window.location.href='{{ route('challenges', ['classId' => $class->id]) }}'">Challenges</button>
            </div>
            <div class="col-12 col-md-3 mb-2 d-flex justify-content-center">
                <button class="btn" onclick="window.location.href='{{ route('players', ['classId' => $class->id]) }}'">Players</button>
            </div>
        </div>
    </div>

    </header>

    

    <header>
        <div class="container first-line">
            <div class="row justify-content-between">
                <div class="col-md-4 mt-4">
                    <h1 class="text">Student Assessment</h1>
                </div>

                <div class=" col-md-4 mt-4">
                    <a href="{{ route('student-list.export',['classId' => $class->id]) }}"> <button type="button" class="export">Export</button> </a>
                </div>
            </div>
        </div>
    </header>

    <!-- <div class="custom-line-2 container-sm container-md container-lg"></div> -->


    <main>
        <div class="left-right container mt-4">

            <div class="left-container">

                <div class ="class-theme">
                    <h6 class="mt-3 school-year">School Year: 2024-2025</h6>
                        <h6 class="mt-3 semester">Semester: 1st</h6>
                        <h6 class="mt-3 section">Section: {{ $class->section }}</h6>
                </div>

                <div class="mt-3">
                    <h6 class="class">{{ $class->name }}</h6>
                    <h6 class="schedule">{{ $class->schedule }}</h6>
                    <h6 class="room">{{ $class->room }}</h6>
                </div>

                <div class="class-buttons">
                    <button onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">Attendance</button>
                    <!-- <button onclick="window.location.href='{{ route('feedback', ['classId' => $class->id]) }}'">Feedback</button> -->
                    <button class="btn challenge-btn active"
                    onclick="window.location.href='{{ route('students-list', ['classId' => $class->id]) }}'">Gradebook</button>
                </div>

            </div>

            <div class="right-container">
                <table class="styled-table">
                    <thead>
                        <tr class="table-head">
                            <th>ID Number</th>
                            <th>Name</th>
                            <th>Course</th>
                            <th>Grading System</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classUsers as $classUser)
                            <tr class="table-row"
                                onclick="location.href='{{ route('student-details',  ['classId' => $class->id,'id_number' => $classUser->id_number]) }}'">
                                <td>{{ $classUser->id_number }}</td>
                                <td>{{ $classUser->first_name }} {{ $classUser->last_name }}</td>
                                <td>{{ $classUser->course_id }}</td>
                                <td>{{ $classUser->grading_system }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        </div>
    </main>

        
@endsection
