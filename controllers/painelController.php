<?php
class painelController extends controller{
	public function index(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		switch ($_SESSION['tipo']) {
			case 0:
				$this->loadTemplate('admin/painel');
			break;

			case 1:
				$this->loadTemplate('cliente/painel');
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

	public function empresa(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		switch ($_SESSION['tipo']) {
			case 0:
				$this->loadTemplate('admin/empresa');
			break;

			case 1:
				$this->loadTemplate('cliente/empresa');
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

	public function faqs(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		switch ($_SESSION['tipo']) {
			case 0:
				$this->loadTemplate('admin/faqs');
			break;

			case 1:
				$this->loadTemplate('cliente/faqs');
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

	public function configuracoes(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
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

	public function sair(){
		unset($_SESSION['logado']);
		unset($_SESSION['nome_do_usuario']);
		unset($_SESSION['permissao']);
		unset($_SESSION['tipo']);
		header("Location: ".URL_BASE);
	}
}