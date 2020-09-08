<?php
namespace Model;

require __DIR__ . './../vendor/jarouche/viacep/src/BuscaViaCEP_inc.php';

use Jarouche\ViaCEP\HelperViaCep;

class GetCep{

	public function getEndereco($cep)
	{
		
		try{		
			$andressJson = HelperViaCep::getBuscaViaCEP('JSON',$cep);
			//return json_decode($andressJson['text'], true);
			print_r( $andressJson['text']);	

		}
		catch(\Exception $e){
			return "error";
		}
	}
}

