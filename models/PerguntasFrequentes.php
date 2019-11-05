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
		$sql = $this->conexao->prepare("SELECT * FROM perguntas_frequentes");
		$sql->execute();

		if($sql->rowCount() > 0){
			$array = $sql->fetchAll();
		}

		return $array;
	}
}