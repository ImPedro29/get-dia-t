<?php
	//Diretorio principal
	$dir = "/GitHub/get-dia-t";
	
	//Desativado erros
	error_reporting(E_ERROR | E_PARSE);
	
	//Banco de Dados
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
	
	//Setando JSON
	header('Content-type: application/json');
	
	//Checar se o o username existe
	if(!isset($_GET["username"])){
		$response->error = true;
		die(json_encode($response));
	}
	
	//Variaveis
	$userForRegister = $_GET["username"];
	$response->error = false;
	
	//--Interação Banco de Dados
	$sql = "SELECT * FROM rounds";
	$res = $con->query($sql);
	
	$question = rand(2,3);

	$sql = "INSERT INTO rounds (player, question, corrects) VALUES ('$userForRegister', '$question', 0)";
	$response->question = $question;
	$response->error = true;
	$con->query($sql) or die(json_encode($response));
	
	$sql = "SELECT * FROM players";
	$res = $con->query($sql);
	
	$register = true;
	//Checa se o usuário ja está no banco de dados
	while($row = $res->fetch_assoc()){
		if($res->num_rows == $row["id"]){
			$id = $row["id"];
			$plays = $row["plays"];
			if($row["username"] == $userForRegister){
				$register = false;
			}
		}
	}
	
	if($register){
		$sql = "INSERT INTO players (username, points, plays) VALUES ('$userForRegister', 0, 0)";
		$response->error = true;
		$con->query($sql) or die(json_encode($response));
	}else{
		$plays++;
		$sql = "UPDATE players SET plays=$plays WHERE id='$id'";
		$response->error = true;
		$con->query($sql) or die(json_encode($response));
	}
	
	
	$response->error = false;
	echo json_encode($response);
	
	
?>