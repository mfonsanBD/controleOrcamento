<?php
class Usuario extends model{
	public function login($email, $senha){
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE email = ? AND senha = ?");
		$sql->execute(array($email, $senha));

		if ($sql->rowCount() > 0) {
			$dado = $sql->fetch();

			$_SESSION['logado'] 			= $dado['id'];
			$_SESSION['nome_do_usuario'] 	= $dado['nome'];
			$_SESSION['permissao'] 			= $dado['permissao'];
			$_SESSION['tipo'] 				= $dado['tipo'];
			$_SESSION['foto'] 				= $dado['foto'];

			return true;
		}else{
			return false;
		}
	}

	public function verificaPermissao($email, $senha){
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE email = ? AND senha = ? AND permissao = 0");
		$sql->execute(array($email, $senha));

		if ($sql->rowCount() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function cadastrar($nome, $email, $senha, $codigo){
		$sql = $this->conexao->prepare("INSERT INTO usuario SET nome = ?, email = ?, senha = ?, tipo = 1, permissao = 0, hash = ?");
		$sql->execute(array($nome, $email, $senha, $codigo));
	}
}