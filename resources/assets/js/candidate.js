require('./bootstrap');
window.Vue = require('vue');
window.Event = new Vue();
import Modal from './components/Modal.vue';
import Hero from './components/Hero.vue';
// import FetchCandidates from './components/FetchCandidates.vue';
import AddPost from './components/AddPost.vue';
import Dashboard from './components/Dashboard.vue';
import LoadingModal from './components/LoadingModal.vue';

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
        success: '',
        loading: ''
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
            formData.append('course', this.course);
            formData.append('position', this.role);
            formData.append('image', this.image, this.image.name);
            

            axios.post('/add-candidates', formData)
            .then((data)=>{
                this.loading = false;
                this.success = data.data;
                this.showModal = true;
                
            })
            .catch((error)=>{
                this.loading = false;
                console.log(error);
            });
        }
    },
    components: {Modal, Hero, AddPost, Dashboard, LoadingModal}
})


