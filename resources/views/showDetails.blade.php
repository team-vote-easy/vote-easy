<!DOCTYPE html>
<html>
<head>
	<title>Show Student details</title>
</head>
<body>
	<p>First Name: {{$student->first_name}}</p>
	<p>Last Name: {{$student->last_name}}</p>
	<p>Level: {{$student->level}}</p>
	<p>Course: {{$student->course}}</p>
	<p>Password: {{$student->password}}</p>
</body>
</html>