@extends('components.teacher-dashboard')

@section('landing')
    <link rel="stylesheet" href="{{ secure_asset('class-dashboard/tutorial.css') }}">
    <link rel="stylesheet" href="{{ asset('class-dashboard/tutorial.css') }}">



    <div class=" container right-container">

        <div class="create">
            <a href="{{ route('create-bulletins', $class->id) }}" class="create-tutorial">
                <img src="{{ asset('img/lesson.png') }}" alt="lesson-img" class="lesson-img">
                <p class="tut-text"> Create a Bulletin to your class</p>
            </a>

        </div>

        @foreach ($tutorials as $tutorial)
            <div class="created-tutorial"
                onclick="window.location.href='{{ route('display-bulletins', ['classId' => $class->id, 'tutorialId' => $tutorial->id]) }}'">
                <img src="{{ asset('img/lesson.png') }}" alt="lesson-img" class="lesson-img">
                <p class="tut-text"> Bulletin Title: <span class="tutt-title"><b>{{ $tutorial->title }}</b></span></p>

                <img src="{{ asset('img/hamburger.png') }}" alt="lesson-img" class="hamburger-img" data-bs-toggle="dropdown"
                    aria-expanded="false" onclick="event.stopPropagation();">

                <ul class="dropdown-menu">
                    <li>
                        <form
                            action="{{ route('delete-bulletin', ['classId' => $class->id, 'bulletinId' => $tutorial->id]) }}"
                            method="POST" onsubmit="return confirm('Are you sure you want to delete this bulletin?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="dropdown-item delete">Delete</button>
                        </form>
                    </li>
                </ul>
            </div>
        @endforeach


    </div>
@endsection
