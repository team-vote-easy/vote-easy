<template>
	<div class="column">
		<div class="card">
		  <div class="card-content">
		    <p class="title">
		      {{student.first_name}} {{student.last_name}}
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
		  </footer>
		</div>
	</div>
</template>

<script>
	export default{
		props: {
			student: {required: true}
		},
		data(){
			return {

			}
		},
	}
</script>