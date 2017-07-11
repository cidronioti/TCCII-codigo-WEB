<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8"/>
	<script src="../_javascript/jquery.js"></script>
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
	
	
		<main class="servicos container">
            <section class="newsletter container bg-black">
				<center>
				   <p>
					Status: <span id="status" class="label"></span>
					</p>
				
					<p>
						<div class="botoesControle">
							<div>
								<button type="button" class="btn btn-default botaoEnvia" id="000">Controle</button>
								<span id="resultControle"></span>
							</div>
							
							<div class="btn-ventilador">
								<button type="button" class="btn btn-default botaoEnvia" id="001">Ventiladores</button>
								<span id="resultVentiladores"></span>
							</div>
							<div class="btn-nebulizador">
								<button type="button" class="btn btn-default botaoEnvia" id="002">Nebulizadores</button>
								<span id="resultNebulizadores"></span>
							</div>
							<div class="btn-lampada">
								<button type="button" class="btn btn-default botaoEnvia" id="003">Lampadas</button>
								<span id="resultLampadas"></span>
							</div>
							<div>
								<button type="button" class="btn btn-default botaoEnvia" id="004">Aquecedores</button>
								<span id="resultAquecedores"></span>
							</div>
							<div>
								<button type="button" class="btn btn-default botaoEnvia" id="005">Exaustores</button>
								<span id="resultExaustore"></span>
							</div>
						</div>
						
						<br/>
						
					</p>
			   </center>
			</section>
        </main> 
	
	
	<?php
		include("conectaBD.php");
	
		session_start();
		if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
			header("Location: _login.php");
			exit;
		}
	?>
	
	<script type="text/javascript">
	//var url = 'http://177.177.165.14:50';
	var url = 'http://192.168.1.102:8095';

	$(document).ready(function(){
		$('.botaoEnvia').click(function(){
			var valor = $(this).attr('id');
			enviaDados(valor);
		});
		
		function enviaDados(dado){		
			$.ajax({
				url: url,
				data: { 'acao': dado},
				dataType: 'jsonp',
				crossDomain: true,
				jsonp: false,
				jsonpCallback: 'dados',
				success: function(data,status,xhr) {
					// posso ler dados e retoranar na pagina para avisar se a luz ta ligada ou desligada.
					console.log(data.ventilador);
					console.log(data.nebulizador);
					$('#resultControle').text(statusReturn(data.controle)); 
					$('#resultVentiladores').text(statusReturn(data.ventilador)); 
					$('#resultNebulizadores').text(statusReturn(data.nebulizador));
					$('#resultLampadas').text(statusReturn(data.lampada));
					$('#resultAquecedores').text(statusReturn(data.aquecedor));
					$('#resultExaustore').text(statusReturn(data.exaustor));
				}
			  });
			return false;
		}

		function statusReturn (valor) {
			if(valor == 0) {
				return "Desligada";
			}
			else if(valor == 1) {
				return "Ligada";
			}
			 else { return "Desconhecido";}
		}

		var i = 0;
		function fazerRequisicao(){
			$('#status').removeClass('label-success').addClass('label-warning');
			$('#status').text("Enviando Requisição...");
			$.ajax({
				url: url,
				data: { '': ''}, // usaremos em proximas versões
				dataType: 'jsonp', // IMPORTANTE
				crossDomain: true, // IMPORTANTE
				jsonp: false,
				jsonpCallback: 'dados', // IMPORTANTE
				success: function(data,status,xhr) {
					$('#status').removeClass('label-warning').addClass('label-success')
					$('#status').text("Requisição Recebida!");
					$('#resultControle').text(statusReturn(data.controle)); 
					$('#resultVentiladores').text(statusReturn(data.ventilador)); 
					$('#resultNebulizadores').text(statusReturn(data.nebulizador));
					$('#resultLampadas').text(statusReturn(data.lampada));
					$('#resultAquecedores').text(statusReturn(data.aquecedor));
					$('#resultExaustore').text(statusReturn(data.exaustor));
					i++;
	
					console.log(data);
				}
			  });
			return false;
		}

		// A cada 1000 milis (1 segundo), faça uma nova requisição.
		setInterval(fazerRequisicao, 1000);
		// Acredito que 3000 (3 segundos) ou mais seja o ideal para um serviço online.
		// Caso use local host, arrisco colocar ate 400 milis, você tera uma boa resposta. 
	});

	
  
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