<?php

namespace Controller;

use Controller\Service\Service;

class Controller{

	protected function getURL(){
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}

	public  function rota(){
		$rota = $this->getURL();
		switch ($rota) {
		 	case '/':
		 		require 'View/TelaLista.php';
		 	break;
		 	case '/cadastro':
		 		require 'View/TelaCadastro.php';
		 	break;		 	
		 	case '/salvar':
		 		$service = new Service;
		 		$service->save($_POST);		 		
		 	break;
		 	case '/remove':
		 		$service = new Service;
		 		$service->delete($_GET['id']);
		 	break;
		 		 	
		 } 
	}
}