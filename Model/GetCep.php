<?php
namespace Model;

require __DIR__ . './../vendor/jarouche/viacep/src/BuscaViaCEP_inc.php';

use Jarouche\ViaCEP\HelperViaCep;

class GetCep{



	public function getEndereco($cep){
		try{		
		$andressJson = HelperViaCep::getBuscaViaCEP('JSON',$cep);
		$andress = json_decode($andressJson['text'], true);			
		return $andress;
		}
		catch(\Exception $e){
			return "error";
		}
	}
}

