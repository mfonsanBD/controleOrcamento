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
			$nome_da_foto = md5(time().rand(0, 99999)).'.jpg';
				if(is_dir('assets/img/usuarios/'.$_SESSION['logado'].'/')){
					file_put_contents('assets/img/usuarios/'.$_SESSION['logado'].'/'.$nome_da_foto, $dados);
				}else{
					mkdir('assets/img/usuarios/'.$_SESSION['logado'].'/');
					file_put_contents('assets/img/usuarios/'.$_SESSION['logado'].'/'.$nome_da_foto, $dados);
				}
				$u = new Usuario();
				if($u->alteraFoto($nome_da_foto, $id)){
					echo "1";
				}else{
					echo "0";
				}
			}
		}
	}
}