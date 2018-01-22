<template>
	<section class="hero is-primary is-medium">
	  <!-- Hero content: will be in the middle -->
	  <div class="hero-body">
	    <div class="container has-text-centered">
	      <h1 class="title">
	        VOTE EASY
	      </h1>
	      <h2 class="subtitle">
	        Demo by Chudi
	      </h2>
	    </div>
	  </div>

	  <!-- Hero footer: will stick at the bottom -->
	  <div class="hero-foot">
	    <nav class="tabs is-boxed is-fullwidth">
	      <div class="container">
	      	<ul>
	      		<li v-for="tab in tabs" :class="{'is-active' : tab.selected}">
	      			<a :href="tab.href"> {{tab.text}} </a>
	      		</li>
	      	</ul>
	       
	      </div>
	    </nav>
	  </div>
	</section>
</template>

<script>
	export default{
		props: ['link'],
		data(){
			return{
				tabs: [
					{
						href: '/import', 
						text: 'Add Students',
						selected: true
					},
					{
						href: '/add-candidates',
						text: 'Add Candidates',
						selected: false
					},
					{
						href: '/fetch-course',
						text: 'View Students',
						selected: false
					},
					{
						href: '/fetch-student',
						text: 'Search For Student',
						selected: false
					},
					{
						href: '/fetch-candidates',
						text: 'Search candidate',
						selected: false
					}
				]
			}
		},
		created(){
			this.tabs.forEach((tab)=>{
				tab.selected = (this.link===tab.href);
			});
		}
	}
</script>

<style>
	.hero{
		margin-bottom: 70px;
	}
</style>