<template>
	<div>
        <div class="tabs">
            <ul> 
                <li v-for="tab in tabs" :class="{'is-active' : tab.isActive}"> 
                    <a :href="tab.href" @click.prevent="selectTab(tab)"> {{tab.name}}  </a>
                </li>
            </ul>
        </div>

        <div class="tab-details">
            <slot> </slot>
        </div>
    </div>
</template>

<script>
	export default{
		data(){
	        return{
	            tabs: [],
	        }
	    },
	    created(){
	        this.tabs = this.$children;
	        Event.$on('hey', function(){
	        	console.log('Got the event!');
	        })
	    },
	    methods: {
	        selectTab: function(selectedTab){
	            this.tabs.forEach(tab=>{
	                tab.isActive = (tab.name==selectedTab.name);
	            });
	        }
	    }
	}
</script>