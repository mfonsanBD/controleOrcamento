<?php
namespace Models;
use \Core\Model;

class Usuario extends Model{
	public function login($email, $senha){
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE email = ? AND senha = ?");
		$sql->execute(array($email, $senha));

		if ($sql->rowCount() > 0) {
			$dado = $sql->fetch();

			$_SESSION['logado'] 					= $dado['id'];
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
	public function listaUsuarios($p, $upp){
		$offset = ($p - 1)*$upp;
		$array = array();
		$sql = $this->conexao->prepare("
			SELECT * FROM usuario 
			WHERE tipo = 1 
			ORDER BY id DESC 
			LIMIT $offset, $upp");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function idNomeUsuario(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT id, nome, sobrenome FROM usuario WHERE tipo = 1");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function verificaEmail($email){
		$sql = $this->conexao->prepare("SELECT email FROM usuario WHERE email = ?");
		$sql->execute(array($email));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function addU($nome, $sobrenome, $email, $senha, $codigo){
		$sql = $this->conexao->prepare("INSERT INTO usuario SET nome = ?, sobrenome = ?, email = ?, senha = ?, tipo = 1, foto = 'usuario.jpg', permissao = 1, hash = ?");
		$sql->execute(array($nome, $sobrenome, $email, $senha, $codigo));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function excluiU($id){
		$sql = $this->conexao->prepare("DELETE FROM usuario WHERE id = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			return true;
		}
		else{
			return false;
		}
	}
	public function getNome($email){
		$sql = $this->conexao->prepare("SELECT nome FROM usuario WHERE email = ?");
		$sql->execute(array($email));

		if($sql->rowCount() > 0){
			return $sql->fetch();
		}
	}
	public function redefinirSenha($hash, $codigo, $email){
		$sql = $this->conexao->prepare("UPDATE usuario SET hash = ?, codigo_redefinicao = ? WHERE email = ?");
		$sql->execute(array($hash, $codigo, $email));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function verificaCodigo($hash, $codigo){
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE hash = ? AND codigo_redefinicao = ?");
		$sql->execute(array($hash, $codigo));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function redefinir($senha, $hash){
		$sql = $this->conexao->prepare("UPDATE usuario SET senha = ? WHERE hash = ?");
		$sql->execute(array($senha, $hash));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function cadastrar($nome, $sobrenome, $email, $senha, $codigo){
		$sql = $this->conexao->prepare("INSERT INTO usuario SET nome = ?, sobrenome = ?, email = ?, senha = ?, tipo = 1, foto = 'usuario.jpg', permissao = 0, hash = ?");
		$sql->execute(array($nome, $sobrenome, $email, $senha, $codigo));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
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
	public function contaInfos($id){
		$array = array();
		$sql = $this->conexao->prepare("SELECT * FROM usuario WHERE id = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			$array = $sql->fetch();
		}

		return $array;
	}
	public function verificaFoto($foto){
		$sql = $this->conexao->prepare("SELECT foto FROM usuario WHERE foto = ?");
		$sql->execute(array($foto));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function alteraFoto($foto, $id){
		$sql = $this->conexao->prepare("UPDATE usuario SET foto = ? WHERE id = ?");
		$sql->execute(array($foto, $id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function alteraDados($nome, $sobrenome, $email, $id){
		$sql = $this->conexao->prepare("UPDATE usuario SET nome = ?, sobrenome = ?, email = ? WHERE id = ?");
		$sql->execute(array($nome, $sobrenome, $email, $id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function verificaSenha($senha, $id){
		$sql = $this->conexao->prepare("SELECT senha FROM usuario WHERE senha = ? AND id = ?");
		$sql->execute(array($senha, $id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function alteraSenha($senha, $id){
		$sql = $this->conexao->prepare("UPDATE usuario SET senha = ? WHERE id = ?");
		$sql->execute(array($senha, $id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
}