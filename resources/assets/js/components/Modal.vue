<template>
  	<div class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-content">
          <div class="box animated shake notification" :class="[green ? 'is-primary' : 'is-danger']" style="text-align: center; font-size: 20px">
            <slot> </slot>
          </div>
      </div>
      <button class="modal-close is-large" aria-label="close" @click="close"></button>
    </div>
</template>

<script>
	export default{
		methods: {
	        close(){
	            this.$emit('close');
	        }
    },
    props: ['green']
	}
</script>

