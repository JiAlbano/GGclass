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
        top: 40px;
        margin-left: 15px;
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

    .left-container{
        margin-top: -77px;
        margin-left: 22px;
        width: 400px;
        height: 440px;
        border: 2px solid #050834;;
    }

    .back-button {
    margin-left: 20px;
    margin-bottom: 10px;
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
    }

    .back-button button:hover {
        text-decoration: underline;
    }

    /* Buttons */
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
        width: 80%;
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

    .challenge-btn.active {
        background-color: #2e3667; /* Active button color */
        color: white; /* Text color for active button */
        transition: all 0.3s ease;
    }

    .btn:hover {
        color: gold;
        font-weight: bold;
    }
    </style>

    <header>
        {{-- <div class="header container-sm text-center mt-2">
            <a href="#">Bulletin</a>
            <a href="#">Tutorials</a>
            <a href="#">Challenges</a>
            <a href="#">Players</a>
        </div> --}}


        <div class="container-sm first-line">
            <div class="row justify-content-between">
                <div class="col-md-4 mt-4">
                    <h1 class="text">Assessment Type</h1>
                </div>
                <div class="col-md-4 mt-4">
                    {{-- <a href="{{ route('student-list.export',['classId' => $class->id]) }}}">
                        <button type="button" class="export">Export</button>
                    </a> --}}
                </div>
            </div>
        </div>
    <div class="back-button">
        <button onclick="window.history.back()">&#8592; Back</button>
    </div>
        <!-- <div class="custom-line-2 container-sm container-md container-lg"></div> -->
    </header>

    <main>
        <div class="left-right container mt-4">

            <div class="left-container">

                <div class ="class-theme" style="padding: 15px;">
                    <h6>In Game Name: {{ $student[0]->ign }} </h6>
                    <h6>Course: {{ $student[0]->course_name }}</h6>
                    <h6 >Name: {{ $student[0]->first_name}} {{ $student[0]->last_name}}</h6> 
                </div>

                <div>
                    <h6 class="mt-3 class">ID number: {{ $student[0]->id_number }} </h6>
                    <h6 class="mt-3 schedule">Email: {{ $student[0]->email }}</h6>
                    <h6 class="mt-3 room">Grading System: {{ $student[0]->grading_system }} </h6>
                </div>

                <!-- <div class="line-between"></div> -->

                <div class="class-buttons">
                    <button onclick="window.location.href='{{ route('attendance', ['classId' => $class->id]) }}'">Attendance</button>
                    <button class="btn challenge-btn active"
                    onclick="window.location.href='{{ route('students-list', ['classId' => $class->id]) }}'">Gradebook</button>
                </div>

            </div>

            <div class="right-container">
                <table class="styled-table" style="margin-top: -80px;">
                    <thead>
                        <tr class="table-head">
                            <th>
                                <p class="challenge">Challenge type</p>
                            </th>
                            {{-- <th>
                                <p class="percentage">Challenge Percentage </p>
                            </th> --}}
                        </tr>
                    </thead>

                    <tbody>
                     @foreach ($challengetype as $type) 
                            <tr class="table-row"
              
                               onclick="window.location='{{ route('student-assessment-scores', ['student_id' => $student[0]->id_number, 'challengetype_id' => $type->id, 'challengetype' => $type->type])  }}'"> 
                                <td>
                                   <p class="challenge">{{ $type->title }}</p> 
                                </td>
                                {{-- <td>
                                    <p class="percentage">{{ $assessment->assessment_percentage }}%</p>
                                </td> --}}
                            </tr>
                       @endforeach
                    </tbody>


                </table>















                {{-- <div class="challenge-type">
                    <img src="{{ asset('img/icon.png') }}" alt="icon" class="icon">
                    <h4 class="assessment">Quiz</h4>
                </div>

                <div class="challenge-type">
                    <img src="{{ asset('img/icon.png') }}" alt="icon" class="icon">
                    <h4 class="assessment">Quiz</h4>
                </div>

                <div class="challenge-type">
                    <img src="{{ asset('img/icon.png') }}" alt="icon" class="icon">
                    <h4 class="assessment">Quiz</h4>
                </div> --}}
            </div>

        </div>
    </main>
@endsection
