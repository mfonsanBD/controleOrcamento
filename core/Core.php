<?php
class Core{
	public function run(){
		$url = '/';
		if (isset($_GET['url'])) {
			$url .= $_GET['url'];
		}

		$url = $this->checkRouters($url);

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

	public function checkRouters($url){
		global $routers;

		foreach ($routers as $pt => $newurl) {
			// Identifica os argumentos e substitui por regex
			$pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $pt);

			// match da url
			if(preg_match('#^('.$pattern.')*$#i', $url, $matches) === 1){
				array_shift($matches);
				array_shift($matches);
				
				// pegar os argumentos para associar
				$itens = array();
				if (preg_match_all('(\{[a-z0-9]{1,}\})', $pt, $m)) {
					$itens = preg_replace('(\{|\})', '', $m[0]);
				}

				// faz a associação
				$arg = array();
				foreach ($matches as $key => $match) {
					$arg[$itens[$key]] = $match;
				}

				// monta a nova url
				foreach ($arg as $argkey => $argvalue) {
					$newurl = str_replace(':'.$argkey, $argvalue, $newurl);
				}

				$url = $newurl;

				break; 
			}
		}

		return $url;
	}
}