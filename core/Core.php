<?php
class Core{
	public function run(){
		$url = '/';
		if (isset($_GET['url'])) {
			$url .= $_GET['url'];
		}

		$parametro = array();

		if (!empty($url) && $url != '/') {
			$url = explode('/', $url);
			array_shift($url);

			$controllerAtual = $url[0]."Controller";
			array_shift($url);

			if (!empty($url[0]) && isset($url[0])) {
				$actionAtual = $url[0];
				array_shift($url);
			}else{
				$actionAtual = 'index';
			}

			if (count($url) > 0) {
				$parametro = $url;
			}

		}else{
			$controllerAtual = 'loginController';
			$actionAtual = 'index';
		}

		if(!file_exists('controllers/'.$controllerAtual.'.php') || !method_exists($controllerAtual, $actionAtual)){
			$controllerAtual = 'notfoundController';
			$actionAtual = 'index';
		}
		
		$c = new $controllerAtual();
		call_user_func_array(array($c, $actionAtual), $parametro); 
	}
}