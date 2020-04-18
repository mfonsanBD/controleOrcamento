<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuario;

class UsuarioController extends Controller{
	public function index(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		if ($_SESSION['tipo'] != 0) {
			header("Location: ".URL_BASE."painel/cliente/");
			exit();
		}

		$this->titulo = "Usuários";
		
		$u = new Usuario();

		$id = $_SESSION['logado'];
		$infoContas = $u->contaInfos($id);

		$this->fotoUsuario 	= $infoContas['foto'];
		$this->nome 		= $infoContas['nome'];
		$this->sobrenome 	= $infoContas['sobrenome'];

		$qtdUsuarios = $u->qtdUsuarios();
		$dados['qtdUsuarios'] = $qtdUsuarios;
		
		$this->p = 1;
		$upp = 5;
		if (isset($_GET['p']) && !empty($_GET['p'])) {
			$this->p = addslashes($_GET['p']);
		}
		$totalPaginas = ceil($qtdUsuarios/$upp);
		
		$listaUsuarios = $u->listaUsuarios($this->p, $upp);

		$dados['listaUsuarios'] = $listaUsuarios;
		$dados['totalPaginas'] = $totalPaginas;

		$this->loadTemplate('admin/usuario', $dados);
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
			
			$caminho = "assets/img/usuarios/".$id;
			$foto = md5($id).".jpg";

			unlink($caminho."/".$foto);
			rmdir($caminho);

			if($u->excluiU($id)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	public function adminAddU(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		$u = new Usuario();
		if(isset($_POST) && !empty($_POST)){
			$nome 		= addslashes($_POST['nome']);
			$sobrenome 	= addslashes($_POST['sobrenome']);
			$email 		= addslashes($_POST['email']);
			$senha 		= md5($_POST['senha']);
			$codigo		= md5(time().rand(0, 9999));

			if($u->verificaEmail($email)){
				echo 2;
			}
			else{
				if($u->addU($nome, $sobrenome, $email, $senha, $codigo)){
					echo 1;
				}else{
					echo 0;
				}
			}
		}
	}
}