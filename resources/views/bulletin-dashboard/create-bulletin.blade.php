@extends('components.create-dashboard')

@section('landing')
    <!-- Include CSS files for styling -->
    <link rel="stylesheet" href="{{ secure_asset('css/tutorial/create-tutorial.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tutorial/create-tutorial.css') }}">

    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>


    <div class="tutorial-container container-sm mt-1 mb-5">

        <a href="{{ route('bulletins', ['classId' => $class->id]) }}">
            <button class="bg-white text-center w-48 rounded-2xl h-14 relative text-black text-xl font-semibold group"
                type="button">
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

        <div class="tutorial-body">
            <div class="tutorial-content">
                {{-- Input form for creating a tutorial --}}
                <form id="tutorial-form" action="{{ route('store-bulletins', $class->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <!-- Tutorial Title Input -->
                    <label for="tut-title"> <span class="title-text">Bulletin Title:</span></label><br>
                    <input type="text" id="tut-title" name="title" class="input-field-title"
                        placeholder="Hello world, Welcome to Programming" required><br>

                    <!-- Tutorial Description Input -->
                    <label for="tut-description"> <span class="title-text">Bulletin Description:</span></label><br>
                    <textarea id="tut-description" name="description" class="input-field-description"
                        placeholder="Hello World is waving at you"></textarea><br>

                    <!-- Container for uploaded files -->
                    <div class="tutorial-upload-container">
                        <!-- Files will be appended here by JavaScript -->
                    </div>

                    <!-- Container for uploaded links -->
                    <div class="tutorial-link-container">
                        <!-- Links will be appended here by JavaScript -->
                    </div>

                    <!-- Buttons for uploading files and links -->
                    <div class="tutorial-buttons">
                        <div class="upload-file">
                            <div class="upload-links">
                                <img src="{{ asset('img/upload.png') }}" alt="upload-img" class="upload-img"
                                    data-bs-toggle="modal" data-bs-target="#addFile" data-bs-target="#staticBackdrop">
                                <div class="upload-text">
                                    <p class="text-upload">Upload a file</p>
                                    <p class="text-opacity"> Pdf, docs, images</p>
                                </div>
                            </div>

                            <!-- Modal for uploading files -->
                            <div class="modal fade" id="addFile" data-bs-backdrop="static" tabindex="-1"
                                aria-labelledby="file" aria-hidden="true">
                                <div class="modal-dialog modal-layout">
                                    <div class="modal-content" style="border: 2px solid #283891">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="file">Add File</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="formFileMultiple" class="form-label">Browse</label>
                                                <input class="form-control" type="file" id="formFileMultiple"
                                                    name="files[]" multiple>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="button" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="button" id="add-file-btn"
                                                data-bs-dismiss="modal">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="link-links">
                                <img src="{{ asset('img/link.png') }}" alt="link-img" class="link-img"
                                    data-bs-toggle="modal" data-bs-target="#addLink" data-bs-target="#staticBackdrop">
                                <div class="link-text">
                                    <p class="text-link">Upload a link</p>
                                </div>
                            </div>

                            <!-- Modal for uploading links -->
                            <div class="modal fade" id="addLink" data-bs-backdrop="static" tabindex="-1"
                                aria-labelledby="link" aria-hidden="true">
                                <div class="modal-dialog modal-layout">
                                    <div class="modal-content" style="border: 2px solid #283891">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="link">Add Link</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="enter-link" class="form-label">Enter a link</label>
                                                <input type="url" class="form-control" id="enter-link"
                                                    placeholder="http://example.com" style="height: 50px; width:465px">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="button" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="button" id="add-link-btn"
                                                data-bs-dismiss="modal">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cancel and Create buttons -->
                    <div class="cancel-create">
                        <a href="{{ route('bulletins', $class->id) }}" class="cancel-button btn btn-secondary">Cancel</a>
                        <button type="submit" class="create-button btn btn-primary">Create</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Loading screen -->
    <div id="loading-screen" class="section-center" style="display: none;">
        <div class="section-path">
            <div class="globe">
                <div class="wrapper">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for handling file uploads and previews -->
    <script>
        // Array to store all files and links
        let allFiles = [];
        let allLinks = [];

        // Event listener for the "Add" button in the file upload modal
        document.getElementById('add-file-btn').addEventListener('click', function() {
            // Get the selected files from the input
            const files = document.getElementById('formFileMultiple').files;
            // Get the container where the files will be displayed
            const container = document.querySelector('.tutorial-upload-container');

            // Loop through each selected file
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileType = file.type.split('/')[1];
                const fileName = file.name;

                // Add the file to the allFiles array
                allFiles.push(file);

                // Create a div for each uploaded file
                const fileDiv = document.createElement('div');
                fileDiv.classList.add('tutorial-upload');

                // Create a div for file text
                const fileTextDiv = document.createElement('div');
                fileTextDiv.classList.add('upload-file-text');

                // Create an image element for the uploaded file
                const img = document.createElement('img');
                if (fileType === 'pdf') {
                    img.src = '{{ asset('img/pdficon.png') }}';
                } else if (fileType === 'msword' || fileType ===
                    'vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    img.src = '{{ asset('img/docsicon.png') }}';
                } else if (fileType === 'vnd.ms-powerpoint' || fileType ===
                    'vnd.openxmlformats-officedocument.presentationml.presentation') {
                    img.src = '{{ asset('img/ppticon.png') }}';
                } else {
                    img.src = URL.createObjectURL(file);
                }
                img.classList.add('uploaded-img');
                img.addEventListener('click', function() {
                    if (fileType === 'pdf' || fileType === 'msword' || fileType ===
                        'vnd.openxmlformats-officedocument.wordprocessingml.document' || fileType ===
                        'vnd.ms-powerpoint' || fileType ===
                        'vnd.openxmlformats-officedocument.presentationml.presentation') {
                        // Create a link element for download
                        const link = document.createElement('a');
                        link.href = URL.createObjectURL(file);
                        link.download = fileName;
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    } else {
                        // Open the image in a new tab for preview
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
                                    <img src="${img.src}" class="file-preview">
                                </body>
                            </html>
                        `);
                    }
                });

                // Create a paragraph element for the file name
                const fileNameP = document.createElement('p');
                fileNameP.classList.add('file-name-upload');
                fileNameP.textContent = fileName;

                // Create a paragraph element for the file type
                const fileTypeP = document.createElement('p');
                fileTypeP.classList.add('file-name-type');
                fileTypeP.textContent = (fileType ===
                    'vnd.openxmlformats-officedocument.wordprocessingml.document') ? 'Docs' : fileType;

                // Append the image, file name, and file type to the file text div
                fileTextDiv.appendChild(img);
                fileTextDiv.appendChild(fileNameP);
                fileTextDiv.appendChild(fileTypeP);

                // Create a div for the delete button
                const deleteDiv = document.createElement('div');
                deleteDiv.classList.add('upload-delete');

                // Create an image element for the delete button
                const deleteImg = document.createElement('img');
                deleteImg.src = '{{ asset('img/hamburger.png') }}';
                deleteImg.classList.add('hamburger-img');
                deleteImg.addEventListener('click', function() {
                    // Remove the file div when the delete button is clicked
                    fileDiv.remove();
                    // Remove the file from the allFiles array
                    allFiles = allFiles.filter(f => f !== file);
                });

                // Append the delete button to the delete div
                deleteDiv.appendChild(deleteImg);

                // Append the file text div and delete div to the file div
                fileDiv.appendChild(fileTextDiv);
                fileDiv.appendChild(deleteDiv);

                // Append the file div to the container
                container.appendChild(fileDiv);
            }
        });

        // Event listener for the "Add" button in the link upload modal
        document.getElementById('add-link-btn').addEventListener('click', function() {
            // Get the inputted link
            const linkInput = document.getElementById('enter-link').value;
            if (linkInput) {
                // Add the link to the allLinks array
                allLinks.push(linkInput);

                // Create a div for each uploaded link
                const linkDiv = document.createElement('div');
                linkDiv.classList.add('tutorial-link');

                // Create a div for link text
                const linkTextDiv = document.createElement('div');
                linkTextDiv.classList.add('upload-link-text');

                // Create an image element for the uploaded link
                const img = document.createElement('img');
                img.src = '{{ asset('img/urlicon.png') }}'; // Thumbnail for the link
                img.alt = 'upload-img';
                img.classList.add('uploaded-link');
                img.addEventListener('click', function() {
                    window.open(linkInput, '_blank');
                });

                // Create a paragraph element for the link URL
                const linkUrlP = document.createElement('p');
                linkUrlP.classList.add('link-url');
                linkUrlP.textContent = linkInput;

                // Append the image and link URL to the link text div
                linkTextDiv.appendChild(img);
                linkTextDiv.appendChild(linkUrlP);

                // Create a div for the delete button
                const deleteDiv = document.createElement('div');
                deleteDiv.classList.add('upload-delete');

                // Create an image element for the delete button
                const deleteImg = document.createElement('img');
                deleteImg.src = '{{ asset('img/hamburger.png') }}';
                deleteImg.classList.add('hamburger-img');
                deleteImg.addEventListener('click', function() {
                    // Remove the link div when the delete button is clicked
                    linkDiv.remove();
                    // Remove the link from the allLinks array
                    allLinks = allLinks.filter(l => l !== linkInput);
                });

                // Append the delete button to the delete div
                deleteDiv.appendChild(deleteImg);

                // Append the link text div and delete div to the link div
                linkDiv.appendChild(linkTextDiv);
                linkDiv.appendChild(deleteDiv);

                // Append the link div to the container below the textarea
                document.getElementById('tut-description').insertAdjacentElement('afterend', linkDiv);
            }
        });

        // Event listener for the modal close event to clear its content
        document.getElementById('addFile').addEventListener('hidden.bs.modal', function() {
            document.getElementById('formFileMultiple').value = '';
        });

        document.getElementById('addLink').addEventListener('hidden.bs.modal', function() {
            document.getElementById('enter-link').value = '';
        });

        // Event listener for the form submission
        document.getElementById('tutorial-form').addEventListener('submit', function(event) {
            // Show the loading screen
            document.getElementById('loading-screen').style.display = 'flex';

            // Create a new FormData object
            const formData = new FormData(this);
            // Append all files to the form data
            allFiles.forEach(file => {
                formData.append('files[]', file);
            });
            // Append all links to the form data
            allLinks.forEach(link => {
                formData.append('links[]', link);
            });

            // Submit the form with all files and links
            fetch(this.action, {
                method: this.method,
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(response => {
                if (response.ok) {
                    window.location.href = '{{ route('bulletins', $class->id) }}';
                } else {
                    alert('Failed to create tutorial');
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Failed to create tutorial');
            }).finally(() => {
                // Hide the loading screen
                document.getElementById('loading-screen').style.display = 'none';
            });

            // Prevent the default form submission
            event.preventDefault();
        });
    </script>
@endsection
