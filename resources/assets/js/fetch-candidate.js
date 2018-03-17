require('./bootstrap');
window.Vue = require('vue');
window.Event = new Vue();
import Dashboard from './components/Dashboard.vue';
import LoadingModal from './components/LoadingModal.vue';
import StatCard from './components/StatCard.vue';

window.app = new Vue({
    el: '#root',
    data: {
        courseData: '',
        levelData: '',
        roleData: '',
        loading: '',
        message: '',
        candidates: '',
        message: '',
        empty: false,
        courseArray: ["Computer Science", "Computer Technology", "Computer Information Systems", "All"],
        levelArray: [100, 200, 300, 400, "All"],
        positionArray: ["PRO", "President", "Vice President", "Chaplain", "Sports Director", "Social Director", "All"]
    },
    methods: {
       fetchCandidate: function(){
            self = this;
            this.loading = true;
            this.message = '';
            this.empty = false;
            this.candidates = '';

            axios.post('fetch-candidates', {
                position: this.roleData,
                level: this.levelData,
                course: this.courseData
            })
            .then((data)=>{
                self.loading = '';
                if(data.data.length == 0 ){
                    self.empty = true;
                    self.message = "Sorry no candidates match your query";
                    return;
                }

                self.candidates = _.chunk(data.data, 3);
                console.log(data)
            })
            .catch((e)=>{
                console.log(e);
            });
        },
        getPath(image){
            return 'candidate-images/'+image;
        }
    },
    components: {StatCard, Dashboard, LoadingModal}
})


