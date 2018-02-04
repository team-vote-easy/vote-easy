<template>
	<div>
		<h1>{{currentView.position}}</h1>
		<div class="columns">
			<side-bar > </side-bar>
				<div v-for="candidate in currentView.candidates" class="column is-3">
					<div class="card">
					  <div class="card-image">
					    <figure class="image is-4by3">
					      <img :src="getPath(candidate.image)" alt="Candidate Image">
					    </figure>
					  </div>
					  <div class="card-content">
					    <p class="title">
					      {{candidate.first_name}} {{candidate.last_name}}
					    </p>
					  </div>
					  <footer class="card-footer">
					  	<p class="card-footer-item">
					      <span>
					        {{candidate.position}}
					      </span>
					    </p>
					    <p class="card-footer-item">
					      <span>
					        {{candidate.course}}
					      </span>
					    </p>
					    <p class="card-footer-item">
					    	{{candidate.level}}
					    </p>
					  </footer>

					  <footer>
					  	<a href="#" class="button vote " @click.prevent="vote(currentView.position, candidate.id)"> 
					  		<span class="icon">
							  <i :class="[studentVote[makeCamel(candidate.position)] == candidate.id  ? 'fa fa-heart votedIcon animated bounce' :' fa fa-heart-o voteIcon' ]"></i>
							</span>
					  	</a>
					  </footer>
					</div>
				</div>
			
		</div>

		<div>
			<a href="#" @click.prevent="prev" class="button is-danger prev" :disabled="count==0">Previous</a>
			<a href="#" @click.prevent="submitVotes" class="button is-primary done" :disabled="isDone()">Done</a>
			<a href="#" @click.prevent="next" class="button is-danger next" :disabled="count>=5">Next</a>
		</div>

	</div>
</template>

<script>
	import axios from 'axios';
	import SideBar from './SideBar.vue';
	export default{
		data(){
			return {
				studentVote: {
					president: '',
					vicePresident: '',
					pro: '',
					chaplain: '',
					socialDirector: '',
					sportsDirector: '',
				},
				currentView: '',
				candidatesData: [],
				count: 0,
				voted: false
			}
		},
		props: ['student'],
		created(){
			console.log(this.student);
			const self = this;
			axios.get('/api/candidates')
				.then((data)=>{
					var candidates = data.data;
					var keys = Object.keys(candidates);
	
					keys.forEach((key)=>{
						//Remember to chunk the array into 3
						self.candidatesData[self.count] = {
							position: _.toUpper(_.startCase(key)),
							candidates: candidates[key]
						};
						self.count+=1;
					});

					self.count = 0;

					self.currentView = self.candidatesData[0];

				})
				.catch((e)=>{
					console.log(e);
				});

			Event.$on('menuChange', (index)=>{
				self.count = index;
				self.currentView = self.candidatesData[self.count];
			});
		
		},
		methods: {
			getPath(image){
				return require('../../../../public/candidate-images/'+image);
			},

			vote(position, id){
				this.studentVote[_.camelCase(position)] = id;



				//Move to the next candidate

				this.next();			

				// var keys = Object.keys(this.studentVote);
				// keys.forEach((k)=>{
				// 	console.log(k + ':' + this.studentVote[k]);
				// })
			},

			prev(){
				//Check to ensure we don't go below the no of available posts
				if(this.count==0){
					return;
				}

				const self = this;
				this.count-=1;
				Event.$emit('menuChange', self.count);
				this.currentView = this.candidatesData[this.count];
			},

			next(){
				//Check to ensure we don't go above the no of available posts
				if(this.count==5){
					return;
				}

				const self = this;
				this.count+=1;
				Event.$emit('menuChange', self.count);
				this.currentView = this.candidatesData[this.count];
			},

			makeCamel(toCamelString){
				return _.camelCase(toCamelString);
			},

			isDone(){
				//Function to ensure all positions have been selected by the student
				var keys = Object.keys(this.studentVote);
				var incomplete = 0;
				keys.forEach((key)=>{
					if(this.studentVote[key]==''){
						incomplete+=1;
					}
				});

				if(incomplete>=1){
					return true;
				}
				else{
					return false;
				}
			},

			submitVotes(){
				self = this;
				var voteData = new FormData();
				voteData.append('student_id', this.student);
				voteData.append('president', this.studentVote.president);
				voteData.append('vice_president', this.studentVote.vicePresident);
				voteData.append('pro', this.studentVote.pro);
				voteData.append('chaplain', this.studentVote.chaplain);
				voteData.append('social_director', this.studentVote.socialDirector);
				voteData.append('sports_director', this.studentVote.sportsDirector);
				axios.post('api/vote', voteData)
				.then((data)=>{
					Event.$emit('voted', data.data);
					_.delay(self.redirect, 3000);
					
				})
				.catch((e)=>{
					console.log(e);
				})
			},
			redirect(){
				window.location.href="student-login";
			}
		},
		components: {SideBar}
	}
</script>

<style>

	.card{
		max-width: 140%;
	}

	.card-content{
		text-align: center;
	}
	.card-footer-item{
		height: 80px;
		text-align: center;
	}

	.prev{
		float: left;
		position: relative;
		left: -90px;
		width: 100px;
		padding: 20px; 
		top: 50px;
		cursor: pointer;
	}

	.done{
		width: 300px;
		position: relative;
		left: 480px;
		padding: 20px;
		cursor: pointer;
		top: 50px;
	}

	.next{
		float: right;
		position: relative;
		left: 90px;
		width: 100px;
		padding: 20px;
		top: 50px;
		cursor: pointer;
	}

	h1{
		font-family: Helveticaneue;
	    font-size: 40px;
	    text-align: center;
	    padding-bottom: 10px;
	    position: relative;
	    left: 600px;
	    color: black;
		border-bottom: 4px solid #ff3860;
		width: 400px;
		margin-bottom: 50px;
	}

	.vote{
		border: 1px solid white;
		border-top: 1px solid #dbdbdb;
		border-radius: 0px;
		width: 100%;
		padding: 20px 0px;
		background-color: none;
	}

	.vote:hover{
		border: none;
		border-top: 1px solid #dbdbdb; 
		cursor: pointer;
	}

	.vote:focus{
		border: none;
		outline: none;
		box-shadow: none;
	}

	.voteIcon{
		font-size: 24px;
		color: grey;
	}

	.voteIcon:hover{
		color: #ff3860;
		transition: 0.7s ease-in-out;
	}

	.voteIcon:focus{
		color: #ff3860;
		transition: 0.7s ease-in-out;
	}

	.votedIcon{
		font-size: 24px;
		color: #ff3860;
	}
</style>