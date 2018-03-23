require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();
import Modal from './components/Modal.vue';
import SideBar from './components/SideBar.vue';

window.app = new Vue({
	el: '#root',
	data: {
		showModal: true,
		votedModal: false,
		studentVote: {},
		currentView: '',
		candidatesData: [],
		count: 0,
		tabs: '',
		voted: false,
		incomplete: '',
		numOfPosts: '',
		numOfSentators: '',
		showNotDone: ''
	},
	created(){
		window.addEventListener('keydown', (e)=>{
			if(e.key=='ArrowLeft' || e.key=="ArrowUp"){
				console.log('Moved left!');
				this.prev();
				return;
			}

			if(e.key=='ArrowRight' || e.key=="ArrowDown"){
				console.log('Moved right!');
				this.next();
				return;
			}
		});

		const self = this;
		Event.$on('candidates', (candidates, senators, studentVote)=>{
			this.studentVote = studentVote;

			var keys = Object.keys(candidates);
			keys = keys.sort();
			this.numOfPosts = keys.length;
			
			keys.forEach((key)=>{
				//Remember to chunk the array into 3
				self.candidatesData[self.count] = {
					position: _.toUpper(_.startCase(key)),
					text: key,
					candidates: candidates[key]
				};
				self.count+=1;
			});

			if(senators != ''){
				var keys = Object.keys(senators);
				keys = keys.sort();
				keys.forEach((key)=>{
					self.candidatesData[self.count] = {
						position: _.toUpper(_.startCase(key)),
						text: key,
						candidates: senators[key]
					}
					self.count+=1;
				});
			}

			self.count = 0;
			this.tabs = self.candidatesData.length;
			self.currentView = self.candidatesData[0];
		});	


		Event.$on('menuClick', (index, candidateType)=>{
			if(candidateType=='Senator'){
				index+= self.numOfPosts;
			}

			self.count = index;

			this.currentView = this.candidatesData[index];
		});

		Event.$on('voted', ()=>{
			this.votedModal = true;
		})
	},
	methods: {

		getPath(image){
			return 'candidate-images/'+image;
		},

		vote(position, id){
			self = this;
			this.studentVote[position] = id;

			//Send Event to sidebar component to check if sidebar option has been selected
			Event.$emit('updateSideBar', self.studentVote);

			//Move to the next candidate
			_.delay(self.next, 500);	
		},

		prev(){
			//Check to ensure we don't go below the no of available posts
			if(this.count==0){
				return;
			}

			const self = this;
			this.count-=1;
			Event.$emit('menuChange', self.count);
			this.currentView = this.candidatesData[this.count];
		},

		next(){
			//Check to ensure we don't go above the no of available posts
			if(this.count == (this.tabs - 1)){
				return;
			}

			const self = this;
			this.count+=1;
			Event.$emit('menuChange', self.count);
			this.currentView = this.candidatesData[this.count];
		},

		isDone(){
			//Function to ensure all positions have been selected by the student
			var keys = Object.keys(this.studentVote);
			var incomplete = 0;
			keys.forEach((key)=>{
				if(this.studentVote[key]==''){
					incomplete+=1;
				}
			});

			if(incomplete>=1){
				this.incomplete = true;
				return true;
			}
			else{
				this.incomplete = false;
				return false;
			}
		},

		submitVotes(){
			if(this.incomplete){
				this.showNotDone = true;
				return;
			}
			self = this;

			axios.post('api/vote', this.studentVote)
			.then((data)=>{
				console.log(data);
				Event.$emit('voted');
				_.delay(self.redirect, 2000);
				
			})
			.catch((e)=>{
				console.log(e);
			})
		},

		redirect(){
			window.location.href="student-login";
		}
	},
	components: {Modal, SideBar},
})