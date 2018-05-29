<?php
//CONEXÃO COM O BANCO DE DADOS
//> é daqui que você dá o include
	$servidor = '35.198.28.56';
	$usuario = 'getdiat';
	$senha = '2Sjp60qLwuwflbUf';
	$banco = 'getdiat';
	$con = new mysqli($servidor, $usuario, $senha, $banco) or die("Conexão com banco de dados não pode ser estabelecida.");