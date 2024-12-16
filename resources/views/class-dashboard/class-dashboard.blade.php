@extends('components.layout')

@section('landing')
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-dashboard.css') }}">
    <div class="center-container">
        <img src="{{ asset('img/adnu.png') }}" alt="adnu-logo" class="adnu-logo">
        <h4>Create a class to get started</h4>

        <button type="button" class="btn btn-primary create-class-btn">
            <span class="create-class-text">Create Class</span>
        </button>

        <!-- Modal -->
        <div class="modal" id="createClassModal">
            <div class="modal-content">
                <button class="close-btn">&times;</button>
                <h2 class="modal-title">Create Class</h2>
                <form method="POST" action="{{ route('classes.store') }}">
                    @csrf <!-- Include CSRF token for security -->
                    <div class="form-row">
                        <!-- School Year -->
                        <div class="form-group">
                            <label for="school_year">School Year</label>
                            <input type="text" id="school_year" name="school_year" placeholder="e.g 2024-2025"
                                required />
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



    <script>
        // Modal Logic
        document.querySelector('.create-class-btn').addEventListener('click', () => {
            document.getElementById('createClassModal').style.display = 'flex';
        });

        document.querySelector('.close-btn').addEventListener('click', () => {
            document.getElementById('createClassModal').style.display = 'none';
        });
    </script>
    
@endsection
