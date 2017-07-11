<?php

	$usuario = "root";
	$senha = "";
	$host = "localhost";

	$conexao = mysql_connect($host,$usuario,$senha);
	
	$desconecta = mysql_close($conexao);
	
	if($desconecta){
		//echo("Desconectou");
	}else{
		echo("Erro ao desconectar");
	}

?>