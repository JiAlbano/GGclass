@extends('components.layout')

@section('landing')
<link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-list.css') }}">
<link rel="stylesheet" href="{{ secure_asset('css/class-dashboard/class-dashboard.css') }}">
<link rel="stylesheet" href="{{ secure_asset('css/components/main.css') }}">
<link rel="stylesheet" href="{{ asset('css/class-dashboard/class-list.css') }}">
<link rel="stylesheet" href="{{ asset('css/class-dashboard/class-dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/components/main.css') }}">

<div class="center-container">
    <img src="{{ asset('img/adnu.png') }}" alt="adnu-logo" class="adnu-logo">
    <h4>{{ auth()->user()->user_type === 'teacher' ? 'Create a class to get started' : 'Join a class to get started' }}</h4>

    @if (auth()->user()->user_type === 'teacher')
        <!-- Teacher: Create Class Button -->
        <button type="button" class="btn btn-primary create-class-btn" data-bs-target="#createClassModal">
            <span class="create-class-text">Create Class</span>
        </button>
    @elseif (auth()->user()->user_type === 'student')
        <!-- Student: Join Class Button -->
        <button type="button" id="join-class-option" class="btn btn-success join-class-btn" data-bs-toggle="modal" data-bs-target="#joinClassModal">
            <span class="join-class-text">Join Class</span>
        </button>
    @endif
</div>

<!-- Create Class Modal -->
<div class="modal fade" id="createClassModal" tabindex="-1" aria-labelledby="createClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Center the modal -->
        <div class="modal-content">
            <button class="close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            <h2 class="modal-title">Create Class</h2>
            <form method="POST" action="{{ route('classes.store') }}">
                @csrf <!-- Include CSRF token for security -->
                <div class="form-row">
                    <!-- School Year -->
                    <div class="form-group">
                        <label for="school_year">School Year</label>
                        <input type="text" id="school_year" name="school_year" placeholder="e.g 2024-2025" required />
                    </div>
                    <!-- Semester -->
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select id="semester" name="semester" required>
                            <option value="1st">1st</option>
                            <option value="2nd">2nd</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <!-- Subject -->
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="e.g CSDC105" required />
                    </div>
                    <!-- Section -->
                    <div class="form-group">
                        <label for="section">Section</label>
                        <input type="text" id="section" name="section" placeholder="e.g N1Am" required />
                    </div>
                </div>
                <div class="form-row">
                    <!-- Schedule Day -->
                    <div class="form-group">
                        <label for="schedule_day">Schedule Day</label>
                        <select id="schedule_day" name="schedule_day" required>
                            <option value="M">M</option>
                            <option value="T">T</option>
                            <option value="W">W</option>
                            <option value="TH">TH</option>
                            <option value="F">F</option>
                            <option value="S">S</option>
                            <option value="MW">MW</option>
                            <option value="TTH">TTH</option>
                        </select>
                    </div>
                    <!-- Start Time -->
                    <div class="form-group-start">
                        <label for="start_time">Start Time</label>
                        <input type="time" id="start_time" class="control-time" name="start_time" required />
                    </div>
                    <!-- End Time -->
                    <div class="form-group-end">
                        <label for="end_time">End Time</label>
                        <input type="time" id="end_time" class="control-time" name="end_time" required />
                    </div>
                </div>
                <!-- Room -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="room">Room</label>
                        <input type="text" id="room" name="room" placeholder="e.g AL211B/CSLAB2" required />
                    </div>
                </div>
                <button type="submit" class="btn-create">Create</button>
            </form>
        </div>
    </div>
</div>

<!-- Join Class Modal -->
<div class="modal fade" id="joinClassModal" tabindex="-1" aria-labelledby="joinClassModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered"> <!-- Center the modal -->
        <div class="modal-content p-4"> <!-- Add padding for proper spacing -->
            <!-- Close button aligned to the top-right -->
            <button type="button" class="btn-close position-absolute" style="right: 1rem; top: 1rem;" data-bs-dismiss="modal" aria-label="Close"></button>
            
            <!-- Modal title -->
            <div class="text-center mb-4">
                <h2 class="modal-title" id="joinClassModalLabel">Join Class</h2>
            </div>
            
            <!-- Form Content -->
            <form method="POST" action="{{ route('join.class') }}">
                @csrf
                <div class="mb-4">
                    <label for="classCode" class="form-label">Class Code</label>
                    <input type="text" class="form-control" id="classCode" name="class_code" placeholder="Enter class code" aria-required="true">
                </div>
                <div class="text-end"> <!-- Align button to the right -->
                    <button type="submit" class="btn btn-primary">Join</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
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
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
        });
    });
});
</script>

<!-- Bootstrap JS Bundle (includes Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
