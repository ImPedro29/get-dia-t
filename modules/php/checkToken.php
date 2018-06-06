<?php
	$sql = "SELECT * FROM admin_token";
	$res = $con->query($sql);

	if(!isset($_GET["token"])){
		die("Oops você precisa colocar um token no link, se acha que isso foi um erro, fale com a administração.");
	}
	
	$statusToken = false;
	if($res->num_rows > 0){
		while($row = $res->fetch_assoc()){
			if($_GET["token"]== $row["token"]){
				$statusToken = true;
				break;
			}
		}
	}
	
	error_reporting(E_ERROR | E_PARSE);
	
	if(!$statusToken){
		die("Oops apenas a administração tem acesso :(");
	}else if(!$noShowJSInfo){
		echo "<script> var token = '". $_GET["token"] ."'; var dir = '$dir'; </script>";
	}

?>