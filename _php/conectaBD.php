<?php

	$usuario = "root";
	$senha = "";
	$host = "localhost";
	
	$conexao = mysql_connect($host,$usuario,$senha);
	$banco_dados = mysql_select_db("arduinoweb");
	
	if($conexao){
		//echo("Conectou");
	}else{
		echo("Erro ao Conectar");
	}
?>