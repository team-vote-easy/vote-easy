<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
    <title>Fetch Candidates</title>
    <link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
    <link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/animate.css">
</head>
<body>
    <div id="root">
    	<hero :link="'/fetch-candidates'"> </hero>
    	<fetch-candidates> </fetch-candidates>
    </div>
    
</body>
</html>

<script type="text/javascript" src="js/candidate.js"></script>