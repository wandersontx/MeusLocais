<?php

namespace Controller;

class Controller{

	protected function getURL(){
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}

	public  function rota(){
		$rota = $this->getURL();
		switch ($rota) {
		 	case '/':
		 		# code...
		 	break;
		 	case '/cadastro':
		 		require 'View/TelaCadastro.php';
		 	break;
		 	case '':
		 		
		 	break;
		 	case '':
		 		# code...
		 	break;
		 	
		 	
		 } 
	}
}