<template>
	<div v-if="isActive"> <slot> </slot> </div>
</template>

<script>
	export default {
		props: {
	        name: {required: true},
	        selected: false
	    },
	    data(){
	        return{
	            isActive: false
	        }
	    },
	    computed: {
	        href(){
	            return this.name.toLowerCase().replace(/ /g, '-');
	        }
	    },
	    mounted(){
	        this.isActive = this.selected;
	        
	    }
	}
</script>