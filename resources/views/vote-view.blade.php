<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<head>
	<title>BUCC Vote</title>
	<link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
	<link rel="stylesheet" type="text/css" href="css/font awesome/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/vote-view.css">
</head>
<body>
	<ul class="nav-ting">
		<li><h3> Hey <strong> {{$firstName}} </strong>!  {{$emojis[array_rand($emojis)]}} </h3></li>
	</ul>
	
	<div id="root" v-cloak>
		<div class="container">
			<h1>@{{currentView.position}}</h1>
			<div class="columns">
				<side-bar > </side-bar>
					<div v-for="candidate in currentView.candidates" class="column is-3">
						<div class="card">
							<div class="card-image">
								<figure class="image is-4by3">
									<img :src="getPath(candidate.image)" alt="Candidate Image">
								</figure>
						  	</div>
						  	<div class="card-content">
								<p class="title">
							  		@{{candidate.first_name}} @{{candidate.last_name}}
								</p>
						  	</div>
						  	<footer class="card-footer">
								<p class="card-footer-item">
							  		<span>
										@{{candidate.position}}
							  		</span>
								</p>
								<p class="card-footer-item">
							  		<span>
										@{{candidate.course}}
						  			</span>
								</p>
								<p class="card-footer-item">
									@{{candidate.level}}
								</p>
					 	 	</footer>

						  	<footer>
								<a href="#" class="button vote " @click.prevent="vote(currentView.position, candidate.id)"> 
									<span class="icon">
								  		<i :class="[studentVote[makeCamel(candidate.position)] == candidate.id  ? 'fa fa-heart votedIcon animated wobble' :' fa fa-heart-o voteIcon' ]"></i>
									</span>
								</a>
						  	</footer>
						</div>
					</div>
			</div>

			<div>
				<a href="#" @click.prevent="prev" class="button is-danger prev" :disabled="count==0">Previous</a>
				<a href="#" @click.prevent="submitVotes" class="button is-primary done" :disabled="isDone()">Done</a>
				<a href="#" @click.prevent="next" class="button is-danger next" :disabled="count>=5">Next</a>
			</div>

		</div>

		<div>
			<modal v-if="votedModal" :green="true" @close="votedModal = false"> 
				Thanks for voting {{$firstName}} {{$emojis[1]}} ! 
			</modal>
		</div>
		
	</div>

</body>
</html>

<script type="text/javascript" src="js/student.js"></script>