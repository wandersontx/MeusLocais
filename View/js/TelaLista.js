$(document).ready(function(){

	$( ".btn_remove" ).click(function() {
  	 	let id = $(this).val();
  	 	let rota = "/remove?id="+id
  	 	$("#btn_remove_sim").attr('href',rota)
  	 	$('#modal_title').html('Remoção de local visitado')
  	 	$('#modal_body').html('Tem certeza que deseja excluir este local?')
  	 	$('#modal_remover').modal('show');
	});
})
