<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="{{ asset('build/css/style.css') }}">

</head>

<body>
    <h1>Edit Student</h1>
    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="student_id">Student ID:</label>
        <input type="text" name="student_id" value="{{ $student->student_id }}" required>
        <br>
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="{{ $student->first_name }}" required>
        <br>
        <label for="second_name">Second Name:</label>
        <input type="text" name="second_name" value="{{ $student->second_name }}">
        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="{{ $student->last_name }}" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ $student->email }}" required>
        <br>
        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
        </select>
        <br>
        <label for="disability_status">Disability Status:</label>
        <input type="text" name="disability_status" value="{{ $student->disability_status }}">
        <br>
        <label for="status">Status:</label>
        <select name="status" required>
            <option value="active" {{ $student->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <br>
        <label for="citizenship">Citizenship:</label>
        <input type="text" name="citizenship" value="{{ $student->citizenship }}">
        <br>
        <button type="submit">Update</button>
    </form>
</body>

</html>