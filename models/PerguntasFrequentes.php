<?php
namespace Models;
use \Core\Model;

class PerguntasFrequentes extends Model{
	public function adicionaPF($pergunta, $resposta){
		$sql = $this->conexao->prepare("INSERT INTO perguntas_frequentes SET pergunta_pf = ?, resposta_pf = ?");
		$sql->execute(array($pergunta, $resposta));

		if ($sql->rowCount() > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function qtdFaqs(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT COUNT(*) AS pf FROM perguntas_frequentes");
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array['pf'];
	}
	public function listaFaqs($p, $pfpp){
		$offset = ($p - 1)*$pfpp;
		$array = array();
		$sql = $this->conexao->prepare("
			SELECT * FROM perguntas_frequentes 
			ORDER BY id_pf DESC
			LIMIT $offset, $pfpp");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}
	public function editaPF($pergunta, $resposta, $id){
		$sql = $this->conexao->prepare("UPDATE perguntas_frequentes SET pergunta_pf = ?, resposta_pf = ? WHERE id_pf = ?");
		$sql->execute(array($pergunta, $resposta, $id));

		if($sql->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function excluiPF($id){
		$sql = $this->conexao->prepare("DELETE FROM perguntas_frequentes WHERE id_pf = ?");
		$sql->execute(array($id));

		if ($sql->rowCount() > 0) {
			return true;
		}else{
			return false;
		}
	}
}