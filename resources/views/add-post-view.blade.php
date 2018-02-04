<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>Add Post</title>
    <link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <style type="text/css">
       h1{
        font-family: Helveticaneue;
        font-size: 40px;
        text-align: center;
        padding-bottom: 10px;
        position: relative;
        color: black;
       }

       .label{
            position: relative;
            left: 240px;
       }

       .input{
        width: 300px;
        padding: 20px;
        box-shadow: none;
        position: relative;
        left: 240px;
       }

       select{
        width: 300px;
       }

       .file{
        position: relative;
        left: 100px;
        padding-top: 20px;
       }

       input[type=submit]{
        width: 500px;
        position: relative;
        left: 380px;
       }

       .heh{
        font-family: Montserrat;
        border: 2px solid #b9382e;
       }

       .green{
        border: 2px solid #5eaa4d;
       }


    </style>
</head>
<body>
    <div id="root">
        <add-post> </add-post>
    </div>

</body>
</html>

<script type="text/javascript" src="js/candidate.js"></script>