@extends('components.create-dashboard')

@section('landing')
    <link rel="stylesheet" href="{{ secure_asset('css/tutorial/display-tutorial.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutorial/display-tutorial.css') }}">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>

    <div class="tutorial-content container">

        <a href="{{ route('tutorials-student', ['classId' => $class->id]) }}">
            <button class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
                type="button" style="position: relative; right:600px;">
                <div
                    class="bg-[#283891] rounded-xl h-12 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" height="25px" width="25px">
                        <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z" fill="#ffffff" />
                        <path
                            d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                            fill="#ffffff" />
                    </svg>
                </div>
                <p class="translate-x-2 text-black hover:text-white opacity-100">Go Back</p>
            </button>
        </a>
        <div class="first-content">
            <h5>Tutorial Title</h5>
            <div class="title-content">
                <p class="text-content">{{ $tutorial->title }}</p>
            </div>
        </div>

        <div class="second-content">
            <h5>Tutorial Description</h5>
            <div class="description-content">
                <div class="desription-text">
                    <p class="text-content">{{ $tutorial->description }}</p>
                </div>
            </div>
        </div>

        {{-- Display uploaded files --}}
        @foreach ($tutorial->files as $file)
            <div class="tutorial-upload">
                <div class="upload-file-text">
                    @php
                        $fileType = pathinfo($file->file_path, PATHINFO_EXTENSION);
                    @endphp
                    <img src="{{ $fileType == 'pdf' ? asset('img/pdficon.png') : ($fileType == 'doc' || $fileType == 'docx' ? asset('img/docsicon.png') : ($fileType == 'ppt' || $fileType == 'pptx' ? asset('img/ppticon.png') : asset('storage/' . $file->file_path))) }}"
                        alt="upload-img" class="uploaded-img"
                        onclick="handleFileClick('{{ asset('storage/' . $file->file_path) }}', '{{ $file->file_name }}', '{{ $fileType }}')">
                    <div class="textalign">
                        <p class="file-name-upload">{{ $file->filename }}</p>
                        <p class="file-name-type">{{ strtoupper($fileType) }}</p>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Display uploaded links --}}
        @foreach ($tutorial->links as $link)
            <div class="tutorial-link">
                <div class="upload-link-text">
                    <img src="{{ asset('img/urlicon.png') }}" alt="upload-img" class="uploaded-link"
                        onclick="window.open('{{ $link->url }}', '_blank')">
                    <div class="textalign">
                        <p class="link-url">{{ $link->url }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        function handleFileClick(fileUrl, fileName, fileType) {
            if (['pdf', 'doc', 'docx', 'ppt', 'pptx'].includes(fileType)) {
                const link = document.createElement('a');
                link.href = fileUrl;
                link.download = fileName;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                const newWindow = window.open();
                newWindow.document.write(`
                    <html>
                        <head>
                            <title>${fileName}</title>
                            <style>
                                body { display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
                                .file-name { position: absolute; top: 10px; left: 10px; font-size: 18px; }
                                .file-preview { max-width: 90%; max-height: 90%; }
                            </style>
                        </head>
                        <body>
                            <div class="file-name">${fileName}</div>
                            <img src="${fileUrl}" class="file-preview">
                        </body>
                    </html>
                `);
            }
        }
    </script>
@endsection
