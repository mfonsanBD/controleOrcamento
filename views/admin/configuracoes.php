<?php 
require 'topo.php';

if($this->foto == "usuario.jpg"){
	$usuarioFoto = URL_BASE.'assets/img/'.$this->foto;
}else{
	$usuarioFoto = URL_BASE.'assets/img/usuarios/'.$_SESSION['logado'].'/'.$this->foto;
}
?>
	</h1>
	<p class="p-0 m-0 subtitulo">Faça as alterações da sua conta.</p>
</div>
<div id="modalCorteImagem" class="modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-padrao">
				<h5 class="modal-title">Corte e envio de foto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
			</div>
			<div class="modal-body mb-4">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div id="image_demo" style="width: 100%;" class="mt-3"></div>
					</div>
					<div class="col-lg-6 text-right">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					</div>
					<div class="col-lg-6 text-left">
						<button class="btn btn-success" id="cortarImagem">Cortar e Enviar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="pt-5 pb-5">
		<h3 class="text-uppercase text-center titulo_pagina"><?=$this->titulo;?></h3>
	</div>
	<div class="col-lg-8 offset-lg-2 text-center pag">
		<img src="<?=$usuarioFoto?>" width="120" alt="Usuário" class="d-inline-block align-top rounded-circle mb-4">
		<form method="POST" enctype="multipart/form-data" id="dados" class="col-lg-12">
			<label for="foto" class="text-black-50 label_foto">Clique aqui e escolha uma imagem para o seu perfil</label>
			<input type="file" id="foto" class="mb-5" accept="image/png, image/jpeg">
			<div class="form-row text-left col-lg-12 m-0 p-0">
				<div class="form-group col-lg-6">
					<label for="nome">Nome:</label>
					<input type="text" id="nome" class="resposta" value="<?=$mostraInfos['nome'];?>">
				</div>
				<div class="form-group col-lg-6">
					<label for="sobrenome">Sobrenome:</label>
					<input type="text" id="sobrenome" class="resposta" value="<?=$mostraInfos['sobrenome'];?>">
				</div>
			</div>
			<div class="form-row text-left col-lg-12 m-0 p-0">
				<div class="form-group col-lg-12">
					<label for="email">E-mail:</label>
					<input type="email" id="email" class="resposta" value="<?=$mostraInfos['email'];?>">
				</div>
			</div>
			<div class="form-row text-left col-lg-12 mt-0 ml-0 mr-0 mb-5 p-0">
				<div class="form-group col-lg-4">
					<label for="atual">Senha Atual:</label>
					<input type="password" id="atual" class="resposta">
				</div>
				<div class="form-group col-lg-4">
					<label for="nova">Nova Senha:</label>
					<input type="password" id="nova" class="resposta">
				</div>
				<div class="form-group col-lg-4">
					<label for="cnova">Confirma Nova Senha:</label>
					<input type="password" id="cnova" class="resposta">
				</div>
			</div>
			<button type="submit" class="btn bg-padrao">
				<i class="fas fa-check"></i> Salvar Configurações
			</button>
		</form>
	</div>
</div>