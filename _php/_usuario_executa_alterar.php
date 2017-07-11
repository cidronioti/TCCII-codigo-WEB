<html>	
	
	<head>
		<title>Autenticando Usuário</title>
		<script type="text/javascript">
		function loginsuccessfully(){
			setTimeout("window.location='_index.php'",3000);
		}
		
		function loginfailed(){
			setTimeout("window.location='_usuario_alterar.php?id=1'",3000);
		}
		</script>
	</head>
<body>
<?php
	include("conectaBD.php");
	$cod = $_POST['tCod'];
	$nome = $_POST['tTempMax'];
	$login = $_POST['tTempMin'];
	$senha = $_POST['tUmiMax'];
	$confirma_senha = $_POST['tUmiMin'];
	$senhaEncript = md5($senha);
	if($senha == $confirma_senha){
		$consulta = mysql_query("update usuario set ID_USUARIO='$cod ', NOME='$nome', LOGIN='$login', SENHA='$senhaEncript' where ID_USUARIO = $cod");
	}else{
		echo "<center>O campo senha deve ser igual ao confirma senha</center>";
		echo"<script>loginfailed()</script>";
	}
	if($consulta){		
		echo "<center>Dados alterados com sucesso</center>";
		echo"<script>loginsuccessfully()</script>";
	} else{
		echo "<center>Falha ao alterar dados</center>";
		echo"<script>loginfailed()</script>";
	}
?>
</body>
</html>	