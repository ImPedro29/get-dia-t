<?php
	//VARIAVEIS Referentes somente a esta página
	$global_scripts = array("code.js", "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"); //Scripts
	
	//Diretorio principal
	$dir = $_SERVER['DOCUMENT_ROOT'] . "/GitHub/get-dia-t";
	
	//Banco de Dados
	require($dir . "/modules/php/mysql/connect.php");
?>
<!DOCTYPE html>
<html>
	<!-- ESTRUTURA -->
	<head>
		<title>GET- Administração</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
		<button id="startGame">Iniciar!<h5 id="startGamePlayers">0 Jogadores...</h5></button>
	</body>
	<?php
		//Scripts
		for($i = 0; $i <= (count($global_scripts)-1); $i++){
			echo "<script charset='UTF-8' src='" . $global_scripts[$i] . "'></script>";
		}
	?>
</html>