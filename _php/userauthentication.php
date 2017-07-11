
		<?php
			include("conectaBD.php");

			$usuario = $_POST['login'];
			$senha = md5($_POST['senha']);
			
			$consulta = mysql_query("SELECT *FROM usuario WHERE login = '$usuario' and senha='$senha'") or die(mysql_error);
			
			$row = mysql_num_rows($consulta);
			
			if($row > 0){
				session_start();
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['senha'] = $_POST['senha'];
				
				echo json_encode(1);
				exit;
				//echo"<script>loginsuccessfully()</script>";
			} else{
				
				echo json_encode(0);				
			}
		?>
