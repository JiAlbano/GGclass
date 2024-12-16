@extends('components.layout')

@section('landing')
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-list.css') }}">

    <main>
        <div class="container">
            <div class="class-list-wrapper">
                @foreach ($classes as $class)
                    <div class="class-list">
                        <div class="class-theme">
                            <p class="school-year">School Year: {{ $class->school_year }}</p>
                            <p class="semester">Semester: {{ $class->semester }}</p>
                            <p class="section">Section: {{ $class->section }}</p>
                            <img src="{{ asset('img/ainz.jpg') }}" alt="Logo" class="user-picture">
                        </div>
                        <div class="class-info">
                            <p class="subject">{{ $class->subject }}</p>
                            <p class="schedule">{{ $class->schedule_day }}
                                {{ date('h:i A', strtotime($class->start_time)) }} -
                                {{ date('h:i A', strtotime($class->end_time)) }}</p>
                            <p class="room">{{ $class->room }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
@endsection
