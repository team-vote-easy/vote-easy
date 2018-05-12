<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{csrf_token()}}">
<meta charset="utf-8">
<head>
	<title>Staff | View Breakdown</title>
	<link rel="stylesheet" type="text/css" href="/css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="/css/font awesome/css/font-awesome.css">
    <style>
        h2{
            font-family: Helveticaneue;
            font-size: 90px;
            text-align: center;
            left: -60px;
            padding-bottom: 1px;
            position: relative;
            color: black;
            top: -70px;
       }

    	.title{
    		font-family: Montserrat;
    		font-size: 40px;
    		text-align: center;
    	}

    	hr{
    		border: 3px solid #00d1b2;
    		width: 40%;
    		position: relative;
            top: -30px;
    		left: 30%; 
    	}

        [v-cloak] {
            display: none;
        }

        h1.data{
            text-align: center;
            font-family: Helvetica;
            color: white;
            font-size: 18px;    
        }

        span.digit{
            font-size: 89px;
        }
    
        .info{
            box-shadow: none;
            width: 30%;
            margin-left: 30px;
            height: 200px;
            position: relative;
            left: -100px;
            top: -60px;
        }

        .total{
            border: 2px solid #0a0a0a;
            background-color: #0a0a0a;
            border-color: #0a0a0a;   
        }

        .voted{
            background-color: #00d1b2;
            border-color: #00d1b2; 
        }

        .unvoted{
            background-color: #ff3860;
            border-color: #ff3860;
        }

        .level{
            box-shadow: none;
            width: 40%;
            margin-left: 20px;
            height: 200px;
            background-color: #ffdd57;
        }

        .level{
            box-shadow: none;
            width: 50%;
            margin-left: 20px;
            height: 200px;
            background-color: #ffdd57;
        }

        strong{
            font-size: 20px;
            color: white;
            border-bottom: 2px solid white;
        }

    </style>
</head>
<body>
	<div id="root" v-cloak>
		<staff-dashboard link="/staff/view-breakdown" staff={{$staff}}>
            <h2>{{$hall}} <hr/></h2>
            <div class="columns container">
                <div class="box info total column is-3">
                    <h1 class="data"> <span class="digit"> {{$totalStudents}} </span>  <br/>Total Students registered</h1>
                </div>

                <div class="box info voted column is-3">
                    <h1 class="data"> <span class="digit"> {{$votedStudents}} </span>  <br/> Students have Voted</h1>
                </div>

                <div class="box info unvoted column is-3">
                    <h1 class="data"> <span class="digit"> {{$unvotedStudents}} </span>  <br/> Are Yet To Vote</h1>
                </div>
            </div>
            


        </staff-dashboard>
		
	</div>
</body>
</html>

<script type="text/javascript" src="/js/staff.js"></script>

