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
        level: '',
        course: '',
        file: '',
        showModal: false,
        loading: '',
        errors: {},
        success: ''
    },
    methods: {
        processFile: function(event){
            this.file = event.target.files[0];
        },

        submit: function(){
            self = this;
            var formData = new FormData();
            if(this.level !== '' || this.course !== '' || this.file !== ''){
                formData.append('level', this.level);
                formData.append('course', this.course);
                formData.append('file', this.file, this.file.name);
            }
            else{
                this.errors.title = 'Missing field error'
                this.errors.message = 'Some fields are missing';
                this.showModal = true;
                console.log(this.errors);
                return;
            }

            this.loading = true;

            axios.post('/import', formData)
            .then(function(data){
                self.loading = false;
                self.level = '';
                self.course = '';
                self.file = '';
                self.success = data.data;
                self.showModal = true;
                console.log(data);
            })
            .catch(function(error){
                console.log(error);
                console.log('Na me the error');
                self.loading = false;
                self.errors.title = 'Student already exists!';
                self.errors.message = error.response.data.message;
                self.showModal = true;
            })
        }
    },
    components: {Modal, Hero, LoadingModal, Dashboard}
})


