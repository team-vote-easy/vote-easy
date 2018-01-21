<template>
	<div>
		<div class="container box">
	        <form method="POST" action="/import" enctype="multipart/form-data" class="container" @submit.prevent="fetchCandidate">
	            <h1>Search Candidates</h1>

	            <div class="field is-horizontal">
	                <div class="field-label is-normal">
	                    <label class="label">Course & Level: </label>
	                </div>
	                <div class="field-body">
	                    <div class="field">
	                        <div class="control is-expanded">
	                            <div class="select">
	                                <select name="course" v-model="courseData">
                                		<option value="" disabled>Select Course</option>
                                        <option v-for="course in courseArray" :value="course" :key="course">{{course}}</option>
	                                </select>
	                            </div>
	                        </div>
	                    </div>

	                    <div class="field">
	                        <div class="control is-expanded">
	                            <div class="select">
	                                <select name="level" v-model="levelData">
                                    	<option value="" disabled>Select Level</option>
                                        <option  v-for="level in levelArray" :value="level" :key="level"> {{level}} </option>
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
	                              <select name="position" v-model="roleData">
                              			<option value="" disabled>Select Position</option>
	                                    <option v-for="position in positionArray" :value="position" :key="position"> {{position}} </option>
	                              </select>
	                          </div>
	                      </div>
	                  </div>
	              </div>
	            </div>
	        
	            <div class="field">
	                <div class="control">
	                  <input type="submit" name="Submit" value="Search" class="button is-primary is-medium">  
	                </div>
	            </div>
	        </form>
	    </div>
	    <div class="content container">
	            <h1 v-if="loading">Loading...</h1>
	            <stat-card v-if="message" :message="message" :empty="empty"> </stat-card>
	            <candidate-card v-if="candidates" v-for="(candidate, key) in candidates" :candidates="candidate" :key="key"> </candidate-card>
	       
	    </div>
	</div>
</template>

<script>
	import CandidateCard from './CandidateCard.vue';
	import StatCard from './StatCard.vue';
	export default {
		props: [ ],
		data(){
			return{
				courseData: '',
				levelData: '',
				roleData: '',
				loading: '',
				message: '',
				candidates: '',
				message: '',
				empty: false,
				courseArray: ["Computer Science", "Computer Technology", "Computer Information Systems", "All"],
	        	levelArray: [100, 200, 300, 400, "All"],
	        	positionArray: ["PRO", "President", "Vice President", "Chaplain", "Sports Director", "Social Director", "All"]
			}
		},
		methods: {
			fetchCandidate: function(){
				self = this;
				this.loading = true;
				this.message = '';
				this.empty = false;
				this.candidates = '';

				axios.post('fetch-candidates', {
					position: this.roleData,
					level: this.levelData,
					course: this.courseData
				})
				.then((data)=>{
					self.loading = '';
					if(data.data.length == 0 ){
						self.empty = true;
						self.message = "Sorry no candidates match your query";
						return;
					}

					self.candidates = _.chunk(data.data, 3);
					console.log(data)
				})
				.catch((e)=>{
					console.log(e);
				});
			}
		},
		components: {CandidateCard, StatCard}
	}
</script>

<style>
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
</style>