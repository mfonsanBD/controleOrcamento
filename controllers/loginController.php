<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuario;

class LoginController extends Controller{
	public function index(){
		$this->titulo = "Acesse sua conta ou faça seu cadastro.";
		$this->loadTemplate('login');
	}
	public function logar(){
		$usuario = new Usuario();
		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$email = addslashes($_POST['email']);
			$senha = md5($_POST['senha']);

			if($usuario->verificaPermissao($email, $senha)){
				echo 2;
			}else{
				if($usuario->login($email, $senha)){
					echo 1;
				}else{
					echo 0;
				}
			}
		}
	}
	public function cadastro(){
		$usuario = new Usuario();
		if (isset($_POST) && !empty($_POST)) {
			$nome 		= addslashes($_POST['nome']);
			$sobrenome 	= addslashes($_POST['sobrenome']);
			$email 		= addslashes($_POST['email']);
			$senha 		= addslashes(md5($_POST['senha']));
			$codigo 	= md5(time().rand(0,9999));

			if ($usuario->cadastrar($nome, $sobrenome, $email, $senha, $codigo)) {
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