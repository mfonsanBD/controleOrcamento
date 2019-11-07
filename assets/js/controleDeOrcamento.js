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
	$('#addU').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var nome = button.data('nome');
		var modal = $(this);

		modal.find('.modal-title').text('Adicionar Usuário');

		$("#adicionarUsuario").on("click", function(e){
			e.preventDefault();
			var nome 		= $("#nomeu").val();
			var email 		= $("#emailu").val();
			var senha 		= $("#senhau").val();
			var csenha 		= $("#csenhau").val();

			if(nome == ''){
				swal({
					title: "Aviso!", 
					text: "O campo NOME COMPLETO é obrigatório.", 
					icon: "warning"
				});
			}
			else if(!isNaN(nome)){
				swal({
					title: "Aviso!", 
					text: "O campo NOME COMPLETO não permite números.",
					icon: "warning"
				});
			}
			else if(nome.length < 3){
				swal({
					title: "Aviso!", 
					text: "O campo NOME COMPLETO deve conter pelo menos 3 caracteres.",
					icon: "warning"
				});
			}
			else if(email == ''){
				swal({
					title: "Aviso!", 
					text: "O campo E-MAIL é obrigatório.", 
					icon: "warning"
				});
			}
			else if(!emailValido(email)){
				swal({
					title: "Aviso!", 
					text: "Digite um e-mail válido.", 
					icon: "warning"
				});
			}
			else if(senha == ''){
				swal({
					title: "Aviso!", 
					text: "O campo SENHA é obrigatório.", 
					icon: "warning"
				});
			}
			else if(csenha == ''){
				swal({
					title: "Aviso!", 
					text: "O campo COMFIRMAR SENHA é obrigatório.", 
					icon: "warning"
				});
			}
			else if(csenha != senha){
				swal({
					title: "Aviso!", 
					text: "As senhas não coincidem.", 
					icon: "warning"
				});
			}else{
				// alert(nome+' - '+email+' - '+senha+' - '+csenha);
				$.ajax({
					url: 'http://localhost/gcc/painel/adminAddU/',
					type: 'POST',
					data: {nome:nome, email:email, senha:senha},
					success: function(dados){
						if(dados == 1){
							swal({
								title: "Parabéns!", 
								text: "Usuário adicionado com sucesso!", 
								icon: "success"
							})
							.then((resposta) => {
								$('#modalEdUs').modal('hide');
								window.location.reload();
							});
						}else{
							swal({
								title: "Erro!", 
								text: "O usuário não pôde ser adicionado.", 
								icon: "error"
							})
							.then((resposta) => {
								$('#modalEdUs').modal('hide');
							});
						};
					}
				});

				$("#adicionaUsuario")[0].reset();
			}

			function emailValido($email){
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				return emailReg.test($email);
			}
		});
		$("#cancela").on("click", function(){
			$("#adicionaUsuario")[0].reset();
		});
	});
	$('#modalEdUs').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var nome = button.data('nome');
		var modal = $(this);

		modal.find('.modal-title').text('Editar a senha de: '+nome);

		$("#salvarAlteracoes").on("click", function(){
		  	var novaSenha = $("#nsenha").val();
		  	var cNovaSenha = $("#cnsenha").val();

			if(novaSenha == '' && cNovaSenha == ''){
				swal({
					title: "Aviso!", 
					text: "Os campos não podem estar vazios.", 
					icon: "warning"
				});
			}else{
				if(novaSenha != cNovaSenha){
					swal({
						title: "Aviso!", 
						text: "As senhas não coincidem!", 
						icon: "warning"
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
							$("#editaSU")[0].reset();
						}
					});
				}
			}
		});
	});
	$('#modalExUs').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var nome = button.data('nome');
		var modal = $(this);

		modal.find('.modal-title').text('Excluir usuário!');
		modal.find('.texto-confirmacao').html("Tem certeza que deseja excluir <span class=text-danger>'"+nome+"'</span>?");

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

			if(pergunta == ''){
				swal({
					title: "Atenção!", 
					text: "O campo PERGUNTA não pode estar vazio.", 
					icon: "warning"
				});
			}else if(resposta == ''){
				swal({
					title: "Atenção!", 
					text: "O campo RESPOSTA não pode estar vazio.", 
					icon: "warning"
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
		  				$("#adcPF")[0].reset();
					}
				});
			}
		});
	});
	$('#modalEdPF').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var pergunta = button.data('pergunta');
		var resposta = button.data('resposta');
		var modal = $(this);
		
		modal.find('.modal-title').text('Editar: '+pergunta);

		$("#salvarAlteracoes").on("click", function(){
		  	var novapergunta = $("#novapergunta").val();
		  	var novaresposta = $("#novaresposta").val();

			if(novapergunta == '' && novaresposta != ''){
				novapergunta = pergunta;
			}else if(novapergunta != '' && novaresposta == ''){
				novaresposta = resposta;
			}else{
				swal({
					title: "Aviso!", 
					text: "Para editar é necessário que pelo menos um campo seja preenchido.", 
					icon: "warning"
				});
			}
			
			$.ajax({
				url: 'http://localhost/gcc/painel/adminEditaPF',
				type: 'POST',
				data: {pergunta:novapergunta, resposta:novaresposta, id:id},
				success: function(dados){
					if(dados == 1){
						swal({
							title: "Parabéns!", 
							text: "Senha alterada com sucesso!", 
							icon: "success"
						})
						.then((resposta) => {
							$('#modalEdPF').modal('hide');
							window.location.reload();
						});
					}else{
						swal({
							title: "Erro!", 
							text: "A senha não pôde ser alterada.", 
							icon: "error"
						})
						.then((resposta) => {
							$('#modalEdPF').modal('hide');
						});
					}
					$("#editaPF")[0].reset();
				}
			});
		});
	});
	$('#modalExPF').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var pergunta = button.data('pergunta');
		var modal = $(this);

		modal.find('.modal-title').text('Excluir Pergunta Frequente!');
		modal.find('.texto-confirmacao').html("Tem certeza que deseja excluir <span class=text-danger>'"+pergunta+"'</span>?");

		$("#cExcluirPF").on("click", function(){
			$.ajax({
				url: 'http://localhost/gcc/painel/adminExcluiPF',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == 1){
						swal({
							title: "Parabéns!", 
							text: "Pergunta excluída com sucesso!", 
							icon: "success"
						})
						.then((resposta) => {
							$('#modalExPF').modal('hide');
							window.location.reload();
						});
					}else{
						swal({
							title: "Erro!", 
							text: "A pergunta não pôde ser excluída.", 
							icon: "error"
						})
						.then((resposta) => {
							$('#modalExPF').modal('hide');
						});
					}
				}
			});
		});
	});
	$("#voltaAoInicio").click(function(){
		window.location.href="http://localhost/gcc/painel";
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