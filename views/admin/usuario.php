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
            <label for="nsenha" class="col-form-label">Nova Senha: 
				<span class="m-0 p-0 text-danger">*</span>
			</label>
            <input type="password" id="nsenha">
            <label for="cnsenha" class="col-form-label">Confirmar Nova Senha: 
				<span class="m-0 p-0 text-danger">*</span>
			</label>
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
            <label for="nomeu" class="col-form-label">Nome: 
				<span class="m-0 p-0 text-danger">*</span>
			</label>
            <input type="text" id="nomeu">
            <label for="sobrenomeu" class="col-form-label">Sobrenome: 
				<span class="m-0 p-0 text-danger">*</span>
			</label>
            <input type="text" id="sobrenomeu">
            <label for="emailu" class="col-form-label">E-mail: 
				<span class="m-0 p-0 text-danger">*</span>
			</label>
            <input type="text" id="emailu">
            <label for="senhau" class="col-form-label">Senha: 
				<span class="m-0 p-0 text-danger">*</span>
			</label>
            <input type="password" id="senhau">
            <label for="csenhau" class="col-form-label">Confirmar Senha: 
				<span class="m-0 p-0 text-danger">*</span>
			</label>
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
		<button class="btn bg-padrao btn-sm shadow-sm ml-1 rounded-lg" data-toggle="modal" data-target="#addU">
			<i class="fa fa-plus"></i>
			<span class="m-0 p-0 text-white">Adicionar Usuário</span>
		</button>
	</div>
	<div class="row">
		<div class="col-lg-12 mb-4">
			<?php
				if($qtdUsuarios != 0){
					foreach ($listaUsuarios as $lu): 
			?>
				<div class="col-md-12 bg-white rounded-lg pt-3 pb-3 mb-3 shadow-sm">
					<div class="row">
						<div class="col-md-1 align-self-center">
							<img src="<?=URL_BASE?>assets/img/<?=$lu['foto']?>" class="rounded-circle" width="70" alt="">
						</div>
						<div class="col-md-2 align-self-center">
							<h6 class="mb-1">Nome:</h6>
							<p class="p-0 m-0 text-padrao">
								<?php
									$nome 		= $lu['nome'];
									$sobrenome 	= $lu['sobrenome'];

									echo $nome." ".$sobrenome;
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
						<div class="col-md-3 align-self-center text-center">
							<h6 class="mb-1">Ação:</h6>
							<button id="ueditar" type="button" class="btn bg-padrao btn-sm" data-toggle="modal" data-target="#modalEdUs" data-id="<?= $lu['id']; ?>" data-nome="<?= $lu['nome']." ".$lu['sobrenome'];?>">
								<i class="fa fa-edit"></i> Editar
							</button>
							<button id="uexcluir" value="<?= $lu['id']; ?>" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExUs" data-id="<?= $lu['id']; ?>" data-nome="<?= $lu['nome']." ".$lu['sobrenome'];?>">
								<i class="fas fa-trash-alt"></i> Excluir</button>
						</div>
					</div>
				</div>
			<?php 
					endforeach;
				}else{
			?>
			<div class="col-md-4 offset-md-4 bg-secundario rounded-lg p-0 mb-5">
				<div class="text-padrao text-center pt-3 pb-3">
				  <p class="p-0 m-0">Nenhum usuário encontrado.</p>
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
				switch ($qtdUsuarios) {
					case '0':
						echo $qtdUsuarios." usuário encontrado.";
					break;

					case '1':
						echo $qtdUsuarios." usuário encontrado.";
					break;
					
					default:
						echo $qtdUsuarios." usuários encontrados.";
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
							<a class="page-link text-padrao" href="<?=URL_BASE;?>usuario/?p=<?=$i?>">
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