<?php
date_default_timezone_set('America/Sao_Paulo');
if($this->fotoUsuario == "usuario.jpg"){
	$usuarioFoto = URL_BASE.'assets/img/'.$this->fotoUsuario;
}else{
	$usuarioFoto = URL_BASE.'assets/img/usuarios/'.$_SESSION['logado'].'/'.$this->fotoUsuario;
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
				<a class="dropdown-item pt-3 pb-3 bg-danger text-light icones" href="<?=URL_BASE?>sair">
					<i class="fas fa-power-off"></i> Sair
				</a>
			</div>
		</nav>
	</header>
</div>
<div class="container-fluid bg-padrao pt-5 pb-5 text-center">
	<h1 class="text-uppercase m-0 p-0">
		<?php
			if((date("d/m") >= "04/11") && (date("d/m", strtotime("+1 year")) <= "20/03")){
				$hora = date("H", strtotime("-1 hour"));
			}else{
				$hora = date("H");
			}

			switch ($hora) {
				case (($hora) >= "00" && $hora < "12"):
					$cumprimento = "Bom dia";
				break;

				case ($hora >= "13" && $hora < "18"):
					$cumprimento = "Boa tarde";
				break;
				
				default:
					$cumprimento = "Boa noite";
				break;
			}
		?>
		<?=$cumprimento.", ".$this->nome." ".$this->sobrenome; ?>!