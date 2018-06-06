<!DOCTYPE html>
<html>
	<!-- ESTRUTURA -->
	<head>
		<title>GET- Administração</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	
	<body>
	
		<?php
			//VARIAVEIS Referentes somente a esta página
			$global_scripts = array("code.js", "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"); //Scripts
			
			//Diretorio principal
			$dir = "/GitHub/get-dia-t";
			
			//Banco de Dados
			require($_SERVER['DOCUMENT_ROOT'] . $dir . "/modules/php/mysql/connect.php");
			
			//Checar se existe algum round
			$sql = "SELECT * FROM players ORDER BY points";
			$res = $con->query($sql);
			
			echo "<table>";
			echo "<tr>";
			echo "<th>Nome</th>";
			echo "<th>Pontos</th>";
			echo "<th>Jogadas</th>";
			echo "</tr>";
			
			if($res->num_rows > 0){
				while($row = $res->fetch_assoc()){
					echo "<tr>";
					echo "<td>" . strtoupper(str_replace(strval(intval($row["username"])), "", $row["username"])) . "</th>";
					echo "<td>" . $row["points"] . "</th>";
					echo "<td>" . $row["plays"] . "</th>";
					echo "</tr>";
				}
			}	
			echo "</table>";
		
		
		?>
	
	</body>
	<?php
		//Scripts
		for($i = 0; $i <= (count($global_scripts)-1); $i++){
			echo "<script charset='UTF-8' src='" . $global_scripts[$i] . "'></script>";
		}
	?>
</html>