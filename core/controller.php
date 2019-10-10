<?php
class controller{
	public function loadView($viewNome, $dados = array()){
		extract($dados);
		require 'views/'.$viewNome.'.php';
	}
	public function loadTemplate($viewNome, $dados = array()){
		require 'views/template.php';
	}
	public function loadViewInTemplate($viewNome, $dados = array()){
		extract($dados);
		require 'views/'.$viewNome.'.php';
	}
}