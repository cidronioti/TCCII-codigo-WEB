<?php
	include("conectaBD.php");

	$sqlTemp = "SELECT valor FROM temperatura where id_temp = (select max(id_temp) from temperatura)";
	$consulta = mysql_query($sqlTemp); 
	// Armazena os dados da consulta em um array associativo 
	while($registroTemp = mysql_fetch_assoc($consulta)){	 	 
		$tempUti = $registroTemp["valor"];	 
	}
	
	$sqlUmi = "SELECT valor_umidade FROM umidade where id_umidade = (select max(id_umidade) from umidade)";
	$consultaUmi = mysql_query($sqlUmi); 
	// Armazena os dados da consulta em um array associativo 
	while($registroUmi = mysql_fetch_assoc($consultaUmi)){	 	 
		$umiUti = $registroUmi["valor_umidade"];	 
	}
	
	$sqlCo = "SELECT valor_co FROM monoxido_carbono where id_mono_car = (select max(id_mono_car) from monoxido_carbono)";
	$consultaCo = mysql_query($sqlCo); 
	// Armazena os dados da consulta em um array associativo 
	while($registroCo = mysql_fetch_assoc($consultaCo)){	 	 
		$coUti = $registroCo["valor_co"];	 
	}
	
	$sqlAmo = "SELECT valor_amonia FROM amonia where id_amonia = (select max(id_amonia) from amonia)";
	$consultaAmo = mysql_query($sqlAmo); 
	// Armazena os dados da consulta em um array associativo 
	while($registroAmo = mysql_fetch_assoc($consultaAmo)){	 	 
		$amoUti = $registroAmo["valor_amonia"];	 
	}
	
	$sqlLum = "SELECT valor_lum FROM luminosidade where id_lum = (select max(id_lum) from luminosidade)";
	$consultaLum = mysql_query($sqlLum); 
	// Armazena os dados da consulta em um array associativo 
	while($registroLum = mysql_fetch_assoc($consultaLum)){	 	 
		$lumUti = $registroLum["valor_lum"];	 
	}


	
	$dht11Temp = $_GET['sensorDht11Temp'];
	$dht11Umidade = $_GET['sensorDht11Umidade'];
	$mq7 = $_GET['sensorMq7'];
	$mq135 = $_GET['sensorMq135'];
	$ldr = $_GET['sensorLdr'];
	
	
	if($dht11Temp != $tempUti){
		$sql_insert  = "insert into temperatura (valor) values('$dht11Temp')";
		mysql_query($sql_insert);
	}
	if($dht11Umidade != $umiUti){
		$sql_insert  = "insert into umidade (valor_umidade) values('$dht11Umidade')";
		mysql_query($sql_insert);
	}
	if($mq7 != $coUti){
		$sql_insert  = "insert into monoxido_carbono (valor_co) values('$mq7')";
		mysql_query($sql_insert);
	}
	if($mq135 != $amoUti){
		$sql_insert  = "insert into amonia (valor_amonia) values('$mq135')";
		mysql_query($sql_insert);
	}
	if($ldr != $lumUti){
		$sql_insert  = "insert into luminosidade (valor_lum) values('$ldr')";
		mysql_query($sql_insert);
	}
	
	$todosDados = array($tempUti,$umiUti,$coUti,$amoUti,$lumUti);
	echo json_encode($todosDados);
	
	
	if($sql_insert){
		echo("Dados Armazenados com Sucesso");		
	}else{
		echo("Erro - ao armazenar");
	}
?>