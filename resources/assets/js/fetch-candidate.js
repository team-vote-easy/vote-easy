require('./bootstrap');
window.Vue = require('vue');
window.Event = new Vue();
import Dashboard from './components/Dashboard.vue';
import LoadingModal from './components/LoadingModal.vue';
import StatCard from './components/StatCard.vue';

window.app = new Vue({
    el: '#root',
    data: {
        levelData: '',
        roleData: '',
        loading: '',
        message: '',
        candidates: '',
        message: '',
        empty: false,
        hallArray: ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Kings Delight Hall", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Marigold", "FAD", "Off-Campus", "All"],
        floorArray: ["Ground Floor (GF)", "First Floor (FF)", "Second Floor (SF)", "Third Floor (TF)", "All"],
        levelArray: [100, 200, 300, 400, "All"],
        positionArray: ["PRO", "President", "Vice President", "Chaplain", "Sports Director", "Social Director", "Hall Senator", "All"],
        hall: '',
        floor: '',
        showHalls: '',
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
                hall: this.hall,
                floor: this.floor
            })
            .then((data)=>{
                console.log(data.data);
                self.loading = '';
                if(data.data.length == 0 ){
                    self.empty = true;
                    self.message = "Sorry no candidates match your query";
                    return;
                }

                self.candidates = _.chunk(data.data, 2);
                console.log(data)
            })
            .catch((e)=>{
                console.log(e);
            });
        },
        getPath(image){
            return 'candidate-images/'+image;
        },
        handleChange(){
            if(this.roleData == 'Hall Senator'){
                this.showHalls = true;
            } else{
                this.showHalls = '';
            }
        }
    },
    components: {StatCard, Dashboard, LoadingModal}
})


