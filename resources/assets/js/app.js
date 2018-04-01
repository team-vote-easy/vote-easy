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
        hall: '',
        block: '',
        file: '',
        showModal: false,
        loading: '',
        errors: {},
        success: '',
        firstName: '',
        lastName: '',
        matricNumber: ''
    },
    methods: {
        processFile: function(event){
            this.file = event.target.files[0];
        },

        submit: function(){
            self = this;
            var formData = new FormData();

            if(this.file !== '' && this.hall !== ''){
                formData.append('hall', this.hall);
                formData.append('file', this.file, this.file.name);
            }
            else{
                this.errors.title = 'Missing field error'
                this.errors.message = 'Oops... Some fields are missing';
                this.showModal = true;
                console.log(this.errors);
                return;
            }

            this.loading = true;

            axios.post('/import', formData)
            .then(function(data){
                var response = data.data;
                self.loading = false;
                self.file = '';
                self.hall = '';
                self.showModal = true;
                self.success=`Successfully added ${response.addedStudents} students in ${response.hall}. Skipped ${response.skippedStudents} students. ${response.duplicates.length} duplicate students were found`;
            })
            .catch(function(error){
                var duplicateStudents = error.response.data.duplicates;
                self.loading = false;
                self.errors.message = `Sorry duplicate students were found! Please recheck excel file`;
                self.showModal = true;
            })
        },

        addStudent: function(){
            self = this;
            if(this.firstName != '' && this.lastName !='' && this.matricNumber !='' && this.hall != ''){
                self.loading = true;
                axios.post('/add-student', {
                    firstName: self.firstName,
                    lastName: self.lastName,
                    matricNumber: self.matricNumber,
                    hall: self.hall,
                    block: self.block
                })
                    .then((data)=>{
                        var studentName = self.firstName + ' ' + self.lastName;
                        self.loading = false;
                        self.firstName = '';
                        self.lastName = '';
                        self.matricNumber = '';
                        self.hall = '';
                        self.block = '';
                        self.success = `Successfully Added Student: ${studentName}`;
                        self.showModal = true;
                    })
                    .catch((e)=>{
                        self.loading = false;
                        self.errors.message = `Sorry! The matric number already belongs to a student`;
                        self.showModal = true;
                    })

            }
            else{
                console.log('some fields are missing');
            }
        }
    },
    components: {Modal, Hero, LoadingModal, Dashboard}
})


