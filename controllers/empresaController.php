<?php
class empresaController extends controller{
	public function index(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		
		$u = new Usuario();

		$id = $_SESSION['logado'];
		$infoContas = $u->contaInfos($id);

		$this->foto = $infoContas['foto'];

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
	public function aceita(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		if(isset($_POST['id']) && !empty($_POST['id'])){
			$id = $_POST['id'];

			$e = new Empresa();

			if($e->aceitaEmpresa($id)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function desativar(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		if(isset($_POST['id']) && !empty($_POST['id'])){
			$id = $_POST['id'];

			$e = new Empresa();

			if($e->desativaEmpresa($id)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function exclui(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		if(isset($_POST['id']) && !empty($_POST['id'])){
			$id = $_POST['id'];

			$e = new Empresa();

			if($e->excluiEmpresa($id)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
}