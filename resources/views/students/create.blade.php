<!-- resources/views/students/create.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <link rel="stylesheet" href="{{ asset('build/css/style.css') }}">
</head>

<body>

    <div class="container">
        <h1>Create Student</h1>
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" required class="form-control"><br><br>
            </div>

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="first_name" required class="form-control"><br><br>
            </div>

            <div class="form-group">
                <label for="last_name">Second Name:</label>
                <input type="text" id="second_name" name="second_name" required class="form-control"><br><br>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="last_name" required class="form-control"><br><br>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required class="form-control"><br><br>
            </div>

            <div class="form-group">
                <label for="gender">Gender:</label>
                <select name="gender" id="gender" class="form-control">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select><br><br>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" required class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select><br><br>
            </div>

            <div class="form-group">
                <label for="disability_status">Disability Status:</label>
                <select name="disability_status" id="disability_status" class="form-control">
                    <option value="">Select Disability Status</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select><br><br>
            </div>

            <div class="form-group">
                <label for="citizenship">Citizenship:</label>
                <input type="text" id="citizenship" name="citizenship" class="form-control"><br><br>
            </div>

            <button type="submit" class="btn btn-primary">Create Student</button>
        </form>
    </div>

</body>

</html>