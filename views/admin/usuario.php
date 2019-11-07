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
		    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
		    <button type="button" id="salvarAlteracoes" class="btn bg-padrao"><i class="fas fa-check"></i> Salvar</button>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalExUs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="bg-light" id="excluiSU"> 
      		<p class="texto-confirmacao"></p>       
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>  Não, cancelar.</button>
				<button type="button" id="excluirSU" class="btn bg-danger text-white"><i class="fas fa-trash-alt"></i> Sim, excluir.</button>
			</div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addU" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-padrao">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="bg-light" id="adicionaUsuario">
          <div class="form-group text-left">
            <label for="nome" class="col-form-label">Nome:</label>
            <input type="text" id="nomeu">
            <label for="email" class="col-form-label">E-mail:</label>
            <input type="text" id="emailu">
            <label for="senha" class="col-form-label">Senha:</label>
            <input type="password" id="senhau">
            <label for="csenha" class="col-form-label">Confirmar Senha:</label>
            <input type="password" id="csenhau">
          </div>
		  <div class="modal-footer">
		    <button type="button" id="cancela" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
		    <button type="button" id="adicionarUsuario" class="btn bg-padrao"><i class="fa fa-check"></i> Adicionar</button>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="container">
	<div class="pt-5 pb-5 text-center">
		<h3 class="text-uppercase titulo_pagina mb-5"><?=$this->titulo;?></h3>
		<button class="btn bg-padrao shadow-sm ml-1 rounded-lg" data-toggle="modal" data-target="#addU">
			<i class="fa fa-plus"></i>
			<span class="m-0 p-0 text-white">Adicionar Usuário</span>
		</button>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<?php foreach ($listaUsuarios as $lu): ?>
				<div class="col-md-12 bg-white rounded-lg pt-3 pb-3 mb-4 shadow-sm">
					<div class="row">
						<div class="col-md-1 align-self-center">
							<img src="<?=URL_BASE?>assets/img/<?=$lu['foto']?>" class="rounded-circle" width="70" alt="">
						</div>
						<div class="col-md-2 align-self-center">
							<h6 class="mb-1">Nome:</h6>
							<p class="p-0 m-0 text-padrao">
								<?php
									$usuario = explode(" ", $lu['nome']);
									echo $usuario[0];
								?>
							</p>
						</div>
						<div class="col-md-4 align-self-center">
							<h6 class="mb-1">E-mail:</h6>
							<p class="p-0 m-0 text-padrao"><?= $lu['email']; ?></p>
						</div>
						<div class="col-md-2 align-self-center">
							<h6 class="mb-1">Status:</h6>
							<?php
								switch($lu['permissao']) {
									case '0':
										echo '<i class="fas fa-circle text-danger fa-xs"></i> <span class="btn-status text-danger">Não Confirmado</span>';
									break;
									default:
										echo '<i class="fas fa-circle text-success fa-xs"></i> <span class="btn-status text-success">Confirmado</span>';
									break;
								}
							?>
						</div>
						<div class="col-md-3 align-self-center">
							<h6 class="mb-1">Ação:</h6>
							<button id="ueditar" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalEdUs" data-id="<?= $lu['id']; ?>" data-nome="<?= $lu['nome']; ?>">
								<i class="fa fa-edit"></i> Editar
							</button>
							<button id="uexcluir" value="<?= $lu['id']; ?>" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExUs" data-id="<?= $lu['id']; ?>" data-nome="<?= $lu['nome']; ?>">
								<i class="fas fa-trash-alt"></i> Excluir</button>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="col-lg-6 pag offset-lg-3">
		<nav aria-label="Page navigation example">
		  <ul class="pagination justify-content-center">
		    <li class="page-item disabled">
		      <a class="page-link text-padrao" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
		    </li>
		    <li class="page-item active"><a class="page-link text-padrao" href="#">1</a></li>
		    <li class="page-item"><a class="page-link text-padrao" href="#">2</a></li>
		    <li class="page-item"><a class="page-link text-padrao" href="#">3</a></li>
		    <li class="page-item">
		      <a class="page-link text-padrao" href="#">Próximo</a>
		    </li>
		  </ul>
		</nav>
	</div>
</div>