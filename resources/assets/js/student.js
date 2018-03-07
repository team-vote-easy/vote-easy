require('./bootstrap');

window.Vue = require('vue');
window.Event = new Vue();
// import VoteCard from './components/VoteCard.vue';
import Modal from './components/Modal.vue';
import SideBar from './components/SideBar.vue';

window.app = new Vue({
	el: '#root',
	data: {
		showModal: true,
		votedModal: false,
		studentVote: {
			president: '',
			vicePresident: '',
			pro: '',
			chaplain: '',
			socialDirector: '',
			sportsDirector: '',
		},
		currentView: '',
		candidatesData: [],
		count: 0,
		voted: false
	},
	created(){
		const self = this;
		/* API Call to fetch candidates for client-side rendering*/
		axios.get('/api/candidates')
			.then((data)=>{
				var candidates = data.data;
				var keys = Object.keys(candidates);

				keys.forEach((key)=>{
					//Remember to chunk the array into 3
					self.candidatesData[self.count] = {
						position: _.toUpper(_.startCase(key)),
						candidates: candidates[key]
					};
					self.count+=1;
				});

				self.count = 0;

				self.currentView = self.candidatesData[0];
			})
			.catch((e)=>{
				console.log(e);
			});

		/*Event Handler for when a menu change event occurs */
		Event.$on('menuChange', (index)=>{
			self.count = index;
			self.currentView = self.candidatesData[self.count];
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
			this.studentVote[_.camelCase(position)] = id;

			//Send Event to sidebar component to check if sidebar option has been selected
			Event.$emit('updateSideBar', self.studentVote);

			//Move to the next candidate
			_.delay(self.next, 1000);	
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
			if(this.count==5){
				return;
			}

			const self = this;
			this.count+=1;
			Event.$emit('menuChange', self.count);
			this.currentView = this.candidatesData[this.count];
		},

		makeCamel(toCamelString){
			return _.camelCase(toCamelString);
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
				return true;
			}
			else{
				return false;
			}
		},

		submitVotes(){
			self = this;
			var voteData = new FormData();
			voteData.append('president', this.studentVote.president);
			voteData.append('vice_president', this.studentVote.vicePresident);
			voteData.append('pro', this.studentVote.pro);
			voteData.append('chaplain', this.studentVote.chaplain);
			voteData.append('social_director', this.studentVote.socialDirector);
			voteData.append('sports_director', this.studentVote.sportsDirector);
			axios.post('api/vote', voteData)
			.then((data)=>{
				console.log(data);
				Event.$emit('voted');
				_.delay(self.redirect, 4000);
				
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