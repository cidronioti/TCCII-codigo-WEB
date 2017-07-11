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


	<script type="text/javascript">
	var url = 'http://192.168.1.102:8095';

	$(document).ready(function(){
		$('#botao').click(function(){
			//var valor = $(this).attr('id');
			var codigo = $('#cod').val();
			var tempMax = $('#tempMax').val();
			var tempMin = $('#tempMin').val();
			var umiMax = $('#umiMax').val();
			var umiMin = $('#umiMin').val();
			var coMax = $('#coMax').val();
			var amoMax = $('#amoMax').val();
			var luzMin = $('#luzMin').val();

			if(tempMax < tempMin){
				document.getElementById('errolog').style.color="#ff0052";
				$('#errolog').html("A temperatura máxima não pode ser menor que a minima!");
				$('#errolog').show();//Informa o erro
			}else if(umiMax < umiMin){
				document.getElementById('errolog').style.color="#ff0052";
				$('#errolog').html("A umidade máxima não pode ser menor que a minima!");
				$('#errolog').show();//Informa o erro
			}else{
				var dados = ["a"+tempMax, "a"+tempMin, "a"+umiMax, "a"+umiMin, "a"+coMax, "a"+amoMax, "a"+luzMin];
				//console.log(dados);
				enviaDados(dados);
				enviaDadosBD(codigo, tempMax, tempMin, umiMax, umiMin, coMax, amoMax, luzMin);
			}
		});
		
		function enviaDados(dado){//manda dados para o arduino		
			$.ajax({
				url: 'http://192.168.1.102:8095',
				data: { 'acao': dado},
				dataType: 'jsonp',
				crossDomain: true,
				jsonp: false,
				jsonpCallback: 'dados',
				success: function(data,status,xhr) {
					// posso ler dados e retoranar na pagina para avisar se a luz ta ligada ou desligada.
					//$('#resultVentiladores').text(statusReturn(data.ventilador)); 
					//$('#resultNebulizadores').text(statusReturn(data.nebulizador));
					//$('#resultLampadas').text(statusReturn(data.lampada));
					//$('#resultAquecedores').text(statusReturn(data.aquecedor));
					//$('#resultExaustore').text(statusReturn(data.exaustor));
				}
			  });
			return false;
		}

		function enviaDadosBD(id, tmax, tmin, umax,umin, cmax, amax, lmin){// manda dados para o banco de dados
			$(document).ready(function(){
				$.ajax({			//Função AJAX
						url:"_enviaDadosSocket.php?",			//Arquivo php
						type:"post",				//Método de envio
						data: "tCod="+id+"&tTempMax="+tmax+"&tTempMin="+tmin+"&tUmiMax="+umax+"&tUmiMin="+umin+"&tCoMax="+cmax+"&tNh3Max="+amax+"&tLuzMin="+lmin,	//Dados
						success: function (result){			//Sucesso no AJAX
							//console.log(result);
								if(result==1){	
									document.getElementById('errolog').style.color="#026f0a";
									$('#errolog').html("Parâmetros atualizados com sucesso!");
									$('#errolog').show();					
									setTimeout("window.location='_paratros_sitema_visualisa.php'",3000);	//Redireciona
								}else if(result==-1){
									document.getElementById('errolog').style.color="#ff0052";
									$('#errolog').html("Preencha todos os campos!");
									$('#errolog').show();
								}else{
									document.getElementById('errolog').style.color="#ff0052";
									$('#errolog').html("Erro ao atualizar dados!");
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
		$consulta = mysql_query("select ID_PARAM, TEMP_MAX, TEM_MIN, UMIDADE_MAX, UMIDADE_MIN, CO_MAX, NH3_MAX, LUZ_MIN from parametros_sistema where ID_PARAM = $cod");
					
		$linha = mysql_fetch_array($consulta);
	?>
	
	<!-- FORM DE LOGIN --> 
        <main class="servicos container">
            <section class="newsletter container bg-black">
				<center>
				   <h2> Alterar variáveis de ambiente </h2>
				   <form method="POST" id="fcontatos" action="">
				   	  <span class="errolog" id="errolog"></span>
					  <p class="lb">Codigo: <input class="bg-black radius" onKeyPress="tecla()" id="cod" type="text"  name="tCod" value="<?php echo $linha["ID_PARAM"]; ?>"/></p>
					  <p class="lb">Temperatura Max.: <input class="bg-black radius" onKeyPress="tecla()" id="tempMax" type="text" maxlength="2" name="tTempMax" value="<?php echo $linha["TEMP_MAX"]; ?>"/></p>
					  <p class="lb">Temperatura Min.: <input class="bg-black radius" onKeyPress="tecla()" id="tempMin" type="text" maxlength="2" name="tTempMin" value="<?php echo $linha["TEM_MIN"]; ?>"/></p>
					  <p class="lb">Umidade Max.: <input  class="bg-black radius" onKeyPress="tecla()" id="umiMax" type="text" maxlength="2" name="tUmiMax" value="<?php echo $linha["UMIDADE_MAX"]; ?>"/></p>
					  <p class="lb">Umidade Min.: <input class="bg-black radius" onKeyPress="tecla()" id="umiMin" type="text" maxlength="2" name="tUmiMin" value="<?php echo $linha["UMIDADE_MIN"]; ?>"/></p>
					  <p class="lb">CO Max.: <input class="bg-black radius" onKeyPress="tecla()" id="coMax" type="text" maxlength="3" name="tCoMax" value="<?php echo $linha["CO_MAX"]; ?>"/></p>
					  <p class="lb">Amônia Max.: <input class="bg-black radius" onKeyPress="tecla()" id="amoMax" type="text" maxlength="3" name="tNh3Max" value="<?php echo $linha["NH3_MAX"]; ?>"/></p>
					  <p class="lb">Luminosidade Min.: <input class="bg-black radius" onKeyPress="tecla()" id="luzMin" type="text" maxlength="2" name="tLuzMin" value="<?php echo $linha["LUZ_MIN"]; ?>"/></p>
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
			function tecla(){//aceita apenas numeros nos campos
				evt = window.event;
				var tecla = evt.keyCode;
				if(tecla > 47 && tecla < 58){ 
				      
				}else{
				  	document.getElementById('errolog').style.color="#ff0052";
				   	$("#errolog").html("*Apenas Números");
					$("#errolog").show();
			      	evt.preventDefault();
			    }
  			}	
		</script>
</body>
</html>