<?php

namespace Controller\Service;

require "Validation.php";

use DataBase\Database;
use Model\GetCep;

class Service
{
	private $db;

	public function save($dadosForm)
	{	
		try {
			if (validateDate($dadosForm)) {
				$this->db = Database::getConnection();
				$query = "INSERT INTO locais 
				(nome, cep, logradouro, complemento, numero, bairro, uf, cidade, data)
				VALUES 
				(?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$stmt = $this->db->prepare($query);
				$stmt->bindValue(1, htmlspecialchars($dadosForm['nome']));
				$stmt->bindValue(2, htmlspecialchars($dadosForm['cep']));
				$stmt->bindValue(3, htmlspecialchars($dadosForm['logradouro']));
				$stmt->bindValue(4, htmlspecialchars($dadosForm['complemento']));
				$stmt->bindValue(5, htmlspecialchars($dadosForm['numero']));
				$stmt->bindValue(6, htmlspecialchars($dadosForm['bairro']));
				$stmt->bindValue(7, htmlspecialchars($dadosForm['uf']));
				$stmt->bindValue(8, htmlspecialchars($dadosForm['cidade']));
				
				$fieldData = explode("/",$dadosForm['data']);
				$data = "$fieldData[2]-$fieldData[1]-$fieldData[0]";			
				$stmt->bindValue(9, htmlspecialchars($data));	 
				
				$row =  $stmt->execute();

				if ($row > 0) {
					header("Location: /");
				}

			}
		} catch	 (PDOException $e) {
			 die("ERROR: Could not able to execute $sql. " . $e->getMessage());
		}
	}

	public function update($dados)
	{	
		try {
			$this->db = Database::getConnection();
			$query = "UPDATE locais SET 
					  nome = :nome, cep = :cep, logradouro = :logradouro,
					  complemento = :complemento, numero = :numero, bairro = :bairro,
					  uf = :uf, cidade = :cidade, data = :data
					  WHERE id = :id
					 ";
			$stmt = $this->db->prepare($query);
			$stmt->bindValue(":nome", htmlspecialchars($dados['nome']));
			$stmt->bindValue(":cep", htmlspecialchars($dados['cep']));
			$stmt->bindValue(":logradouro", htmlspecialchars($dados['logradouro']));
			$stmt->bindValue(":complemento", htmlspecialchars($dados['complemento']));
			$stmt->bindValue(":numero", htmlspecialchars($dados['numero']));
			$stmt->bindValue(":bairro", htmlspecialchars($dados['bairro']));
			$stmt->bindValue(":uf", htmlspecialchars($dados['uf']));
			$stmt->bindValue(":cidade", htmlspecialchars($dados['cidade']));
			$stmt->bindValue(":id", htmlspecialchars($dados['id']));

			$dataForm = explode("/", $dados['data']);
			$data_bd = $dataForm[2]."-".$dataForm[1]."-".$dataForm[0];
			$stmt->bindValue(":data", htmlspecialchars($data_bd));

			$row = $stmt->execute();

			if ($row > 0)
				header("Location: /");
		} catch (PDOException $e) {
			 die("ERROR: Could not able to execute $sql. " . $e->getMessage());
		}

	}

	public function getRegistrosPorPagina($limit, $offeset)
	{
		try {
			$this->db = Database::getConnection();
			$query = "SELECT  
						id, data, uf, nome 
					  FROM 
					    locais				  
					  ORDER BY 
					    data desc
					  LIMIT
					    $limit
	                  OFFSET
	                    $offeset
					   ";
			$stmt = $this->db->prepare($query);
			$stmt->execute();		
			return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			 die("ERROR: Could not able to execute $sql. " . $e->getMessage());
		}
	}

	public function getTotalRegistros()
	{	
		try {
			$this->db = Database::getConnection();
			$query = "SELECT 
			    		COUNT(*) as total
			    	  FROM 
			    	    locais";
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$total = $stmt->fetch(\PDO::FETCH_ASSOC);
			return $total['total'];
		} catch (PDOException $e) {
			die("ERROR: ".$e->getMessage());
		}

	}

	public function findById($id)
	{
		try {
			$this->db = Database::getConnection();
			$query = "select * from locais where id = ".$id;
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$result = $stmt->fetch(\PDO::FETCH_ASSOC);		
			$arr = explode("-", $result['data']);			
			$result['data'] = "$arr[2]/$arr[1]/$arr[0]";			
			return $result;
		} catch (PDOException $e) {
			die("ERROR: ".$e->getMessage());
		}
	}

	public function delete($id)
	{
		try {
			$this->db = Database::getConnection();
			$query = "delete from locais where id = ".$id;
			$this->db->exec($query);
			header("Location: /");	

		} catch (PDOException $e) {
			die("ERROR: ".$e->getMessage());
		}
	}

	public function buscarEnderecoPorCep($cep)
	{
		$getCep = new GetCep;
		return $getCep->getEndereco($cep);		
	}

}