require('./bootstrap');
import Modal from './components/Modal.vue';
import Dashboard from './components/Dashboard.vue';
import LoadingModal from './components/LoadingModal.vue';
window.Vue = require('vue');
window.Event = new Vue();

window.app = new Vue({
	el: '#root',
	data: {
		firstName: '',
		lastName: '',
		hall: '',
		username: '',
		phone: '',
		loading: '',
		showModal: '',
		success: '',
		error: ''
	},
	methods: {
		submit(){
			self = this;
			self.success = '';
			self.showModal = '';
			self.error = '';
			var incomplete = 0;
			var dataFields = ['firstName', 'lastName', 'hall', 'username', 'phone'];
			dataFields.forEach((data)=>{
				if(this._data[data]==''){
					incomplete+=1;
				}
			});

			if(incomplete>0){
				console.log('Plese Select all Fields!');
			}
			else{
				axios.post('/add-staff', {
					firstName: self.firstName,
					lastName: self.lastName,
					hall: self.hall,
					username: self.username,
					phone: self.phone
				})
				.then((data)=>{
					self.firstName= '';
					self.lastName= '';
					self.hall= '';
					self.username= '';
					self.phone= '';
					self.loading= '';
					self.showModal= '';
					self.success= '';
					self.error= '';
					self.showModal = true;
					self.success = data.data;
				})	
				.catch((e)=>{
					self.showModal = true;
					self.error = e.response.data;
				})
			}
			
		}
	},
	components: {Modal, Dashboard, LoadingModal}
});