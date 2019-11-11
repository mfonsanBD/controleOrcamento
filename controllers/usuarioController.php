<?php
class usuarioController extends controller{
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

		$this->foto = $infoContas['foto'];
		
		$listaUsuarios = $u->listaUsuarios();
		$dados['listaUsuarios'] = $listaUsuarios;

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

			if($u->excluiU($id)){
				echo "1";
			}else{
				echo "0";
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
			$nome 		= $_POST['nome'];
			$email 		= $_POST['email'];
			$senha 		= $_POST['senha'];
			$codigo		= md5(time().rand(0, 9999));

			if($u->addU($nome, $email, md5($senha), $codigo)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
}