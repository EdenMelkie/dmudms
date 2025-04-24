<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="{{ asset('build/css/style.css') }}">

</head>

<body>
    <h1>Student Details</h1>
    <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
    <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}</p>
    <p><strong>Email:</strong> {{ $student->email }}</p>
    <p><strong>Gender:</strong> {{ $student->gender }}</p>
    <p><strong>Disability Status:</strong> {{ $student->disability_status }}</p>
    <p><strong>Status:</strong> {{ $student->status }}</p>
    <p><strong>Citizenship:</strong> {{ $student->citizenship }}</p>
</body>

</html>