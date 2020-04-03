<?php
namespace Core;

class Model{
	protected $conexao;

	public function __construct(){
		global $conexao;
		$this->conexao = $conexao;
	}
}