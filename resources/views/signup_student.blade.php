<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="finalLogo.png" type="image/png" sizes="16x16">
    <title>Sign-up as Student</title>
    <link rel="stylesheet" href="{{ asset('signup_student.css') }}"> <!-- Link to external CSS file -->
</head>

<body>

    <div class="container">

        @if ($errors->any())
        <div class="alert alert-danger" style="text-align: center; color: white; font-family: 'Press Start 2P', cursive;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif

        <!-- Logo -->

        <img src="{{ asset('finalLogo.png') }}" alt="Logo" class="logo">
        <div class="sign-up-title">Sign-up as Student</div>

        <!-- Sign Up Form -->
        <form action="{{ url('signup-student') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="first_name" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required
                    pattern="[a-zA-Z0-9._%+-]+@gbox\.adnu\.edu\.ph"
                    title="Please enter a valid email address ending with @gbox.adnu.edu.ph">
            </div>
                <script> //for gbox invalidation sign up
                    document.querySelector('form').addEventListener('submit', function(event) {
                        const emailInput = document.getElementById('email');
                        const emailPattern = /^[a-zA-Z0-9._%+-]+@gbox\.adnu\.edu\.ph$/;

                        if (!emailPattern.test(emailInput.value)) {
                            alert('Please enter a valid email address ending with @gbox.adnu.edu.ph');
                            event.preventDefault(); // Prevents form submission
                        }
                    });
                </script>

<div class="form-group">
    <label for="first_name" class="form-label">First Name:</label> <!-- Added label -->
    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required oninput="updateNameDisplay()">
</div>

<div class="form-group">
    <label for="last_name" class="form-label">Last Name:</label> <!-- Added label -->
    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
</div>

<div class="form-group">
    <label for="id_number" class="form-label">ID Number:</label> <!-- Added label -->
    <input type="text" name="id_number" id="id_number" class="form-control" placeholder="ID Number" required>
</div>

<div class="form-group">
    <label for="course" class="form-label">Select Course:</label> <!-- Added label -->
    <select name="course" id="course" class="form-control">
        <option value="">Select Course</option>
        @foreach($courses as $course)
        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
        @endforeach
    </select>
</div>

                    {{-- <div class="form-group">
                        <label for="birthday">Birthday</label>
                        <input type="date" name="birthday" id="birthday" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select> --}}
                        <button type="submit" class="btn">Sign Up</button>

                    </div>

        </form>

    </div>
</body>
</html>
