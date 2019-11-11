<?php
class painelController extends controller{
	public function index(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		
		$u = new Usuario();

		$id = $_SESSION['logado'];
		$infoContas = $u->contaInfos($id);

		$this->foto = $infoContas['foto'];

		$this->titulo = "Painel de Controle";

		switch ($_SESSION['tipo']) {
			case 0:
				if ($_SESSION['tipo'] != 0) {
					header("Location: ".URL_BASE."painel/cliente/");
					exit();
				}
				$u = new Usuario();
				$e = new Empresa();

				$qtdUsuarios 						= $u->qtdUsuarios();
				$qtdEmpresas 						= $e->qtdEmpresas();

				$empresasAguardandoAprovacao 		= $e->aguardandoAprovacao();
				$empresasEmAtividade 				= $e->empresasEmAtividade();

				$dados['qtdUsuarios'] 				= $qtdUsuarios;
				$dados['qtdEmpresas'] 				= $qtdEmpresas;
				$dados['aguardandoAprovacao'] 		= $empresasAguardandoAprovacao;
				$dados['emAtividade'] 				= $empresasEmAtividade;

				$this->loadTemplate('admin/painel', $dados);
			break;

			case 1:
				if ($_SESSION['tipo'] != 1) {
					header("Location: ".URL_BASE."painel/cliente/");
					exit();
				}

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
}