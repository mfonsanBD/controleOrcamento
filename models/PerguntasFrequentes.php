<?php
class PerguntasFrequentes extends model{
	public function adicionaPF($pergunta, $resposta){
		$sql = $this->conexao->prepare("INSERT INTO perguntas_frequentes SET pergunta_pf = ?, resposta_pf = ?");
		$sql->execute(array($pergunta, $resposta));

		if ($sql->rowCount() > 0) {
			return true;
		}else{
			return false;
		}
	}
	public function listaFaqs(){
		$array = array();
		$sql = $this->conexao->prepare("SELECT * FROM perguntas_frequentes ORDER BY id_pf DESC");
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