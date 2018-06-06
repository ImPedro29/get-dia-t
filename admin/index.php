<?php
	//VARIAVEIS Referentes somente a esta página
	$global_scripts = array("code.js", "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"); //Scripts
	
	//Diretorio principal
	$dir = "/GitHub/get-dia-t";
	
	//Banco de Dados
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
	
	//Verificar Token
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/checkToken.php");
	
	//Checar se existe algum round
	$sql = "SELECT * FROM rounds";
	$res = $con->query($sql);
	
	$lastRoundEnded = true;
	
	if($res->num_rows > 0){
		while($row = $res->fetch_assoc()){
			if($row["progressing"] == 0){
				$lastRoundEnded = false;
				break;
			}
		}
	}
	
	//Insere novo round na database
	if($lastRoundEnded){
		$rdNumber1 = rand(1,10);
		$rdNumber2 = rand(1,10);
		while($rdNumber1 == $rdNumber2) $rdNumber2 = rand(1,10);
		
		$roundQuestions = $rdNumber1 . "," . $rdNumber2;
		
		$sql = "INSERT INTO rounds (id, players, progressing, playersNumber, roundQuestions) VALUES (NULL, 'null', 0, 0, '$roundQuestions')";
		$con->query($sql) or die("Falha. Não foi possível inserir um novo round na DB.");
	}
	
	
	
?>
<!DOCTYPE html>
<html>
	<!-- ESTRUTURA -->
	<head>
		<title>GET- Administração</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<button id="startGame" class="startGame">Iniciar!<h5 id="startGamePlayers">0 Jogadores...</h5></button>
		<button id="schedule" class="schedule"></button>
		<div id="message">VENHA JOGAR!</div>
		<div id="question">
			<h4 id="questionNumber">Pergunta 01:</h4>
			<h4 class="questionEnunciation">Veja a questão no seu celular!</h4>
		</div>
	</body>
	<?php
		//Scripts
		for($i = 0; $i <= (count($global_scripts)-1); $i++){
			echo "<script charset='UTF-8' src='" . $global_scripts[$i] . "'></script>";
		}
	?>
</html>