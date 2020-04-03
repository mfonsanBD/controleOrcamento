<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuario;

class EsqueciController extends Controller{
	public function index(){
		$this->titulo = "Esqueci minha senha";

		$this->loadTemplate('esqueci-minha-senha', $dados=array());
	}
	public function verificaEmail(){
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email = addslashes($_POST['email']);

			$u = new Usuario();

			if($u->verificaEmail($email)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function redefinirSenha(){
		if(isset($_POST['email']) && !empty($_POST['email'])){
			$email 		= addslashes($_POST['email']);
			$hash 		= md5(time().rand(0,9999));

			$ascii 		= implode('', array_merge(range('a', 'z'), range(0, 9)));
		    $ascii 		= str_repeat($ascii, 5);
		    $codigo 	= substr(str_shuffle($ascii), 0, 6);

			$u = new Usuario();
			$pegaNome = $u->getNome($email);
			$nome = $pegaNome['nome'];

			if($u->redefinirSenha($hash, $codigo, $email)){
			    echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function verificaCodigo(){
		$hash 		= addslashes($_POST['hash']);
		$codigo 	= addslashes($_POST['codigo']);

		$u = new Usuario();

		if($u->verificaCodigo($hash, $codigo)){
			echo "1";
		}else{
			echo "0";
		}
	}
	public function redefinir(){
		if(isset($_POST) && !empty($_POST)){
			$senha 	= md5($_POST['senha']);
			$hash	= addslashes($_POST['hash']);

			$u = new Usuario();

			if($u->redefinir($senha, $hash)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function redefinicaoDeSenha(){
		$this->titulo = "Redefinição de Senha";
		$hash = addslashes($_GET['hash']);
		$dados['hash'] = $hash;
		$this->loadTemplate('redefinicao-de-senha', $dados);
	}
}