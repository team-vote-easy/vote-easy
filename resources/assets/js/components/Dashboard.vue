<template>
	<div>
		<header class="hero is-light is-bold is-medium">
			<div class="hero-head">
				<nav class="navbar">
					<div class="navbar-brand">
						<a class="navbar-item">
						  <img src="css/images/bulma-logo.png" width="112" height="28" alt="Bulma">
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

						<div v-for="category in tabs">
							<p class="menu-label"> {{category.title}}</p>
							<ul class="menu-list">
								<li v-for="tab in category.subTabs"> 
									<a :class="{'is-active' : tab.selected}" :href="tab.href">
										<i :class="tab.icon"></i>
										{{tab.text}}
									</a> 
								</li>
							</ul>
						</div>
				 	</nav>
				</aside>
				
				<main class="column">
				  	<slot> </slot>
				</main>
			  </div>
		</div>
	</div>
</template>

<script>
	export default{
		props: ['link'],
		data(){
			return{
				tabs: [
						{
							title: 'Students',
							subTabs: [
								{
									href: '/import', 
									text: 'Add Students',
									icon: 'fa fa-graduation-cap',
									selected: false
								},
								{
									href: '/add-student', 
									text: 'Add a Student',
									icon: 'fa fa-graduation-cap',
									selected: false
								},
								{
									href: '/fetch-student',
									text: 'Search For A Student',
									icon: 'fa fa-search',
									selected: false
								},
								{
									href: '/fetch-course',
									text: 'View Students',
									icon: 'fa fa-eye',
									selected: false
								},
							]
						},
						{
							title: 'Candidates',
							subTabs: [
								{
									href: '/add-candidates',
									text: 'Add Candidates',
									icon: 'fa fa-user-plus',
									selected: false
								},
								{
									href: '/fetch-candidates',
									text: 'Search candidates',
									icon: 'fa fa-search',
									selected: false
								},
							]
						},
						{
							title: 'Stats',
							subTabs: [
								{
									href: '/view-votes',
									text: 'View Results',
									icon: 'fa fa-signal',
									selected: false
								}
							]
						}
					]
				}
			},
			created(){
				this.tabs.forEach((category)=>{
					category.subTabs.forEach((tab)=>{
						tab.selected = (this.link===tab.href);
					});
				});
			}
		}
</script>

<style>
	.fa{
		margin-right: 5px;
	}

	.menu-list a.is-active{
		background-color: #363636;
		color: white;
	}
</style>