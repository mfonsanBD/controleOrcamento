<?php
namespace Core;

class Controller{
	public function loadView($viewNome, $dados = array()){
		extract($dados);
		require 'Views/'.$viewNome.'.php';
	}
	public function loadTemplate($viewNome, $dados = array()){
		require 'Views/template.php';
	}
	public function loadViewInTemplate($viewNome, $dados = array()){
		extract($dados);
		require 'Views/'.$viewNome.'.php';
	}
}