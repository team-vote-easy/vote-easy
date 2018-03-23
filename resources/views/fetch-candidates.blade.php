<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
	<title>Fetch Candidates</title>
	<link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
	<link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/fetch-candidates.css">
	<style>
		[v-cloak] {
			display: none;
		}
	</style>
</head>
<body>
	<div id="root" v-cloak>
		<dashboard :link="'/fetch-candidates'" admin={{$admin}}>
			<div>
				<div class="box">
			        <form method="POST" action="/import" enctype="multipart/form-data" class="" @submit.prevent="fetchCandidate">
			            <h1>Search Candidates</h1>

			            <div class="field is-horizontal">
			                <div class="field-label is-normal">
			                    <label class="label">Level: </label>
			                </div>
			                <div class="field-body">
			                    <div class="field">
			                        <div class="control is-expanded">
			                            <div class="select">
			                                <select name="level" v-model="levelData">
		                                    	<option value="" disabled>Select Level</option>
		                                        <option  v-for="level in levelArray" :value="level" :key="level"> @{{level}} </option>
			                                </select>
			                            </div>
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
			                              <select name="position" v-model="roleData" @change="handleChange">
		                              			<option value="" disabled>Select Position</option>
			                                    <option v-for="position in positionArray" :value="position" :key="position"> 
			                                    	@{{position}} 
			                                    </option>
			                              </select>
			                          </div>
			                      </div>
			                  </div>
			              </div>
			            </div>


						<div class="field is-horizontal" v-if="showHalls">
	                        <div class="field-label is-normal">
	                            <label class="label">Hall + Floor: </label>
	                        </div>
	                        <div class="field-body">
	                            <div class="field">
	                                <div class="control is-expanded">
	                                    <div class="select">
	                                        <select name="hall" v-model="hall">
	                                            <option value="" disabled="">Select Hall</option>
	                                            <option v-for="hall in hallArray"  :value="hall" :key="hall"> @{{hall}}  </option>
	                                        </select>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="field">
	                                <div class="control is-expanded">
	                                    <div class="select">
	                                        <select name="floor" v-model="floor">
	                                            <option value="" disabled=>Select Floor</option>
	                                            <option v-for="floor in floorArray" :value="floor" :key="floor"> @{{floor}}  </option>
	                                        </select>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>

			        
			            <div class="field">
			                <div class="control">
			                  <input type="submit" name="Submit" value="Search" class="button is-dark is-medium">  
			                </div>
			            </div>
			        </form>
			    </div>

			    <div class="content">
		            <h1 v-if="loading">Loading...</h1>

		            <stat-card v-if="message" :message="message" :empty="empty"> </stat-card>

		            <div class="columns" v-if="candidates" v-for="(candidateSet, key) in candidates" :key="key">
						<div v-for="candidate in candidateSet" class="column is-3">
							<div class="card view">
								<div class="card-image">
							    	<figure class="image is-4by3">
							      		<img :src="getPath(candidate.image)" alt="Candidate Image">
							    	</figure>
							  	</div>
							  	<div class="card-content">
							    	<p class="title">
							      		@{{candidate.first_name}} @{{candidate.last_name}}
							    	</p>
							  	</div>
							  	<footer class="card-footer">
							  		<p class="card-footer-item">
							      		<span>
							        		@{{candidate.position}}
							      		</span>
							    	</p>
							    	<p class="card-footer-item" v-if="candidate.position=='Hall Senator'">
							      		<span>
							        		@{{candidate.hall}}
							      		</span>
							    	</p>
							    	<p class="card-footer-item" v-if="candidate.position=='Hall Senator'">
							      		<span>
							        		@{{candidate.floor}}
							      		</span>
							    	</p>
							    	<p class="card-footer-item">
						    			@{{candidate.level}}
							    	</p>
							  	</footer>
							</div>
						</div>
					</div>
			       
			    </div>
			</div>

			
		</dashboard>
		
	</div>
	
</body>
</html>

<script type="text/javascript" src="js/fetch-candidate.js"></script>