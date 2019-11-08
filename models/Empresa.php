<?php
class Empresa extends model{
	public function qtdEmpresas(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS c FROM empresa");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array['c'];
	}
	public function aguardandoAprovacao(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS aa FROM empresa WHERE permissao_empresa = 0");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array['aa'];
	}
	public function empresasEmAtividade(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS ea FROM empresa WHERE permissao_empresa = 1");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array['ea'];
	}
	public function listaEmpresas(){
		$array = array();
		$sql = $this->conexao->prepare("
			SELECT e.*, u.* 
			FROM empresa AS e
			INNER JOIN usuario AS u
			ON e.id_usuario = u.id
		");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function aceitaEmpresa($id){
		$sql = $this->conexao->prepare("UPDATE empresa SET permissao_empresa = 1 WHERE id_empresa = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function desativaEmpresa($id){
		$sql = $this->conexao->prepare("UPDATE empresa SET permissao_empresa = 2 WHERE id_empresa = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function excluiEmpresa($id){
		$sql = $this->conexao->prepare("DELETE FROM empresa WHERE id_empresa = ?");
		$sql->execute(array($id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	// public function cadastrar($nome, $email, $senha, $codigo){
	// 	$sql = $this->conexao->prepare("INSERT INTO empresa SET nome = ?, email = ?, senha = ?, tipo = 1, foto = 'usuario.jpg', permissao = 0, hash = ?");
	// 	$sql->execute(array($nome, $email, $senha, $codigo));
	// }
}