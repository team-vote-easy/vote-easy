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
        blockArray: ["First Floor", "Second Floor", "Third Floor", "A", "B", "C", "D", "E", "F", "G", "H"],
        levelArray: [100, 200, 300, 400, "All"],
        positionArray: ["PRO", "President", "Vice President", "Chaplain", "Director of Sports", "Director of Social", "General Secretary", "Director of Transport", "Treasurer", "Director of Finance", "Director of Welfare", "Senate President", "Sargent At Arms", "Assistant Gen Secretary", "Senator Chief Whip", "Deputy Senate President", "Senate Scribe", "Hall Senator", "All"],
        hall: '',
        block: '',
        showHalls: '',
    },
    created(){
        this.levelArray = this.levelArray.sort();
        this.positionArray = this.positionArray.sort();
        this.hallArray = this.hallArray.sort();
        this.blockArray = this.blockArray.sort();
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
                block: this.block
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


