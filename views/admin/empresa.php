<?php 
require 'topo.php';
?>
	</h1>
	<p class="p-0 m-0 subtitulo">Essas são as empresas cadastradas no sistema.</p>
</div>
<div class="container">
	<div class="pt-5 pb-5">
		<h3 class="text-uppercase text-center titulo_pagina"><?=$this->titulo;?></h3>
	</div>
	<div class="text-center mb-5">
		<button data-filter="all" class="btn btn-outline-dark text-dark btn-sm btn_filtro">Todas</button>
		<button data-filter="aa" class="btn btn-outline-secondary text-secondary btn-sm btn_filtro">Aguardando Aprovação</button>
		<button data-filter="ea" class="btn btn-outline-success text-success btn-sm btn_filtro">Em Atividade</button>
	</div>
	<div class="row">
		<?php foreach ($listaEmpresas as $le): ?>
		<div class="col-lg-12 mb-4 filterE 
			<?php
				switch($le['permissao_empresa']) {
					case '0':
						echo 'aa';
					break;
					default:
						echo 'ea';
					break;
				}
			?>
		">
			<div class="bg-white text-center shadow-sm pt-4 pb-4 rounded-lg">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 align-self-center text-center">
							<img src="<?=URL_BASE?>assets/img/imagem-de-apresentacao.jpg" alt="Empresa" class="rounded-circle" width="80">
						</div>
						<div class="col-lg-3 align-self-center text-left">	
							<h6 class="mb-1">Empresa:</h6>
							<p class="m-0 p-0 text-padrao"><?=$le['nome_empresa'];?></p>
						</div>
						<div class="col-lg-3 align-self-center text-left">	
							<h6 class="mb-1">Status:</h6>
							<?php
								switch($le['permissao_empresa']) {
									case '0':
										echo '<img src="'.URL_BASE.'assets/img/circulo-cinza.svg" alt="" width="10"> <span class="btn-status text-secondary">Aguardando Aprovação</span>';
									break;
									default:
										echo '<img src="'.URL_BASE.'assets/img/circulo-verde.svg" alt="" width="10"> <span class="btn-status text-success">Em Atividade</span>';
									break;
								}
							?>
						</div>
						<div class="col-lg-4 align-self-center">
							<h6 class="mb-1">Ações:</h6>
							<div class="text-center">	
								<?php
									switch($le['permissao_empresa']) {
										case '0':
											echo '<button type="button" class="btn btn-success btn-sm pl-4 pr-4">
													<img src="'.URL_BASE.'assets/img/aceitar.svg" width="15" class="mr-1 icones" alt="Aceitar">Aceitar
												</button>
												<button type="button" class="btn btn-danger btn-sm pl-4 pr-4">
													<img src="'.URL_BASE.'assets/img/rejeitar.svg" width="15" class="mr-1 icones" alt="Rejeitar">Rejeitar
												</button>
											';
										break;
										default:
											echo '<button type="button" class="btn btn-primary btn-sm pl-4 pr-4">
													<img src="'.URL_BASE.'assets/img/editar.svg" width="17" class="mr-1 icones" alt="Editar">Editar
												</button>
												<button type="button" class="btn btn-danger btn-sm pl-4 pr-4">
													<img src="'.URL_BASE.'assets/img/rejeitar.svg" width="15" class="mr-1 icones" alt="Excluir">Excluir
												</button>
											';
										break;
									}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
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