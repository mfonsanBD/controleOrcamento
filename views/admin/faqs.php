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
            <label for="novapergunta" class="col-form-label">Nova Pergunta: 
              <span class="m-0 p-0 text-danger">*</span>
            </label>
            <input type="text" id="novapergunta">
            <label for="novaresposta" class="col-form-label">Nova Resposta: 
              <span class="m-0 p-0 text-danger">*</span>
            </label>
            <input type="text" id="novaresposta">
          </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
        <button type="button" id="salvarAlteracoes" class="btn bg-padrao"><i class="fas fa-check"></i> Salvar</button>
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
            <label for="pergunta" class="col-form-label">Pergunta: 
              <span class="m-0 p-0 text-danger">*</span>
            </label>
            <input type="text" id="pergunta">
            <label for="resposta" class="col-form-label">Resposta: 
              <span class="m-0 p-0 text-danger">*</span>
            </label>
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
<div class="container">
	<div class="pt-5 pb-5 text-center">
		<h3 class="text-uppercase text-center titulo_pagina mb-5"><?=$this->titulo;?></h3>
    <button class="btn bg-padrao btn-sm shadow-sm ml-1 rounded-lg" data-toggle="modal" data-target="#addPF">
      <i class="fa fa-plus"></i>
      <span class="m-0 p-0 text-white">Adicionar Pergunta Frequente</span>
    </button>
	</div>
  <div class="accordion mb-4" id="accordionExample">
      <div class="card bg-transparent border-0">
        <?php
          if($qtdFaqs != 0){
           foreach ($listaDePF as $lpf):
        ?>
          <div class="card-header bg-white mb-2 rounded-lg shadow-sm" id="heading<?=$lpf['id_pf']?>" data-toggle="collapse" data-target="#collapse<?=$lpf['id_pf']?>" aria-expanded="true" aria-controls="collapse<?=$lpf['id_pf']?>">
            <div class="row">
              <div class="col-lg-9">
                <h2 class="mb-0">
                  <button class="btn text-dark family-titulo pl-0" type="button">
                    <?=$lpf['pergunta_pf']?>
                  </button>
                </h2>
              </div>
              <div class="col-lg-3 align-self-center">
                <div class="text-right">
                  <button id="pfeditar" type="button" class="btn bg-padrao btn-sm" data-toggle="modal" data-target="#modalEdPF" data-id="<?= $lpf['id_pf']; ?>" data-pergunta="<?= $lpf['pergunta_pf']; ?>" data-resposta="<?= $lpf['resposta_pf']; ?>">
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
              <p class="text-secondary p-0 m-0"><?=$lpf['resposta_pf']?></p>
            </div>
          </div>
        <?php 
            endforeach;
          }else{
        ?>
          <div class="col-md-6 offset-md-3 bg-secundario rounded-lg p-0 mb-5">
            <div class="row">
              <div class="col-md-1">
                <div class="bg-padrao text-white text-center pt-3 pb-3 pl-5 pr-5">
                  !
                </div>
              </div>
              <div class="col-md-11">
                <div class="text-padrao text-center pt-3 pb-3">
                  <p class="pt-1 m-0">Nenhuma pergunta frequente encontrada.</p>
                </div>
              </div>
            </div>
          </div>
        <?php    
          }
        ?>
      </div>
  </div>
  <div class="col-lg-12 p-0 pag">
    <div class="row">
      <div class="col-md-6 text-left">
        <p class="pt-2 pb-2 m-0 text-secondary">
        <?php
          switch ($qtdFaqs) {
            case '0':
              echo $qtdFaqs." pergunta frequente encontrada.";
            break;

            case '1':
              echo $qtdFaqs." pergunta frequente encontrada.";
            break;
            
            default:
              echo $qtdFaqs." perguntas frequentes encontradas.";
            break;
          }
        ?>
        </p>
      </div>
      <div class="col-md-5 p-0 pr-2 m-0">
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-end">
            <?php for($i=1; $i<=$totalPaginas;$i++):?>
            <li class="page-item <?= ($this->p == $i)?'active':''; ?>">
              <a class="page-link text-padrao" href="<?=URL_BASE;?>faqs/?p=<?=$i?>">
                <?= ($i) ?>
              </a>
            </li>
          <?php endfor; ?>
          </ul>
        </nav>
      </div>
      <div class="col-md-1 ml-0 pl-0 text-right">
        <p class="pt-2 pb-2 m-0 text-secondary">
          <?php
            switch ($totalPaginas) {
              case '0':
                echo $totalPaginas." páginas.";
              break;

              case '1':
                echo $totalPaginas." página.";
              break;
              
              default:
                echo $totalPaginas." páginas.";
              break;
            }
          ?>
        </p>
      </div>
    </div>
  </div>
</div>