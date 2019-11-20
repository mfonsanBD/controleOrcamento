<?php 
require 'topo.php';
if($this->fotoUsuario == "usuario.jpg"){
	$usuarioFoto = URL_BASE.'assets/img/'.$this->fotoUsuario;
}else{
	$usuarioFoto = URL_BASE.'assets/img/usuarios/'.$_SESSION['logado'].'/'.$this->fotoUsuario;
}
?>
	</h1>
	<p class="p-0 m-0 subtitulo">Essas são as empresas cadastradas no sistema.</p>
</div>
<div class="modal fade" id="addEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-padrao">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="bg-light" id="adicionaEmpresa">
          	<div class="form-group text-left">
	            <div class="form-row text-left col-lg-12 m-0 p-0">
					<div class="form-group col-lg-12">
						<label for="nomeEmpresa">Nome da Empresa: 
							<span class="m-0 p-0 text-danger">*</span>
						</label>
						<input type="text" id="nomeEmpresa" placeholder="Ex.: Minha Empresa">
					</div>
					<div class="form-group col-lg-12">
						<label for="emailEmpresa">E-mail: 
							<span class="m-0 p-0 text-danger">*</span>
						</label>
						<input type="email" id="emailEmpresa" placeholder="Ex.: minhaempresa@gmail.com">
					</div>
					<div class="form-group col-lg-12">
						<label for="siteEmpresa">Site:</label>
						<input type="text" id="siteEmpresa" placeholder="Ex.: http://minhaempresa.com.br">
					</div>
					<div class="form-group col-lg-12">
						<label for="telefoneEmpresa">Telefone: 
							<span class="m-0 p-0 text-danger">*</span>
						</label>
						<input type="text" id="telefoneEmpresa" class="telefone" placeholder="Ex.: 21xxxxxxxx | 21xxxxxxxxx">
					</div>
					<div class="form-group col-lg-12">
						<div class="row">
							<div class="col-md-1">
								<button type="button" class="btn btn-sm pt-0 pb-0 text-white bg-secondary" id="wpp">
									<i class="fa fa-check"></i>
								</button>
							</div>
							<div class="col-md-11 pt-1 pb-3 pl-2">
								<p class="p-0 m-0">Marque esta opção para adicionar o WhatsApp da empresa.</p>
							</div>
						</div>
					</div>
					<div class="form-group col-lg-12" id="whatsapp">
						<label for="whatsappEmpresa">WhatsApp:</label>
						<input type="text" id="whatsappEmpresa" class="telefone" placeholder="Ex.: 21xxxxxxxxx">
					</div>
					<div class="form-group col-lg-12">
						<label>Gerente: 
							<span class="m-0 p-0 text-danger">*</span>
						</label>
						<div class="input-group mb-3">
						  <select class="custom-select" id="gerente">
						    <option value="" disabled selected>Selecione um gerente...</option>
							<?php foreach($usuarios as $usuario): ?>
								<option class="opcoes" value="<?=$usuario['id']?>">
									<?=$usuario['nome']." ".$usuario['sobrenome']?>
								</option>
							<?php endforeach; ?>
						  </select>
						</div>
					</div>
				</div>
          	</div>
		  <div class="modal-footer">
		    <button type="button" id="cancela" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
		    <button type="submit" class="btn bg-padrao"><i class="fa fa-check"></i> Adicionar</button>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="container">
	<div class="pt-5 pb-5">
		<h3 class="text-uppercase text-center titulo_pagina mb-5"><?=$this->titulo;?></h3>
		<div class="row">
			<div class="col-md-8">
				<div class="text-left">
					<button data-filter="all" class="btn btn-outline-dark text-dark btn-sm btn_filtro">Todas</button>
					<button data-filter="aa" class="btn btn-outline-secondary text-secondary btn-sm btn_filtro">Aguardando Aprovação</button>
					<button data-filter="ea" class="btn btn-outline-success text-success btn-sm btn_filtro">Em Atividade</button>
					<button data-filter="ed" class="btn btn-outline-danger text-danger btn-sm btn_filtro">Desativada</button>
				</div>
			</div>
			<div class="col-md-4">
				<div class="text-right">
					<button class="btn bg-padrao btn-sm shadow-sm ml-1 rounded-lg" data-toggle="modal" data-target="#addEmpresa">
						<i class="fa fa-plus"></i>
						<span class="m-0 p-0 text-white">Adicionar Empresa</span>
					</button>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-4">
		<?php
			if($qtdEmpresas != 0){
				foreach ($listaEmpresas as $le):
		?>
		<div class="col-lg-12 mb-3 filterE 
			<?php
				switch($le['permissao_empresa']) {
					case '0':
						echo 'aa';
					break;
					case '1':
						echo 'ea';
					break;
					default:
						echo 'ed';
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
										echo '<i class="fas fa-circle text-secondary fa-xs"></i> <span class="btn-status text-secondary">Aguardando Aprovação</span>';
									break;
									case '1':
										echo '<i class="fas fa-circle text-success fa-xs"></i> <span class="btn-status text-success">Em Atividade</span>';
									break;
									default:
										echo '<i class="fas fa-circle text-danger fa-xs"></i> <span class="btn-status text-danger">Desativada</span>';
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
											echo '<button type="button" class="btn btn-success btn-sm pl-4 pr-4" onclick="aceitaEmpresa('.$le['id_empresa'].')">
													<i class="fa fa-check"></i> Aceitar
												</button>
											';
										break;
										case '1':
											echo '<button type="button" class="btn btn-warning btn-sm pl-4 pr-4 text-white" onclick="desativarEmpresa('.$le['id_empresa'].')">
													<i class="fa fa-times fa-lg"></i> Dasativar
												</button>
												<button type="button" class="btn btn-danger btn-sm pl-4 pr-4" onclick="excluiEmpresa('.$le['id_empresa'].')">
													<i class="fas fa-trash-alt"></i> Excluir
												</button>
											';
										break;
										default:
											echo '<button type="button" class="btn btn-success btn-sm pl-4 pr-4" onclick="reativarEmpresa('.$le['id_empresa'].')">
													<i class="fa fa-check"></i> Reativar
												</button>
												<button type="button" class="btn btn-danger btn-sm pl-4 pr-4" onclick="excluiEmpresa('.$le['id_empresa'].')">
													<i class="fas fa-trash-alt"></i> Excluir
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
		<?php
				endforeach;
			}else{
		?>
          <div class="col-md-4 offset-md-4 bg-secundario rounded-lg p-0 mb-5">
            <div class="text-padrao text-center pt-3 pb-3">
              <p class="p-0 m-0">Nenhuma empresa encontrada.</p>
            </div>
          </div>
		<?php		
			}
		?>
	</div>
	<div class="col-lg-12 p-0 pag">
		<div class="row">
			<div class="col-md-6 text-left ">
				<p class="pt-2 pb-2 m-0 text-secondary">
				<?php
				switch ($qtdEmpresas) {
					case '0':
						echo $qtdEmpresas." empresa encontrada.";
					break;

					case '1':
						echo $qtdEmpresas." empresa encontrada.";
					break;
					
					default:
						echo $qtdEmpresas." empresas encontradas.";
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
							<a class="page-link text-padrao" href="<?=URL_BASE;?>empresa/?p=<?=$i?>">
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