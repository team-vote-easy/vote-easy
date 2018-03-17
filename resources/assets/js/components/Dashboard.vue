<template>
	<div>
		<nav class="navbar">
			<div class="navbar-menu">
				<div class="navbar-end">
					<img class="navbar-item brand" src="css/images/bucc-logo.PNG" width="130" height="180" alt="BUCC">

					<span class="navbar-item">
						Signed In as: <span class="admin"> {{admin}} </span>
					</span>

					<span class="navbar-item">
						<a class="button is-dark is-outlined is-rounded" href="/admin-logout"> Sign Out</a>
					</span>

					
				</div>
			</div>
		</nav>
			

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
		props: ['link', 'admin'],
		data(){
			return{
				tabs: [
						{
							title: 'Students',
							subTabs: [
								{
									href: '/import', 
									text: 'Add Students',
									icon: 'fa fa-users',
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
							title: 'Analytics',
							subTabs: [
								{
									href: '/view-votes',
									text: 'View Results',
									icon: 'fa fa-bar-chart',
									selected: false
								},
								{
									href: '/view-breakdown',
									text: 'View Breakdown',
									icon: 'fa fa-line-chart',
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

	.navbar{
		border-bottom: 6px solid whitesmoke;
	}

	.brand{
		position: relative;
		left: -870px;
	}

	.fa{
		margin-right: 5px;
	}

	.menu-list a.is-active{
		background-color: #0a0a0a;
		color: white;
	}

	span.admin{
		margin: 5px 6px;
		padding: 1px;
		border-bottom: 3px solid black;
	}
</style>