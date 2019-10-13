<header class="entrar">
	<div class="container text-center text-light pt-4">
		<a href="<?=URL_BASE?>">
			<img src="<?=URL_BASE?>assets/img/logo1.png" alt="LogoTipo">
		</a>
	</div>
</header>

<div class="login-cadastro">
	<div class="container-form" id="container">
		<div class="form-container sign-up-container">
		     <form method="POST" id="cadastro">
		        <h2 class="text-padrao text-uppercase mb-3">Crie Sua Conta</h2>
		        <input type="text" id="nome" placeholder="Nome Completo" />
		        <span class="form-text text-warning m-0 p-0" id="erroNome"></span>
		        <input type="email" id="email" placeholder="E-mail" />
		        <span class="form-text text-warning m-0 p-0" id="erroEmail"></span>
		        <input type="password" id="senha" placeholder="Senha" onkeyup="validarForcaSenha()" />
		        <div id="forca" class="w-12">
		        	<p class="m-0 p-0 text-black-50" id="numeros">*Números</p>
		        	<p class="m-0 p-0 text-black-50" id="maiuscula">*Letras Maiúsculas</p>
		        	<p class="m-0 p-0 text-black-50" id="minuscula">*Letras Minúsculas</p>
		        	<p class="m-0 p-0 text-black-50" id="oito">*Mínimo 8 caracteres</p>
		        	<p class="mt-0 ml-0 mr-0 mb-2 p-0 text-black-50" id="especiais">*Caracteres Especiais</p>
		        	<p class="m-0 p-0 text-danger" id="forcaSenha"></p>
		        </div>
		        <span class="form-text text-warning m-0 p-0" id="erroSenha"></span>
		        <input type="password" id="cSenha" placeholder="Confirmar Senha" />
		        <span class="form-text text-warning mt-0 ml-0 mr-0 mb-4 p-0" id="erroCSenha"></span>
		        <button type="submit">Cadastrar</button>
		    </form>
		</div>
		<div class="form-container sign-in-container">
		    <form method="POST" id="login">
		        <h2 class="text-padrao text-uppercase">Olá, Tudo bem?</h2>
		        <span>Acesse sua conta e vamos ao trabalho!</span>
		        <input type="email" id="lemail" placeholder="E-mail" />
		        <input type="password" id="lsenha" placeholder="Senha" />
		        <a class="text-secondary mt-2 mb-3" href="<?=URL_BASE?>login/esqueci">Esqueci minha senha.</a>
		        <button type="submit">Acessar</button>
		    </form>
		</div>
		<div class="overlay-container">
		    <div class="overlay">
		    	<div class="overlay-panel overlay-left">
		            <h2 class="text-uppercase mb-4">Já tem uma conta?</h2>
		            <button class="ghost" id="signIn">Acesse Agora</button>
		        </div>
		        <div class="overlay-panel overlay-right">
		            <h2 class="text-uppercase mb-4">Não tem uma conta?</h2>
		            <button class="ghost" id="signUp">Cadastre-se</button>
		        </div>
		    </div>
		</div>
	</div>
</div>