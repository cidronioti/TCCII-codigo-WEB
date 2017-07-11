

<?php
	include("conectaBD.php");
	$cod_lote = $_POST['codigo'];				
	$consulta = mysql_query("delete from lote where id_lote = $cod_lote");
	

	if($consulta){		
		echo json_encode(1);
	} else{
		echo json_encode(0);
	}
?>

