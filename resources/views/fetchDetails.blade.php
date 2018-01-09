<!DOCTYPE html>
<html>
<head>
    <title>Import Test</title>
</head>
<body>
    <form method="POST" action="/fetch/student">
        {{csrf_field()}}
        <input type="text" name="matric_no" placeholder="Enter Student Matric Number">
        <input type="submit" name="Submit" value="Submit">
    </form>
</body>
</html>