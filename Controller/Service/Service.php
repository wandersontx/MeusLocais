<?php


namespace Controller\Service;
use Controller\MeuLocal;
use Model\Database;
require "Validation.php";



class Service
{
	private $db;


	public function save($dadosForm)
	{	/*$this->db = new Database;		
		print_r($dadosForm);
		echo "<br><br><br>";
		$this->validateDate($dadosForm);	*/

		//$validation = new Validation;
		validateDate($dadosForm);	

	}




	
		

}
	


/*
$arr = ["username" => "wanderson teixeira"];



$is_valid = GUMP::is_valid(array_merge($arr, $_FILES), [
    'username' => ['required'],
   
], [
    'username' => ['required' => 'Field name is required, pleaseeeee'],
    
]);

if ($is_valid === true) {
   echo "Fiel success";
} else {
    var_dump($is_valid); // array of error messages
}

*/