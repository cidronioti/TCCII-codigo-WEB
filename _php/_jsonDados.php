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
	
	$sqlLum = "SELECT valor_lum FROM luminosidade where id_lum = (select max(id_lum) from temperatura)";
	$consultaLum = mysql_query($sqlLum); 
	// Armazena os dados da consulta em um array associativo 
	while($registroLum = mysql_fetch_assoc($consultaLum)){	 	 
		$lumUti = $registroLum["valor_lum"];	 
	}

	
	
	
	//$todosDados = array('temperaturaT'=>$tempUti, 'umidadeU'=>$umiUti, 'co'=>$coUti, 'nh3'=>$amoUti, 'luz'=>$lumUti);
	$todosDados = array("temperaturaT"=>$tempUti, "umidadeU"=>$umiUti, "co"=>$coUti, "nh3"=>$amoUti, "luz"=>$lumUti);
	
	echo json_encode($todosDados);
	
	
	
	
?>