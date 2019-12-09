<?php
global $routers;
$routers = array();

$routers['/empresa/{slug}'] 						= '/empresa/abrir/:slug';

$routers['/configuracoes/verificaCampos'] 			= '/configuracoes/verificaCampos';
$routers['/configuracoes/alteraNome'] 				= '/configuracoes/alteraNome';
$routers['/configuracoes/alteraSobrenome'] 			= '/configuracoes/alteraSobrenome';
$routers['/configuracoes/alteraEmail'] 				= '/configuracoes/alteraEmail';
$routers['/configuracoes/alteraNomeSobrenome'] 		= '/configuracoes/alteraNomeSobrenome';
$routers['/configuracoes/alteraNomeEmail'] 			= '/configuracoes/alteraNomeEmail';
$routers['/configuracoes/alteraSobrenomeEmail'] 	= '/configuracoes/alteraSobrenomeEmail';

$routers['/configuracoes/verificaSenhaAtual'] 		= '/configuracoes/verificaSenhaAtual';
$routers['/configuracoes/alteraSenha'] 				= '/configuracoes/alteraSenha';
$routers['/configuracoes/alteraSenha'] 				= '/configuracoes/alteraSenha';

$routers['/empresa/aceita'] 						= '/empresa/aceita';
$routers['/empresa/exclui'] 						= '/empresa/exclui';
$routers['/empresa/desativar'] 						= '/empresa/desativar';

$routers['/esqueci/verificaEmail/'] 				= '/esqueci/verificaEmail/';
$routers['/esqueci/verificaCodigo/'] 				= '/esqueci/verificaCodigo/';
$routers['/esqueci/redefinir/'] 					= '/esqueci/redefinir/';
$routers['/esqueci/redefinirSenha/'] 				= '/esqueci/redefinirSenha/';

$routers['/login/index'] 							= '/login/index';
$routers['/login/logar'] 							= '/login/logar';
$routers['/login/verificaEmail'] 					= '/login/verificaEmail';

$routers['/painel'] 								= '/painel';
$routers['/usuario'] 								= '/usuario';
$routers['/empresa'] 								= '/empresa';
$routers['/faqs'] 									= '/faqs';
$routers['/configuracoes'] 							= '/configuracoes';
$routers['/esqueci'] 								= '/esqueci';

$routers['/sair'] 									= '/login/sair/';