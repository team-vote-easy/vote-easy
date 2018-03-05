<template>
	<div class="column is-2">
		<aside class="menu">
		  <p class="menu-label">
		    Candidates
		  </p>
		  <ul class="menu-list">
		    <li v-for="position in positions">
		    	<a :href="position.url" :class="{'is-active' : position.selected}" @click.prevent="menuChange(position)">{{position.position}} 
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
				positions: [
					{
						position: 'President',
						url: '#',
						selected: true
					},
					{
						position: 'Vice President',
						url: '#',
						selected: false
					},
					{
						position: 'PRO',
						url: '#',
						selected: false
					},
					{
						position: 'Social Director',
						url: '#',
						selected: false
					},
					{
						position: 'Chaplain',
						url: '#',
						selected: false
					},
					{
						position: 'Sports Director',
						url: '#',
						selected: false
					},
				],
				votes: ''
			}
		},
		created(){
			const self = this;
			
			Event.$on('menuChange', (index)=>{
				self.positions.forEach((position)=>{
					position.selected = (self.positions.indexOf(position)==index);
				})
			});

			//Check to see if the sidebar option has been voted for
			Event.$on('updateSideBar', (votes)=>{
				self.votes = votes;
			});
		},
		methods: {
			menuChange(position){
				var keys = this.positions.indexOf(position);
				Event.$emit('menuChange', keys);
			},

			hasVoted(position){

				if(this.votes == ''){
					return false;
				}

				if(this.votes[_.camelCase(position)] != ''){
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
		top: 30px;
		left: -85px;

	}

	.menu-list{
		border-left: 3px solid #ff3860;
	}

	.menu-list a.is-active{
		background-color: whitesmoke;
		color: #ff3860;
		border-right: 4px solid #ff3860;
		/*border: 2px solid #ff3860;*/
		/*border-radius: 4px;*/
	}

	.voted{
		float: right;
		color: #00d1b2;
	}
</style>