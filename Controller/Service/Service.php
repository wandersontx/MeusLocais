<?php


namespace Controller\Service;
use Controller\MeuLocal;
use Model\Database;
use Model\GetCep;
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

			if($row > 0){
				header("Location: /");
			}

		}	

	}

	public function update($dadosForm)
	{

	}

	public function findAll()
	{	
		try{
		$this->db = Database::getConnection();
		$query = "select id, data, uf, nome from locais order by data desc";
		$stmt = $this->db->prepare($query);
		$stmt->execute();		
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		}
		catch(PDOException $e){
			 die("ERROR: Could not able to execute $sql. " . $e->getMessage());
		}
	}

	public function findById($id)
	{

	}

	public function delete($id)
	{
		try{
			$this->db = Database::getConnection();
			$query = "delete from locais where id = ".$id;
			$this->db->exec($query);
			header("Location: /");	

		}
		catch(PDOException $e){
			die("ERROR: Could not connect. ".$e->getMessage());
		}
	}

	public function buscarEnderecoPorCep($cep){
		$getCep = new GetCep;
	}

		

}