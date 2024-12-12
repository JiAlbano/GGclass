<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Information</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('basic-info-student.css') }}">
</head>
<body>
    <button class="logout-btn" onclick="logout()">Back</button>

    <script>
        function logout() {
            // Optional: Clear user session or authentication tokens
            alert('You have been logged out!');

            // Redirect to the login page
            window.location.href = 'auth.view';
        }
    </script>

    <div class="container">
        <div class="main-container">
            <div class="header-label">Complete your profile</div>
            <!-- Content starts here -->
            <div class="form-content">
                <!-- Left-side Label -->
                {{-- <label class="form-description">Complete the details below:</label> --}}
                
                <form method="POST" action="{{ route('basic-info-student.update') }}">
                @csrf
                    <!-- Input Fields with Labels -->
                    <div class="form-group">
                        <label for="first-name" class="first-name">First Name:</label>
                        <input type="text" id="first-name" name="first-name" value="{{ $user->first_name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="middle-initial">Middle Initial:</label>
                        <input type="text" id="middle-inital" name="middle-initial" value="{{ $user->middle_initial }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name:</label>
                        <input type="text" id="last-name" name="last-name" value="{{ $user->last_name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="ign">In-game name:</label>
                        <input type="text" id="ign" name="ign" placeholder="Enter your IGN" required>
                    </div>
                    <div class="form-group">
                        <label for="Id-number">ID Number:</label>
                        <input type="text" id="id-number" name="id-number" placeholder="Enter your ID Number" required>
                    </div>
                    <div class="form-group">
                        <label for="course">Course:</label>
                        <select id="course" name="course" required>
                            <option value="" disabled selected>Select your Course</option>
                            @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Buttons on the right -->
                    <div class="button-group">
                        <button type="submit" class="save-btn">Save</button>
                    </div>
                </form>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Content ends here -->
        </div>
    </div>
</body>

</html>