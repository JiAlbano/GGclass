@extends('components.class-dashboard')

@section('landing')
    <link rel="stylesheet" href="{{ secure_asset('class-dashboard/tutorial.css') }}">
    <link rel="stylesheet" href="{{ asset('class-dashboard/tutorial.css') }}">


    <div class="right-container">

        <a href="{{ route('create-tutorials', $class->id) }}" class="create-tutorial">
            <img src="{{ asset('img/lesson.png') }}" alt="lesson-img" class="lesson-img">
            <p class="tut-text"> Create a tutorial to your class</p>
        </a>

        <div class="created-tutorial">
            <img src="{{ asset('img/lesson.png') }}" alt="lesson-img" class="lesson-img">
            <p class="tut-text"> You posted a tutorial to your class: <span><b>
                        Tutorial Title
                    </b>
                </span></p>

            <img src="{{ asset('img/hamburger.png') }}" alt="lesson-img" class="hamburger-img">
        </div>

    </div>
@endsection
