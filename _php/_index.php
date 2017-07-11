<!DOCTYPE html>
<html lang="pt-br">
    <head>
    	<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title> SGRAPA </title>
    	<meta name="description" content="Agência especializada em Marketing Digital, Criação de Sites e Aplicativos Mobile.">
    	<meta name="keywords" content="Agência digital, Marketing, Sites">
    	<meta name="robots" content="index, follow">
    	<meta name="author" content="Cidronio Oliveira">
    	<link rel="stylesheet" href="../_css/style.css">
    	<link rel="icon" href="../_img/icon.png">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    	<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
		<script src="../_javascript/Chart.js"></script>
		<script type="text/javascript" src="../_javascript/jquery-3.1.1.min.js"></script>
		
		<script type="text/javascript">
			var cont= 0;
			var cont1= 0;
			var cont2= 0;
			var loadData = function(){
				$.ajax({
					type:"POST",
					url:"_jsonDados.php"
				}).done(function(data){
					/*console.log(data);*/
					var d = JSON.parse(data);
						$("#sensor1").text(d.temperaturaT);
						$("#sensor2").text(d.umidadeU);
						$("#sensor3").text(d.co);
						$("#sensor4").text(d.nh3);
						$("#sensor5").text(d.luz);
						
						myLine.addData([d.temperaturaT],cont++);
						myLine2.addData([d.umidadeU, d.luz],cont1++);
						myLine3.addData([d.co, d.nh3],cont2++);
				});
			}
			window.setInterval("loadData()", 3000);
		</script>
		
    </head>
    <body>
        <!-- CABEÇALHO --> 
        <header class="cabecalho container">
           <a href="index.html"><h1 class="logo"> NodeProp - Especializada em Soluções Digitais </h1></a>
           <button class="btn-menu bg-gradient"><i class="fa fa-bars fa-lg"></i></button>
           <nav class="menu">
               <a class="btn-close"><i class="fa fa-times"></i></a>
               <ul>
				<li><a href="_index.php">HOME</a></li>
				<li><a href="_controle.php">CONTROLE</a></li>
				<li><a href="#">PARAMETROS DO SISTEMA</a>
					<ul>
						<li><a href="_paratros_sitema_visualisa.php">VISUALISAR</a>
					</ul>
				</li>
				<li><a href="#">LOTE</a>
					<ul>
						<li><a href="_lote.php">CADASTRAR</a>
						<li><a href="_lote_visualisa.php">VISUALISAR</a>
					</ul>
				</li>
				<li><a href="#">HISTÓRICO</a>
					<ul>
						<li><a href="_temperatura.php">TEMPERATURA</a>
						<li><a href="_umidade.php">UMIDADE</a>
						<li><a href="_monoxido_carbono.php">CO</a>
						<li><a href="_amonia.php">AMONIA</a>
						<li><a href="_luminosidade.php">LUMINOSIDADE</a>
					</ul>
				</li>	
				<li><a href="#">USUÁRIOS</a>
					<ul>
						<li><a href="_usuario_visualisa.php">VISUALISAR</a>
					</ul>
				</li>
				<li><a href="_logout.php">SAIR</a></li>
			</ul>
           </nav>          
        </header>
        
        <?php
			include("conectaBD.php");
		
			session_start();
			if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
				header("Location: _login.php");
				exit;
			}
		?>
        <!-- SERVICOS --> 
        <main class="servicos container">
        	<center>
				<div class="todosCirculos">
					<div class="circulo">
						<h5 id="legSensor">Temperatura (ºC):</h5>
						<p id="sensor1">29</p>
					</div>

					<div class="circulo">
						<h5>Umidade (%):</h5>
						<p id="sensor2">65</p>
					</div>
						
					<div class="circulo">
						<h5>CO (ppm):</h5>
						<p id="sensor3">80</p>
					</div>
						
					<div class="circulo">
						<h5>NH3 (ppm):</h5>
						<p id="sensor4">83</p>
					</div>
						
					<div class="circulo">
						<h5>Luminosidade (%):</h5>
						<p id="sensor5">35</p>
					</div>
				</div>
			</center>
			<div class="graficos">
				<h2 id="temperatura">Temperatura</h2>
				<h2 id="medida">(°C)</h2>
				<div id="temp" style="width:100%">
					<canvas id="canvas" height="400" width="400"></canvas>
				</div>
			</div>
			<div class="graficos">
				<h2 id="luminosidade">Luminosidade</h2>
				<h2 id="umidade">Umidade</h2>
				<h2 id="medida">(%)</h2>
				<div id="temp" style="width:100%">
					<canvas id="canvas2" height="400" width="400"></canvas>
				</div>
			</div>
			<div class="graficos">
				<h2 id="carbono">Monóxido de Cobono</h2>
				<h2 id="amonia">Amônia</h2>
				<h2 id="medida">(ppm)</h2>
				<div id="temp" style="width:100%">
					<canvas id="canvas3" height="400" width="400"></canvas>
				</div>
			</div>
        </main>


		
		<!-- MEDIDA DE SEGURANÇA - Essa parte do php evita essa pagina seja acessada diretamente sem passar pela autenticação  -->
		
		
		<script>
			Chart.defaults.global.responsive = true;
			var ctx = document.getElementById("canvas").getContext("2d");
			var lineChartData = {
				labels : [],
				datasets : [
					{
						label: "Dados Temperatura",
						fillColor : "rgba(255,099,071,0.2)",
						strokeColor : "rgba(255,099,071,1)",
						pointColor : "rgba(255,099,071,1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(255,099,071,1)",
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
						fillColor : "rgba(000,191,255,0.2)",
						strokeColor : "rgba(000,191,255,1)",
						pointColor : "rgba(000,191,255,1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(000,191,255,1)",
						data : []
					},
					{
						label: "Dados Temperatura",
						fillColor : "rgba(255,165,000,0.2)",
						strokeColor : "rgba(255,165,000,1)",
						pointColor : "rgba(255,165,000,1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(255,165,000,1)",
						data : []
					}
				]
			};
			var myLine2 = new Chart(ctx).Line(lineChartData);
		</script>
		
		<script>
			Chart.defaults.global.responsive = true;
			var ctx = document.getElementById("canvas3").getContext("2d");
			var lineChartData = {
				labels : [],
				datasets : [
					{
						label: "Dados Temperatura",
						fillColor : "rgba(000,250,154,0.2)",
						strokeColor : "rgba(000,250,154,1)",
						pointColor : "rgba(000,250,154,1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(000,250,154,1)",
						data : []
					},
					{
						label: "Dados Temperatura",
						fillColor : "rgba(218,112,214,0.2)",
						strokeColor : "rgba(218,112,214,1)",
						pointColor : "rgba(218,112,214,1)",
						pointStrokeColor : "#fff",
						pointHighlightFill : "#fff",
						pointHighlightStroke : "rgba(218,112,214,1)",
						data : []
					}
				]
			};
			var myLine3 = new Chart(ctx).Line(lineChartData);
		</script>
		
        <!-- RODAPÉ -->
        <footer class="rodape container bg-gradient">
          <div class="social-icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-envelope"></i></a>
          </div>
          <p class="copyright">
            Copyright © Cidronio Oliveira 2016. Todos os direitos reservados.
        </footer>       
        
        <!-- JQUERY --> 
        <script type="text/javascript" src="../_javascript/jquery-3.1.1.min.js"></script>
        <script>
			$(".btn-menu").click(function(){
			  $(".menu").show();
			});
			$(".btn-close").click(function(){
			  $(".menu").hide();
			});
		 </script>
		
             
    </body>
</html>