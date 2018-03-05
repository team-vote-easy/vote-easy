<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
	<title>Admin Dashbaord</title>
	<link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
	<link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<style type="text/css">
		.fa{
			margin-right: 5px;
		}

		.menu-list a.is-active{
			background-color: #363636;
			color: white;
		}

		
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
        box-shadow: none;
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


	</style>
</head>
<body>
	<header class="hero is-light">
		<div class="hero-head">
			<nav class="navbar">
				<div class="navbar-brand">
					<a class="navbar-item">
					  <img src="css/images/BUCC Logo.jpg" width="112" height="28" alt="Bulma">
					</a>
				</div>
				<div class="navbar-menu">
					<div class="navbar-end">
						<span class="navbar-item">
							Signed In as: Chudi
						</span>

						<span class="navbar-item">
							<a class="button is-dark is-outlined is-rounded"> Sign Out</a>
						</span>
					</div>
				</div>
			</nav>
		</div>
	</header>

	<div class="section">
	 	<div class="columns">
			<aside class="column is-2">
				<nav class="menu">

					<p class="menu-label">Students</p>
					<ul class="menu-list">
					  <li><a class="is-active"> <i class="fa fa-graduation-cap"> </i> Add Students </a></li>
					  <li><a> <i class="fa fa-search"> </i> Search For A Student</a></li>
					  <li><a href=""> <i class="fa fa-eye"></i> View Students  </a></li>
					</ul>

					<p class="menu-label">Candidates</p>
					<ul class="menu-list">
						<li><a><i class="fa fa-user-plus"> </i> Add Candidate </a></li>
						<li><a class=""> <i class="fa fa-eye"> </i> View Candidates</a></li>
					</ul>

					<p class="menu-label">Stats</p>
					<ul class="menu-list">
						<li><a><i class="fa fa-signal"> </i> View Results </a></li>
						<li><a class=""> <i class="fa fa-eye"> </i> Other</a></li>
					</ul>
			 	</nav>
			</aside>
			
			<main class="column">
			  	<div class="box">
		            <form method="POST" action="/import" enctype="multipart/form-data" class="" @submit.prevent="submit">
		                <h1>ADD CANDIDATES</h1>

		                <div class="field is-horizontal">
		                    <div class="field-label is-normal">
		                        <label class="label">Name: </label>
		                    </div>
		                    <div class="field-body">

		                        <div class="field">
		                            <div class="control is-expanded">
		                                <input type="text" name="first_name" class="input" placeholder="First Name" v-model="firstName">
		                            </div>
		                        </div>

		                        <div class="field">
		                            <div class="control is-expanded">
		                                <input type="text" name="first_name" class="input" placeholder="Last Name" v-model="lastName">
		                            </div>
		                        </div>
		                    </div>
		                </div>

		                <div class="field is-horizontal">
		                    <div class="field-label is-normal">
		                        <label class="label"> Position:</label>
		                    </div>
		                    <div class="field-body">
		                        <div class="field is-narrow">
		                            <div class="control">
		                                <div class="select is-fullwidth">
		                                    <select name="position" v-model="role">
		                                      
		                                    </select>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>


		                <div class="field is-horizontal">
		                    <div class="field-label is-normal">
		                        <label class="label">Course + Level: </label>
		                    </div>
		                    <div class="field-body">
		                        <div class="field">
		                            <div class="control is-expanded">
		                                <div class="select">
		                                    <select name="course" v-model="course">
		                                        <option value="" disabled="">Select Course</option>
		                                    
		                                    </select>
		                                </div>
		                            </div>
		                        </div>

		                        <div class="field">
		                            <div class="control is-expanded">
		                                <div class="select">
		                                    <select name="level" v-model="level">
		                                        <option value="" disabled>Select Level</option>
		                                        
		                                    </select>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>

		                <div class="field">
		                    <div class="file is-primary has-name" :class="{ 'has-name' : image}">
		                        <label class="file-label">
		                           <input type="file" name="file" class="file-input" @change="processFile($event)">
		                           <span class="file-cta">
		                                <span class="file-icon">
		                                    <i class="fa fa-upload"></i>
		                                </span>
		                                <span class="file-label">
		                                    Upload Candidate Image...
		                                </span>
		                           </span>
		                           <span class="file-name" v-if="image">
		                               @{{image.name}}
		                           </span>
		                        </label>
		                    </div>
		                </div>
		            
		                <div class="field">
		                    <div class="control">
		                      <input type="submit" name="Submit" value="Submit" class="button is-primary is-medium">  
		                    </div>
		                </div>
		            </form>

		            <modal v-if="showModal && errors.message" @close="showModal = false; errors={} " :green="false">
		                @{{errors.message}}
		            </modal>

		            <modal v-if="showModal && success" @close="showModal = false; success='' " :green="true">
		                <!-- Successfully Added Candidate: @{{success.first_name}} @{{success.last_name}} -->
		            </modal>
		        </div>



			</main>
		  </div>
	</div>
</body>
</html>