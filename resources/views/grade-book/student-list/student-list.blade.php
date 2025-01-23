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
            </style>
            
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
                    <h1 class="text">Student Assessment</h1>
                </div>

                <div class="col-md-4 mt-4">
                    <a href="{{ route('student-list.export') }}"> <button type="button" class="export">Export</button> </a>
                </div>


            </div>
        </div>
    </header>

    <div class="custom-line-2 container-sm container-md container-lg"></div>


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

                <div class="line-between"></div>

                <div class="first-button">
                    <a href="" class="btns">Attendance</a>
                </div>

                <div class="second-button">
                    <a href="" class="btns">Feedback</a>
                </div>

                <div class="third-button">
                    <a href="" class="btns">Gradebook</a>
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
