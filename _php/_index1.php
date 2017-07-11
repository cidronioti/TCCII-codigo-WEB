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
		<script type="text/javascript" src="../_javascript/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="../_javascript/javascripts/jquery.min.js">
		
		<script type="text/javascript">
			var i = 0;
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
						
						i++;
						setGrafico(i,data.temperaturaT);
				});
			}
			window.setInterval("loadData()", 1000);
			
			function setGrafico(i, dado){
				$(function () {
				Highcharts.chart('container', {
					title: {
						text: 'Monthly Average Temperature',
						x: -20 //center
					},
					subtitle: {
						text: 'Source: WorldClimate.com',
						x: -20
					},
					xAxis: {
						categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
							'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
					},
					yAxis: {
						title: {
							text: 'Temperature (°C)'
						},
						plotLines: [{
							value: 0,
							width: 1,
							color: '#808080'
						}]
					},
					tooltip: {
						valueSuffix: '°C'
					},
					legend: {
						layout: 'vertical',
						align: 'right',
						verticalAlign: 'middle',
						borderWidth: 0
					},
					series: [{
						name: 'Tokyo',
						data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
					}, {
						name: 'New York',
						data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
					}, {
						name: 'Berlin',
						data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
					}, {
						name: 'London',
						data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
					}]
				});
			});
		}
		</script>
		
    </head>
    <body>
	<script src="../_javascript/highcharts.js"></script>
	<script src="../_javascript/modules/exporting.js"></script>

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
        
        
        <!-- SERVICOS --> 
        <main class="servicos container">
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
        </main>  
		<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
		<!-- MEDIDA DE SEGURANÇA - Essa parte do php evita essa pagina seja acessada diretamente sem passar pela autenticação  -->
		<?php
			include("conectaBD.php");
		
			session_start();
			if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
				header("Location: _login.php");
				exit;
			}
		?>
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