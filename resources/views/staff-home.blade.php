<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
	<title>Staff | Fetch Student </title>
	<link rel="stylesheet" type="text/css" href="/css/bulma-0.6.2/css/bulma.css">
	<link rel="stylesheet" type="text/css" href="/css/font awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="/css/animate.css">
	<style type="text/css">
	   h1{
		font-family: Helveticaneue;
		font-size: 40px;
		text-align: center;
		left: 40px;
		padding-bottom: 10px;
		position: relative;
		color: black;
	   }

	   .input{
		width: 300px;
		position: relative;
		left: 38%;
		box-shadow: none;
	   }


	   input[type=submit]{
		width: 600px;
		position: relative;
		left: 240px;
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

	   .password{
		  border-bottom: 8px solid #363636;
		  position: relative;
		  top: -18px;
		  font-size: 50px;
		}

		[v-cloak] {
		    display: none;
		}
	</style>
</head>
<body>
	<div id="root" v-cloak>
		<staff-dashboard :link="'/staff/home'" staff={{$staff}}> 
			<div class="box">
			  <form method="POST" class="" @submit.prevent="fetchStudent">
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
		  	<div class="content">
			  	<h1 v-if="loading">Loading...</h1>
			  	<stat-card v-if="message" :message="message" :empty="empty"> </stat-card>

			  	<div v-if="studentDetails">
					<div class="card">
					  <div class="card-content">
						<p class="title">
						  @{{studentDetails.name}}
						</p>
					  </div>
					  <footer class="card-footer">
						<p class="card-footer-item">
						  <span>
							@{{studentDetails.matric_no}}
						  </span>
						</p>
						<p class="card-footer-item">
						  <span>
							@{{studentDetails.hall == 'Off-Campus' ? studentDetails.hall : `${studentDetails.hall} Hall`}} 
						  </span>
						</p>
						<p class="card-footer-item">
						  <span>
							@{{studentDetails.block}}
						  </span>
						</p>
						<p class="card-footer-item">
						  @{{ studentDetails.voted ? 'Voted' : 'Not Voted' }}
						</p>

						<p class="card-footer-item">
						  <strong> <span class="password"> @{{studentDetails.key}} </span> </strong>
						</p>
					  </footer>
					</div>
				</div>
		  	</div>
		</staff-dashboard>
		  
	</div>
	
</body>
</html>

<script type="text/javascript" src="/js/staff.js"></script>