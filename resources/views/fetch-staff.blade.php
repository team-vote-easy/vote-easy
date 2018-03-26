<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
	<title>View Staff</title>
	<link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
	<link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/fetch-candidates.css">
	<style>
		h1{
        font-family: Helveticaneue;
        font-size: 60px;
        text-align: center;
        padding-bottom: -10px;
        top: -30px;
        position: relative;
        color: black;
       }

		[v-cloak] {
			display: none;
		}

		.staff-card{
			position: relative;
			left: 60px;
		}

		.username{
			border-bottom: 3px solid purple;
		}

		.password{
			border-bottom: 3px solid #00d1b2;
			width: 330px;
		}

		.password:hover, .username:hover{
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div id="root" v-cloak>
		<dashboard :link="'/view-staff'" admin={{$admin}}>
			 <h1>view staff. <hr/> </h1>
			<staff-card> </staff-card>

			
		</dashboard>
		
	</div>
	
</body>
</html>

<script type="text/javascript" src="js/staff.js"></script>