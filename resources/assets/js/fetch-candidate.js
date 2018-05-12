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
        hallArray: ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Neal Wilson", "Nyberg", "Ogden", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Felicia Adebisi Dada (FAD)", "Queen Esther", "Off-Campus", "Ameyo Adadevoh", "Gamaliel", "Havilah Gold", "Justice Deborah", "All"],
        blockArray: ["GF", "FF", "TF", "SF", "A", "B", "C", "D", "E", "F", "G", "H", "100", "200", "300", "400"],
        levelArray: [100, 200, 300, 400, "All"],
        positionArray:  ["President", "Vice President (Main)", "Vice President (Iperu)", "General Secretary", "Assistant General Secretary", "Treasurer", "Director of Financial Records", "Director of Public Relations (Main)", "Director of Public Relations (Iperu)", "Director of Socials (Main)", "Director of Socials (Iperu)", "Director of Sports (Main)", "Director of Sports (Iperu)", "Director of Transport and Ventures (Main)", "Director of Transport and Ventures (Iperu)", "Director of Welfare (Main)", "Director of Welfare (Iperu)", "Sergeant At Arms", "Chaplain", "Hall Senator"],
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


