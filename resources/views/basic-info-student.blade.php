<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Information</title>
    <link rel="stylesheet" type="text/css" href="{{ secure_asset('basic-info-student.css') }}">
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

    <body>
        <div class="container">
            <div class="header">
                <img src="{{ asset('img/Ateneo_de_Naga_University_logo.png') }}" alt="ateneo-logo">
                <h1>Ateneo De Naga University</h1>
            </div>

            <h1 class="header-label">Complete Your Profile</h1>

            <div class="form-content">
                <form method="POST" action="{{ route('basic-info-student.update') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first-name">First Name</label>
                            <input type="text" id="first-name" name="first-name" value="{{ $user->first_name }}"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name</label>
                            <input type="text" id="last-name" name="last-name" value="{{ $user->last_name }}"
                                disabled>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="ign">In-game Name</label>
                            <input type="text" id="ign" name="ign" placeholder="Enter your IGN" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="id-number">ID Number</label>
                            <input type="text" id="id-number" name="id-number" placeholder="Enter your ID Number"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select id="course" name="course" required>
                                <option value="" disabled selected>Select your Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="save-btn">Save</button>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
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
            </div>
        </div>
    </body>

</html>
