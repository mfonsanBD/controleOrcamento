<?php 
require 'topo.php';
?>
	</h1>
	<p class="p-0 m-0 subtitulo">Cadastre as questões que os usuários possam ter.</p>
</div>
<div class="container">
	<div class="pt-5 pb-5 text-center">
		<h3 class="text-uppercase text-center titulo_pagina mb-5"><?=$this->titulo;?></h3>
    <button class="btn bg-white shadow-sm ml-1 rounded-lg" data-toggle="modal" data-target="#addPF">
      <img src="<?=URL_BASE?>assets/img/mais-cinza.svg" width="15" class="mr-1 icones" alt="Adicionar">
      <span class="m-0 p-0 text-secondary">Adicionar Perguntas Frequentes</span>
    </button>
	</div>

  <div class="accordion pag" id="accordionExample">
      <div class="card bg-transparent border-0">
        <?php foreach ($listaDePF as $lpf):?>
          <div class="card-header bg-white mb-2 rounded-lg shadow-sm" id="heading<?=$lpf['id_pf']?>" data-toggle="collapse" data-target="#collapse<?=$lpf['id_pf']?>" aria-expanded="true" aria-controls="collapse<?=$lpf['id_pf']?>">
            <h2 class="mb-0">
              <button class="btn text-dark family-titulo" type="button">
                <?=$lpf['pergunta_pf']?>
              </button>
            </h2>
          </div>

          <div id="collapse<?=$lpf['id_pf']?>" class="collapse collapsed" aria-labelledby="heading<?=$lpf['id_pf']?>" data-parent="#accordionExample">
            <div class="card-body">
              <p class="text-secondary"><?=$lpf['resposta_pf']?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
  </div>
</div>


<div class="modal fade" id="addPF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-padrao">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="bg-light" id="adcPF">
          <div class="form-group text-left">
            <label for="pergunta" class="col-form-label">Pergunta:</label>
            <input type="text" id="pergunta">
            <label for="resposta" class="col-form-label">Resposta:</label>
            <input type="text" id="resposta">
          </div>
		  <div class="modal-footer">
		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		    <button type="button" id="add" class="btn bg-padrao">Adicionar</button>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>