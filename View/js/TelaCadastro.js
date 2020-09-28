	$(document).ready(function(){

			$('#data').mask('00/00/0000')
			$('#numero').mask('0000')
			$('#cep').mask('00000000')

			//verifica campos vazios
			$('.fieldEmpty').blur(function(){
				let id = $(this).attr("id");							
				if($("#"+id).val() !=''){
				    $("#"+id).removeClass('is-invalid')
				    $("#"+id).addClass('is-valid')
		
				}else{		 
				    $("#"+id).removeClass('is-valid')
					$("#"+id).addClass('is-invalid')
				}
			})

			//validar data
			$('#data').blur(function(){
				let dataForm = $(this).val();							
				let erro = 0
				let sizeData = dataForm.length
				let fieldData = dataForm.split("/")
				let dataCurrent = new Date()
				currentYear = dataCurrent.getFullYear()				
				currentMonth = dataCurrent.getMonth() + 1
				currentDay = dataCurrent.getDate()
			
				if(fieldData[0] > 31 || fieldData[1] > 12 || Number(fieldData[2]) > currentYear || sizeData <10)
					erro++
				if(fieldData[2] == currentYear && (fieldData[1] > currentMonth || (fieldData[0] > currentDay && fieldData[1] >= currentMonth)))
					erro++
				else{
					switch(fieldData[1]){
						case '01': case '03': case '05': case '07': case '08': case '10': case '12':
							erro += fieldData[0] > 31 ? 1 : 0							
						break;
						case '04': case '06': case '09': case '11':
							erro += fieldData[0] > 30 ? 1 : 0
							
						break;
						case '02':
						let anobissesto = fieldData[2]%4 == 0  && fieldData[2]%100 != 0? true : false
							if(anobissesto)
								erro += fieldData[0] > 29 ? 1 : 0
							else
								erro += fieldData[0] > 28 ? 1 : 0

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
				
			})

			//validar uf
			$('#uf').blur(function(){
				let uf = $(this).val()					
				let estados = ["AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO" ];
				let findUf = estados.indexOf(uf.toUpperCase())
				let regex = /[0-9]/;
				let findLetter = uf.search(regex)
				if(uf.value == ''){
					$('#uf').addClass('is-invalid')
					$(this).val('')	
				}

				if(findLetter != -1 && uf.length > 0){
					$('#titlemodal').html('Dado incorreto')
					$('#msgcep').html('<p>O campo estado deve conter a sigla do estado, contendo apenas letras. Como por exemplo: DF, MG, SP ..</p>')
					$('#modalerro').modal('show');
					$("#uf").removeClass('is-valid')
					$("#uf").addClass("is-invalid")
					$(this).val('')					
				}
				else if(findUf == -1 && uf.length > 0){
					$('#titlemodal').html('Estado não encontrado')
					$('#msgcep').html('<p>A sigla informada <strong>"'+uf.toUpperCase()+'"</strong> não corresponde a nenhum estado brasileiro.</p>')
					$('#modalerro').modal('show');
					$("#uf").removeClass('is-valid')
					$("#uf").addClass("is-invalid")
					$(this).val('')					
				}
				else if(findUf != -1){
					$("#uf").removeClass('is-invalid')
					$("#uf").addClass("is-valid")						
				}				
			})

			//Pesquisar cep
			$("#cep").on('blur',e => {
				const CEP = $(e.target).val()
				if(validarCep(CEP)){
					$.ajax({
						type:'GET',
						url :'/cep',
						data:'cep='+CEP,
						dataType:'json',
						success: dados =>{
							let cep = dados.cep != undefined ? dados.cep.replace("-","") : null							
							$('#cep').val(cep)
							$('#logradouro').val(dados.logradouro)
							$('#bairro').val(dados.bairro)
							$('#uf').val(dados.uf)
							$('#cidade').val(dados.localidade)
							let arrField = ["cep","logradouro", "bairro", "uf","cidade"]
							if(!dados.erro){validField(arrField)}
							if(dados.erro){
								$('#titlemodal').html('CEP não encontrado')
								$('#msgcep').html('<p>Não foi encontrado endereço para o cep <strong>'+CEP+'</strong>.<p>')
								$('#modalerro').modal('show');
							}
						},
						error: erro => { console.log(erro)}

					})
				}
			 	
			})

			function validField(arr){
				for(var id in arr) {
					if($("#"+arr[id]).val() != '')  					
    					$("#"+arr[id]).addClass("is-valid")
    				if($("#"+arr[id]).val() === '')
    					$("#"+arr[id]).removeClass("is-valid")
				}
			}			

			function validarCep(cep){				
				if(cep.length < 8){				
					$('#titlemodal').html('CEP invalido')
					$('#msgcep').html('<p>O campo Cep deve conter 8 digitos. Você informou o seguinte dado: <strong>'+cep+'</strong>.<p>')
					$('#modalerro').modal('show');
					$('#cep').val('')
					return false
				}				
				return true				
			}
		
			//verificar campos obrigatorio antes do envio de formulario
			$("form").submit(function(e){
				let erro = 0
				$("input").each(function(){
					let id = $(this).attr("id");				
					if($("#"+id).val() != undefined && id != 'id' && $("#"+id).val() == ''){
						$('#'+id).addClass('is-invalid')
						erro++
					}				
				})
				if(erro > 0){
				var msg = erro > 1 ? erro : ''
					$('#titlemodal').html('Campos obrigatórios não preenchidos')
					$('#msgcep').html('<p>Favor preencher o(s) '+msg+' campo(s) em destaque vermelho.</p>')
					$('#modalerro').modal('show');
				return false
				}
				return;				
				e.preventDefault()
			})

})


