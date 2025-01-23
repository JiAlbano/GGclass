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
                    <h1 class="text">Assessment Scores</h1>
                </div>
                <div class="col-md-4 mt-4">
                    <a href="{{ route('student-list.export') }}">
                        <button type="button" class="export">Export</button>
                    </a>
                </div>
            </div>
        </div>

        <div class="custom-line-2 container-sm container-md container-lg"></div>
    </header>

    <main>
        <div class="left-right container mt-4">

            <div class="left-container">

                <div class ="class-theme">
                    <h6 class="school-year">In Game Name:{{ $student->ign }} </h6>
                    {{-- <h6 class="semester ">Course: {{ $student[0]->course_name }}</h6>
                   <h6 >Name: {{ $student[0]->first_name}} {{ $student[0]->last_name}}</h6>  --}}
               </div>

               <div class="">
                    {{-- <h6 class="mt-3 class">ID number:{{ $student[0]->id_number }} </h6>
                   <h6 class="mt-3 schedule">Email: {{ $student[0]->email }}</h6>
                   <h6 class="mt-3 room">Grading System:{{ $student[0]->grading_system }} </h6> --}}
               </div>

                <div class="line-between"></div>

                <div class="first-button">
                    <a href="" class="btns">Attendance</a>
                </div>

                <div class="second-button">
                    <a href="" class="btns">Feedback</a>
                </div>

            </div>

            <div class="right-container">
                <table class="styled-table">
                    <thead>
                        <tr class="table-head">
                            <th>
                                <p class="challenge">Examination</p>
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
                        {{-- @if (isset($assessmentTypes) && !empty($assessmentTypes))
                            @foreach ($assessmentTypes as $assessmentType) --}}
                                <tr class="table-row">
                                    <td>
                                        {{-- <p class="challenge">{{ $assessmentType->assessment_type_name }}</p> --}}
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
                            {{-- @endforeach
                        @endif --}}

                        <!-- Handle Exams -->
                        {{-- @if (isset($examTypes) && !empty($examTypes))
                            @foreach ($examTypes as $examType) --}}
                                <tr class="table-row">
                                    <td>
                                        {{-- <p class="challenge">{{ $examType->exams_type_name }}</p> --}}
                                    </td>
                                    <td>
                                        {{-- <p class="total-points">{{ $examType->total_scores }}</p> --}}
                                    </td>
                                    <td>
                                        <p class="individual-points">
                                            {{-- {{ $examScores->firstWhere('exams_type_id', $examType->exams_type_id)->score ?? 'No Score' }} --}}
                                        </p>
                                    </td>
                                </tr>
                            {{-- @endforeach
                        @endif --}}
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
