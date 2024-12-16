@extends('components.layout')

@section('landing')
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-list.css') }}">
    <link rel="stylesheet" href="{{ asset('css/class-dashboard/class-dashboard.css') }}">
    <main>
    <div class="container">
    <div class="class-list-wrapper">
        @foreach ($classes as $class)
            <a 
                href="{{ auth()->user()->user_type === 'teacher' ? route('bulletins', ['classId' => $class->id]) : route('studentbulletins', ['classId' => $class->id]) }}" 
                class="class-list-link" 
                style="flex:3; text-decoration: none; color: inherit;"
            >
                <div class="class-list" style="cursor: pointer;">
                    <div class="class-theme">
                        <p class="school-year">School Year: {{ $class->school_year }}</p>
                        <p class="semester">Semester: {{ $class->semester }}</p>
                        <p class="section">Section: {{ $class->section }}</p>
                        <img src="{{ $user->google_profile_image ?? asset('ainz.jpg') }}" alt="Logo" class="user-picture">
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

<script>

document.addEventListener('DOMContentLoaded', function () {
                // Handle class card clicks for redirection
                document.querySelectorAll('.class-card').forEach(function (card) {
                    card.addEventListener('click', function (event) {
                        const isDropdownOrModal = event.target.closest('.dropdown') || event.target.closest('.modal');

                        if (!isDropdownOrModal && !document.querySelector('.dropdown-menu.show')) {
                            window.location.href = this.getAttribute('data-href');
                        }
                    });
                });
            });
</script>

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
document.querySelectorAll('.create-class-btn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('createClassModal').style.display = 'flex';
    });
});

// Close modal
document.querySelector('.close-btn').addEventListener('click', () => {
    document.getElementById('createClassModal').style.display = 'none';
});
    </script>
        
    </main>
@endsection
