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
    <div class="container">
        <div class="main-container">
            <div class="header-label">Basic Information</div>
            <!-- Content starts here -->
            <div class="form-content">
                <!-- Left-side Label -->
                <label class="form-description">Please fill in the details below:</label>
                
                <!-- Input Fields with Labels -->
                <div class="form-group">
                    <label for="first-name">First Name:</label>
                    <input type="text" id="first-name" name="first-name" placeholder="Enter your first name">
                </div>
                <div class="form-group">
                    <label for="middle-name">Middle Name:</label>
                    <input type="text" id="middle-name" name="middle-name" placeholder="Enter your middle name">
                </div>
                <div class="form-group">
                    <label for="last-name">Last Name:</label>
                    <input type="text" id="last-name" name="last-name" placeholder="Enter your last name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="department">Department:</label>
                    <select id="department" name="department">
                        <option value="" disabled selected>Select your department</option>
                        <option value="HR">Human Resources</option>
                        <option value="IT">Information Technology</option>
                        <option value="Finance">Finance</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                </div>
                
                <!-- Buttons on the right -->
                <div class="button-group">
                    <button type="button" class="cancel-btn">Cancel</button>
                    <button type="submit" class="save-btn">Save</button>
                </div>
            </div>
            <!-- Content ends here -->
        </div>
    </div>
</body>

</html>