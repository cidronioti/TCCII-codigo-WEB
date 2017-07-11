<?php
	include("conectaBD.php");
		
	session_start();
	if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
		header("Location: _login.php");
		exit;
	}
?>


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
	<!--<script type="text/javascript" src="../_javascript/validation.js"></script>-->


	<script type="text/javascript">
			function tecla(){//impede a digitação de letras nos campos de numero
			    evt = window.event;
			    var tecla = evt.keyCode;
			    if(tecla > 47 && tecla < 58){ 
			      
			    }else{
			    	document.getElementById('tempConfErro').style.color="#ff0052";
			    	$("#tempConfErro").html("*Apenas Números");
					$("#tempConfErro").show();
			      	evt.preventDefault();
			    }
  			}

  			function tecla1(){
			    evt = window.event;
			    var tecla = evt.keyCode;
			    if(tecla > 47 && tecla < 58){ 
			      
			    }else{
			    	document.getElementById('quantidadeErro').style.color="#ff0052";
			    	$("#quantidadeErro").html("*Apenas Números");
					$("#quantidadeErro").show();
			      	evt.preventDefault();
			    }
  			}



  			$(document).ready(function(){
	  			$('#botao').click(function(){
					//var valor = $(this).attr('id');
					var codigo = $('#iCod').val();
					var especie = $('#iEspecie').val();
					var linhagem = $('#iLinhagem').val();
					var tempConf = $('#iTempConf').val();
					var faseConf = $('#iFaseConf').val();
					var quantidade = $('#iQuantidade').val();
					
					enviaDadosBD(codigo, especie, linhagem, tempConf, faseConf, quantidade);
					//console.log("fase COnf: "+faseConf);
				});

				function enviaDadosBD(codi, es, li, te, fa, qu){// manda dados para o banco de dados
					//console.log("fase COnf: "+fa);
					$(document).ready(function(){
						//console.log(especie);
						$.ajax({			//Função AJAX
								url:"_lote_executa_alterar.php?",			//Arquivo php
								type:"post",				//Método de envio
								data: "tCod="+codi+"&tTempMax="+es+"&tTempMin="+li+"&tUmiMax="+te+"&tUmiMin="+fa+"&tCoMax="+qu,	//Dados
								success: function (result){			//Sucesso no AJAX
									console.log(result);
									if(result==1){	
										console.log(result);
											document.getElementById('errolog').style.color="#026f0a";
											$('#errolog').html("Dados cadastrados  com sucesso!");
											$('#errolog').show();					
											setTimeout("window.location='_lote_altera.php'",3000);	//Redireciona
									}else if(result==-1){
										console.log(result);
										document.getElementById('errolog').style.color="#ff0052";
										$('#errolog').html("Preencha todos os campos!");
										$('#errolog').show();		//Informa o erro
									}else{
										document.getElementById('errolog').style.color="#ff0052";
										$('#errolog').html("Erro ao cadastrar dados!");
										$('#errolog').show();		//Informa o erro
									}
								}
						});
						return false;
					});
				}
			});
		</script>


</head>
<body>
	<!-- CABEÇALHO --> 
        <header class="cabecalho container">
           <a href="_index.php"><h1 class="logo"> NodeProp - Especializada em Soluções Digitais </h1></a>
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
		$cod_lote = $_GET['id'];
		$consulta = mysql_query("select ID_LOTE, AVE_ESPECIE, QTD_AVES, LINHAGEM, TEMPO_CONFINAMENTO, DATA_HORA, FASE_CONFINAMENTO from lote where ID_LOTE = $cod_lote");
					
					$linha = mysql_fetch_array($consulta);
	?>
	
	
	<!-- FORM DE LOGIN --> 
        <main class="servicos container">
            <section class="newsletter container bg-black">
				<center>
				   <h2> Alterar dados do lote </h2>
				   <form method="POST" id="fcontatos" action="">
						<span class="form-erro" id="errolog"></span>
						<input class="bg-black radius" id="iCod" type="text" name="tCod" value="<?php echo $linha["ID_LOTE"]; ?>">
						<span class="form-erro" id="especieErro"></span>
						<input class="bg-black radius" id="iEspecie" type="text" name="tTempMax" value="<?php echo $linha["AVE_ESPECIE"]; ?>">
						<span class="form-erro" id="linhagemErro"></span>
						<input class="bg-black radius" id="iLinhagem" type="text" name="tTempMin" value="<?php echo $linha["LINHAGEM"]; ?>">
						<span class="form-erro" id="tempConfErro"></span>	
						<input class="bg-black radius" id="iTempConf" type="text" onKeyPress="tecla()" name="tUmiMax" value="<?php echo $linha["TEMPO_CONFINAMENTO"]; ?>">
						<span class="form-erro" id="faseConfErro"></span>	
						<input class="bg-black radius" id="iFaseConf" type="text" name="tUmiMin" value="<?php echo $linha["FASE_CONFINAMENTO"]; ?>">
						<span class="form-erro" id="quantidadeErro"></span>  
						<input class="bg-black radius" id="iQuantidade" onKeyPress="tecla1()" type="text" name="tCoMax" value="<?php echo $linha["QTD_AVES"]; ?>">
						<button class="bg-white radius" id="botao" type="submit"> Enviar </button>
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
        <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
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
				$('input').blur(function(){
					if($(this).val())
						$(this).addClass('used');
					else
						$(this).removeClass('used');
				});
			});
		</script>
	
</body>
</html>