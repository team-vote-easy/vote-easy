require('./bootstrap');
window.Vue = require('vue');
window.Event = new Vue();
import Modal from './components/Modal.vue';
import FetchCandidates from './components/FetchCandidates.vue'

window.app = new Vue({
    el: '#root',
    data: {
        firstName: '',
        lastName: '',
        level: '',
        course: '',
        image: '',
        role: '',
        showModal: false,
        errors: {},
        success: ''
    },
    methods: {
        processFile(event){
            this.image = event.target.files[0];
            console.log(this.image);
        },

        submit: function(){
            var formData = new FormData();
            formData.append('firstName', this.firstName);
            formData.append('lastName', this.lastName);
            formData.append('level', this.level);
            formData.append('course', this.course);
            formData.append('position', this.role);
            formData.append('image', this.image, this.image.name);
            

            axios.post('/add-candidates', formData)
            .then((data)=>{
                console.log(data);
                this.success = data.data;
                this.showModal = true;
                
            })
            .catch((error)=>{
                console.log(error);
            });
        }
    },
    components: {Modal, FetchCandidates}
})


