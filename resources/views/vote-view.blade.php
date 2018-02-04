<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>BUCC Vote</title>
    <link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <style type="text/css">
        h3{
            float: right;
            position: relative;
            left: -30px;
            border-bottom: 3px solid #ff3860;
            padding-bottom: 6px;
            margin-left: 30px;
        }

        ul.nav-ting a{
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <ul class="nav-ting">
        <li><h3> <a href="/logout">Logout</a> </h3></li>
        <li><h3> Logged in as: <strong> {{$student->first_name. ' '.$student->last_name}} </strong> </h3></li>
    </ul>
    
    <div id="root">
        <div class="container">
           <vote-card student="{{$student->id}}"> </vote-card>

            <modal v-if="votedModal" :green="true" @close="votedModal = false"> Successfully Voted! </modal>
        </div>
    </div>

</body>
</html>

<script type="text/javascript" src="js/student.js"></script>