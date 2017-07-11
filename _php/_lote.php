<?php
	include("conectaBD.php");
		
	session_start();
	if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
		header("Location: _login.php");
		exit;
	}else{

	}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
			function tecla(){
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
					var especie = $('#iEspecie').val();
					var linhagem = $('#iLinhagem').val();
					var tempConf = $('#iTempConf').val();
					var faseConf = $('#iFaseConf').val();
					var quantidade = $('#iQuantidade').val();
					
					enviaDadosBD(especie, linhagem, tempConf, faseConf, quantidade);
					//console.log("fase COnf: "+faseConf);
				});

				function enviaDadosBD(es, li, te, fa, qu){// manda dados para o banco de dados
					//console.log("fase COnf: "+fa);
					$(document).ready(function(){
						//console.log(especie);
						$.ajax({			//Função AJAX
								url:"_lote_cadastra.php?",			//Arquivo php
								type:"post",				//Método de envio
								data: "tTempMax="+es+"&tTempMin="+li+"&tUmiMax="+te+"&tUmiMin="+fa+"&tCoMax="+qu,	//Dados
								success: function (result){			//Sucesso no AJAX
									console.log(result);
									if(result==1){	
											document.getElementById('errolog').style.color="#026f0a";
											$('#errolog').html("Dados cadastrados  com sucesso!");
											$('#errolog').show();					
											setTimeout("window.location='_lote.php'",3000);	//Redireciona
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
           <a href="index.html"><h1 class="logo"> NodeProp - Especializada em Soluções Digitais </h1></a>

			<div class="usuarioTopo"><p><?php echo $_SESSION["login"]; ?></p></div>

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
	
	<!-- FORM DE LOGIN --> 
        <main class="servicos container">
            <section class="newsletter container bg-black">
				<center>
				   <h2> Cadastro de Lotes </h2>
				   <form method="POST" id="fcontatos" action="">
				   		<span class="form-erro" id="errolog"></span>
				   		<span class="form-erro" id="especieErro"></span>
						<input class="bg-black radius" id="iEspecie" type="text" name="tTempMax" placeholder="Informe a espécie" required="">					  
						<span class="form-erro" id="linhagemErro"></span>
						<input class="bg-black radius" id="iLinhagem" type="text" name="tTempMin" placeholder="Informe a linhagem" required="">
						<span class="form-erro" id="tempConfErro"></span>	
						<input class="bg-black radius" onKeyPress="tecla()" id="iTempConf" type="text" name="tUmiMax"  placeholder="Informe o tempo confinamento" required="">
						<span class="form-erro" id="faseConfErro"></span>	
						<input class="bg-black radius" id="iFaseConf" type="text" name="tUmiMin" placeholder="Informe a fase confinamento" required="">
						<span class="form-erro" id="quantidadeErro"></span>  
						<input class="bg-black radius" onKeyPress="tecla1()" id="iQuantidade" type="text" name="tCoMax" placeholder="Informe a quantidade" required="">
						<button type="button" class="bg-white radius" id="botao"> Enviar </button>
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
        <script type="text/javascript" src="../_javascript/jquery-3.1.1.min.js"></script>
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