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
}