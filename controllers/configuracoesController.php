<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuario;

class ConfiguracoesController extends Controller{
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

				$this->fotoUsuario 	= $infoContas['foto'];
				$this->nome 		= $infoContas['nome'];
				$this->sobrenome 	= $infoContas['sobrenome'];

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
	public function alteraImagem(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}

		if(isset($_POST['foto']) && !empty($_POST['foto'])){
			$id = $_SESSION['logado'];
			$foto = $_POST['foto'];

			$array1 = explode(";", $foto);
			$array2 = explode(",", $array1[1]);

			$permitidos = array('data:image/jpeg', 'data:image/png', 'data:image/jpg');

			if (in_array($array1[0], $permitidos)) {
			$dados = base64_decode($array2[1]);
			$nome_da_foto = md5($id).'.jpg';

				if(is_dir('assets/img/usuarios/'.$_SESSION['logado'].'/')){
					file_put_contents('assets/img/usuarios/'.$_SESSION['logado'].'/'.$nome_da_foto, $dados);
				}else{
					mkdir('assets/img/usuarios/'.$_SESSION['logado'].'/');
					file_put_contents('assets/img/usuarios/'.$_SESSION['logado'].'/'.$nome_da_foto, $dados);
				}
				
				$u = new Usuario();
				
				if($u->verificaFoto($nome_da_foto)){
					echo "2";
				}else{
					if($u->alteraFoto($nome_da_foto, $id)){
						echo "1";
					}else{
						echo "0";
					}
				}
			}
		}
	}
	public function alteraDados(){
		if(isset($_POST) && !empty($_POST)){
			$nome 			= addslashes($_POST['nome']);
			$sobrenome 		= addslashes($_POST['sobrenome']);
			$email 			= addslashes($_POST['email']);
			$id 			= $_SESSION['logado'];

			$u = new Usuario();
			if($u->alteraDados($nome, $sobrenome, $email, $id)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	public function verificaSenhaAtual(){
		if(isset($_POST['senha']) && !empty($_POST['senha'])){
			$senha 	= md5(addslashes($_POST['senha']));
			$id 	= $_SESSION['logado'];

			$u = new Usuario();

			if($u->verificaSenha($senha, $id)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
	public function alteraSenha(){
		if(isset($_POST['senha']) && !empty($_POST['senha'])){
			$senha 	= md5(addslashes($_POST['senha']));
			$id 	= $_SESSION['logado'];

			$u = new Usuario();

			if($u->alteraSenha($senha, $id)){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
}