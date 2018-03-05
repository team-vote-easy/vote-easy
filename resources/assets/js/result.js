require('./bootstrap');
import Hero from './components/Hero.vue';
import ResultCard from './components/ResultCard.vue';
import Chart from './components/Chart.vue';
import Dashboard from './components/Dashboard.vue';

window.Vue = require('vue');
window.Event = new Vue();
var app = new Vue({
	el: '#root',
	data: {

	},
	components: {Hero, ResultCard, Chart, Dashboard}
});