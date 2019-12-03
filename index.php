<?php 
session_start();
require 'configuracao.php';
require 'routers.php';

spl_autoload_register(function($classe){
	if (file_exists('controllers/'.$classe.'.php')) {
		require 'controllers/'.$classe.'.php';
	}
	else if (file_exists('models/'.$classe.'.php')) {
		require 'models/'.$classe.'.php';
	}
	else if (file_exists('core/'.$classe.'.php')) {
		require 'core/'.$classe.'.php';
	}
});

$core = new Core();
$core->run();