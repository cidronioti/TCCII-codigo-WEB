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
	<script type="text/javascript" src="../_javascript/validation.js"></script>
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
		$cod = $_GET['id'];
		$consulta = mysql_query("select ID_USUARIO, NOME, LOGIN from usuario where ID_USUARIO = $cod");
					
		$linha = mysql_fetch_array($consulta);
	?>
	
	
	<!-- FORM DE LOGIN --> 
        <main class="servicos container">
            <section class="newsletter container bg-black">
				<center>
				   <h2> Alterar dados de Usuário </h2>
				   <form method="POST" id="fcontatosUsuario" action="_usuario_executa_alterar.php">
				   		<span class="form-erro" id="idUsuarioErro"></span>
						<input class="bg-black radius" id="idUsuario" type="text" name="tCod" value="<?php echo $linha["ID_USUARIO"]; ?>">
						<span class="form-erro" id="nomeErro"></span>
						<input class="bg-black radius" id="iNome" type="text" name="tTempMax" value="<?php echo $linha["NOME"]; ?>">
						<span class="form-erro" id="loginErro"></span>
						<input class="bg-black radius" id="iLogin" type="text" name="tTempMin" value="<?php echo $linha["LOGIN"]; ?>">
						<span class="form-erro" id="senhaErro"></span>
						<input class="bg-black radius" id="iSenha" type="password" name="tUmiMax" placeholder="Informe a senha">
						<span class="form-erro" id="confirmaSenhaErro"></span>
						<input class="bg-black radius" id="iConfirmaSenha" type="password" name="tUmiMin" placeholder="Confirme a senha">
						<button class="bg-white radius"> Enviar </button>
				   </form>
			   </center>
			</section>
        </main>      
	
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
        <!--<script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>-->
        <script>
			$(".btn-menu").click(function(){
			  $(".menu").show();
			});
			$(".btn-close").click(function(){
			  $(".menu").hide();
			});
        </script>    

		<script type="text/javascript">/*essa parte de java script he o texto q esta com efeito não sobrepor o texto informado pelo usuario mas não ta funcionando*/
			$(document).ready(function(){
				$("#iSenha").focus();
			});
		</script>
</body>
</html>