<?php 
require 'topo.php';
?>
	</h1>
	<p class="p-0 m-0 subtitulo">Cadastre as questões que os usuários possam ter.</p>
</div>
<div class="modal fade" id="modalEdPF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-padrao">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="bg-light" id="editaPF">
          <div class="form-group text-left">
            <label for="novapergunta" class="col-form-label">Nova Pergunta:</label>
            <input type="text" id="novapergunta">
            <label for="novaresposta" class="col-form-label">Nova Resposta:</label>
            <input type="text" id="novaresposta">
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <button type="button" id="salvarAlteracoes" class="btn bg-padrao"><i class="fas fa-check"></i> Salvar Alterações</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalExPF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="bg-light" id="excluiPF"> 
          <p class="texto-confirmacao"></p>       
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>  Não, cancelar.</button>
        <button type="button" id="cExcluirPF" class="btn bg-danger text-white"><i class="fas fa-trash-alt"></i> Sim, excluir.</button>
      </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="container">
	<div class="pt-5 pb-5 text-center">
		<h3 class="text-uppercase text-center titulo_pagina mb-5"><?=$this->titulo;?></h3>
    <button class="btn bg-padrao shadow-sm ml-1 rounded-lg" data-toggle="modal" data-target="#addPF">
      <i class="fa fa-plus"></i>
      <span class="m-0 p-0 text-white">Adicionar Pergunta Frequente</span>
    </button>
	</div>
  <div class="accordion pag" id="accordionExample">
      <div class="card bg-transparent border-0">
        <?php foreach ($listaDePF as $lpf):?>
          <div class="card-header bg-white mb-2 rounded-lg shadow-sm" id="heading<?=$lpf['id_pf']?>" data-toggle="collapse" data-target="#collapse<?=$lpf['id_pf']?>" aria-expanded="true" aria-controls="collapse<?=$lpf['id_pf']?>">
            <div class="row">
              <div class="col-lg-9">
                <h2 class="mb-0">
                  <button class="btn text-dark family-titulo" type="button">
                    <?=$lpf['pergunta_pf']?>
                  </button>
                </h2>
              </div>
              <div class="col-lg-3 align-self-center">
                <div class="text-right">
                  <button id="pfeditar" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEdPF" data-id="<?= $lpf['id_pf']; ?>" data-pergunta="<?= $lpf['pergunta_pf']; ?>" data-resposta="<?= $lpf['resposta_pf']; ?>">
                    <i class="fa fa-edit"></i> Editar
                  </button>
                  <button id="pfexcluir" value="<?= $lpf['id']; ?>" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExPF" data-id="<?= $lpf['id_pf']; ?>" data-pergunta="<?= $lpf['pergunta_pf']; ?>" data-resposta="<?= $lpf['resposta_pf']; ?>">
                    <i class="fas fa-trash-alt"></i> Excluir</button>
                </div>
              </div>
            </div>
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
		    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
		    <button type="button" id="add" class="btn bg-padrao"><i class="fa fa-check"></i> Adicionar</button>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>