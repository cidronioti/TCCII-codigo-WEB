<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8"/>
	<title>SERVIÇOS-Tec Solution</title>
	<meta name="description" content="A tec Solution oferece ao mercado soluções completas em automação para o varejo."/>
	<link rel="icon" href="../_img/inconeTopo.png"/>
	<link rel="stylesheet" type="text/css" href="../_css/_estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../_css/_estilo_menu.css"/>
	<link rel="stylesheet" type="text/css" href="../_css/_estilo_controle.css"/>
</head>
<body>
	<header>
		<img id="logo" src="../_img/logoCabecalho.png">
		<input type="checkbox" id="btnMenu">
		<label for="btnMenu"><img src="../_img/btnMenu.png" alt=""></label>
		<nav class="menu">
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
	<div id="interface">
		<?php
			$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			// Se conecta ao IP e Porta:
			socket_connect($sock,"192.168.0.102", 8095);
			 
			// Executa a ação correspondente ao botão apertado.
			if(isset($_POST['bits'])) {
			  $msg = $_POST['bits'];
			  if(isset($_POST['Fora'   ])){ if($msg[0]=='1') { $msg[0]='0'; } else { $msg[0]='1'; }}
			  if(isset($_POST['Quarto1'])){ if($msg[1]=='1') { $msg[1]='0'; } else { $msg[1]='1'; }}
			  if(isset($_POST['Quarto2'])){ if($msg[2]=='1') { $msg[2]='0'; } else { $msg[2]='1'; }}
			  if(isset($_POST['Sala'   ])){ if($msg[3]=='1') { $msg[3]='0'; } else { $msg[3]='1'; }}
			  if(isset($_POST['Pequeno'])){ $msg = 'P#'; }
			  if(isset($_POST['Grande' ])){ $msg = 'G#'; }
			  socket_write($sock,$msg,strlen($msg));
			}
			 
			socket_write($sock,'R#',2); //Requisita o status do sistema.
			 
			// Espera e lê o status e define a cor dos botões de acordo.
			$status = socket_read($sock,6);
			if (($status[4]=='L')&&($status[5]=='#')) {
			  if ($status[0]=='0') $cor1 = 'lightcoral';
			    else $cor1 = 'lightgreen';
			  if ($status[1]=='0') $cor2 = 'lightcoral';
			    else $cor2 = 'lightgreen';
			  if ($status[2]=='0') $cor3 = 'lightcoral';
			    else $cor3 = 'lightgreen';
			  if ($status[3]=='0') $cor4 = 'lightcoral';
			    else $cor4 = 'lightgreen';
			   
			  echo "<form method =\"post\" action=\"_controle.php\">";
			  echo "<div id=\"controle\">";
			  echo "<input type=\"hidden\" name=\"bits\" value=\"$status\">";
			  echo "<button style=\"width:150; background-color: $cor1 ;font: bold 14px Arial\" type = \"Submit\" Name = \"Fora\">Exaustor</button></br></br>";
			  echo "<button style=\"width:150; background-color: $cor2 ;font: bold 14px Arial\" type = \"Submit\" Name = \"Quarto1\">Ventilador</button></br></br>";
			  echo "<button style=\"width:150; background-color: $cor3 ;font: bold 14px Arial\" type = \"Submit\" Name = \"Quarto2\">Lampadas</button></br></br>";
			  echo "<button style=\"width:150; background-color: $cor4 ;font: bold 14px Arial\" type = \"Submit\" Name = \"Sala\">Nebulizador</button></br></br></br>";
			  echo "<button style=\"width:150;font: bold 14px Arial\" type = \"Submit\" Name = \"Pequeno\">Portao Pequeno</button></br></br>";
			  echo "<button style=\"width:150;font: bold 14px Arial\" type = \"Submit\" Name = \"Grande\">Portao Grande</button></br></br>";
			  echo "</div>";
			  echo "</form>";
			}
			// Caso ele não receba o status corretamente, avisa erro.
			else { echo "Falha ao receber status da casa."; }
			socket_close($sock);
		?>
			 
	</div>
	<?php
		include("conectaBD.php");
	
		session_start();
		if(!isset($_SESSION["login"]) || !isset($_SESSION["senha"])){
			header("Location: _login.php");
			exit;
		}
	?>
	<div class="rodape">
		<p id="enrecoRodape">
			Rua Castelo Branco, 333</br>
			Bairro: Junco</br>
			Cidade: Picos-PI</br>
			Fone: (81) 99602-8794</br>
			&copy 2016 - Cidronio de Oliveira, todos os direito reservados.
		</p>
	</div>
</body>
</html>