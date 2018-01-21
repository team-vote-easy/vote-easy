<template>
	<div class="card" :class="[empty ? 'empty animated shake' : 'exists animated bounce']">
	  <div class="card-content">
	    <p class="title">
	      {{message}}
	    </p>
	  </div>
	</div>
</template>

<script>
	export default{
		props: ['message', 'empty'],
		data(){
			return {

			}
		},
	}
</script>