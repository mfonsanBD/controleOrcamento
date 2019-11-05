<?php
class painelController extends controller{
	public function index(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		$this->titulo = "Painel de Controle";

		switch ($_SESSION['tipo']) {
			case 0:
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
	public function usuario(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		$this->titulo = "Usuários";
		
		$u = new Usuario();
		
		$listaUsuarios = $u->listaUsuarios();
		$dados['listaUsuarios'] = $listaUsuarios;

		$this->loadTemplate('admin/usuario', $dados);
	}
	public function empresa(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		$this->titulo = "Empresas";

		switch ($_SESSION['tipo']) {
			case 0:
				$e = new Empresa();
				
				$listaEmpresas = $e->listaEmpresas();
				$dados['listaEmpresas'] = $listaEmpresas;

				$this->loadTemplate('admin/empresa', $dados);
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

		$this->titulo = "Perguntas Frequentes";

		switch ($_SESSION['tipo']) {
			case 0:

				$pf = new PerguntasFrequentes();
				
				$listaDePF = $pf->listaFaqs();

				$dados['listaDePF'] = $listaDePF;

				$this->loadTemplate('admin/faqs', $dados);
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
	public function adminEdita(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		$u = new Usuario();

		if (isset($_POST['senha']) && !empty($_POST['senha'])) {
			$id = $_POST['id'];
			$senha = md5($_POST['senha']);
			
			if($u->alteraSenhaUsuario($senha, $id)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function adminExcluiU(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		$u = new Usuario();

		if(isset($_POST['id']) && !empty($_POST['id'])){
			$id = $_POST['id'];

			if($u->excluiU($id)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function addFaqs(){

		$pf = new PerguntasFrequentes();

		if(isset($_POST['pergunta']) && isset($_POST['resposta']) && !empty($_POST['pergunta']) && !empty($_POST['resposta'])){
			
			$pergunta = addslashes($_POST['pergunta']);
			$resposta = addslashes($_POST['resposta']);

			if($pf->adicionaPF($pergunta, $resposta)){
				echo "1";
			}else{
				echo "0";
			}
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