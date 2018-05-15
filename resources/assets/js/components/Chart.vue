<template>
	<div>
		<div v-for="key in keys" class="charts box" :id="key" style="height: 550px; width: 100%;"> </div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				keys: [ "President", "Vice President (Main)", "Vice President (Iperu)", "General Secretary", "Assistant General Secretary", "Treasurer", "Director of Financial Records", "Director of Public Relations (Main)", "Director of Public Relations (Iperu)", "Director of Socials (Main)", "Director of Socials (Iperu)", "Director of Sports (Main)", "Director of Sports (Iperu)", "Director of Transport and Ventures (Main)", "Director of Transport and Ventures (Iperu)", "Director of Welfare (Main)", "Director of Welfare (Iperu)", "Sergeant At Arms", "Chaplain"
					]
			}
		},
		created(){
			this.fetchVotes();
		},
		methods: {
			fetchVotes(){
				self = this;
				axios.get('api/get-votes')
					.then((data)=>{
						var posts = data.data;
						var keys = Object.keys(posts);	
						keys.forEach((k)=>{
							self.renderChart(posts[k]);
						});	
					})
					.catch((e)=>{
						console.log(e);
					});
			},

			renderChart(candidate){
				var candidateItems = new Array();

				candidate.candidates.forEach((c)=>{
					candidateItems.push({ 
						name: (c.first_name + ' ' + c.last_name), 
						y: (c.votes === null ? 0 : c.votes.count) 
					});
				});

				CanvasJS.addColorSet("warmShades", 
				[
					"#e3d9ca",
					"#95a792",          
					"#363333"            
				]);

				var chart = new CanvasJS.Chart(candidate.name, {
					colorSet: "warmShades",
					title:{
						text: candidate.name            
					},
					legend: {
						cursor: "pointer",
						fontSize: 18,
						fontFamily: "Montserrat",
						itemclick: self.explodePie
					},
					toolTip: {
						borderColor: "Black",
						fontColor: "White",
						backgroundColor: "Black"
					},
					data: [              
						{
							type: "pie",
							showInLegend: true,
							indexLabelPlacement: "outside",
							indexLabelOrientation: "vertical",
							indexLabelFontFamily: "Montserrat",
							indexLabelFontSize: 20,
							indexLabel: "{name}: {y} votes",
							toolTipContent: "{name}: {y} votes.",
							dataPoints: candidateItems
						}
					]
				});
				chart.render();
			},	
			explodePie(e){
				if(typeof(e.dataSeries.dataPoints[e.dataPointIndex].exploded) === "undefined" || !e.dataSeries.dataPoints[e.dataPointIndex].exploded){
					e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
				} 
				else{
					e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
				}
				e.chart.render();
			}
		}
	}
</script>

<style>
	.charts{
		margin-top: 40px;
	}
</style>