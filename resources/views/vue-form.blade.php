<!DOCTYPE html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{csrf_token()}}">
<html>
<head>
	<title>A Vue Form</title>
	<link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
	<style type="text/css">
		.input{
			width: 400px;
			box-shadow: none;
		}
	</style>
</head>
<body>
	<div id="root">
		<form class="container" @submit.prevent="submit" @keydown="errors.clear($event.target.name)">

			<div class="field">
				<label class="label">First Name</label>
				<div class="control">
					<input type="text" name="first_name" class="input" placeholder="First Name" v-model="first_name">
					<span class="help is-danger"> @{{errors.get('first_name')}} </span>
				</div>
			</div>

			<div class="field">
				<label class="label">Last Name</label>
				<div class="control">
					<input type="text" name="last_name" class="input" placeholder="Last Name" v-model="last_name">
					<span class="help is-danger"> @{{errors.get('last_name')}} </span>
				</div>
			</div>

			<div class="field">
				<label class="label">Matric Number</label>
				<div class="control">
					<input type="text" name="matric_no" class="input" placeholder="Matric Number" v-model="matric_no">
					<span class="help is-danger"> @{{errors.get('matric_no')}} </span>
				</div>
			</div>

			<div class="field">
				<label class="label"> Course</label>
				<div class="control">
					<div class="select">
						<select name="course" v-model="course">
							<option disabled value="">Select a Course</option>
							@foreach($courses as $course)
								<option value="{{$course}}"> {{$course}} </option>
							@endforeach
						</select>
					</div>
					<span class="help is-danger" v-if="!course"> @{{errors.get('course')}} </span>
				</div>
			</div>

			<div class="field">
				<label class="label"> Level</label>
				<div class="control">
					<div class="select">
						<select name="level" v-model="level">
							<option disabled value="">Select a Level</option>
							@foreach($levels as $level)
								<option value="{{$level}}"> {{$level}} </option>
							@endforeach
						</select>
					</div>
					<span class="help is-danger" v-if="! level"> @{{errors.get('level')}} </span>	
				</div>
			</div>

			<div class="field">
				<label class="label">Password</label>
				<div class="control">
					<input type="password" name="password" class="input" placeholder="Password" v-model="password">
					<span class="help is-danger"> @{{errors.get('password')}} </span>
				</div>
			</div>

			<div class="field">
				<div class="control">
					<input type="submit" name="submit" class="button is-danger is-rounded" value="Create Student" :disabled="errors.any()">
				</div>
			</div>

		</form>
	</div>
</body>
</html>

<script src="js/app.js"></script>