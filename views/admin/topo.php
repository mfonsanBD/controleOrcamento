<?php
date_default_timezone_set('America/Sao_Paulo');
if($this->foto == "usuario.jpg"){
	$usuarioFoto = URL_BASE.'assets/img/'.$this->foto;
}else{
	$usuarioFoto = URL_BASE.'assets/img/usuarios/'.$_SESSION['logado'].'/'.$this->foto;
}
?>
<div class="container">
	<header>
		<nav class="navbar">
			<a href="<?= URL_BASE ?>painel" class="navbar-brand">
				<img src="<?= URL_BASE ?>assets/img/logo2.png" width="150" alt="Logotipo Controle de Orçamento" class="d-inline-block align-top">
			</a>
			<ul class="nav justify-content-center">
			  <li class="nav-item <?=($this->titulo == "Painel de Controle") ? 'ativo' : ''?>">
			    <a class="nav-link text-secondary" href="<?= URL_BASE ?>painel">Painel de Controle</a>
			  </li>
			  <li class="nav-item <?=($this->titulo == "Usuários") ? 'ativo' : ''?>">
			    <a class="nav-link text-secondary" href="<?= URL_BASE ?>usuario">Usuários</a>
			  </li>
			  <li class="nav-item <?=($this->titulo == "Empresas") ? 'ativo' : ''?>">
			    <a class="nav-link text-secondary" href="<?= URL_BASE ?>empresa">Empresas</a>
			  </li>
			  <li class="nav-item <?=($this->titulo == "Perguntas Frequentes") ? 'ativo' : ''?>">
			    <a class="nav-link text-secondary" href="<?= URL_BASE ?>faqs">FAQ's</a>
			  </li>
			</ul>
			<button class="foto dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src="<?=$usuarioFoto?>" width="60" alt="Usuário" class="d-inline-block align-top rounded-circle">
			</button>
			
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item pt-3 pb-3 icones text-secondary" href="<?= URL_BASE ?>configuracoes">
					<i class="fas fa-cog"></i> Configurações
				</a>
				<a class="dropdown-item pt-3 pb-3 bg-danger text-light icones" href="<?=URL_BASE?>login/sair">
					<i class="fas fa-power-off"></i> Sair
				</a>
			</div>
		</nav>
	</header>
</div>
<div class="container-fluid bg-padrao pt-5 pb-5 text-center">
	<h1 class="text-uppercase m-0 p-0">
		<?php 
			$nome 			= $_SESSION['nome_do_usuario'];
			$sobrenome 		= $_SESSION['sobrenome_do_usuario'];

			$hora = date("H:i:s");

			switch ($hora) {
				case ($hora >= "00:00:00" && $hora < "12:00:00"):
					$cumprimento = "Bom dia";
				break;

				case ($hora >= "12:00:00" && $hora < "19:00:00"):
					$cumprimento = "Boa tarde";
				break;
				
				default:
					$cumprimento = "Boa noite";
				break;
			}
		?>
		<?=$cumprimento.", ".$nome." ".$sobrenome; ?>!