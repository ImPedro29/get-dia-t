<?php
//CONEXÃO COM O BANCO DE DADOS
//> é daqui que você dá o include
	$servidor = 'localhost';
	$usuario = 'getdiat';
	$senha = 'tg0vvlbb5o';
	$banco = 'getdiat';
	$con = new mysqli($servidor, $usuario, $senha, $banco) or die("Conexão com banco de dados não pode ser estabelecida.");
	$con->set_charset("utf8");