<!DOCTYPE html>
<html>
<head>
    <title>Import Test</title>
</head>
<body>
    <form method="POST" action="/import" enctype="multipart/form-data">
        {{csrf_field()}}
        <select name="course">
            <option>Select Course</option>
            @foreach($courses as $course)
                <option value="{{$course}}">{{$course}}</option>
            @endforeach
        </select>

        <select name="level">
            <option>Select Level</option>
            @foreach($levels as $level)
                <option value="{{$level}}"> {{$level}} </option>
            @endforeach
        </select>

        <p>Excel File: </p>
        <input type="file" name="file">
        <input type="submit" name="Submit" value="Submit">
    </form>
</body>
</html>