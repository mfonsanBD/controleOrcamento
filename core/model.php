<?php
class model{
	protected $conexao;

	public function __construct(){
		global $conexao;
		$this->conexao = $conexao;
	}
}