<?php
	use Controller\Service\Service;
	
	$dados = null;
	$nomeLocal = null;
	$cidade = null;
	$id = null;
	$service = new Service;

	if(isset($_GET['acao']) && $_GET['acao'] == 'buscarcep'){
		$dados = $service->buscarEnderecoPorCep($_GET['cep']);
		$nomeLocal = $_GET['nome'];
		$cidade = isset($dados['localidade']) ? $dados['localidade'] : null;
	}
	if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
		$dados = $service->findById($_GET['id']);
		$nomeLocal = $dados['nome'];
		$cidade = $dados['cidade'];
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	

	<script src="/View/jquery.mask.min.js"></script>
	<script src="/View/eventos.js"></script>

</head>
<body style="margin-top: 50px;">

	<form method="post" action="<?= isset($_GET['acao']) && $_GET['acao'] == 'editar' ? '/update' : '/salvar'?>" onsubmit="return verificarCamposPreenchidos(this)">
		<a href="/" class="ml-5 text-warning">Voltar </a>
		<div class="container">	
			<h2 class="text-primary display-2 text-sm-center">Cadastro</h2>			
			<div class="row form-group">				
				<div class="col-sm-12">
					<label for="nome" class="text-info">Nome do local visitado</label>
					<input type="text" name="nome" id="nome" onblur="fieldEmpty(this)" maxlength="100"  class="form-control" value="<?= isset($nomeLocal) && !empty($nomeLocal) ? $nomeLocal : '' ?>">
				</div>
			</div>
			<hr>
			<div class="row form-group">
				<div class="col-sm-3">
					<label for="cep" class="text-info">CEP</label>
					<input type="text" name="cep" id="cep" maxlength="8" placeholder="Digite o cep para consulta" class="form-control" value="<?= isset($dados['cep']) && !empty($dados['cep']) ? $dados['cep'] : '' ?>"
						
					 onblur="consultarCep()">
				</div>
				
			</div>
			<div class="row form-group">
				<div class="col-sm-6">
					<label for="logradouro" class="text-info">Logradouro</label>
					<input type="text" name="logradouro" onblur="fieldEmpty(this)"  id="logradouro" class="form-control"
					 value="<?= isset($dados['logradouro']) && !empty($dados['logradouro']) ? $dados['logradouro'] : '' ?>"
					>
				</div>
				<div class="col-sm-6">
					<label for="complemento" class="text-info">complemento</label>
					<input type="text" name="complemento"  class="form-control"
					 value="<?= isset($dados['complemento']) && !empty($dados['complemento']) ? $dados['complemento'] : '' ?>"
					>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-3">
					<label for="numero" class="text-info">Numero</label>
					<input type="text" name="numero" id="numero" placeholder="Ex. 400" class="form-control" maxlength="4">
				</div>
				<div class="col-sm-9">
					<label for="bairro" class="text-info">Bairro</label>
					<input type="text" name="bairro" id="bairro" onblur="fieldEmpty(this)"  class="form-control" 
					value="<?= isset($dados['bairro']) && !empty($dados['bairro']) ? $dados['bairro'] : '' ?>"
					>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-sm-3">
				<label for="uf" class="text-info">Estado</label>				
					<input type="text" maxlength="2" name="uf" id="uf" placeholder="EX. DF" onblur="validarUf(this)" class="form-control"
					 value="<?= isset($dados['uf']) && !empty($dados['uf']) ? $dados['uf'] : '' ?>"
					 >
				</div>
				<div class="col-sm-6">
					<label for="cidade" class="text-info">Cidade</label>
					<input type="text" name="cidade"  id="cidade" onblur="fieldEmpty(this)" class="form-control"
					 value="<?= isset($cidade) && !empty($cidade) ? $cidade : '' ?>"
					 >
				</div>
				<div class="col-sm-3">
					<label for="data" class="text-info">Data da visita</label>
					<input type="text" id="data" name="data" onblur="validarData()" maxlength="10" class="form-control" placeholder="Ex. 04/02/1999" 
					 value="<?= isset($dados['data']) && !empty($dados['data']) ? $dados['data'] : '' ?>"
					>
				</div>
			</div>
			<button class="btn btn-block btn-info"><?= isset($_GET['acao']) && $_GET['acao'] == 'editar'  ? 'Atualizar' : 'Cadastrar'?></button>

		</div>
		<input type="hidden" name="id" value="<?= $id ?? '' ?>">

		<?= $id ?? 'sem Id' ?>








	<script type="text/javascript">	

			function validarData(){
				let erro = 0
				let sizeData = document.getElementById('data').value.length
				let dataForm = document.getElementById('data').value
				let fieldData = dataForm.split("/")
				let dataCurrent = new Date()
				currentYear = dataCurrent.getFullYear()
				currentMonth = dataCurrent.getMonth() + 1
				currentDay = dataCurrent.getDate()
				


				if(fieldData[0] > 31 || fieldData[1] > 12 || fieldData[2] > currentYear || sizeData <10)
					erro++
				if(fieldData[2] == currentYear && (fieldData[1] > currentMonth || (fieldData[0] > currentDay && fieldData[1] >= currentMonth)))
					erro++
				else{
					switch(fieldData[1]){
						case '01': case '03': case '05': case '07': case '08': case '10': case '12':
							erro = fieldData[0] > 31 ? 1 : 0							
						break;
						case '04': case '06': case '09': case '11':
							erro = fieldData[0] > 30 ? 1 : 0
							
						break;
						case '02':
						let anobissesto = fieldData[2]%4 == 0  && fieldData[2]%100 != 0? true : false
							if(anobissesto)
								erro = fieldData[0] > 29 ? 1 : 0
							else
								erro = fieldData[0] > 28 ? 1 : 0

					}

				}

				if(erro > 0 && sizeData > 0){
					$('#titlemodal').html('Erro no campo data')
					$('#msgcep').html('Data informada <strong>"'+dataForm+'"</strong> inválida ou superior a data atual')
					$('#modalerro').modal('show');
					$("#data").removeClass('is-valid')
					$("#data").addClass("is-invalid")
					document.getElementById('data').value = ''
					return false
				}
				else if(dataForm == ''){
					$("#data").removeClass('is-valid')
					$("#data").addClass("is-invalid")
					
				}
				else{
					$("#data").removeClass('is-invalid')
					$("#data").addClass("is-valid")
				}
			}

			function validaCep(){
			//implementar validação
			}	

			function consultarCep(){						
				let cep = document.getElementById('cep').value			
				let cep2 = cep.replace(/[^0-9]/,'')
				let qtdNumero = cep2.length									
				let pattern = /[a-z]/
				let testNumber = pattern.test(cep)
				let nome = document.getElementById('nome').value			
				if(testNumber || (qtdNumero > 0 && qtdNumero < 8)){				
					$('#titlemodal').html('CEP invalido')
					$('#msgcep').html('<p>Favor informar o cep no seguinte formato:<strong>73402042</strong><p>')
					$('#modalerro').modal('show');
					document.getElementById('cep').value = ''
				}			
				else if(qtdNumero > 8){
					$('#titlemodal').addClass('is-invalid')
					$('#titlemodal').html('CEP invalido')
					$('#msgcep').html('O campo cep deve possuir no <strong>máximo 8</strong> caracteres numericos')
					$('#modalerro').modal('show');
					document.getElementById('cep').value = ''
				}
				else{
					
					if(cep2 != ''){
						let url = '/cep?cep='+cep2
						let reqCep = new XMLHttpRequest()
						reqCep.open('GET',url)
						reqCep.onreadystatechange = () =>{
							if(reqCep.readyState == 4 && reqCep.status == 200){
								
								let dados = reqCep.responseText			
								let obj = JSON.parse(dados)
								console.log(obj)
									if(obj.erro){
										console.log('error na busca ')
									}
									else{
										let cep = obj.cep
										cep = cep.replace('-','')
										document.getElementById('cep').value = cep
										document.getElementById('logradouro').value = obj.logradouro
										document.getElementById('bairro').value = obj.bairro
										document.getElementById('cidade').value = obj.localidade
										document.getElementById('uf').value = obj.uf
									}

								
								
							}
						}

						reqCep.send()


					}				
				}
			}


		function validarUf(uf){
			console.log('validarUF')			
			let estados = ["AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO" ];
			let findUf = estados.indexOf(uf.value.toUpperCase())
			let regex = /[0-9]/;
			let findLetter = uf.value.search(regex)
			

			if(uf.value == ''){
				$('#uf').addClass('is-invalid')
				document.getElementById('uf').value =''
			}


			if(findLetter != -1 && uf.value.length > 0){
				$('#titlemodal').html('Dado incorreto')
				$('#msgcep').html('<p>O campo estado deve conter a sigla do estado, contendo apenas letras. Como por exemplo: DF, MG, SP ..</p>')
				$('#modalerro').modal('show');
				$("#uf").removeClass('is-valid')
				$("#uf").addClass("is-invalid")
				document.getElementById('uf').value =''				
			}
			else if(findUf == -1 && uf.value.length > 0){
				$('#titlemodal').html('Estado não encontrado')
				$('#msgcep').html('<p>A sigla informada <strong>"'+uf.value.toUpperCase()+'"</strong> não corresponde a nenhum estado.</p>')
				$('#modalerro').modal('show');
				$("#uf").removeClass('is-valid')
				$("#uf").addClass("is-invalid")
				document.getElementById('uf').value =''				
			}
			else if(findUf != -1){
			$("#uf").removeClass('is-invalid')
			$("#uf").addClass("is-valid")						}

		}


		$('#data').mask('00/00/0000')
		$('#numero').mask('0000')
		
	
	function fieldEmpty(value){			
		let field = value.value
		let id = value.id
		if(field !=''){
		 $("#"+id).removeClass('is-invalid')
		$("#"+id).addClass('is-valid')
		
		}
		else{		 
		 $("#"+id).removeClass('is-valid')
		 $("#"+id).addClass('is-invalid')

		
		}
	}

	function verificarCamposPreenchidos(field){
		let erro = 0
		if(field.nome.value == ''){
			erro++;
			$('#nome').addClass('is-invalid')
		}
		if(field.cep.value == ''){
			erro++;
			$('#cep').addClass('is-invalid')
		}
		if(field.logradouro.value == ''){
			erro++;
			$('#logradouro').addClass('is-invalid')
		}
		if(field.bairro.value == ''){
			erro++;
			$('#bairro').addClass('is-invalid')
		}
		if(field.uf.value == ''){
			erro++;
			$('#uf').addClass('is-invalid')
		}
		if(field.cidade.value == ''){
			erro++;
			$('#cidade').addClass('is-invalid')
		}
		if(field.data.value.trim() == ''){
			erro++;
			$('#data').addClass('is-invalid')
		}else{
			validarData()			
		}	


		if(erro > 0){
			var msg = erro > 1 ? erro : ''
			$('#titlemodal').html('Campos obrigatórios não preenchidos')
			$('#msgcep').html('<p>Favor preencher o(s) '+msg+' campo(s) em destaque vermelho.</p>')
			$('#modalerro').modal('show');
			return false
		}
		return true
		
	}
	

		
		
	</script>

	<?if(isset($dados['erro'])){ ?>
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
        <h5 class="modal-title text-danger" id="titlemodal">CEP não encontrado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="msgcep">Verique o cep informado. </strong></p>        
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