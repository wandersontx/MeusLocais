$(document).ready(function (){

	$(".remove").click(e =>{		
		$('#modal_title').html('Remover local')
		$('#modal_body').html('Tem certeza que deseja remover este local?')
		$('#btn_remove').attr('href','/remove?id='+e.target.value)
		$('#modal_remover').modal('show');
	})

});


