<?php require 'configuracao.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Template E-mail Confirma Cadastro</title>
</head>
<body>
	<div style="width: 600px; line-height: 1.5; background-color: #f9f9f9; font-family: 'Helvetica', Geneva, sans-serif;">
		<div style="width: 100%; background-color: #005E76; padding: 10px 0; text-align: center;">
			<img src="<?=URL_BASE?>assets/img/logo1.png" width="120" alt="Logo Controle de Orçamentos">
		</div>
		<h2 style="text-align: center;">Confirmação de Cadastro</h2>
		<p style="padding: 0 20px">
			Olá, tudo bem? Esperamos que sim.<br>
			Antes de mais nada, queremos agradecer por se cadastrar no <span style="color:#005E76;">Controle de Orçamento</span>! Aqui você pode gerenciar todos os leads que chegam até a sua empresa.
		</p>
		<p style="padding: 0 20px">
			Este e-mail é para confirmar que você fez o cadastro em nosso sistema.<br>
			É coisa rápida, só clicar no botão abaixo:
		</p>
		<p style="padding: 0 20px 30px">
			<?php
				$codigo = md5(time().rand(0,9999));
			?>
			<a style="background-color: #005E76; color: #FFFFFF; padding: 10px 20px; text-decoration: none;" href="<?=URL_BASE?>login/confirmacao-de-cadastro/?codigo=<?=$codigo?>">
				Confirmar
			</a>
		</p>
		<p style="padding: 0 20px 30px">
			Atenciosamente,<br>
			Equipe Controle de Orçamento
		</p>
		<div style="width: 100%; font-size: 12px; background-color: #005E76; color: #FFFFFF; padding: 10px 0; text-align: center;">
			&copy; 2019 - Controle de Orçamentos
		</div>
	</div>
</body>
</html>