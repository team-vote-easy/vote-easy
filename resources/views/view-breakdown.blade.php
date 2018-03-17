<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{csrf_token()}}">
<meta charset="utf-8">
<head>
	<title>View Breakdown</title>
	<link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
    <style>
    	.title{
    		font-family: Montserrat;
    		font-size: 40px;
    		text-align: center;
    	}

    	hr{
    		border: 3px solid #00d1b2;
    		width: 40%;
    		position: relative;
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
		<dashboard link="/view-breakdown" admin={{$admin}}>
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

            <div class="columns container">
                @foreach($levelsData as $level=>$count)
                    <div class="box level column is-2 container">
                        <h1 class="data"> <span class="digit"> {{$count}} </span>  <br/><strong> {{$level}} </strong> level students have voted </h1>
                    </div>                
        
                @endforeach
            </div>
            


        </dashboard>
		
	</div>
</body>
</html>

<script type="text/javascript" src="js/result.js"></script>

