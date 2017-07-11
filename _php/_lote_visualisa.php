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
		<script type="text/javascript" src="../_javascript/jquery-1.11.3.min.js"></script>
		<!--<script type="text/javascript" src="../_javascript/Footable.js"></script>-->
		<link rel="stylesheet" type="text/css" href="../_css/footable.core.css"/>
		<link rel="stylesheet" type="text/css" href="../_css/footable.metro.css"/>
		<script type="text/javascript" src="../_javascript/footable.js"></script>
		<script type="text/javascript" src="../_javascript/footable.paginate.js"></script>
		

		<script type="text/javascript">	//login		
			$(document).ready(function(){
				$('#errolog').hide(); //Esconde o elemento com id errolog	
				$('.btn-delete').click(function(){ 	//Ao submeter formulário
				var codigo= $(this).attr('id');
				
				$.ajax({			//Função AJAX
					url:"_lote_deleta.php?",			//Arquivo php
					type:"post",				//Método de envio
					data: "codigo="+codigo,	//Dados
					success: function (result){			//Sucesso no AJAX
						console.log(result);
							if(result==1){	
								document.getElementById('errolog').style.color="#026f0a";
								$('#errolog').html("Dados Excluidos com Sucesso!");
								$('#errolog').show();					
								setTimeout("window.location='_index.php'",3000);	//Redireciona
							}else{
								document.getElementById('errolog').style.color="#ff0052";
								$('#errolog').html("Erro ao Excluir Dados!");
								$('#errolog').show();		//Informa o erro
							}
						}
					});
					return false;	//Evita que a página seja atualizada
				});
			});
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
		<br>
		<main class="servicos container">
            <center>
            	<span class="form-erro" id="errolog"></span>
				<table class="footable toggle-square-filled">
					<thead>
						<tr>
							<th data-toggle="true">CODIGO</th>
							<th data-hide="tablet,phone">ESPÉCIE</th>
							<th data-hide="tablet,phone">QUANTIDADE</th>
							<th >LINHAGEM</th>
							<th data-hide="tablet,phone">TEMPO CONF</th>
							<th data-hide="tablet,phone">DATA E HORA</th>
							<th data-hide="tablet,phone">AÇÃO</th>
							<th data-hide="tablet,phone">AÇÃO</th>
						</tr>
					</thead>
					<?php
						include("conectaBD.php");
						
						$consulta = mysql_query("select ID_LOTE, AVE_ESPECIE, QTD_AVES, LINHAGEM, TEMPO_CONFINAMENTO, DATA_HORA from lote");
						
						while($linha = mysql_fetch_array($consulta)){
							echo '<tboby>';
								echo '<tr>';
									echo '<td id="iCodigo">'.$linha["ID_LOTE"].'</td>';
									echo '<td>'.$linha["AVE_ESPECIE"].'</td>';
									echo '<td>'.$linha["QTD_AVES"].'</td>';
									echo '<td>'.$linha["LINHAGEM"].'</td>';
									echo '<td>'.$linha["TEMPO_CONFINAMENTO"].'</td>';
									echo '<td>'.date('d/m/Y - H:i:s', strtotime($linha["DATA_HORA"])).'</td>';
									echo '<td>'.'<a class="btn-alter" href=\'_lote_altera.php?id='.$linha['ID_LOTE'].'\'>ALTERAR</a>'.'</td>';
									echo '<td>'.'<a class="btn-delete" id="'.$linha["ID_LOTE"] .'">DELETAR</a>'.'</td>';
								echo '</tr>';
							echo '</tboby>';
						}
						
					?>
					<tfoot class="hide-if-no-paging">
						<td colspan="5">
							<div class="pagination"></div>
						</td>
					</tfoot>
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