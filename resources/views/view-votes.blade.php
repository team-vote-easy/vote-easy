<!DOCTYPE html>
<html>
<meta name="csrf-token" content="{{csrf_token()}}">
<meta charset="utf-8">
<head>
	<title>View Results</title>
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
    </style>
</head>
<body>
	<div id="root" v-cloak>
		<dashboard link="/view-votes"> 
            <chart> </chart>
        </dashboard>
		
	</div>
</body>
</html>

<script type="text/javascript" src="js/canvasjs.min.js"></script>
<script type="text/javascript" src="js/result.js"></script>