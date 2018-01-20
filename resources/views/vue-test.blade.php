<!DOCTYPE html>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<html>
<head>
	<title>Vue Tests</title>
	<link rel="stylesheet" type="text/css" href="css/bulma-0.6.2/css/bulma.css">
</head>
<body>
	<div id="app" class="container">
		<tabs>
			<tab name="Our Vision" :selected="true"> 
				<h1>THis is our Vision</h1>
			</tab>

			<tab name="Our Culture"> 
				<h1>THis is our Culture</h1>
			</tab>

			<tab name="Our Mission"> 
				<h1>THis is our Mission</h1>
			</tab>
		 </tabs>

		<modal v-if="showModal" @close="showModal = false"> 
			<template slot="title">to pimp a butterfly.</template>
				
			<div slot="footer">
				<button class="button is-success">Save changes</button>
              	<button class="button">Cancel</button>
			</div>

		</modal>

		<button @click="showModal = true">Click Me!</button>		

	</div>
</body>
</html>

<script type="text/javascript" src="js/app.js"></script>