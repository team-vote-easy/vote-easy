require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();
import VoteCard from './components/VoteCard.vue';
import Modal from './components/Modal.vue';

window.app = new Vue({
	el: '#root',
	data: {
		showModal: true,
		votedModal: false
	},
	created(){
		Event.$on('voted', (data)=>{
			this.votedModal = true;
		})
	},
	methods: {
		test: function(){
			
		}
	},
	components: {VoteCard, Modal},
})