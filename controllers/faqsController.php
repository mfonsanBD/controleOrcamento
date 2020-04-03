<?php
namespace Controllers;
use \Core\Controller;
use \Models\Usuario;
use \Models\PerguntasFrequentes;

class FaqsController extends Controller{
	public function index(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		
		$u = new Usuario();

		$id = $_SESSION['logado'];
		$infoContas = $u->contaInfos($id);

		$this->fotoUsuario 	= $infoContas['foto'];
		$this->nome 		= $infoContas['nome'];
		$this->sobrenome 	= $infoContas['sobrenome'];

		$this->titulo = "Perguntas Frequentes";

		switch ($_SESSION['tipo']) {
			case 0:

				$pf = new PerguntasFrequentes();

				$qtdFaqs = $pf->qtdFaqs();
				$dados['qtdFaqs'] = $qtdFaqs;
				
				$this->p = 1;
				$pfpp = 5;
				if (isset($_GET['p']) && !empty($_GET['p'])) {
					$this->p = addslashes($_GET['p']);
				}
				$totalPaginas = ceil($qtdFaqs/$pfpp);
				
				$listaDePF = $pf->listaFaqs($this->p, $pfpp);

				$dados['listaDePF'] = $listaDePF;
				$dados['totalPaginas'] = $totalPaginas;

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
	public function adminEditaPF(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		$pf = new PerguntasFrequentes();
		if (isset($_POST) && !empty($_POST)) {
			$id = $_POST['id'];
			$pergunta = addslashes($_POST['pergunta']);
			$resposta = addslashes($_POST['resposta']);
			
			if($pf->editaPF($pergunta, $resposta, $id)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	public function adminExcluiPF(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		$pf = new PerguntasFrequentes();
		if(isset($_POST['id']) && !empty($_POST['id'])){
			$id = $_POST['id'];

			if($pf->excluiPF($id)){
				echo "1";
			}else{
				echo "0";
			}
		}
	}
}