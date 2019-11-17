<?php require 'configuracao.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Template E-mail Altera Senha</title>
</head>
<body>
	<div style="width: 600px; line-height: 1.5; background-color: #f9f9f9; font-family: 'Helvetica', Geneva, sans-serif;">
		<div style="width: 100%; background-color: #005E76; padding: 10px 0; text-align: center;">
			<img src="<?=URL_BASE?>assets/img/logo1.png" width="120" alt="Logo Controle de Orçamentos">
		</div>
		<h2 style="text-align: center;">Redefinição de Senha</h2>
		<p style="padding: 0 20px">
			Prezado(a)
		</p>
		<p style="padding: 0 20px">
			<?php
				$ascii = implode('', array_merge(range('a', 'z'), range(0, 9)));
			    $ascii = str_repeat($ascii, 5);
			    $codigo = substr(str_shuffle($ascii), 0, 6);
			?>
			Clique no botão abaixo e utilize o código a seguir para redefinir sua senha: <b><?=$codigo?></b>
		</p>
		<p style="padding: 0 20px 30px">
			<?php $hash = md5(time().rand(0,9999));?>
			<a style="background-color: #005E76; color: #FFFFFF; padding: 10px 20px; text-decoration: none;" href="<?=URL_BASE?>login/redefinicaoDeSenha/?hash=<?=$hash?>" target="_blank">
				Redefinir
			</a>
		</p>
		<p style="padding: 0 20px 30px">
			Atenciosamente,<br>
			Equipe Controle de Orçamento
		</p>
		<div style="width: 100%; font-size: 12px; background-color: #005E76; color: #FFFFFF; padding: 10px 0; text-align: center;">
			&copy; <?=date('Y');?> - Controle de Orçamentos
		</div>
	</div>
</body>
</html>