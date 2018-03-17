<template>
	<div class="columns">
		<div v-for="student in students" class="column is-4">
			<div class="card">
			  <div class="card-content">
			    <p class="title">
			      {{student.name}} 
			    </p>
			  </div>
			  <footer class="card-footer">
			    <p class="card-footer-item">
			      <span>
			        {{student.matric_no}}
			      </span>
			    </p>
			    <p class="card-footer-item">
			      <span>
			        {{student.course}}
			      </span>
			    </p>
			    <p class="card-footer-item">
			    	{{student.level}}
			    </p>

			    <p class="card-footer-item">
			    	{{student.hall}}
			    </p>

			    <!-- <p class="card-footer-item">
			    	<strong> Password: </strong> &nbsp;&nbsp;&nbsp;&nbsp; <span class="password"> {{student.key}} </span>
			    </p> -->
			  </footer>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		props: {
			students: {required: true}
		},
		data(){
			return {

			}
		},
		methods: {
			normalizeName(){
				
			}
		}
	}
</script>

<style>
	.password{
		border-bottom: 3px solid #00d1b2;

	}
</style>