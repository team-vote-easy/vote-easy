el: '#app',
    data: {
    	matric: '',
    	name: null,
    	active: 'active',
    	red: false,
    	Montserrat: 'Montserrat'
    },
    watch: {
    	matric: function(){
    		this.name='Fetching...';
    		this.fetchStudent();
    		this.active = true;
    	}
    },
    methods: {
    	fetchStudent: _.debounce(function(){
    		if(! /\d\d(\/)\d*/.test(this.matric)){
    			this.name = 'Enter a valid matric number';
    			return;
    		}
    		this.name="Fetching matric number: "+this.matric;
    		let self = this;
    		axios.post('/vue-test', {
    				matric: this.matric
    			})
    			.then(function(data){
    				student = data.data;
    				if(!student.first_name){
    					self.name='No Students have this matric number!';
    					return;
    				}
    				self.name = _.toUpper(student.first_name+' '+student.last_name);
    				console.log(student);
    				return student;
    			})
    			.catch(function(error){
    				alert(error);
    			});
    	}, 500),
    }