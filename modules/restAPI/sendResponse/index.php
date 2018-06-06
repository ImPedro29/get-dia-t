<?php
	//Diretorio principal
	$dir = "/GitHub/get-dia-t";
	
	//Desativado erros
	error_reporting(E_ERROR | E_PARSE);
	
	//Banco de Dados
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
	
	header('Content-type: application/json');
	
	if(!isset($_GET["alternative"]) || !isset($_GET["name"]) || !isset($_GET["question"]) || !isset($_GET["id"]) || !isset($_GET["points"])){
		$response->error = true;
		die(json_encode($response));
	}
	$alternative = $_GET["alternative"];
	$name = $_GET["name"];
	$question = $_GET["question"];
	$roundid = $_GET["id"];
	$points = $_GET["points"];
	
	$sql = "SELECT * FROM questions";
	$response->error = true;
	$res = $con->query($sql) or die(json_encode($response));
	
	$response->correct = false;
	
	while($row = $res->fetch_assoc()){
		if($_GET["question"] == $row["id"]){
			if($alternative == $row["corrects"]){
				$response->correct = true;
				$sql2 = "SELECT * FROM players";
				$res2 = $con->query($sql2);
				while($row2 = $res2->fetch_assoc()){
					if($row2["username"] == $name){
						$sql3 = "UPDATE players SET points='" . ($row2["points"]+$points) . "' WHERE username='$name'";
						$response->error = true;
						$con->query($sql3) or die(json_encode($response));
					}
				}
				$sql4 = "UPDATE rounds SET corrects=1 WHERE id=$roundid";
				$response->error = true;
				$con->query($sql4) or die(json_encode($response));
				
			}
		}
	}
	
	$response->error = false;
	echo json_encode($response);
	
?>