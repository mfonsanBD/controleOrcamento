<?php
class empresaController extends controller{
	public function index(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		
		$u = new Usuario();

		$id 			= $_SESSION['logado'];
		$infoContas 	= $u->contaInfos($id);

		$usuarios		= $u->idNomeUsuario();
		$dados['usuarios'] = $usuarios;
		
		$this->fotoUsuario 	= $infoContas['foto'];
		$this->nome 		= $infoContas['nome'];
		$this->sobrenome 	= $infoContas['sobrenome'];

		$this->titulo = "Empresas";

		switch ($_SESSION['tipo']) {
			case 0:
				$e = new Empresa();

				$filtros = array(
					'estado' => ''
				);

				if(isset($_GET['filtros'])){
					$filtros = $_GET['filtros'];
				}

				$qtdEmpresas = $e->qtdEmpresas();
				$dados['qtdEmpresas'] = $qtdEmpresas;
		
				$this->p = 1;
				$epp = 5;
				if (isset($_GET['p']) && !empty($_GET['p'])) {
					$this->p = addslashes($_GET['p']);
				}
				$totalPaginas = ceil($qtdEmpresas/$epp);
				
				$listaEmpresas = $e->listaEmpresas($this->p, $epp, $filtros);

				$dados['listaEmpresas'] = $listaEmpresas;
				$dados['totalPaginas'] = $totalPaginas;

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