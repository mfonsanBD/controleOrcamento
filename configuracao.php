<?php
require 'ambiente.php';

define("NOME_DO_SITE", 'Controle de Orçamentos');

$config = array();
if (AMBIENTE == 'desenvolvimento') {
	define("URL_BASE", 'http://localhost/gcc/');
	$config['banco'] 		= 'gcc';
	$config['host'] 		= 'localhost';
	$config['usuario'] 		= 'root';
	$config['senha'] 		= 'root';
}else{
	define("URL_BASE", 'http://controle.clientes/');
	$config['banco'] 		= 'gcc';
	$config['host'] 		= 'localhost';
	$config['usuario'] 		= 'root';
	$config['senha'] 		= 'root';
}

global $conexao;

try {
	$conexao = new PDO("mysql:dbname=".$config['banco']."; host=".$config['host']."; charset=utf8", $config['usuario'], $config['senha']);
} catch (PDOException $e) {
	echo "Falha na conexão: ".$e->getMessage();
}