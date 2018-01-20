require('./bootstrap');

window.Vue = require('vue');

window.Event = new Vue();

import Modal from './components/Modal.vue';
import Tab from './components/Tab.vue';
import Tabs from './components/Tabs.vue';
import Errors from './helpers/error.js';

// var app = new Vue({
//     el: '#app',
//     data: {
//         showModal: false
//     },
//     components: {Modal, Tab, Tabs}
// });



var ting = new Vue({
    el: '#root',
    data: {
        first_name: '',
        last_name: '',
        matric_no: '',
        level: '',
        course: '',
        password: '',
        errors: new Errors()
    },
    methods: {
        submit: function(){
            self = this;
            axios.post('vue-form', this._data)
                .then(function(data){
                    console.log(data);
                })
                .catch(function(e){
                    self.errors.record(e.response.data.errors);
                });
        }
    }

});


