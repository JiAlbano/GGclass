<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GGclass</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdownmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal-create.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class-card.css') }}">
        <!-- JS -->
        <script>
            
            document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.class-card').forEach(function (card) {
        card.addEventListener('click', function (event) {
            // Only handle redirection if the dropdown menu is not open or a modal button is not clicked
            const isDropdownOrModal = event.target.closest('.dropdown') || event.target.closest('.modal');
            
            if (!isDropdownOrModal && !document.querySelector('.dropdown-menu.show')) {
                window.location.href = this.getAttribute('data-href');
            }
        });
    });

    // Enable dropdown functionality
    document.querySelectorAll('[data-bs-toggle="dropdown"]').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.stopPropagation(); // Prevents the click from bubbling up and triggering other handlers
            const target = document.querySelector(this.getAttribute('data-bs-target'));
            if (target) {
                target.classList.toggle('show');
            }
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function (event) {
        if (!event.target.matches('[data-bs-toggle="dropdown"]')) {
            document.querySelectorAll('.dropdown-menu.show').forEach(function (menu) {
                menu.classList.remove('show');
            });
        }
    });
});

</script>
</head>

<body>
    
        <!-- Checking -->

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <!-- Checking -->
            
    <!---Header-->
    <header>
        <div class="header">
            <!---Left Section-->
            <div class="left-section">
                <img class="logo-img" src="{{ asset('img/logo.png') }}" alt="GGclass Logo">
                <h1 class="logo-font">GGclass</h1>
            </div>
            <!---End Left Section-->

            <!---Right Section-->
            <div class="right-section">
                <img class="create-class" src="{{ asset('img/plus.png') }}" alt="Create" id="create-class-btn" data-bs-toggle="dropdown" aria-expanded="false">

                <!-- Dropdown Menu -->
                <div class="dropdown-container">
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li class="dropdown-item-container">
                      
                            <a class="dropdown-item" href="#" id="create-class-option">Create Class</a>
                 
                        </li>
                        <li class="dropdown-item-container">
                            <a class="dropdown-item" href="#" id="join-class-option">Join Class</a>
                        </li>
                    </ul>
                </div>

                <!-- Modal for Create Class -->
                   <!-- Teacher can create and join classes -->
               
                <div class="modal fade" id="createClassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createClassModalLabel">Create Class</h5>
                                <button type="button" class="btn-close" style="background-color: rgb(246, 246, 246)" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="createClassForm" action="{{ route('create.class') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="modal-form-sections">
                                        <!-- Section 1: Class Name, Section, and Image Upload -->
                                        <div id="section-1">
                                            <div class="form-section">
                                                <div class="mb-3">
                                                    <label for="className" class="form-label">Class Name</label>
                                                    <input type="text" class="form-control" id="className" name="class_name" placeholder="Class Name"  aria-required="true">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="section" class="form-label">Section</label>
                                                    <input type="text" class="form-control" id="section" name="section" placeholder="Section" aria-required="true">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="image" class="form-label">Class Image</label>
                                                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary" id="next-to-2">Next</button>
                                            <div id="error-message-1" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                                        </div>
                                        <!-- Section 2: Subject and Room -->
                                        <div id="section-2" style="display: none;">
                                            <div class="form-section">
                                                <div class="mb-3">
                                                    <label for="subject" class="form-label">Subject</label>
                                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" aria-required="true">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="room" class="form-label">Room</label>
                                                    <input type="text" class="form-control" id="room" name="room" placeholder="Room" aria-required="true">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" id="back-to-1">Back</button>
                                            <button type="button" class="btn btn-primary" id="next-to-3">Next</button>
                                            <div id="error-message-2" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                                        </div>
                                        <!-- Section 3: Schedule -->
                                        <div id="section-3" style="display: none;">
                                            <div class="mb-3">
                                                <label for="schedule" class="form-label">Schedule</label>
                                                <input type="text" class="form-control" id="schedule" name="schedule" placeholder="Schedule" aria-required="true">
                                            </div>
                                            <button type="button" class="btn btn-secondary" id="back-to-2">Back</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                            <div id="error-message-3" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
      

                <!-- Modal for Join Class -->
                <div class="modal fade" id="joinClassModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="joinClassModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="joinClassModalLabel">Join Class</h5>
                                <button type="button" class="btn-close" style="background-color: rgb(246, 246, 246)" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('join.class') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="classCode" class="form-label">Class Code</label>
                                        <input type="text" class="form-control" id="classCode" name="class_code" aria-required="true">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Join</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- User Profile-->
                <img class="profile-img" src="{{ asset('img/ainz.jpg') }}" alt="Profile">
            </div>
            <!---End of Right Section-->
        </div>
    </header>
        <!---End Header-->

        <!--ClassCard -->

