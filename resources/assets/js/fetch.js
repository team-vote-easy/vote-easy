require('./bootstrap');
window.Vue = require('vue');
window.Event = new Vue();
import Modal from './components/Modal.vue';
import StudentCard from './components/StudentCard.vue';
import StatCard from './components/StatCard.vue';
import Hero from './components/Hero.vue';
import Dashboard from './components/Dashboard.vue';
import LoadingModal from './components/LoadingModal.vue';

window.app = new Vue({
    el: '#root',
    data: {
        level: '',
        course: '',
        hall: '',
        matricNumber: '',
        students: '',
        studentDetails: '',
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
            axios.post('/fetch-hall', {
                hall: this.hall,
            })
            .then((data)=>{
                console.log(data);

                
                self.loading = false;
                if(data.data.students==''){
                    this.message = 'Sorry... there are no students that satisfy your query';
                    this.empty = true;
                    return;
                }


                this.students = _.chunk(data.data.students, 3);
                this.message = data.data.message;
                this.empty = false;
                console.log(this.students);
            })
            .catch((error)=>{
                console.log(error);
            });
        },

        fetchStudent: function(){
            self = this;
            this.loading = true;
            this.studentDetails = '';
            this.message = '';

            axios.post('/fetch-student', {
                matricNumber: this.matricNumber
            })
            .then((data)=>{
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
                console.log(e);
            });
        }
    },
    components: {Modal, StudentCard, StatCard, Hero, LoadingModal, Dashboard}
})


