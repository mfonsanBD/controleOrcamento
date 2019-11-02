<?php 
require 'topo.php';
?>
	</h1>
	<p class="p-0 m-0 subtitulo">Esses são os usuários cadastrados no sistema.</p>
</div>

<div class="modal fade" id="modalEdUs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-padrao">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="bg-light" id="editaSU">
          <div class="form-group text-left">
            <label for="nsenha" class="col-form-label">Nova Senha:</label>
            <input type="password" id="nsenha">
            <label for="cnsenha" class="col-form-label">Confirmar Nova Senha:</label>
            <input type="password" id="cnsenha">
          </div>
		  <div class="modal-footer">
		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		    <button type="button" id="salvarAlteracoes" class="btn bg-padrao">Salvar Alterações</button>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container">
	<div class="pt-5 pb-5">
		<h3 class="text-uppercase text-center titulo_pagina"><?=$this->titulo;?></h3>
	</div>
	<div class="row base">
		<div class="col-lg-12">
			<?php foreach ($listaUsuarios as $lu): ?>
				<div class="col-md-12 bg-white rounded-lg pt-3 pb-3 mb-3 shadow-sm">
					<div class="row">
						<div class="col-md-1">
							<img src="<?=URL_BASE?>assets/img/<?=$lu['foto']?>" class="rounded-circle" width="50" alt="">
						</div>
						<div class="col-md-3">
							<h6 class="mb-1">Nome:</h6>
							<p class="p-0 m-0 text-padrao">
								<?php
									$usuario = explode(" ", $lu['nome']);
									echo $usuario[0]." ".$usuario[1];
								?>
							</p>
						</div>
						<div class="col-md-3">
							<h6 class="mb-1">E-mail:</h6>
							<p class="p-0 m-0 text-padrao"><?= $lu['email']; ?></p>
						</div>
						<div class="col-md-3">
							<h6 class="mb-1">Status:</h6>
							<?php
								switch($lu['permissao']) {
									case '0':
										echo '<img src="'.URL_BASE.'assets/img/circulo-vermelho.svg" alt="" width="10"> <span class="btn-status text-danger">Não Confirmado</span>';
									break;
									default:
										echo '<img src="'.URL_BASE.'assets/img/circulo-verde.svg" alt="" width="10"> <span class="btn-status text-success">Confirmado</span>';
									break;
								}
							?>
						</div>
						<div class="col-md-2">
							<h6 class="mb-1">Ação:</h6>
							<button id="ueditar" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEdUs" data-id="<?= $lu['id']; ?>" data-nome="<?= $lu['nome']; ?>">Editar</button>
							<button id="uexcluir" value="<?= $lu['id']; ?>" type="button" class="btn btn-danger btn-sm">Excluir</button>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<script>
var configE = {
	type: 'doughnut',
	data: {
		datasets: [{
			data: [
				5,
				8
			],
			backgroundColor: [
				'#6C757D',
				'#28A745'
			]
		}],
		labels: [
			'Aguardando Aprovação',
			'Em Atividade'
		]
	},
	options: {
		responsive: true,
		animation:{
			animateScale: true
		}
	}
};

var configO = {
	type: 'doughnut',
	data: {
		datasets: [{
			data: [
				5,
				13,
				20,
				40,
				71
			],
			backgroundColor: [
				'#6C757D',
				'#007BFF',
				'#FFC107',
				'#28A745',
				'#DC3545'
			]
		}],
		labels: [
			'Não Iniciado',
			'Em Andamento',
			'Aguardando Resposta',
			'Fechado',
			'Não Fechado'
		]
	},
	options: {
		responsive: true,
		animation:{
			animateScale: true
		}
	}
};

window.onload = function() {
	var ctxE = document.getElementById('graficoEmpresas').getContext('2d');
	window.myPie = new Chart(ctxE, configE);

	var ctxO = document.getElementById('graficoOrcamentos').getContext('2d');
	window.myPie = new Chart(ctxO, configO);
};
</script>