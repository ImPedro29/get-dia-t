<?php
	//VARIAVEIS Referentes somente a esta página
	$global_scripts = array("code.js", "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"); //Scripts
	
	//Diretorio principal
	$dir = "/GitHub/get-dia-t";
	
	//Banco de Dados
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
	
	//Verificar Token
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/checkToken.php");
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