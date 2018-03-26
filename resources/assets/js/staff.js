require('./bootstrap');
import Modal from './components/Modal.vue';
import Dashboard from './components/Dashboard.vue';
import LoadingModal from './components/LoadingModal.vue';
import StaffCard from './components/StaffCard.vue';
import StaffDashboard from './components/StaffDashboard.vue';
import StatCard from './components/StatCard.vue';
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
		error: '',
		matricNumber: '',
		studentDetails: '',
		message: '',
		empty: ''
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
		},
		fetchStudent(){
            self = this;
            this.loading = true;
            this.studentDetails = '';
            this.message = '';

            axios.post('/staff/fetch-student', {
                matricNumber: this.matricNumber
            })
            .then((data)=>{
            	console.log(data);
                self.loading = '';
                if(Object.keys(data.data).length === 0){
                    self.message = 'Sorry... there are no students that satisfy your query';
                    self.empty = true;
                    return;
                }
                self.studentDetails = data.data;
                self.empty = false;
            })
            .catch((e)=>{
            	self.loading = '';
            	self.message = 'Seems like the server is down!';
                self.empty = true;
                console.log(e);
            });
        },
        pushServer(){
        	console.log('🚀');
        	// axios.post('/staff/push-to-server')
        }
	},
	components: {Modal, Dashboard, LoadingModal, StaffCard, StaffDashboard, StatCard}
});