<template>
	<div>
		<nav class="navbar">
			<div class="navbar-menu">
				<div class="navbar-end">
					<img class="navbar-item brand" src="/css/images/bucc-logo.PNG" width="130" height="180" alt="BUCC">
					
					<span class="navbar-item">
						Signed In as: <span class="admin"> {{staff}} </span>
					</span>

					<span class="navbar-item">
						<a class="button is-dark is-outlined is-rounded" href="/staff/logout"> Sign Out</a>
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
		props: ['link', 'staff'],
		data(){
			return{
				tabs: [
						{
							title: 'Students',
							subTabs: [
								{
									href: '/staff/home',
									text: 'Fetch Student',
									icon: 'fa fa-search',
									selected: false
								}
							]
						},
						{
							title: 'Analytics',
							subTabs: [
								{
									href: '/staff/view-breakdown',
									text: 'View Breakdown',
									icon: 'fa fa-line-chart',
									selected: false
								}
							]
						},
						{
							title: 'Server',
							subTabs: [
								{
									href: '/staff/push-to-server',
									text: 'Push To Server',
									icon: 'fa fa-server',
									selected: false
								}
							]
						},
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
	.menu{
		position: fixed;
		top: 100px;
	}

	.navbar{
		border-bottom: 6px solid whitesmoke;
	}

	.brand{
		position: relative;
		left: -880px;
	}

	.fa{
		margin-right: 5px;
	}

	.menu-list a.is-active{
		background-color: #00d1b2;
		color: white;
	}

	span.admin{
		margin: 5px 6px;
		padding: 1px;
		border-bottom: 3px solid black;
	}

</style>