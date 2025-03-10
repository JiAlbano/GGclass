@extends('components.layout')

@section('landing')
    <link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-list.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-dashboard.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/components/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/main.css') }}">


    <main>
        <div class="container">
            <div class="class-list-wrapper">
                @foreach ($classes as $class)
                    <a href="{{ auth()->user()->user_type === 'teacher' ? route('bulletins', ['classId' => $class->id]) : route('studentbulletins', ['classId' => $class->id]) }}"
                        class="class-list-link">
                        <div class="class-list">
                            <div class="class-theme">
                                <p class="school-year">School Year: {{ $class->school_year }}</p>
                                <p class="semester">Semester: {{ $class->semester }}</p>
                                <p class="section">Section: {{ $class->section }}</p>
                                <img src="{{ $class->teacher->google_profile_image ?? asset('ainz.jpg') }}" alt="Teacher's Profile" class="user-picture">
                            </div>
                            <div class="class-info">
                                <p class="subject">{{ $class->subject }}</p>
                                <p class="schedule">{{ $class->schedule_day }}
                                    {{ date('h:i A', strtotime($class->start_time)) }} -
                                    {{ date('h:i A', strtotime($class->end_time)) }}</p>
                                <p class="room">{{ $class->room }}</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="createClassModal" data-bs-backdrop="static" tabindex="-1"
            aria-labelledby="createClassModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    <h2 class="modal-title">Create Class</h2>
                    <form method="POST" action="{{ route('classes.store') }}">
                        @csrf <!-- Include CSRF token for security -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="school_year">School Year</label>
                                <input type="text" id="school_year" name="school_year" placeholder="e.g 2024-2025"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <select id="semester" name="semester" required>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" name="subject" placeholder="e.g CSDC105" required />
                            </div>
                            <div class="form-group">
                                <label for="section">Section</label>
                                <input type="text" id="section" name="section" placeholder="e.g N1Am" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="schedule_day">Schedule Day</label>
                                <input type="text" id="schedule_day" name="schedule_day" placeholder="e.g MW, TTH"
                                    required />
                            </div>
                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="time" id="start_time" name="start_time" required />
                            </div>
                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="time" id="end_time" name="end_time" required />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="room">Room</label>
                                <input type="text" id="room" name="room" placeholder="e.g AL211B/CSLAB2"
                                    required />
                            </div>
                        </div>
                        <button type="submit" class="btn-create">Create</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Join Class Modal -->
        <div class="modal fade" id="joinClassModal" tabindex="-1" aria-labelledby="joinClassModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h2 class="modal-title">Join Class</h2>
                    <form method="POST" action="{{ route('join.class') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="classCode" class="form-label">Class Code</label>
                            <input type="text" class="form-control" id="classCode" name="class_code"
                                aria-required="true">
                        </div>
                        <button type="submit" class="btn btn-primary">Join</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- 
        <script>
            // Toggle Dropdown Visibility
            document.getElementById('logout-btn').addEventListener('click', () => {
                const dropdown = document.getElementById('logout-dropdown');
                dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' :
                    'none';
            });

            // Close Dropdown When Clicking Outside
            document.addEventListener('click', (event) => {
                const dropdown = document.getElementById('logout-dropdown');
                const logoutBtn = document.getElementById('logout-btn');

                if (!logoutBtn.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.style.display = 'none';
                }
            });

            // Handle Logout Action
            function handleLogout(event) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }


            document.addEventListener('DOMContentLoaded', function() {
                // Initialize modals using Bootstrap's API
                const createClassModal = new bootstrap.Modal(document.getElementById('createClassModal'));
                const joinClassModal = new bootstrap.Modal(document.getElementById('joinClassModal'));

                // Open Create Class Modal
                document.querySelectorAll('.create-class-btn').forEach(button => {
                    button.addEventListener('click', () => {
                        createClassModal.show(); // Use Bootstrap's .show()
                    });
                });

                // Open Join Class Modal
                document.getElementById('join-class-option')?.addEventListener('click', (event) => {
                    event.preventDefault();
                    joinClassModal.show();
                });

                // Clean up modal-backdrop after any modal is closed
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.addEventListener('hidden.bs.modal', () => {
                        document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop
                            .remove());
                    });
                });
            });
        </script> --}}

        <!-- Bootstrap Bundle JS (includes Popper.js) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </main>
@endsection
