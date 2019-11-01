<?php 
require 'topo.php';
?>
	</h1>
	<p class="p-0 m-0 subtitulo">Cadastre as questões que os usuários possam ter.</p>
</div>
<div class="container">
	<div class="pt-5 pb-5">
		<h3 class="text-uppercase text-center titulo_pagina"><?=$this->titulo;?></h3>
	</div>
	<div class="col-lg-6 text-center pag">
		<button class="btn bg-white shadow-sm ml-1 p-3 pt-2 rounded-lg" data-toggle="modal" data-target="#addPF">
			<img src="<?=URL_BASE?>assets/img/mais.svg" width="20" class="mr-1 icones" alt="Adicionar">
			<p class="m-0 p-0 text-secondary">Adicionar Perguntas Frequentes</p>
		</button>
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