<div class="container mt-5">
    <div class="row">
        @foreach($classes as $class)
            <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="class-card" data-href="{{ route('bulletins', ['classId' => $class->id]) }}" style="cursor: pointer;">
                    <div class="class-card-image" style="background-image: url('{{ asset('storage/' . $class->image_path) }}');"></div>
                    <div class="class-card-info">
                        <div class="d-flex justify-content-center align-items-center position-relative">
                            <h3 class="class-name text-center">{{ $class->class_name }}</h3>
                            <div class="dropdown position-absolute" style="right: 0;">
                                <button class="btn btn-link p-0 m-0" type="button" id="dropdownMenuButton{{ $class->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('img/pencil.png') }}" alt="Edit" width="24" height="24">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $class->id }}">
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editClassModal{{ $class->id }}">Edit</a></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $class->id }}').submit();">Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Class Info -->
                        <p class="subject">{{ $class->subject }}</p>
                        <p class="section">{{ $class->section }}</p>
                        <p class="schedule">{{ $class->schedule }}</p>
                        <p class="room">{{ $class->room }}</p>
                    </div>
                </div>

                <!-- Modal for Editing Class Details -->
                <div class="modal fade" id="editClassModal{{ $class->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editClassModalLabel{{ $class->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editClassModalLabel{{ $class->id }}">Edit Class</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Multi-step Form for Editing Class Details -->
                                <form id="editClassForm{{ $class->id }}" action="{{ route('classes.update', $class->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-form-sections">
                                        <!-- Section 1: Class Name, Section, and Image Upload -->
                                        <div id="edit-section-1-{{ $class->id }}">
                                            <div class="form-section">
                                                <div class="mb-3">
                                                    <label for="editClassName{{ $class->id }}" class="form-label">Class Name</label>
                                                    <input type="text" class="form-control" id="editClassName{{ $class->id }}" name="class_name" value="{{ $class->class_name }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editSection{{ $class->id }}" class="form-label">Section</label>
                                                    <input type="text" class="form-control" id="editSection{{ $class->id }}" name="section" value="{{ $class->section }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editImage{{ $class->id }}" class="form-label">Class Image</label>
                                                    <input type="file" class="form-control" id="editImage{{ $class->id }}" name="image" accept="image/*">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary" id="edit-next-to-2-{{ $class->id }}">Next</button>
                                            <div id="edit-error-message-1-{{ $class->id }}" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                                        </div>
                                        <!-- Section 2: Subject and Room -->
                                        <div id="edit-section-2-{{ $class->id }}" style="display: none;">
                                            <div class="form-section">
                                                <div class="mb-3">
                                                    <label for="editSubject{{ $class->id }}" class="form-label">Subject</label>
                                                    <input type="text" class="form-control" id="editSubject{{ $class->id }}" name="subject" value="{{ $class->subject }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editRoom{{ $class->id }}" class="form-label">Room</label>
                                                    <input type="text" class="form-control" id="editRoom{{ $class->id }}" name="room" value="{{ $class->room }}">
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-secondary" id="edit-back-to-1-{{ $class->id }}">Back</button>
                                            <button type="button" class="btn btn-primary" id="edit-next-to-3-{{ $class->id }}">Next</button>
                                            <div id="edit-error-message-2-{{ $class->id }}" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                                        </div>
                                        <!-- Section 3: Schedule -->
                                        <div id="edit-section-3-{{ $class->id }}" style="display: none;">
                                            <div class="mb-3">
                                                <label for="editSchedule{{ $class->id }}" class="form-label">Schedule</label>
                                                <input type="text" class="form-control" id="editSchedule{{ $class->id }}" name="schedule" value="{{ $class->schedule }}">
                                            </div>
                                            <button type="button" class="btn btn-secondary" id="edit-back-to-2-{{ $class->id }}">Back</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                            <div id="edit-error-message-3-{{ $class->id }}" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

                        <!-- Form for Deleting a Class -->
                        <form id="delete-form-{{ $class->id }}" action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        <!--End ClassCard -->

    <script>
        function deleteClass(classId) {
            if (confirm('Are you sure you want to delete this class?')) {
                document.getElementById('delete-form-' + classId).submit();
            }
        }
    </script>
    <!-- JavaScripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>

    <!----Custom JavaScripts -->
    <script src="{{ asset('js/modal-logic.js') }}" defer></script>
</body>


</html>