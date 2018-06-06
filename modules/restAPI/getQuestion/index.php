<?php
	//Diretorio principal
	$dir = "/GitHub/get-dia-t";
	
	//Desativado erros
	error_reporting(E_ERROR | E_PARSE);
	
	//Banco de Dados
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
	
	header('Content-type: application/json');
	
	if(!isset($_GET["question"])){
		$response->error = true;
		die(json_encode($response));
	}
	
	$sql = "SELECT * FROM questions";
	$res = $con->query($sql);
	
	while($row = $res->fetch_assoc()){
		if($_GET["question"] == $row["id"]){
			$response->enunciation = $row["question"];
			$response->alternatives = json_decode($row["alternatives"]);
			$response->image = base64_encode($row["image"]);
		}
	}
	
	$response->error = false;
	echo json_encode($response);
	
?>