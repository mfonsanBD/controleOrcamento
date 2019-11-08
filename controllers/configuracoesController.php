<?php
class configuracoesController extends controller{
	public function index(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		$this->titulo = "Configurações da Conta";
		switch ($_SESSION['tipo']) {
			case 0:
				$this->loadTemplate('admin/configuracoes');
			break;

			case 1:
				$this->loadTemplate('cliente/configuracoes');
			break;
			
			default:
				unset($_SESSION['logado']);
				unset($_SESSION['nome_do_usuario']);
				unset($_SESSION['permissao']);
				unset($_SESSION['tipo']);
				header("Location: ".URL_BASE);
				exit();
			break;
		}
	}
}