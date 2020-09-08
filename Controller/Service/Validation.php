<?php
   
   function validateDate($dados)
	{		
		$is_valid = GUMP::is_valid(
			array_merge($dados, $_FILES),
			[
		    	'nome'		 => ['required'],
		    	'cep'		 => ['required'],
		    	'logradouro' => ['required'],
		    	'bairro' 	 => ['required'],
		    	'uf' 		 => ['required'],
		    	'cidade'	 => ['required'],
		    	'data' 		 => ['required'],
	    	
			],
			[
	    		'nome' => ['required' => 'Campo Obrigatorio'],
	    		'cep' => ['required' => 'Campo Obrigatorio'],
	    		'logradouro' => ['required' => 'Campo Obrigatorio'],
	    		'bairro' => ['required' => 'Campo Obrigatorio'],
	    		'uf' => ['required' => 'Campo Obrigatorio'],
	    		'cidade' => ['required' => 'Campo Obrigatorio'],
	    		'data' => ['required' => 'Campo Obrigatorio'],
	    	 
			]
		);

		return $is_valid;
	}
