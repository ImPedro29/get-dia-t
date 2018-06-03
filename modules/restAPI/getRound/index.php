<?php
	//Diretorio principal
	$dir = "/GitHub/get-dia-t";
	
	//Desativado erros
	error_reporting(E_ERROR | E_PARSE);
	
	//Banco de Dados
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
	
	header('Content-type: application/json');

	$sql = "SELECT * FROM rounds";
	$res = $con->query($sql);
	
	while($row = $res->fetch_assoc()){
		if($res->num_rows == $row["id"]){
			$response->playersNumber = $row["playersNumber"];
			$response->playersName = json_decode($row["players"]);
		}
	}
	
	echo json_encode($response);
	
?>