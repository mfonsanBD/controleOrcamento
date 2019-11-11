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
				$u = new Usuario();

				$id = $_SESSION['logado'];
				$infoContas = $u->contaInfos($id);

				$this->foto = $infoContas['foto'];

				$dados['mostraInfos'] = $infoContas;
				$this->loadTemplate('admin/configuracoes', $dados);
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