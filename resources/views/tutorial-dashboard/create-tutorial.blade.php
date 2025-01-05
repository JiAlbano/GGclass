@extends('components.create-dashboard')

@section('landing')
    <link rel="stylesheet" href="{{ secure_asset('css/tutorial/create-tutorial.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutorial/create-tutorial.css') }}">

    <div class="tutorial-container container-sm mt-1 mb-5">

        <div class="tutorial-body">

            <div class="tutorial-content">
                {{-- Input --}}
                <form>
                    <label for="tut-title"> <span class="title-text">Tutorial Title:</span></label><br>
                    <input type="text" id="tut-title" name="name-title" class="input-field-title"
                        placeholder="Input Tutorial Title"><br>

                    <label for="tut-description"> <span class="title-text">Tutorial Description:</span></label><br>
                    <textarea id="tut-description" name="name-description" class="input-field-description"
                        placeholder="Input Tutorial Description"></textarea><br>
                </form>


                <div class="tutorial-upload">
                    {{-- Uploaded File --}}
                    <div class="upload-file-text">
                        <img src="{{ asset('img/ainz.jpg') }}" alt="upload-img" class="uploaded-img">
                        <p class="file-name-upload">ainz.jpg</p>
                    </div>
                    {{-- Delete File --}}
                    <div class="upload-delete">
                        <img src="{{ asset('img/hamburger.png') }}" alt="hamburger-img" class="hamburger-img">
                    </div>
                </div>

                <div class="tutorial-buttons">
                    {{-- Upload Link --}}
                    <div class="upload-link">

                        <div class="upload-links">
                            <img src="{{ asset('img/upload.png') }}" alt="upload-img" class="upload-img">
                            <div class="upload-text">
                                <p class="text-upload">Upload a file</p>
                                <p class="text-opacity"> Pdf, docs, images</p>
                            </div>
                        </div>

                        <div class="link-links">
                            <img src="{{ asset('img/link.png') }}" alt="link-img" class="link-img">
                            <div class="link-text">
                                <p class="text-link">Upload a link</p>
                            </div>
                        </div>

                    </div>
                    {{-- Cancel Create Buttons --}}
                    <div class="cancel-create">
                        <button type="button" class="cancel-button">Cancel</button>
                        <button type="button" class="create-button">Create</button>
                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
