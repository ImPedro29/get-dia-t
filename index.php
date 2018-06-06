<?php
	//Diretorio principal
	$dir = "/GitHub/get-dia-t";

	//VARIAVEIS Referentes somente a esta página
	$global_scripts = array("js/index/code.js", "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"); //Scripts
	
	//Banco de Dados
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
	
	echo "<script> var dir = '$dir';</script>"
	
?>
<!DOCTYPE html>
<html>
	<!-- ESTRUTURA -->
	<head>
		<title>GET - Cálculo</title>
		<link rel="stylesheet" type="text/css" href="css/index/style.css">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' />
	</head>
	
	<body>
		<button id="startGame" class="startGame">Jogar!<h5 id="startGamePlayers">Questões de Lógica.</h5></button>
		<button id="schedule" class="schedule"></button>
		<div id="question">
			<h4 id="questionNumber">Pergunta 01:</h4>
			<h4 id="questionEnunciation" class="questionEnunciation">Carregando...</h4>
			<img id="questionImage"></img><br><br>
			<center>
			<button onclick="endGame(0, this);" class="alternativesButton" id="alternativeA">NaN</button>
			<button onclick="endGame(1, this);" class="alternativesButton" id="alternativeB">NaN</button>
			<button onclick="endGame(2, this);" class="alternativesButton" id="alternativeC">NaN</button>
			<button onclick="endGame(3, this);" class="alternativesButton" id="alternativeD">NaN</button>
			<button onclick="endGame(4, this);" class="alternativesButton" id="alternativeE">NaN</button>
			</center>
			<div id="message"></div>
		</div>
	</body>
	<?php
		//Scripts
		for($i = 0; $i <= (count($global_scripts)-1); $i++){
			echo "<script charset='UTF-8' src='" . $global_scripts[$i] . "'></script>";
		}
	?>
</html>