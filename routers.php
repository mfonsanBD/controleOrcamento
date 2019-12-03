<?php
global $routers;
$routers = array();

$routers['/empresa/{id}/{slug}'] 	= '/empresa/abrir/:id/:slug';

$routers['/login/index'] 			= '/login/index';
$routers['/login/logar'] 			= '/login/logar';
$routers['/login/verificaEmail'] 	= '/login/verificaEmail';

$routers['/painel'] 				= '/painel';
$routers['/usuario'] 				= '/usuario';
$routers['/empresa'] 				= '/empresa';
$routers['/faqs'] 					= '/faqs';
$routers['/configuracoes'] 			= '/configuracoes';

// $routers['/{sair}'] 				= '/login/sair/:sair';
$routers['/{esqueci}'] 				= '/login/esqueci/:esqueci';
