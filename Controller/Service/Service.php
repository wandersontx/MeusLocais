<?php


namespace Controller\Service;
use Controller\MeuLocal;
use Model\Database;
require "Validation.php";



class Service
{
	private $db;


	public function save($dadosForm)
	{	
		if(validateDate($dadosForm))
		{
			$this->db = Database::getConnection();
			$query = "insert into locais 
			(nome, cep, logradouro, complemento, numero, bairro, uf, cidade, data)
			value 
			(?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(1, $dadosForm['nome']);
			$stmt->bindValue(2, $dadosForm['cep']);
			$stmt->bindValue(3, $dadosForm['logradouro']);
			$stmt->bindValue(4, $dadosForm['complemento']);
			$stmt->bindValue(5, $dadosForm['numero']);
			$stmt->bindValue(6, $dadosForm['bairro']);
			$stmt->bindValue(7, $dadosForm['uf']);
			$stmt->bindValue(8, $dadosForm['cidade']);
			
			$fieldData = explode("/",$dadosForm['data']);
			$data = "$fieldData[2]-$fieldData[1]-$fieldData[0]";			
			$stmt->bindValue(9, $data );	 
			
			$row =  $stmt->execute();

			if($row > 1){
				echo "Dados salvos com sucesso";
				header("Location: /cadastro");
			}

		}	

	}

	public function update($dadosForm)
	{

	}

	public function findAll()
	{

	}

	public function findById($id)
	{

	}

		

}