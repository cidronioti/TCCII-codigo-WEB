
<?php
	
	include("conectaBD.php");
	
	$especie = $_POST['tTempMax'];
	$Linhagem = $_POST['tTempMin'];
	$Tempo_Confinamento = $_POST['tUmiMax'];
	$Fase_Confinamento = $_POST['tUmiMin'];
	$Quantidade = $_POST['tCoMax'];
	
	//$sql_insert = "insert into parametros_sistema (temp_max,temp_min,umidade_max,umidade_min,co_max,nh3_max) values('$temp_max','$temp_min','$umi_max','$umi_min','$co_max','$nh3_max')";
	if(empty($especie) || empty($Linhagem) || empty($Tempo_Confinamento) || empty($Fase_Confinamento) || empty($Quantidade)){
		echo json_encode(-1);
	}else{
		$sql_insert  = "insert into lote (AVE_ESPECIE,QTD_AVES,LINHAGEM,TEMPO_CONFINAMENTO,FASE_CONFINAMENTO) values('$especie','$Quantidade','$Linhagem','$Tempo_Confinamento','$Fase_Confinamento')";
		$insere = mysql_query($sql_insert) or die("erro ao inserir");

		if($insere){		
			echo json_encode(1);
		} else{
			echo json_encode(0);
		}
	}
	
?>
	