<template>
	<div>
		<div class="charts" id="chartContainer" style="height: 550px; width: 100%;"></div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				chart: ''
			}
		},
		created(){
			Event.$on('candidates', (candidates, title)=>{
				this.renderChart(candidates, title);
			});

			Event.$on('destroyChart', ()=>{
				console.log('Destroyed!');
				this.destroyChart();
			});
		},
		methods: {
			renderChart(candidates, chartTitle){
				var candidateItems = new Array();

				candidates.forEach((candidate)=>{
					console.log(candidate.votes);
					candidateItems.push({ 
						name: candidate.candidate.first_name + ' ' +candidate.candidate.last_name, 
						y: candidate.votes
					});
				});

				CanvasJS.addColorSet("warmShades", 
				[
					"#e3d9ca",
					"#95a792",          
					"#363333"
				]);

				var chart = new CanvasJS.Chart("chartContainer", {
					colorSet: "warmShades",
					title:{
						text: chartTitle            
					},
					legend: {
						cursor: "pointer",
						fontSize: 18,
						fontFamily: "Montserrat",
						itemclick: this.explodePie
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
			},
			destroyChart(){
				var chart = document.getElementById("chartContainer");
				while (chart.firstChild) {
				    chart.removeChild(chart.firstChild);
				}
			}
		}
	}
</script>

<style>
	.charts{
		margin-top: 40px;
	}
</style>