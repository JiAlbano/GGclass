<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Information</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('basic-info-teacher.css') }}">
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
            <form method="POST" action="{{ route('basic-info-teacher.update') }}">
                @csrf
                <!-- Content starts here -->
                <div class="form-content">

                    <!-- Input Fields with Labels -->
                    <div class="form-group">
                        <label for="first-name" class="first-name">First Name:</label>
                        <input type="text" id="first-name" name="first_name" value="{{ $user->first_name }}" disabled>
                    </div>
<!--                     <div class="form-group">
                        <label for="middle-name">Middle Initial:</label>
                        <input type="text" id="middle-initial" name="middle_initial" value="{{ $user->middle_initial }}" disabled>
                    </div> -->
                    <div class="form-group">
                        <label for="last-name">Last Name:</label>
                        <input type="text" id="last-name" name="last_name" value="{{ $user->last_name }}" disabled>
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
                        <label for="department">Department:</label>
                        <select id="department" name="department" required>
                            <option value="" disabled selected>Select your department</option>
                            @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Buttons on the right -->
                    <div class="button-group">
                        <button type="submit" class="save-btn">Save</button>
                    </div>
                </div>
                <!-- Content ends here -->
            </form>
        </div>
    </div>

</body>

</html>