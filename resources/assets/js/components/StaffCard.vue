<template>
	<div>
		<div v-if="staffs" class="columns staff-card" v-for="(staffSet, key) in staffs" :key="key">
			<div class="column is-5" v-for="staff in staffSet">
				<div class="card">
					<div class="card-content">
				    	<p class="title">
				      		{{staff.first_name + ' ' + staff.last_name}} 
				    	</p>
				  	</div>
				  	<footer class="card-footer">
				    	<p class="card-footer-item">
				      		<span>
				        		{{staff.hall}}
				      		</span>
				    	</p>

				    	<p class="card-footer-item">
				    		{{staff.phone}}
				    	</p>

				    	<p class="card-footer-item username">
				    		{{staff.username}}
				    	</p>

				    	<p class="card-footer-item password">
				    		{{staff.key}}
				    	</p>
				  	</footer>
				</div>
			</div>
		</div>

		<h1 v-if="empty">Sorry no staff yet!</h1>
	</div>

</template>


<script>
	import axios from 'axios';
	import _ from 'lodash';

	export default{
		data(){
			return{
				staffs: '',
				empty: ''
			}
		},
		created(){
			self = this;
			axios.post('/view-staff')
				.then((data)=>{
					if(data.data==''){
						self.empty = true;
						return;
					}
					self.staffs = _.chunk(data.data, 2);
				})
				.catch((e)=>{
					console.log(e);
				});
		},
		methods: {

		}
	}


</script>