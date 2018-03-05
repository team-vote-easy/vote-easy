<template>
	<div>
        <hero :link="'/add-posts'"> </hero>

        <div class="container box">
            <form method="POST" action="/import" enctype="multipart/form-data" class="container form" @submit.prevent="submit">
                <h1>ADD POSTS</h1>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label">Post: </label>
                    </div>
                    <div class="field-body">

                        <div class="field">
                            <div class="control is-expanded">
                                <input type="text" name="post" class="input" placeholder="Post" v-model="post">
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="field">
                    <div class="control">
                      <input type="submit" name="Submit" value="Submit" class="button is-primary is-medium" :disabled="filled()">  
                    </div>
                </div>
            </form>

            <modal v-if="showModal && errors" @close="showModal = false; errors=''" :green="false">
                {{errors}}
            </modal>

            <modal v-if="showModal && success" @close="showModal = false; success='' " :green="true">
              <p>  {{success}} </p>
            </modal>
        </div>
    </div>
</template>

<script>
	import Hero from './Hero.vue';
	import Modal from './Modal.vue';
	export default{
		props: [],
		data(){
			return{
				post: '',
				success: '',
				errors: '',
				showModal: ''
			}
		},
		methods: {
			submit(){
				self = this;
				console.log(self.post);
				axios.post('/add-posts', {
					post: self.post
				})
					.then((data)=>{
						self.showModal = true;
						self.success = data.data;
						self.post = ''
						console.log(data);
					})
					.catch((e)=>{
						var errorCode = e.response.status;
						if(errorCode == 513){
							self.showModal = true;
							self.post = '';
							self.errors = e.response.data;
						}
						else{
							console.log(e)
						}
					});
			},
			filled(){
				if(this.post==''){
					return true;
				}

				if(this.post!=''){
					return false;
				}
			}
		},
		components: {Hero, Modal}
	}
</script>

<style>
	p{
		font-family: Montserrat;
	}
</style>