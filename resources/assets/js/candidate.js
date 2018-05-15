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
        block: '',
        incomplete: ''
    },
    methods: {
        processFile(event){
            this.image = event.target.files[0];
            console.log(this.image);
        },

        submit: function(){
            var incomplete = 0;
            var fields = ["firstName", "lastName", "level", "role", "level", "image"];
            fields.forEach((field)=>{if(this._data[field]=='')incomplete+=1});
            if(incomplete>0){
                this.incomplete = true;
                this.showModal =true;
                return;
            }

            self = this;
            this.loading = true;
            var formData = new FormData();
            formData.append('firstName', this.firstName);
            formData.append('lastName', this.lastName);
            formData.append('level', this.level);
            formData.append('position', this.role);
            formData.append('image', this.image, this.image.name);
            formData.append('hall', this.hall);
            if(this.block !== ''){
                formData.append('block', this.block);
            }

            axios.post('/add-candidates', formData)
            .then((data)=>{
                this.loading = false;
                this.success = data.data;
                this.showModal = true;
                this.firstName = '';
                this.lastName = '';
                this.level = '';
                this.image = '';
                this.hall = '';
                this.block = '';
                this.role = '';
                this.showHalls = '';                
            })
            .catch((error)=>{
                this.loading = false;
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


