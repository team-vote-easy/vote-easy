<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>Fetch Candidates</title>
    <link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <style>
    	[v-cloak] {
			display: none;
		}
    </style>
</head>
<body>
    <div id="root" v-cloak>
    	<dashboard :link="'/fetch-candidates'">
            <fetch-candidates> </fetch-candidates>
        </dashboard>
    	
    </div>
    
</body>
</html>

<script type="text/javascript" src="js/candidate.js"></script>