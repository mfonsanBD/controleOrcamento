<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= NOME_DO_SITE ?> - <?=$this->titulo;?></title>
    <link rel="stylesheet" href="<?= URL_BASE ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= URL_BASE ?>assets/css/estilo.css">
</head>
<body>

<?php
	$this->loadViewInTemplate($viewNome, $dados);
?>

<div class="modal fade" id="modalEdUs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content bg-light">
      <div class="modal-header bg-padrao">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="bg-light">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
		  <div class="modal-footer">
		    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
		    <button type="button" class="btn bg-padrao">Salvar Alterações</button>
		  </div>
        </form>
      </div>
    </div>
  </div>
</div>

<footer class="text-padrao text-center bg-white fixed-bottom pt-3 pb-3">&copy; 2019 - Controle de Orçamentos</footer>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/Chart.min.js"></script>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/script.js"></script>
<script type="text/javascript" src="<?= URL_BASE ?>assets/js/controleDeOrcamento.js"></script>
</body>
</html>