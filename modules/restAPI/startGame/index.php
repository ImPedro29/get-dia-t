<?php
	//Diretorio principal
	$dir = "/GitHub/get-dia-t";
	
	//Erro
	$response->error = false;
	
	//Desativado erros
	error_reporting(E_ERROR | E_PARSE);
	
	//Banco de Dados
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
	
	//Mostrar token & Diretorio para JavaScript
	$noShowJSInfo = true;
	
	//Checar token
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/checkToken.php");
	
	header('Content-type: application/json');

	$rdNumber1 = rand(1,10);
	$rdNumber2 = rand(1,10);
	while($rdNumber1 == $rdNumber2) $rdNumber2 = rand(1,10);
	
	$roundQuestions = $rdNumber1 . "," . $rdNumber2;

	$sql = "INSERT INTO rounds (id, players, progressing, playersNumber, roundQuestions) VALUES (null, null, 0, 0, '$roundQuestions')";
	echo $sql;
	$con->query($sql) or $response->error = true;
	$response->erroMessage = mysqli_connect_error();
	echo json_encode($response);
?>