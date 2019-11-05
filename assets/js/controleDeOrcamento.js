$(document).ready(function(){
	$(".btn_filtro").click(function(){
		var valor = $(this).attr("data-filter");
		
		if(valor == "all"){
			$(".filterE").show("1000");
		}else{
			$(".filterE").not("."+valor).hide("1000");
			$(".filterE").filter("."+valor).show("1000");
		}
	});

	$("#esqueci").on("submit", function(e){
		e.preventDefault();

		var email = $("#eemail").val();

		if(email == ""){
			swal({
				title: "Aviso!", 
				text: "Para redefinir sua senha é obrigatório que nos envie seu e-mail cadastrado no sistema.", 
				icon: "warning"
			});
			return false;
		}else{
			swal({
				title: "Obrigado!", 
				text: "Estaremos enviando uma senha provisória para seu e-mail com o passo a passo do que você deverá fazer para redefinir sua senha.", 
				icon: "success"
			});
		}
	});

	$('#modalEdUs').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id = button.data('id'); // Extract info from data-* attributes
		var nome = button.data('nome'); // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this);
		modal.find('.modal-title').text('Alterar senha de: '+nome);

		$("#salvarAlteracoes").on("click", function(){
		  	var novaSenha = $("#nsenha").val();
		  	var cNovaSenha = $("#cnsenha").val();

			if(novaSenha == '' && cNovaSenha == ''){
				swal({
					title: "Erro!", 
					text: "Os campos não podem estar vazios.", 
					icon: "error"
				})
				.then((resposta) => {
					$('#modalEdUs').modal('hide');
				});
			}else{
				if(novaSenha != cNovaSenha){
					swal({
						title: "Aviso!", 
						text: "As senhas não coincidem!", 
						icon: "warning"
					})
					.then((resposta) => {
						$('#modalEdUs').modal('hide');
					});
				}else{
					$.ajax({
						url: 'http://localhost/gcc/painel/adminEdita',
						type: 'POST',
						data: {senha:novaSenha, id:id},
						success: function(dados){
							if(dados == 1){
								swal({
									title: "Parabéns!", 
									text: "Senha alterada com sucesso!", 
									icon: "success"
								})
								.then((resposta) => {
									$('#modalEdUs').modal('hide');
								});
							}else{
								swal({
									title: "Erro!", 
									text: "A senha não pôde ser alterada.", 
									icon: "error"
								})
								.then((resposta) => {
									$('#modalEdUs').modal('hide');
								});
							}
						}
					});
				}
			}

			$("#editaSU")[0].reset();
		});
	});

	$('#modalExUs').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget); // Button that triggered the modal
		var id = button.data('id'); // Extract info from data-* attributes
		var nome = button.data('nome'); // Extract info from data-* attributes
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this);
		modal.find('.modal-title').text('Excluir usuário!');
		modal.find('.texto-confirmacao').text('Tem certeza que deseja excluir '+nome+'?');

		$("#excluirSU").on("click", function(){
			$.ajax({
				url: 'http://localhost/gcc/painel/adminExcluiU',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == 1){
						swal({
							title: "Parabéns!", 
							text: "Usuário excluído com sucesso!", 
							icon: "success"
						})
						.then((resposta) => {
							$('#modalExUs').modal('hide');
							window.location.reload();
						});
					}else{
						swal({
							title: "Erro!", 
							text: "Usuário não pôde ser excluído.", 
							icon: "error"
						})
						.then((resposta) => {
							$('#modalExUs').modal('hide');
						});
					}
				}
			});
		});
	});

	$('#addPF').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget); // Button that triggered the modal
		var modal = $(this);
		modal.find('.modal-title').text('Adicionar Pergunta Frequente');

		$("#add").on("click", function(){
			var pergunta = $("#pergunta").val();
			var resposta = $("#resposta").val();

			if(pergunta == '' && resposta == ''){
				swal({
					title: "Atenção!", 
					text: "Os campos não podem estar vazios.", 
					icon: "warning"
				})
				.then((resposta) => {
					$('#addPF').modal('hide');
				});
			}else{
				$.ajax({
					url: 'http://localhost/gcc/painel/addFaqs',
					type: 'POST',
					data: {pergunta:pergunta, resposta:resposta},
					success: function(dados){
						if(dados == "1"){
							swal({
								title: "Parabéns!", 
								text: "Pergunta Frequente adicionada com sucesso.", 
								icon: "success"
							})
							.then((atualizou) => {
								$('#addPF').modal('hide');
								window.location.reload();
							});
						}else{
							swal({
								title: "Erro!",
								text: "Pergunta Frequente não pôde ser adicionada.", 
								icon: "error"
							})
							.then((resposta) => {
								$('#addPF').modal('hide');
							});
						}
					}
				});
			}

		  	$("#adcPF")[0].reset();
		});
	});

	$("#voltaAoInicio").click(function(){
		window.location.href="http://localhost/gcc";
	});
	
	var SPMaskBehavior = function (val) {
	  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	spOptions = {
	  onKeyPress: function(val, e, field, options) {
	      field.mask(SPMaskBehavior.apply({}, arguments), options);
	    }
	};

	$('#telefone').mask(SPMaskBehavior, spOptions);
});