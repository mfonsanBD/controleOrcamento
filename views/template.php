<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= NOME_DO_SITE ?></title>
    <link rel="stylesheet" href="<?= URL_BASE ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>assets/css/estilo.css">
</head>
<body>

<?php
	$this->loadViewInTemplate($viewNome, $dados);
?>

<footer class="text-padrao">&copy; 2019 - Controle de Orçamentos</footer>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/script.js"></script>
</body>
</html>