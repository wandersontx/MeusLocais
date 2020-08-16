<?php
	use Model\GetCep;
	$getCep = new GetCep;
	$dados = null;
	if(isset($_GET['busca']) && !is_null($_GET))
		$dados = $getCep->getEndereco($_GET['cep']);		
?>

<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

</head>
<body style="margin-top: 50px;">

	<form method="get" action="" onsubmit="return  verificarCepVazio(this)">
		
		<div class="container">	
			<h2 class="text-primary display-2 text-sm-center">Cadastro</h2>			
			<div class="row form-group">
				<div class="col-sm-12">
					<input type="text" name="nome" maxlength="100" placeholder="Digite o nome do local visitado" class="form-control">
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<div class="col-sm-3">
					<input type="text" name="cep" id="cep" maxlength="9" placeholder="Digite o cep para consulta" class="form-control"  value="<?= isset($_GET['busca']) && is_array($dados) && !isset($dados['erro']) ? $dados['cep'] : '' ?>" onblur="consultarCep()">
				</div>
				
			</div>
			<div class="row form-group">
				<div class="col-sm-6">
					<input type="text" name="logradouro"  placeholder="Logradouro" class="form-control" value="<?= isset($_GET['busca']) && is_array($dados) && !isset($dados['erro']) ? $dados['logradouro'] : '' ?>">
				</div>
				<div class="col-sm-6">
					<input type="text" name="complemento"  placeholder="Complemento" class="form-control" value="<?= isset($_GET['busca']) && is_array($dados) && !isset($dados['erro'])? $dados['complemento'] : '' ?>">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-3">
					<input type="text" name="numero"  placeholder="Nº" class="form-control">
				</div>
				<div class="col-sm-9">
					<input type="text" name="bairro"  placeholder="Bairro" class="form-control" value="<?= isset($_GET['busca']) && is_array($dados) && !isset($dados['erro']) ? $dados['bairro'] : '' ?>">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-4">				
					<select id="uf" class="form-control">					    
				        <option value="">-- Selecione --</option>
					    <option value="AC" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'AC' ? 'selected' : '' ?>>Acre</option>
					    <option value="AL" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'AL' ? 'selected' : '' ?>>Alagoas</option>
					    <option value="AP" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'AP' ? 'selected' : '' ?>>Amapá</option>
					    <option value="AM" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'AM' ? 'selected' : '' ?>>Amazonas</option>
					    <option value="BA" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'BA' ? 'selected' : '' ?>>Bahia</option>
					    <option value="CE" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'CE' ? 'selected' : '' ?>>Ceará</option>
					    <option value="DF" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'DF' ? 'selected' : '' ?>>Distrito Federal</option>
					    <option value="ES" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'ES' ? 'selected' : '' ?>>Espírito Santo</option>
					    <option value="GO" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'GO' ? 'selected' : '' ?>>Goiás</option>
					    <option value="MA" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'MA' ? 'selected' : '' ?>>Maranhão</option>
					    <option value="MT" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'MT' ? 'selected' : '' ?>>Mato Grosso</option>
					    <option value="MS" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'MS' ? 'selected' : '' ?>>Mato Grosso do Sul</option>
					    <option value="MG" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'MG' ? 'selected' : '' ?>>Minas Gerais</option>
					    <option value="PA" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'PA' ? 'selected' : '' ?>>Pará</option>
					    <option value="PB" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'PB' ? 'selected' : '' ?>>Paraíba</option>
					    <option value="PR" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'PR' ? 'selected' : '' ?>>Paraná</option>
					    <option value="PE" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'PE' ? 'selected' : '' ?>>Pernambuco</option>
					    <option value="PI" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'PI' ? 'selected' : '' ?>>Piauí</option>
					    <option value="RJ" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'RJ' ? 'selected' : '' ?>>Rio de Janeiro</option>
					    <option value="RN" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'RN' ? 'selected' : '' ?>>Rio Grande do Norte</option>
					    <option value="RS" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'RS' ? 'selected' : '' ?>>Rio Grande do Sul</option>
					    <option value="RO" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'RO' ? 'selected' : '' ?>>Rondônia</option>
					    <option value="RR" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'RR' ? 'selected' : '' ?>>Rorâima</option>
					    <option value="SC" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'SC' ? 'selected' : '' ?>>Santa Catarina</option>
					    <option value="SP" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'SP' ? 'selected' : '' ?>>São Paulo</option>
					    <option value="SE" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'SE' ? 'selected' : '' ?>>Sergipe</option>
					    <option value="TO" <?= !is_null($dados) && !isset($dados['erro']) && $dados['uf'] == 'TO' ? 'selected' : '' ?>>Tocantins</option>
					</select>
				</div>
				<div class="col-sm-5">
					<input type="text" name="cidade"  placeholder="cidade" class="form-control" value="<?= isset($_GET['busca']) && is_array($dados) && !isset($dados['erro']) ? $dados['localidade'] : '' ?>">
				</div>
				<div class="col-sm-3">
					<input type="date" name="data" class="form-control">
				</div>
			</div>
			<button class="btn btn-block btn-info">Cadastrar</button>
		</div>
	</form>
	<script type="text/javascript">
		
		function consultarCep(){			
			let cep = document.getElementById('cep').value			
			let cep2 = cep.replace(/[^0-9]/,'')
			let qtdNumero = cep2.length									
			let pattern = /[a-z]/
			let testNumber = pattern.test(cep)			
			if(testNumber || (qtdNumero > 0 && qtdNumero < 8)){
				alert('CEP Inválido.')
				document.getElementById('cep').value = ''
			}			
			else if(qtdNumero > 8){
				alert('CEP invalido!\nFormatos suportado:\n73402-042\n73402042')
				document.getElementById('cep').value = ''
			}
			else{
				if(cep2 != '')				 	
				 window.location.href='/cadastro?busca=true&cep='+cep2
			}
		}

		function verificarCepVazio(field){			
			if(field.cep.value ==''){
				alert('Favor informar cep para consulta')
				return false
			}

		
		}
		
		
	</script>

	<? if(isset($dados['erro'])){ ?>
		<script>
			$(document).ready(
				function(){
					$('#modalerro').modal();
				}
				);

		</script>		
	<? } ?>

	<!-- modal -->
<div class="modal fade" id="modalerro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">CEP não encontrado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Verifique o cep informado!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
	<!-- fim modal -->

<!-- Modal -->
<div class="modal fade" id="cepVazio" tabindex="-1" aria-labelledby="modal2" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal2">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
	<!-- fim modal -->

</body>
</html>