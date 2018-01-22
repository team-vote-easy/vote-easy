<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>Fetch Student Details</title>
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

       .input{
        width: 400px;
        position: relative;
        left: 33%;
        box-shadow: none;
       }


       input[type=submit]{
        width: 300px;
        position: relative;
        left: 440px;
       }

       .heh{
        font-family: Montserrat;
        border: 2px solid #b9382e;
       }

       .green{
        border: 2px solid #5eaa4d;
       }

       .card{
        margin-bottom: 50px;
       }

       .title{
        text-align: center;
       }

       .empty{
        border: 4px solid #ff3860;
        box-shadow: none;
       }

       .exists{
        border: 4px solid #00d1b2;
        box-shadow: none;
       }
    </style>
</head>
<body>
    <div id="root">
        <hero :link="'/fetch-student'"> </hero>
        <div class="container box">
            <form method="POST" action="/import" enctype="multipart/form-data" class="container" @submit.prevent="fetchStudent">
                <h1>Find Student</h1>
                <div class="field">
                    <div class="control is-expanded">
                        <input type="text" name="matric_no" class="input" placeholder="Matric Number" v-model="matricNumber">
                    </div>
                </div>
            
                <div class="field">
                    <div class="control">
                      <input type="submit" name="Submit" value="Search" class="button is-primary is-medium">  
                    </div>
                </div>
            </form>
        </div>
        <div class="content container">
                <h1 v-if="loading">Loading...</h1>
                <stat-card v-if="message" :message="message" :empty="empty"> </stat-card>
                <student-card v-if="studentDetails" :student="studentDetails"> </student-card>
        </div>
    </div>
    
</body>
</html>

<script type="text/javascript" src="js/fetch.js"></script>