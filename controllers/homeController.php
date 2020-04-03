<?php
namespace Controllers;
use \Core\Controller;

class HomeController extends Controller{
	public function index(){
		if (empty($_SESSION['logado']) && $_SESSION['permissao'] != 1) {
			header("Location: ".URL_BASE);
			exit();
		}
		$this->loadTemplate('home', $dados=array());
	}
}