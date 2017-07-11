
<?php
	include("conectaBD.php");
	$cod = $_POST['tCod'];
	$especie = $_POST['tTempMax'];
	$Linhagem = $_POST['tTempMin'];
	$Tempo_Confinamento = $_POST['tUmiMax'];
	$Fase_Confinamento = $_POST['tUmiMin'];
	$Quantidade = $_POST['tCoMax'];

	if(empty($cod) || empty($especie) || empty($Linhagem) || empty($Tempo_Confinamento) || empty($Fase_Confinamento) || empty($Quantidade)){
		echo json_encode(-1);
	}else{
		$consulta = mysql_query("update lote set ID_LOTE='$cod ', AVE_ESPECIE='$especie', QTD_AVES='$Quantidade', LINHAGEM='$Linhagem', TEMPO_CONFINAMENTO='$Tempo_Confinamento', FASE_CONFINAMENTO='$Fase_Confinamento'  where ID_LOTE = $cod");
		
		if($consulta){			
			echo json_encode(1);
		} else{
			echo json_encode(0);
		}
	}
?>
	