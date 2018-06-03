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
	
	//Checa se o usuário ja está no banco de dados
	while($row = $res->fetch_assoc()){
		if($res->num_rows == $row["id"]){
			$id = $row["id"];
			$players = json_decode($row["players"]);
			$playersArray = json_decode(json_encode($players), true);
			$playersNumber = $row["playersNumber"];
			$playersNumber++;
			foreach($players as $username){
				if($userForRegister == $username){
					$response->error = true;
					die(json_encode($response));
				}else{
					for($i = 0; $i < strlen($username); $i++){
						if($username[$i] == "%"){
							$usernames = explode("%", $username);
							foreach($usernames as $usernamesExploded){
								if($usernamesExploded == $userForRegister){
									$response->error = true;
									die(json_encode($response));
								}
							}
						}
					}
				}
			}
		}
	}
	
	//Registra o usuário no round
	if($playersArray[0] == "") $playersArray[0] = $userForRegister;
	else $playersArray[0] = $playersArray[0] . "%" . $userForRegister;

	$sql = "UPDATE rounds SET players='". json_encode($playersArray) ."', playersNumber=$playersNumber WHERE id=$id";
	$response->error = true;
	$con->query($sql) or die(json_encode($response));
	
	
	$response->error = false;
	echo json_encode($response);
	
	
?>