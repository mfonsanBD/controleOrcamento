<?php 
require 'topo.php';
?>
	</h1>
	<p class="p-0 m-0 subtitulo">Informações gerais do sistema.</p>
</div>
<div class="container">
	<div class="pt-5 pb-5">
		<h3 class="text-uppercase text-center titulo_pagina">Painel de Controle</h3>
	</div>
	<div class="row base">
		<div class="col-lg-8 bg-success">
			...
		</div>
		<div class="col-lg-4">
			<div class="row">
				<div class="col-lg-12">
					<div class="bg-white text-center shadow-sm pt-4 pb-4 widget_infos mb-4">
						<h4 class="text-uppercase nomedaempresa mb-3">Informações</h4>
						<div class="row">
							<div class="col-lg-6">
								<h1 class="text-center p-0 m-0">5</h1>
								<p class="text-center p-0 m-0">Usuários Cadastrados</p>
							</div>
							<div class="col-lg-6">
								<h1 class="text-center p-0 m-0">13</h1>
								<p class="text-center p-0 m-0">Empresas Cadastradas</p>							
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="bg-white text-center shadow-sm relatorios pt-4 pb-4 mb-4">
						<h4 class="text-uppercase nomedaempresa mb-2">Empresas</h4>
						<canvas height="250" id="graficoEmpresas"></canvas>
					</div>
				</div>
				<div class="col-lg-12">
					<div class="bg-white text-center shadow-sm relatorios pt-4 pb-4 mb-4">
						<h4 class="text-uppercase nomedaempresa mb-2">Orçamentos</h4>
						<canvas height="290" id="graficoOrcamentos"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
var configE = {
	type: 'doughnut',
	data: {
		datasets: [{
			data: [
				5,
				8
			],
			backgroundColor: [
				'#6C757D',
				'#28A745'
			]
		}],
		labels: [
			'Aguardando Aprovação',
			'Em Atividade'
		]
	},
	options: {
		responsive: true,
		animation:{
			animateScale: true
		}
	}
};

var configO = {
	type: 'doughnut',
	data: {
		datasets: [{
			data: [
				5,
				13,
				20,
				40,
				71
			],
			backgroundColor: [
				'#6C757D',
				'#007BFF',
				'#FFC107',
				'#28A745',
				'#DC3545'
			]
		}],
		labels: [
			'Não Iniciado',
			'Em Andamento',
			'Aguardando Resposta',
			'Fechado',
			'Não Fechado'
		]
	},
	options: {
		responsive: true,
		animation:{
			animateScale: true
		}
	}
};

window.onload = function() {
	var ctxE = document.getElementById('graficoEmpresas').getContext('2d');
	window.myPie = new Chart(ctxE, configE);

	var ctxO = document.getElementById('graficoOrcamentos').getContext('2d');
	window.myPie = new Chart(ctxO, configO);
};
</script>