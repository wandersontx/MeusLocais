<?php
   
   function validateDate($dados)
	{
		
		$is_valid = GUMP::is_valid(
			array_merge($dados, $_FILES),
			[
		    	'nome'		 => ['required'],
		    	'cep'		 => ['required','min_len'=> [8]],
		    	'logradouro' => ['required'],
		    	'bairro' 	 => ['required'],
		    	'uf' 		 => ['required'],
		    	'cidade'	 => ['required', 'min_len'=> [3]],
		    	'data' 		 => ['required'],
	    	
			],
			[
	    		'logradouro' => ['required' => 'Fill the Username field please.'],
	    	 
			]
		);

		if ($is_valid === true) {
		    echo "Todos os dados foram preenchidos corretamente";
		} else {
		    var_dump($is_valid); // array of error messages
		}


	}
