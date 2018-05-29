<head>
	
	<meta charset="UTF-8"> <!-- SETANDO UTF8 -->
	
	<title><?php echo $title;?></title> <!-- TITULO -->
	
	<link rel="icon" type="image/png" href="<?php echo $icon; ?>"/>
	
	<!-- IMPORTs -->
	<?php
	
		//Estilos
		for($i = 0; $i <= (count($global_css)-1); $i++){
			echo "<link rel='stylesheet' type='text/css' href='" . $global_css[$i] . "'>";
		}
	?>
</head>