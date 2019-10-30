<header class="entrar">
	<div class="container text-center text-light pt-4">
		<a href="<?=URL_BASE?>">
			<img src="<?=URL_BASE?>assets/img/logo1.png" alt="LogoTipo">
		</a>
	</div>
</header>

<div class="col-md-5 p-5 text-center rounded-lg bg-white esqueci">
	<h2 class="text-uppercase text-padrao">Esqueceu sua senha?</h2>
	<span class="mb-4">Enviaremos um e-mail com os seus dados de acesso.</span>
	<form method="POST" id="esqueci">
		<input type="email" id="eemail" class="mb-4" placeholder="E-mail" />
		<button type="submit">
			Enviar
			<img src="<?=URL_BASE?>assets/img/enviar.svg" width="20" class="ml-1 icones" alt="Enviar">
		</button>
	</form>
</div>