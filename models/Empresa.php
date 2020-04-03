<?php
namespace Models;
use \Core\Model;

class Empresa extends Model{
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
	public function desativada(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS ed FROM empresa WHERE permissao_empresa = 2");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array['ed'];
	}
	public function listaEmpresas($p, $epp){
		$offset = ($p - 1)*$epp;

		$array = array();
		$sql = $this->conexao->prepare("
			SELECT * FROM empresa
			ORDER BY id_empresa DESC
			LIMIT $offset, $epp");

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
	public function adminAddEmpresa($idGerente, $nomeEmpresa, $emailEmpresa, $siteEmpresa, $telefoneEmpresa, $whatsappEmpresa, $slug){
		$sql = $this->conexao->prepare("INSERT INTO empresa SET id_usuario = ?, nome_empresa = ?, email_empresa = ?, site_empresa = ?, telefone_empresa = ?, whatsapp_empresa = ?, slug_empresa = ?");
		$sql->execute(array($idGerente, $nomeEmpresa, $emailEmpresa, $siteEmpresa, $telefoneEmpresa, $whatsappEmpresa, $slug));

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
}