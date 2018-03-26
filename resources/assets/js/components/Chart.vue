<template>
	<div>
		<div v-for="key in keys" class="charts box" :id="key" style="height: 550px; width: 100%;">1 </div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				keys: ["PRO", "President", "Vice President", "Chaplain", "Director of Sports", "Director of Social", "General Secretary", "Director of Transport", "Treasurer", "Director of Finance", "Director of Welfare", "Senate President", "Sargent At Arms", "Assistant Gen Secretary", "Senator Chief Whip", "Deputy Senate President", "Senate Scribe"]
			}
		},
		created(){
			this.keys.sort();
			this.fetchVotes();
		},
		methods: {
			fetchVotes(){
				self = this;
				axios.get('api/get-votes')
					.then((data)=>{
						var posts = data.data;
						var keys = Object.keys(posts).sort();
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