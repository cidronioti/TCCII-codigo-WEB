<!doctype html>
<html>
	<head>
		<title>Line Chart</title>
		<script src="../_javascript/Chart.js"></script>
		<script type="text/javascript" src="../_javascript/jquery-3.1.1.min.js"></script>
		<link rel="stylesheet" href="../_css/style.css">
		<script type="text/javascript">
			var cont = 0;
			var loadData = function(){
				$.ajax({
					type:"POST",
					url:"_jsonDados.php"
				}).done(function(data){
					/*console.log(data);*/
					var d = JSON.parse(data);
						/*$("#sensor1").text(d.temperaturaT);
						$("#sensor2").text(d.umidadeU);
						$("#sensor3").text(d.co);
						$("#sensor4").text(d.nh3);
						$("#sensor5").text(d.luz);*/
						
						myLine.addData([d.temperaturaT],cont++);
						myLine2.addData([d.umidadeU],cont++);
				});
			}
			window.setInterval("loadData()", 3000);
		</script>
	</head>
	<body>
		
			<div style="width:80%">
				<canvas id="canvas" height="400" width="400"></canvas>
			</div>
			<div style="width:80%">
				<canvas id="canvas2" height="400" width="400"></canvas>
			</div>
		


	<script>
		Chart.defaults.global.responsive = true;
		var ctx = document.getElementById("canvas").getContext("2d");
		var lineChartData = {
			labels : [],
			datasets : [
				{
					label: "Dados Temperatura",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(047,079,079,1)",
					pointColor : "rgba(047,079,079,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(047,079,079,1)",
					data : []
				}	
			]
		};
		var myLine = new Chart(ctx).Line(lineChartData);
	</script>
	<script>
		Chart.defaults.global.responsive = true;
		var ctx = document.getElementById("canvas2").getContext("2d");
		var lineChartData = {
			labels : [],
			datasets : [
				{
					label: "Dados Temperatura",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(047,079,079,1)",
					pointColor : "rgba(047,079,079,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(047,079,079,1)",
					data : []
				}	
			]
		};
		var myLine2 = new Chart(ctx).Line(lineChartData);
	</script>
	
	</body>
</html>
