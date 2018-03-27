require('./bootstrap');
import Hero from './components/Hero.vue';
import Chart from './components/Chart.vue';
import SenatorChart from './components/SenatorChart.vue';
import Dashboard from './components/Dashboard.vue';
import Modal from './components/Modal.vue';
import StatCard from './components/StatCard.vue';


window.Vue = require('vue');
window.Event = new Vue();
var app = new Vue({
	el: '#root',
	data: {
		hall: '',
		block: '',
		loading: '',
		candidates: '',
		uncomplete: '',
		empty: '',
		message: '',
		title: ''
	},
	methods: {
		fetchSenatorResults(){
			self = this;
			self.candidates = '';
			self.empty = '';
			self.message = '';

			if(this.block == '' || this.hall == ''){
				this.uncomplete = true;
				return;
			}

			this.loading = true;
			
			axios.post('/view-votes-senators', {hall: this.hall, block: this.block})
				.then((data)=>{
					self.loading = false;
					if(data.data==''){
						self.empty = true;
						Event.$emit('destroyChart');
						self.message = `Sorry! No results for ${self.block} Block senators in ${self.hall}`;
						return;
					}
					console.log(data.data[0]);
					self.title = `${self.hall} ${self.block} Hall Senator`;
					self.candidates = data.data;
					Event.$emit('candidates', self.candidates, self.title);
				})
				.catch((e)=>{
					self.loading = false;
					console.log(e);
				})
		}
	},
	components: {Hero, Chart, Dashboard, Modal, StatCard, SenatorChart}
});