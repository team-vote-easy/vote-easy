require('./bootstrap');
window.Vue = require('vue');
window.Event = new Vue();
import Modal from './components/Modal.vue';
import StudentCard from './components/StudentCard.vue';
import StatCard from './components/StatCard.vue';

window.app = new Vue({
    el: '#root',
    data: {
        level: '',
        course: '',
        showModal: false,
        errors: {},
        students: '',
        empty: '',
        message: '',
        loading: false
    },
    methods: {
        submit: function(){
            this.loading = true;
            this.message = '';
            this.students = '';

            self = this;
            axios.post('/fetch-course', {
                level: this.level,
                course: this.course
            })
            .then((data)=>{
                self.loading = false;

                if(data.data.students==''){
                    this.message = 'Sorry... there are no students for your query';
                    this.empty = true;
                    return;
                }
                this.students = data.data.students;
                this.message = data.data.message;
                this.empty = false;
                console.log(data)
            })
            .catch((error)=>{
                console.log(error);
            });
        }
    },
    components: {Modal, StudentCard, StatCard}
})


