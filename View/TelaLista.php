<?php 

use Controller\Service\Service;

$service = new Service;

define("REGISTROS_POR_PAGINA", 6);
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$deslocamento = ($pagina -1 ) * REGISTROS_POR_PAGINA;
$dados = $service->getRegistrosPorPagina(REGISTROS_POR_PAGINA, $deslocamento);
$paginaAtiva = $pagina;
$totalRegistros =  $service->getTotalRegistros();
$totalPaginas = ceil($totalRegistros / REGISTROS_POR_PAGINA);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Meus lugares</title>
		<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	
	<style type="text/css">
		.centered {
		    margin: 0 auto !important;
		    float: none !important;
		}
	</style>
</head>
<body style="margin: 40px;">
 
 <div class="container">
 <h2 class="text-success display-3 text-sm-center">Meus Locais</h2>	
 <table class="table table-hover"> 
 	<tr>
 		<a href="/cadastro" class="btn btn-primary mb-1">Novo</a>
 	</tr>	
 	<tr>
 		<th>Data</th>
 		<th>UF</th>
 		<th>Nome</th>
 		<th>Ações</th>
 	</tr>
 	<? foreach ($dados as $key => $value) { ?> 	
 	<tr>
		<td><?php
				$date = new DateTime($value["data"]);
				$data = $date->format('d-m-Y'); 
				echo str_replace("-", "/", $data);
			?>			
		</td>
		<td><?= $value["uf"] ?></td>
		<td><?= $value["nome"] ?></td>
		<td>
			<a href="/cadastro?acao=editar&id=<?= $value['id'] ?>" class="btn btn-info">Atualizar</a>

			<button value="<?= $value['id'] ?>" class="btn btn-outline-danger remove">Remover</button>
		</td>
 	</tr>
 	<? } ?>
 </table>
 	<div class="container text-sm-center">
 		<div class="row ">			
			<div class="row mt-3 mb-3 centered">			 				
				<nav aria-label="Page navigation example">
					<ul class="pagination">
						<li class="page-item"><a href="?pagina=1" class="page-link" href="#">Primeira</a></li>
						<?php for ($i = 1; $i <= $totalPaginas ; $i++) { ?>
							<li class="page-item <?= $paginaAtiva == $i ? 'active' : '' ?>">
								<a class="page-link" href="?pagina=<?= $i?>"><?= $i?></a>
							</li>
						<?php } ?>
						<li class="page-item"><a href="?pagina=<?= $totalPaginas?>" class="page-link" href="#">Ultima </a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
				
			
<div class="modal" tabindex="-1" id="modal_remover">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="modal_title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="modal_body"></p>
      </div>
      <div class="modal-footer">
        <a href="/" class="btn btn-info" data-dismiss="modal">Não</a>
        <a id="btn_remove" class="btn btn-outline-danger btn-sm">Sim</a>
      </div>
    </div>
  </div>
</div>
</div>

</body>
</html>