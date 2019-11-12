<?php
class Usuario extends model{
	public function login($email, $senha){
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE email = ? AND senha = ?");
		$sql->execute(array($email, $senha));

		if ($sql->rowCount() > 0) {
			$dado = $sql->fetch();

			$_SESSION['logado'] 					= $dado['id'];
			$_SESSION['nome_do_usuario'] 			= $dado['nome'];
			$_SESSION['sobrenome_do_usuario'] 		= $dado['sobrenome'];
			$_SESSION['permissao'] 					= $dado['permissao'];
			$_SESSION['tipo'] 						= $dado['tipo'];

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
	public function qtdUsuarios(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS c FROM usuario WHERE tipo = 1");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array['c'];
	}
	public function listaUsuarios(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE tipo = 1 ORDER BY id DESC LIMIT 10");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function alteraSenhaUsuario($senha, $id){
		$sql = $this->conexao->prepare("UPDATE usuario SET senha = ? WHERE id = ?");
		$sql->execute(array($senha, $id));

		if ($sql->rowCount() > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function cadastrar($nome, $email, $senha, $codigo){
		$sql = $this->conexao->prepare("INSERT INTO usuario SET nome = ?, email = ?, senha = ?, tipo = 1, foto = 'usuario.jpg', permissao = 0, hash = ?");
		$sql->execute(array($nome, $email, $senha, $codigo));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function addU($nome, $email, $senha, $codigo){
		$sql = $this->conexao->prepare("INSERT INTO usuario SET nome = ?, email = ?, senha = ?, tipo = 1, foto = 'usuario.jpg', permissao = 1, hash = ?");
		$sql->execute(array($nome, $email, $senha, $codigo));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function excluiU($id){
		$sql = $this->conexao->prepare("DELETE FROM usuario WHERE id = ?");
		$sql->execute(array($id));

		if ($sql->rowCount() > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function contaInfos($id){
		$array = array();
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE id = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}

		return $array;
	}
}