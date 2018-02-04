<template>
	<div class="column is-2">
		<aside class="menu">
		  <p class="menu-label">
		    Candidates
		  </p>
		  <ul class="menu-list">
		    <li v-for="position in positions">
		    	<a :href="position.url" :class="{'is-active' : position.selected}" @click.prevent="menuChange(position)">{{position.position}}</a>
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


				]
			}
		},
		created(){
			const self = this;
			
			Event.$on('menuChange', (index)=>{
				self.positions.forEach((position)=>{
					position.selected = (self.positions.indexOf(position)==index);
				})
			})
		},
		methods: {
			menuChange(position){
				var keys = this.positions.indexOf(position);
				Event.$emit('menuChange', keys);
			}
		}

	}
</script>

<style>
	.menu{
		position: relative;
		top: 30px;
		left: -70px;

	}

	.menu-list{
		border-left: 3px solid #ff3860;
	}

	.menu-list a.is-active{
		background-color: #ff3860;
		border-radius: 0px;
	}
</style>