<?php 
require 'topo.php';
?>
	</h1>
	<p class="p-0 m-0 subtitulo">Faça as alterações da sua conta.</p>
</div>
<div class="container">
	<div class="pt-5 pb-5">
		<h3 class="text-uppercase text-center titulo_pagina"><?=$this->titulo;?></h3>
	</div>
	<div class="col-lg-8 offset-lg-2 text-center pag">
		<img src="<?= URL_BASE ?>assets/img/<?= $_SESSION['foto']; ?>" width="120" alt="Usuário" class="d-inline-block align-top rounded-circle mb-4">
		<form method="POST" enctype="multipart/form-data" id="dados" class="col-lg-12">
			<label for="foto" class="text-black-50 label_foto">Clique aqui e escolha uma imagem para o seu perfil</label>
			<input type="file" id="foto" class="mb-5">
			<div class="form-row text-left col-lg-12 m-0 p-0">
				<div class="form-group col-lg-12">
					<label for="nome">Nome Completo:</label>
					<input type="text" id="nome" class="resposta">
				</div>
			</div>
			<div class="form-row text-left col-lg-12 m-0 p-0">
				<div class="form-group col-lg-6">
					<label for="email">E-mail:</label>
					<input type="email" id="email" class="resposta">
				</div>
				<div class="form-group col-lg-6">
					<label for="telefone">Telefone:</label>
					<input type="text" id="telefone" class="resposta" maxlength="11" data-mask="(00) 0000-0000">
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
				<img src="<?=URL_BASE?>assets/img/salvar.svg" width="20" class="mr-1 icones" alt="Salvar Alterações">
				Salvar Configurações
			</button>
		</form>
	</div>
</div>