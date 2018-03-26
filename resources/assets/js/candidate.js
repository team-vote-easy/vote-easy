require('./bootstrap');
window.Vue = require('vue');
window.Event = new Vue();
import Modal from './components/Modal.vue';
import Hero from './components/Hero.vue';
import Dashboard from './components/Dashboard.vue';
import LoadingModal from './components/LoadingModal.vue';

window.app = new Vue({
    el: '#root',
    data: {
        firstName: '',
        lastName: '',
        level: '',
        image: '',
        role: '',
        showModal: false,
        errors: {},
        success: '',
        loading: '',
        showHalls: '',
        hall: '',
        floor: ''
    },
    methods: {
        processFile(event){
            this.image = event.target.files[0];
            console.log(this.image);
        },

        submit: function(){
            self = this;

            this.loading = true;
            var formData = new FormData();
            formData.append('firstName', this.firstName);
            formData.append('lastName', this.lastName);
            formData.append('level', this.level);
            formData.append('position', this.role);
            formData.append('image', this.image, this.image.name);
            if(this.floor !== '' && this.hall != ''){
                formData.append('floor', this.floor);
                formData.append('hall', this.hall);
            }

            axios.post('/add-candidates', formData)
            .then((data)=>{
                console.log(data.data);
                this.loading = false;
                this.success = data.data;
                this.showModal = true;
                this.firstName = '';
                this.lastName = '';
                this.level = '';
                this.image = '';
                this.hall = '';
                this.floor = '';
                this.role = '';
                this.showHalls = '';                
            })
            .catch((error)=>{
                this.loading = false;
                console.log(error);
            });
        },

        handleChange(){
            if(this.role == 'Hall Senator'){
                this.showHalls = true;
            } else{
                this.showHalls = false;
            }
        }
    },
    components: {Modal, Hero, Dashboard, LoadingModal}
})


