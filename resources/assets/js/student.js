require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();
import VoteCard from './components/VoteCard.vue';

window.app = new Vue({
	el: '#root',
	methods: {
		test: function(){
			
		}
	},
	components: {VoteCard}
})