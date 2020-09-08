<?php

namespace Controller\Service;

require __DIR__ . './../../vendor/jarouche/viacep/src/BuscaViaCEP_inc.php';

use Jarouche\ViaCEP\HelperViaCep;

class GetCep
{

	public function getEndereco($cep)
	{
		
	    try {		
			$andressJson = HelperViaCep::getBuscaViaCEP('JSON',$cep);
			print_r( $andressJson['text']);	

		} catch(\Exception $e) {
			return "error";
		}
	}
}

