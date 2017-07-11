<html>	

	<head>
		<title>Autenticando Usuário</title>
		<script type="text/javascript">
		function loginsuccessfully(){
			setTimeout("window.location='_index.php'",3000);
		}
		
		function loginfailed(){
			setTimeout("window.location='_login.php'",3000);
		}
		</script>
	</head>
	<body>
		<?php
			include("conectaBD.php");

			$usuario = $_POST['usuarioNome'];
			$senha = $_POST['senhaN'];
			
			$consulta = mysql_query("SELECT *FROM usuario WHERE login = '$usuario' and senha='$senha'") or die(mysql_error);
			
			$row = mysql_num_rows($consulta);
			
			if($row > 0){
				session_start();
				$_SESSION['login'] = $_POST['usuarioNome'];
				$_SESSION['senha'] = $_POST['senhaN'];
				echo "<center>Login realizado com sucesso</center>";
				echo"<script>loginsuccessfully()</script>";
			} else{
				echo "<center>Falha ao Realizar o Login</center>";
				echo"<script>loginfailed()</script>";
			}
		?>
	</body>
</html>	