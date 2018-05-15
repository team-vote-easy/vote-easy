<template>
	<div class="column is-2">
		<aside class="menu">
		  <p class="menu-label" v-if="showSenators">
		    Hall Senator
		  </p>

		  <ul class="menu-list">
		    <li v-for="position in hallSenators">
		    	<a :href="position.url" :class="{'is-active' : position.selected}" @click.prevent="menuClick(position, 'Senator')">
					{{position.position}} Block
		    		<span v-if="hasVoted(position.position)" class="fa fa-check-circle voted"></span>
		    	</a>
		    </li>
		  </ul>

		  <p class="menu-label">
		    Candidates
		  </p>
		  <ul class="menu-list">
		    <li v-for="position in positions">
		    	<a :href="position.url" :class="{'is-active' : position.selected}" @click.prevent="menuClick(position, 'Candidate')">{{position.position}} 
		    		<span v-if="hasVoted(position.position)" class="fa fa-check-circle voted"></span>
		    	</a>
		    </li>
		  </ul>
			


		</aside>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				positions: [],
				votes: '',
				hallSenators: [],
				numberofTabs: '',
				numofPosts: '',
				numofSenators: '',
				showSenators: true
			}
		},

		created(){
			const self = this;

			axios.get('api/get-candidates')
				.then((data)=>{
					if(data.data[1] == ''){
						self.showSenators = false;
					}
					self.fillSideBar(data.data[0], data.data[1]);
				})	
				.catch((e)=>{
					console.log(e);
				})


			Event.$on('menuChange', (index)=>{
				if(index > (self.numofSenators - 1)){
					self.hallSenators.forEach((position)=>{
						position.selected = false;
					});

					var newIndex = index - self.numofSenators;
					self.positions.forEach((position)=>{
						position.selected = (self.positions.indexOf(position)==newIndex);
					});
					return;
				}

				self.positions.forEach((position)=>{
					position.selected = false;
				});
				self.hallSenators.forEach((position)=>{
					position.selected = (self.hallSenators.indexOf(position)==index);
				})
			});

			//Check to see if the sidebar option has been voted for
			Event.$on('updateSideBar', (votes)=>{
				self.votes = votes;
			});
		},

		methods: {
			fillSideBar(positions, senators){
				var studentVote = {};
				var keys = Object.keys(positions);

				keys.forEach((key)=>{
					studentVote[key] = '';
					this.positions.push({
						position: key,
						url: '#',
						selected: false
					});
				});
		
				var senatorPosts = Object.keys(senators);
				if(senatorPosts == ''){
					Event.$emit('noSenators');
				}

				senatorPosts.forEach((post)=>{
					studentVote[post] = '';
					this.hallSenators.push({
						position: post,
						url: '#',
						selected: false
					})
				});

				if(senators != ''){
					this.hallSenators[0].selected = true;	
				} else{
					this.positions[0].selected = true;
				}
				
				this.numofPosts = keys.length;
				this.numofSenators = senatorPosts.length;
				this.numberofTabs = this.numofPosts + this.numofSenators;

				Event.$emit('candidates', positions, senators, studentVote);
			},


			menuClick(position, candidateType){
				var key;
				if(candidateType=='Candidate'){
				 	key = this.positions.indexOf(position);

				 	this.hallSenators.forEach((senator)=>{
				 		senator.selected = false;
				 	});

				 	this.positions.forEach((position)=>{
				 		position.selected = this.positions.indexOf(position) == key;
				 	});

					Event.$emit('menuClick', key, candidateType);
				}

				if(candidateType=='Senator'){
				 	key = this.hallSenators.indexOf(position);

					this.positions.forEach((position)=>{
						position.selected = false;
					});

				 	this.hallSenators.forEach((senator)=>{
				 		senator.selected = this.hallSenators.indexOf(senator) == key;
				 	});

					Event.$emit('menuClick', key, candidateType);
				}
			},

			hasVoted(position){
				if(this.votes == ''){
					return false;
				}

				if(this.votes[position] != ''){
					return true;
				}
				else{
					return false;
				}


				

			}
		}

	}
</script>

<style>
	.menu{
		position: relative;
		top: -100px;
		left: -93px;
		width: 210px;
	}

	.menu-list{
		border-left: 3px solid #ff3860;
	}

	.menu-list a{
		font-size: 12.5px;
	}

	.menu-list a.is-active{
		background-color: whitesmoke;
		color: #ff3860;
		border-right: 4px solid #ff3860;
	}

	.voted{
		float: right;
		color: #00d1b2;
	}
</style>