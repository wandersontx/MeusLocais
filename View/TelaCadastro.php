<?php
	use Controller\Service\Service;

	if (isset($_GET['acao']) && $_GET['acao'] == 'editar') {
		$service = new Service;
		$dados = $service->findById($_GET['id']);		
		$id = $_GET['id'];
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>

	<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	

	<script src="/View/js/jquery.mask.min.js"></script>
 	<script src="/View/js/TelaCadastro.js"></script>
</head>
<body style="margin-top: 50px;">

	<form method="post" action="<?= isset($_GET['acao']) && $_GET['acao'] == 'editar' ? '/update' : '/salvar'?>" >
		<a href="/" class="ml-5 text-warning">Voltar </a>
		<div class="container">	
			<h2 class="text-primary display-2 text-sm-center">Cadastro</h2>			
			<div class="row form-group">				
				<div class="col-sm-12">
					<label for="nome" class="text-info ">Nome do local visitado</label>
					<input type="text" name="nome" id="nome"  maxlength="100"  class="form-control fieldEmpty" value="<?= $dados['nome'] ?? '' ?>">
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<div class="col-sm-3">
					<label for="cep" class="text-info">CEP</label>
					<input type="text" name="cep" id="cep" maxlength="8" placeholder="Digite o cep para consulta" class="form-control fieldEmpty" value="<?= $dados['cep'] ?? '' ?>">
				</div>
				
			</div>
			<div class="row form-group">
				<div class="col-sm-6">
					<label for="logradouro" class="text-info">Logradouro</label>
					<input type="text" name="logradouro" id="logradouro" class="form-control fieldEmpty"
					 value="<?= $dados['logradouro'] ?? '' ?>">
				</div>
				<div class="col-sm-6">
					<label for="complemento" class="text-info ">complemento</label>
					<input type="text" name="complemento" class="form-control" value="<?= $dados['complemento'] ?? '' ?>">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-3">
					<label for="numero" class="text-info">Numero</label>
					<input type="text" name="numero" class="form-control" maxlength="4"
					 value="<?= $dados['numero'] ?? '' ?>">
				</div>
				<div class="col-sm-9">
					<label for="bairro" class="text-info ">Bairro</label>
					<input type="text" name="bairro" id="bairro" class="form-control fieldEmpty" 
					value="<?= $dados['bairro'] ?? '' ?>"
					>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-3">
				<label for="uf" class="text-info">Estado</label>				
					<input type="text" maxlength="2" name="uf" id="uf" placeholder="EX. DF"  class="form-control fieldEmpty"  value="<?= $dados['uf'] ?? '' ?>">
				</div>
				<div class="col-sm-6">
					<label for="cidade" class="text-info">Cidade</label>
					<input type="text" name="cidade"  id="cidade" class="form-control fieldEmpty"
					 value="<?= $dados['cidade'] ?? '' ?>">
				</div>
				<div class="col-sm-3">
					<label for="data" class="text-info">Data da visita</label>
					<input type="text" id="data" name="data"  maxlength="10" class="form-control fieldEmpty" placeholder="Ex. 04/02/2020" value="<?= $dados['data'] ?? '' ?>">
				</div>
			</div>
			<button id="btnSave" class="btn btn-block btn-info"><?= isset($_GET['acao']) && $_GET['acao'] == 'editar'  ? 'Atualizar' : 'Cadastrar'?></button>

		</div>
		<input type="hidden" name="id" value="<?= $id ?? '' ?>">	


	<!-- modal -->
<div class="modal fade" id="modalerro" tabindex="-1" aria-labelledby="modalmsgs" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="titlemodal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="msgcep"></strong></p>        
      </div>
      <div class="modal-footer">       
        <button type="button" class="btn btn-danger" data-dismiss="modal">fechar</button>
      </div>
    </div>
  </div>
</div>
	<!-- fim modal -->
</body>
</html>