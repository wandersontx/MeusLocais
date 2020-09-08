<?php

namespace Controller;

class MeuLocal{
	private $id;
	private $nome;
	private $cep;
	private $logradouro;
	private $complemento;
	private $numero;
	private $bairro;
	private $uf;
	private $cidade;
	private $data;


	public function __get($atributo){
		return $this->$atributo;
	}

	public function __set($atributo, $valor){
		$this->$atributo = $valor;
	}


}
