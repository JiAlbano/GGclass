@extends('components.create-dashboard')

@section('landing')
    <link rel="stylesheet" href="{{ secure_asset('css/tutorial/display-tutorial.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutorial/display-tutorial.css') }}">

    <div class="tutorial-content container">
        <div class="first-content">
            <h5>Tutorial Title</h5>
            <div class="title-content">
                <p class="text-content">Testing</p>
            </div>
        </div>

        <div class="second-content">
            <h5>Tutorial Description</h5>
            <div class="description-content">
                <div class="desription-text">
                    <p class="text-content">Hello testing testing, Hello testing testing , Hello testing testing , Hello
                        testing testing, Hello
                        testing testing , Hello testing testing ,Hello testing testing ,Hello testing testing</p>
                </div>
                <div class="upload-del">
                    <img src="{{ asset('img/hamburger.png') }}" alt="hamburger-img" class="hamburger-img">
                </div>
            </div>
        </div>

        <div class="tutorial-upload">
            <div class="tutorial-upload">
                {{-- Uploaded File --}}
                <div class="upload-file-text">
                    <img src="{{ asset('img/ainz.jpg') }}" alt="upload-img" class="uploaded-img">
                    <p class="file-name-upload">ainz.jpg</p>
                </div>
                {{-- Delete File --}}
                <div class="upload-delete">
                    <img src="{{ asset('img/hamburger.png') }}" alt="hamburger-img" class="hamburgers-img">
                </div>
            </div>
        </div>

    </div>
@endsection
