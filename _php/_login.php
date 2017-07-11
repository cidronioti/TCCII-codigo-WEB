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
		<link rel="stylesheet" type="text/css" href="../engine1/style.css" />
		<script type="text/javascript" src="../engine1/jquery.js"></script>
		
		
		<script type="text/javascript">	//login		
			$(document).ready(function(){
				$('#login').focus();
				$('#errolog').hide(); //Esconde o elemento com id errolog
				$('#formlogin').submit(function(){ 	//Ao submeter formulário
				var login=$('#login').val();	//Pega valor do campo login
				var senha=$('#senha').val();	//Pega valor do campo senha
				$.ajax({			//Função AJAX
					url:"userauthentication.php?",			//Arquivo php
					type:"post",				//Método de envio
					data: "login="+login+"&senha="+senha,	//Dados
					success: function (result){			//Sucesso no AJAX
						console.log(result);
							if(result==1){	
								document.getElementById('errolog').style.color="#026f0a";
								$('#errolog').html("Autenticação Realizada com Sucesso!");
								$('#errolog').show();					
								setTimeout("window.location='_index.php'",3000);	//Redireciona
							}else{
								document.getElementById('errolog').style.color="#ff0052";
								$('#errolog').html("Usuário ou senha incorretos!");
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
                    
        </header>
        
		
		<!--SLIDE SHOW-->
		<div id="wowslider-container1">
				<div class="ws_images"><ul>
				<li><img src="../data1/images/sgrapa__bem_estar_animal.jpg" alt="SGRAPA é bem estar animal" title="SGRAPA é bem estar animal" id="wows1_0"/></li>
				<li><img src="../data1/images/_economia.jpg" alt="É economia" title="É economia" id="wows1_1"/></li>
				<li><img src="../data1/images/_maior_produtivivade.jpg" alt="wowslideshow" title="É maior produtivivade" id="wows1_2"/></li>
				<li><img src="../data1/images/_produzir_com_qualidade.jpg" alt="É produzir com qualidade" title="É produzir com qualidade" id="wows1_3"/></li>
			</ul></div>
			<div class="ws_bullets"><div>
				<a href="#" title="SGRAPA é bem estar animal"><span><img src="../data1/tooltips/sgrapa__bem_estar_animal.jpg" alt="SGRAPA é bem estar animal"/>1</span></a>
				<a href="#" title="É economia"><span><img src="../data1/tooltips/_economia.jpg" alt="É economia"/>2</span></a>
				<a href="#" title="É maior produtivivade"><span><img src="../data1/tooltips/_maior_produtivivade.jpg" alt="É maior produtivivade"/>3</span></a>
				<a href="#" title="É produzir com qualidade"><span><img src="../data1/tooltips/_produzir_com_qualidade.jpg" alt="É produzir com qualidade"/>4</span></a>
			</div></div><div class="ws_script" style="position:absolute;left:-99%">by WOWSlider.com v8.7</div>
			<div class="ws_shadow"></div>
		</div>	
		<script type="text/javascript" src="../engine1/wowslider.js"></script>
		<script type="text/javascript" src="../engine1/script.js"></script>
		<!--fim SLIDE SHOW-->

		<main class="servicos container">
            <section class="newsletter container bg-black">
				<center>
				   <h2> Credenciamento </h2>
				  <span class="form-erro" id="errolog"></span>
					<form id="formlogin">
						<input class="bg-black radius" type="text" id="login" placeholder="Login" required="" />
						<input class="bg-black radius" type="password" id="senha" placeholder="Senha" required="" />
						<button class="bg-black radius" type="submit" id="botao">Entrar</button>
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