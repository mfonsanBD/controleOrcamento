<?php
date_default_timezone_set('America/Sao_Paulo');
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
			    <a class="nav-link text-secondary" href="<?= URL_BASE ?>painel/usuario">Usuários</a>
			  </li>
			  <li class="nav-item <?=($this->titulo == "Empresas") ? 'ativo' : ''?>">
			    <a class="nav-link text-secondary" href="<?= URL_BASE ?>painel/empresa">Empresas</a>
			  </li>
			  <li class="nav-item <?=($this->titulo == "Perguntas Frequentes") ? 'ativo' : ''?>">
			    <a class="nav-link text-secondary" href="<?= URL_BASE ?>painel/faqs">FAQ's</a>
			  </li>
			</ul>
			<button class="foto dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src="<?= URL_BASE ?>assets/img/<?= $_SESSION['foto'];?>" width="60" alt="Usuário" class="d-inline-block align-top rounded-circle">
			</button>
			
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item pt-3 pb-3 icones" href="<?= URL_BASE ?>painel/configuracoes">
					<img src="<?= URL_BASE ?>assets/img/configuracoes.svg" width="20" alt="Configurações" class="mr-2">Configurações
				</a>
				<a class="dropdown-item pt-3 pb-3 bg-danger text-light icones" href="<?=URL_BASE?>painel/sair">
					<img src="<?= URL_BASE ?>assets/img/sair.svg" width="15" alt="Configurações" class="mr-2">Sair
				</a>
			</div>
		</nav>
	</header>
</div>
<div class="container-fluid bg-padrao pt-5 pb-5 text-center">
	<h1 class="text-uppercase m-0 p-0">
		<?php 
			$usuario = $_SESSION['nome_do_usuario'];
			$usuario = explode(" ", $usuario);

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
		<?=$cumprimento.", ".$usuario[0]; ?>!