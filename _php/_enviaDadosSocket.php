<?php
	
	include("conectaBD.php");
	
	$cod = $_POST['tCod'];
	$temp_max = $_POST['tTempMax'];
	$temp_min = $_POST['tTempMin'];
	$umi_max = $_POST['tUmiMax'];
	$umi_min = $_POST['tUmiMin'];
	$co_max = $_POST['tCoMax'];
	$nh3_max = $_POST['tNh3Max'];
	$lum_min = $_POST['tLuzMin'];
	
	//$sql_insert = "insert into parametros_sistema (temp_max,temp_min,umidade_max,umidade_min,co_max,nh3_max) values('$temp_max','$temp_min','$umi_max','$umi_min','$co_max','$nh3_max')";
	if(empty($cod) || empty($temp_max) || empty($temp_min) || empty($umi_max) || empty($umi_min) || empty($co_max) || empty($nh3_max) || empty($lum_min)){
		echo json_encode(-1);

	}
	else{
		$sql_atualiza  = "update parametros_sistema set CO_MAX='$co_max', NH3_MAX='$nh3_max',TEMP_MAX='$temp_max', TEM_MIN='$temp_min', UMIDADE_MAX='$umi_max', UMIDADE_MIN='$umi_min', LUZ_MIN='$lum_min' where ID_PARAM=$cod";
		$result = mysql_query($sql_atualiza) or die("erro ao inserir");
		
		
		if($result){		
			echo json_encode(1);
			
		} else{
			echo json_encode(0);
		}
	}
?>
