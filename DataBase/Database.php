<?php
namespace DataBase;

class Database
{	
	
	public  function getConnection()
	{
		try {
			$connection = new \PDO(
				"mysql:host=localhost;dbname=meus_locais;charset=utf8",
				"root",
				""
			);
			return $connection;
		} catch(\PDOException $e) {
			print_r($e);
		}
	}	

}