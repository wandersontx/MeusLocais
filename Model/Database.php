<?php
namespace Model;

class Database{	
	
	public static function getConnection(){
		try{
			$connection = new \PDO(
				"mysql:host=localhost;dbname=meus_locais;charset=utf8",
				"root",
				""
			);
			return $connection;
		}
		catch(\PDOException $e){
			print_r($e);
		}
	}	

}