<?php
	//VARIAVEIS Referentes somente a esta página
	$global_scripts = array("js/index/code.js", "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"); //Scripts
	
	//Diretorio principal
	$dir = "/GitHub/get-dia-t";
	
	//Dar dir para o JS
	echo "<script> var dir = '$dir'; </script>";
	
	//Banco de Dados
	require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
	
?>
<!DOCTYPE html>
<html>
	<!-- ESTRUTURA -->
	<body>
		<head>
			<title>GET - Cálculo</title>
			<link rel="stylesheet" type="text/css" href="css/index/style.css">
			<button id="startGame" class="startGame">Jogar!<h5 id="startGamePlayers">Carregando...</h5></button>
		</head>
	</body>
	<?php
		//Scripts
		for($i = 0; $i <= (count($global_scripts)-1); $i++){
			echo "<script charset='UTF-8' src='" . $global_scripts[$i] . "'></script>";
		}
	?>
</html>