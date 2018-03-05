<template>
  	<div class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-content load">
      	<i class="fa fa-spinner fa-spin load"></i>
      	<br/> <span class="loadText"> {{content}}</span>
      </div>
    </div>
</template>


<script>
	export default{
		props: ['content']
	}
</script>

<style>
	.load{
		color: white;
		font-size: 80px;
		text-align: center;
	}

	.loadText{
		font-size: 50px;
	}
</style>

