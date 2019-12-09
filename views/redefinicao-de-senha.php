<header class="entrar">
	<div class="container text-center text-light pt-4">
		<a href="<?=URL_BASE?>">
			<img src="<?=URL_BASE?>assets/img/logo1.png" alt="LogoTipo">
		</a>
	</div>
</header>

<div class="col-md-3 p-5 text-center rounded-lg bg-white esqueci" id="codigos">
	<h3 class="text-uppercase text-padrao m-0 p-0"><?=$this->titulo;?></h3>
	<span>Digite abaixo o código enviado para o seu e-mail.</span>
	<form method="POST" id="codigoRedefinicao" class="mt-3">
		<input type="hidden" id="hash" value="<?=$hash?>">
		<input type="text" id="codigo" maxlength="6" class="mb-4" placeholder="Código de verificação" />
		<button type="submit">
			<i class="fa fa-check"></i> Enviar
		</button>
	</form>
</div>
<div class="col-md-3 p-5 text-center rounded-lg bg-white esqueci" id="novasenha">
	<h3 class="text-uppercase text-padrao m-0 p-0"><?=$this->titulo;?></h3>
	<span class="mb-4">Digite abaixo sua nova senha.</span>
	<form method="POST" id="camposNovaSenha" class="mt-3">
		<input type="password" id="nsenha" placeholder="Nova Senha" />
		<input type="password" id="cnsenha" class="mb-4" placeholder="Confirmar Nova Senha" />
		<button type="submit">
			<i class="fa fa-check"></i> Enviar
		</button>
	</form>
</div>