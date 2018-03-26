<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{csrf_token()}}">
<meta charset="utf-8">
<head>
	<title>Staff | Push To Server</title>
	<link rel="stylesheet" type="text/css" href="/css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="/css/font awesome/css/font-awesome.css">
    <style>
        h2{
            font-family: Helveticaneue;
            font-size: 90px;
            text-align: center;
            left: 40px;
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

        .server{
            width: 280px;
            position: relative;
            padding: 20px;
            left: -120px;
            top: 80px;
            padding: 40px;
            font-size: 25px;
        }

    </style>
</head>
<body>
	<div id="root" v-cloak>
		<staff-dashboard link="/staff/push-to-server" staff={{$staff}}>
            <h2>{{$hall}} <hr/></h2>
            <div class="columns container">
                <h1>Last Time you pushed was: XXXXXX </h1>

                <a href="#" class="button is-primary is-outlined container server" @click.prevent="pushServer">Push to server 🚀</a>
            </div>
            


        </staff-dashboard>
		
	</div>
</body>
</html>

<script type="text/javascript" src="/js/staff.js"></script>

