
<!DOCTYPE html>
<html>
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
		<!--<script type="text/javascript" src="../_javascript/jquery-3.1.1.min.js"></script>-->
		<script type="text/javascript" src="../_javascript/jquery-1.11.3.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../_css/footable.core.css"/>
		<link rel="stylesheet" type="text/css" href="../_css/footable.metro.css"/>
		<script type="text/javascript" src="../_javascript/footable.js"></script>
		
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
            <center>
				<h2>Parâmetros do sistema</h2>
				<table class="footable toggle-square-filled">
					<thead>
						<tr>
							<th data-toggle="true">TEMP. MAX</th>
							<th>TEMP. MIN.</th>
							<th data-hide="tablet,phone">UMIDADE MAX.</th>
							<th data-hide="tablet,phone">UMIDADE MIN.</th>
							<th data-hide="tablet,phone">CO MAX.</th>
							<th data-hide="tablet,phone">NH3 MAX.</th>
							<th data-hide="tablet,phone">LUZ MIN.</th>
							<th data-hide="tablet,phone">AÇÃO</th>
						</tr>
					</thead>
				<?php
					include("conectaBD.php");
					
					$consulta = mysql_query("select ID_PARAM, TEMP_MAX, TEM_MIN, UMIDADE_MAX, UMIDADE_MIN, CO_MAX, NH3_MAX, LUZ_MIN from parametros_sistema");
						
					while($linha = mysql_fetch_array($consulta)){
						echo '<tbody>';
							echo '<tr>';
								echo '<td>'.$linha["TEMP_MAX"].'</td>';
								echo '<td>'.$linha["TEM_MIN"].'</td>';
								echo '<td>'.$linha["UMIDADE_MAX"].'</td>';
								echo '<td>'.$linha["UMIDADE_MIN"].'</td>';
								echo '<td>'.$linha["CO_MAX"].'</td>';
								echo '<td>'.$linha["NH3_MAX"].'</td>';
								echo '<td>'.$linha["LUZ_MIN"].'</td>';
								echo '<td>'.'<a class="btn-alter" href=\'_paratros_sitema_alterar.php?id='.$linha['ID_PARAM'].'\'>ALTERAR</a>'.'</br>'.'</td>';
							echo '</tr>';
						echo '</tbody>';
					}				
				?>
				</table>		
			</center>
        </main>
		<?php
			/*include("conectaBD.php");
		
			session_start();
			if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
				header("Location: _login.php");
				exit;
			}*/
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('.footable').footable();
			});
		</script>

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
        <!--<script type="text/javascript" src="../_javascript/jquery-3.1.1.min.js"></script>-->
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
