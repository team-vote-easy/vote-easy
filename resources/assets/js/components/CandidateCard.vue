<template>
	<div class="columns">
		<div v-for="candidate in candidates" class="column is-3">
			<div class="card">
			  <div class="card-image">
			    <figure class="image is-4by3">
			      <img :src="getPath(candidate.image)" alt="Candidate Image">
			    </figure>
			  </div>
			  <div class="card-content">
			    <p class="title">
			      {{candidate.first_name}} {{candidate.last_name}}
			    </p>
			  </div>
			  <footer class="card-footer">
			  	<p class="card-footer-item">
			      <span>
			        {{candidate.position}}
			      </span>
			    </p>
			    <p class="card-footer-item">
			      <span>
			        {{candidate.course}}
			      </span>
			    </p>
			    <p class="card-footer-item">
			    	{{candidate.level}}
			    </p>
			  </footer>
			</div>
		</div>
	</div>
	
</template>

<script>
	export default{
		data(){
			return{
				image: '../../../../public/images/Tony_Kellogs.jpg'
			}
		},
		props: {
			candidates: {required: true}
		},
		methods: {
			getPath(image){
				return require('../../../../public/candidate-images/'+image);
			}
		}
	}
</script>

<style>
	.card{
		width: 400px;
	}

	/*.card-image{
		width: 400px;
	}*/
	.title{
		height: 55px;
	}

	.card-content{
		text-align: center;
	}
	.card-footer-item{
		height: 80px;
		text-align: center;
	}
</style>