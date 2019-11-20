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
				title: "Atenção!",
				text: "Para redefinir sua senha é importante que nos envie seu e-mail cadastrado no sistema.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou enviar!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}else{
			$.ajax({
				url: 'http://localhost/gcc/login/verificaEmail/',
				type: 'POST',
				data: {email:email},
				success: function(dados){
					if(dados == "1"){
						$.ajax({
							url: 'http://localhost/gcc/login/redefinirSenha/',
							type: 'POST',
							data: {email:email},
							success: function(dados){
								if(dados == "1"){
									swal({
										title: "Parabéns!", 
										text: "Encaminhamos para seu e-mail um passo a passo do que você deverá fazer para redefinir sua senha.",
										icon: "success",
										buttons: {
											confirm: {
											    text: "Obrigado! 🙌🏼",
											    value: true,
											    visible: true,
											    className: "bg-success",
											    closeModal: true
											}
										}
									})
									.then((resposta) => {
										window.location.href = 'http://localhost/gcc';
									});
								}else{
									
								}
							}
						});
					}else{
						swal({
							title: "Atenção!",
							text: "O e-mail que você digitou não consta em nosso sistema.",
							icon: "warning",
							buttons: {
								confirm: {
								    text: "Ok, vou corrigir!",
								    value: true,
								    visible: true,
								    className: "bg-warning",
								    closeModal: true
								}
							}
						});
					}
				}
			});
		}
	});
	$("#codigoRedefinicao").on("submit", function(e){
		e.preventDefault();
		var codigo 	= $("#codigo").val();
		var hash 	= $("#hash").val();

		if(codigo == ""){
			swal({
				title: "Atenção!",
				text: "Para redefinir sua senha, digite o código enviado por e-mail.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou digitar!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}else{
			$.ajax({
				url: 'http://localhost/gcc/login/verificaCodigo/',
				type: 'POST',
				data: {codigo:codigo, hash:hash},
				success: function(dados){
					if(dados == "1"){
						$("#codigos").hide();
						$("#novasenha").show();
					}else{
						swal({
							title: "Atenção!",
							text: "O código que você digitou não consta em nosso sistema.",
							icon: "warning",
							buttons: {
								confirm: {
								    text: "Ok, vou corrigir!",
								    value: true,
								    visible: true,
								    className: "bg-warning",
								    closeModal: true
								}
							}
						});
					}
				}
			});
		}
	});
	$("#camposNovaSenha").on("submit", function(event){
		event.preventDefault();
		var nova 		= $('#nsenha').val();
		var cnova 		= $('#cnsenha').val();
		var hash		= $('#hash').val();

		if(nova != '' && cnova != ''){
			if(nova == cnova){
				$.ajax({
					url: 'http://localhost/gcc/login/redefinir',
					type: 'POST',
					data: {senha:nova, hash:hash},
					success: function(senha){
						if(senha == "1"){
							swal({
								title: "Parabéns!", 
								text: "Senha redefinida com sucesso.",
								icon: "success",
								buttons: {
									confirm: {
									    text: "Obrigado! 🙌🏼",
									    value: true,
									    visible: true,
									    className: "bg-success",
									    closeModal: true
									}
								}
							})
							.then((resposta) => {
								window.location.href = 'http://localhost/gcc/';
							});
						}
					}
				});
			}else{
				swal({
					title: "Atenção!",
					text: "As NOVAS SENHAS não coincidem.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
		}else{
			swal({
				title: "Atenção!",
				text: "Para redefinir sua senha, é necessário preencher os campos.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou preencher!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
	});

	//Controle do administrador sobre: Usuário
	$('#addU').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var nome = button.data('nome');
		var modal = $(this);

		modal.find('.modal-title').text('Adicionar Usuário');

		$("#adicionarUsuario").on("click", function(e){
			e.preventDefault();
			var nome 		= $("#nomeu").val();
			var sobrenome 	= $("#sobrenomeu").val();
			var email 		= $("#emailu").val();
			var senha 		= $("#senhau").val();
			var csenha 		= $("#csenhau").val();

			if(nome == ''){
				swal({
					title: "Atenção!",
					text: "O campo NOME é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(!isNaN(nome)){
				swal({
					title: "Atenção!",
					text: "O campo NOME não permite números.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(nome.length < 3){
				swal({
					title: "Atenção!",
					text: "O campo NOME deve conter pelo menos 3 caracteres.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(sobrenome == ''){
				swal({
					title: "Atenção!",
					text: "O campo SOBRENOME é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(!isNaN(sobrenome)){
				swal({
					title: "Atenção!",
					text: "O campo SOBRENOME não permite números.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(sobrenome.length < 3){
				swal({
					title: "Atenção!",
					text: "O campo SOBRENOME deve conter pelo menos 3 caracteres.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(email == ''){
				swal({
					title: "Atenção!",
					text: "O campo E-MAIL é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(!emailValido(email)){
				swal({
					title: "Atenção!",
					text: "Digite um e-mail válido.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(senha == ''){
				swal({
					title: "Atenção!",
					text: "O campo SENHA é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(csenha == ''){
				swal({
					title: "Atenção!",
					text: "O campo COMFIRMAR SENHA é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(csenha != senha){
				swal({
					title: "Atenção!",
					text: "As senhas não coincidem.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}else{
				$.ajax({
					url: 'http://localhost/gcc/login/verificaEmail/',
					type: 'POST',
					data: {email:email},
					success: function(dados){
						if(dados == "1"){
							swal({
								title: "Atenção!",
								text: "O e-mail que você digitou já consta em nosso sistema.",
								icon: "warning",
								buttons: {
									confirm: {
									    text: "Ok, vou corrigir!",
									    value: true,
									    visible: true,
									    className: "bg-warning",
									    closeModal: true
									}
								}
							});
						}else{
							$.ajax({
								url: 'http://localhost/gcc/usuario/adminAddU/',
								type: 'POST',
								data: {nome:nome, sobrenome:sobrenome, email:email, senha:senha},
								success: function(dados){
									if(dados == 1){
										swal({
											title: "Parabéns!", 
											text: "Usuário adicionado com sucesso!", 
											icon: "success",
											buttons: {
												confirm: {
												    text: "Obrigado! 🙌🏼",
												    value: true,
												    visible: true,
												    className: "bg-success",
												    closeModal: true
												}
											}
										})
										.then((resposta) => {
											$('#modalEdUs').modal('hide');
											window.location.reload();
										});
									}else{
										swal({
											title: "Erro!", 
											text: "O usuário não pôde ser adicionado.", 
											icon: "error",
											buttons: {
												confirm: {
												    text: "Ok",
												    value: true,
												    visible: true,
												    className: "bg-danger",
												    closeModal: true
												}
											}
										})
										.then((resposta) => {
											$('#modalEdUs').modal('hide');
										});
									};
								}
							});
							$("#adicionaUsuario")[0].reset();
						}
					}
				});
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
					title: "Atenção!",
					text: "Os campos não podem estar vazios.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}else{
				if(novaSenha != cNovaSenha){
					swal({
						title: "Atenção!",
						text: "As senhas não coincidem.",
						icon: "warning",
						buttons: {
							confirm: {
							    text: "Ok, vou corrigir!",
							    value: true,
							    visible: true,
							    className: "bg-warning",
							    closeModal: true
							}
						}
					});
				}else{
					$.ajax({
						url: 'http://localhost/gcc/usuario/adminEdita',
						type: 'POST',
						data: {senha:novaSenha, id:id},
						success: function(dados){
							if(dados == 1){
								swal({
									title: "Parabéns!", 
									text: "Senha alterada com sucesso!", 
									icon: "success",
									buttons: {
										confirm: {
										    text: "Obrigado! 🙌🏼",
										    value: true,
										    visible: true,
										    className: "bg-success",
										    closeModal: true
										}
									}
								})
								.then((resposta) => {
									$('#modalEdUs').modal('hide');
								});
							}else{
								swal({
									title: "Erro!", 
									text: "A senha não pôde ser alterada.", 
									icon: "error",
									buttons: {
										confirm: {
										    text: "Ok",
										    value: true,
										    visible: true,
										    className: "bg-danger",
										    closeModal: true
										}
									}
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
				url: 'http://localhost/gcc/usuario/adminExcluiU',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == 1){
						swal({
							title: "Parabéns!", 
							text: "Usuário excluído com sucesso!", 
							icon: "success",
							buttons: {
								confirm: {
								    text: "Obrigado! 🙌🏼",
								    value: true,
								    visible: true,
								    className: "bg-success",
								    closeModal: true
								}
							}
						})
						.then((resposta) => {
							$('#modalExUs').modal('hide');
							window.location.reload();
						});
					}else{
						swal({
							title: "Erro!", 
							text: "Usuário não pôde ser excluído.", 
							icon: "error",
							buttons: {
								confirm: {
								    text: "Ok",
								    value: true,
								    visible: true,
								    className: "bg-danger",
								    closeModal: true
								}
							}
						})
						.then((resposta) => {
							$('#modalExUs').modal('hide');
						});
					}
				}
			});
		});
	});

	//Controle do administrador sobre: Perguntas Frequentes
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
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}else if(resposta == ''){
				swal({
					title: "Atenção!", 
					text: "O campo RESPOSTA não pode estar vazio.", 
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}else{
				$.ajax({
					url: 'http://localhost/gcc/faqs/addFaqs',
					type: 'POST',
					data: {pergunta:pergunta, resposta:resposta},
					success: function(dados){
						if(dados == "1"){
							swal({
								title: "Parabéns!", 
								text: "Pergunta Frequente adicionada com sucesso.", 
								icon: "success",
								buttons: {
									confirm: {
									    text: "Obrigado! 🙌🏼",
									    value: true,
									    visible: true,
									    className: "bg-success",
									    closeModal: true
									}
								}
							})
							.then((atualizou) => {
								$('#addPF').modal('hide');
								window.location.reload();
							});
						}else{
							swal({
								title: "Erro!",
								text: "Pergunta Frequente não pôde ser adicionada.", 
								icon: "error",
								buttons: {
									confirm: {
									    text: "Ok",
									    value: true,
									    visible: true,
									    className: "bg-danger",
									    closeModal: true
									}
								}
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

			if(novapergunta == '' && novaresposta == ''){
				swal({
					title: "Aviso!", 
					text: "Para editar é necessário que pelo menos um campo seja preenchido.", 
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou preencher!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}else{
				if(novapergunta == '' && novaresposta != ''){
					novapergunta = pergunta;
				}else if(novapergunta != '' && novaresposta == ''){
					novaresposta = resposta;
				}
				$.ajax({
					url: 'http://localhost/gcc/faqs/adminEditaPF',
					type: 'POST',
					data: {pergunta:novapergunta, resposta:novaresposta, id:id},
					success: function(dados){
						if(dados == 1){
							swal({
								title: "Parabéns!", 
								text: "Pergunta Frequente alterada com sucesso!", 
								icon: "success",
								buttons: {
									confirm: {
									    text: "Obrigado! 🙌🏼",
									    value: true,
									    visible: true,
									    className: "bg-success",
									    closeModal: true
									}
								}
							})
							.then((resposta) => {
								$('#modalEdPF').modal('hide');
								window.location.reload();
							});
						}else{
							swal({
								title: "Erro!", 
								text: "A pergunta frequente não pôde ser alterada.", 
								icon: "error",
								buttons: {
									confirm: {
									    text: "Ok",
									    value: true,
									    visible: true,
									    className: "bg-danger",
									    closeModal: true
									}
								}
							})
							.then((resposta) => {
								$('#modalEdPF').modal('hide');
							});
						}
						$("#editaPF")[0].reset();
					}
				});
			}
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
				url: 'http://localhost/gcc/faqs/adminExcluiPF',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == 1){
						swal({
							title: "Parabéns!", 
							text: "Pergunta Frequente excluída com sucesso!", 
							icon: "success",
							buttons: {
								confirm: {
								    text: "Obrigado! 🙌🏼",
								    value: true,
								    visible: true,
								    className: "bg-success",
								    closeModal: true
								}
							}
						})
						.then((resposta) => {
							$('#modalExPF').modal('hide');
							window.location.reload();
						});
					}else{
						swal({
							title: "Erro!", 
							text: "A pergunta frequente não pôde ser excluída.", 
							icon: "error",
							buttons: {
								confirm: {
								    text: "Ok",
								    value: true,
								    visible: true,
								    className: "bg-danger",
								    closeModal: true
								}
							}
						})
						.then((resposta) => {
							$('#modalExPF').modal('hide');
						});
					}
				}
			});
		});
	});

	//Controle do administrador sobre: Empresa
	$('#addEmpresa').on('show.bs.modal', function(){
		var button = $(event.relatedTarget);
		var modal = $(this);
		modal.find('.modal-title').text('Adicionar Empresa');

		$("#adicionaEmpresa").on("submit", function(e){
			e.preventDefault();
			var nome 		= $("#nomeu").val();
			var sobrenome 	= $("#sobrenomeu").val();
			var email 		= $("#emailu").val();
			var senha 		= $("#senhau").val();
			var csenha 		= $("#csenhau").val();

			if(nome == ''){
				swal({
					title: "Atenção!",
					text: "O campo NOME é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(!isNaN(nome)){
				swal({
					title: "Atenção!",
					text: "O campo NOME não permite números.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(nome.length < 3){
				swal({
					title: "Atenção!",
					text: "O campo NOME deve conter pelo menos 3 caracteres.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(sobrenome == ''){
				swal({
					title: "Atenção!",
					text: "O campo SOBRENOME é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(!isNaN(sobrenome)){
				swal({
					title: "Atenção!",
					text: "O campo SOBRENOME não permite números.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(sobrenome.length < 3){
				swal({
					title: "Atenção!",
					text: "O campo SOBRENOME deve conter pelo menos 3 caracteres.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(email == ''){
				swal({
					title: "Atenção!",
					text: "O campo E-MAIL é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(!emailValido(email)){
				swal({
					title: "Atenção!",
					text: "Digite um e-mail válido.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(senha == ''){
				swal({
					title: "Atenção!",
					text: "O campo SENHA é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(csenha == ''){
				swal({
					title: "Atenção!",
					text: "O campo COMFIRMAR SENHA é obrigatório.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(csenha != senha){
				swal({
					title: "Atenção!",
					text: "As senhas não coincidem.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}else{
				$.ajax({
					url: 'http://localhost/gcc/login/verificaEmail/',
					type: 'POST',
					data: {email:email},
					success: function(dados){
						if(dados == "1"){
							swal({
								title: "Atenção!",
								text: "O e-mail que você digitou já consta em nosso sistema.",
								icon: "warning",
								buttons: {
									confirm: {
									    text: "Ok, vou corrigir!",
									    value: true,
									    visible: true,
									    className: "bg-warning",
									    closeModal: true
									}
								}
							});
						}else{
							$.ajax({
								url: 'http://localhost/gcc/usuario/adminAddU/',
								type: 'POST',
								data: {nome:nome, sobrenome:sobrenome, email:email, senha:senha},
								success: function(dados){
									if(dados == 1){
										swal({
											title: "Parabéns!", 
											text: "Usuário adicionado com sucesso!", 
											icon: "success",
											buttons: {
												confirm: {
												    text: "Obrigado! 🙌🏼",
												    value: true,
												    visible: true,
												    className: "bg-success",
												    closeModal: true
												}
											}
										})
										.then((resposta) => {
											$('#modalEdUs').modal('hide');
											window.location.reload();
										});
									}else{
										swal({
											title: "Erro!", 
											text: "O usuário não pôde ser adicionado.", 
											icon: "error",
											buttons: {
												confirm: {
												    text: "Ok",
												    value: true,
												    visible: true,
												    className: "bg-danger",
												    closeModal: true
												}
											}
										})
										.then((resposta) => {
											$('#modalEdUs').modal('hide');
										});
									};
								}
							});
							$("#adicionaUsuario")[0].reset();
						}
					}
				});
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
	$("#adicionaEmpresa").on("submit", function(event){
		event.preventDefault();
		var nomeEmpresa 		= $("#nomeEmpresa").val();
		var emailEmpresa 		= $("#emailEmpresa").val();
		var siteEmpresa 		= $("#siteEmpresa").val();
		var telefoneEmpresa 	= $("#telefoneEmpresa").val();
		var whatsappEmpresa 	= $("#whatsappEmpresa").val();
		var idGerente 			= $("#gerente option:selected").val();

		if(nomeEmpresa == ''){
			swal({
				title: "Atenção!",
				text: "O campo NOME DA EMPRESA é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(nomeEmpresa.length < 3){
			swal({
				title: "Atenção!",
				text: "O campo NOME DA EMPRESA deve conter pelo menos 3 caracteres.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(emailEmpresa == ''){
			swal({
				title: "Atenção!",
				text: "O campo E-MAIL é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(siteEmpresa == ''){
			swal({
				title: "Atenção!",
				text: "O campo SITE é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(!urlValido(siteEmpresa)){
			swal({
				title: "Atenção!",
				text: "Digite um SITE válido.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(telefoneEmpresa == ''){
			swal({
				title: "Atenção!",
				text: "O campo TELEFONE é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(whatsappEmpresa == ''){
			swal({
				title: "Atenção!",
				text: "O campo WHATSAPP é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(idGerente == ''){
			swal({
				title: "Atenção!",
				text: "O campo GERENTE é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else{
			$.ajax({
				url: 'http://localhost/gcc/login/verificaEmail/',
				type: 'POST',
				data: {email:email},
				success: function(dados){
					if(dados == "1"){
						swal({
							title: "Atenção!",
							text: "O e-mail que você digitou já consta em nosso sistema.",
							icon: "warning",
							buttons: {
								confirm: {
								    text: "Ok, vou corrigir!",
								    value: true,
								    visible: true,
								    className: "bg-warning",
								    closeModal: true
								}
							}
						});
					}else{
						$.ajax({
							url: 'http://localhost/gcc/usuario/adminAddU/',
							type: 'POST',
							data: {nome:nome, sobrenome:sobrenome, email:email, senha:senha},
							success: function(dados){
								if(dados == 1){
									swal({
										title: "Parabéns!", 
										text: "Usuário adicionado com sucesso!", 
										icon: "success",
										buttons: {
											confirm: {
											    text: "Obrigado! 🙌🏼",
											    value: true,
											    visible: true,
											    className: "bg-success",
											    closeModal: true
											}
										}
									})
									.then((resposta) => {
										$('#modalEdUs').modal('hide');
										window.location.reload();
									});
								}else{
									swal({
										title: "Erro!", 
										text: "O usuário não pôde ser adicionado.", 
										icon: "error",
										buttons: {
											confirm: {
											    text: "Ok",
											    value: true,
											    visible: true,
											    className: "bg-danger",
											    closeModal: true
											}
										}
									})
									.then((resposta) => {
										$('#modalEdUs').modal('hide');
									});
								};
							}
						});
						$("#adicionaUsuario")[0].reset();
					}
				}
			});
		}
		function urlValido($siteEmpresa) {
			var urlReg = /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
			return urlReg.test($siteEmpresa);
		}
	});
	$('#wpp').click(function(){
		var classe = $('#wpp').attr('class');
		if(classe == 'btn btn-sm pt-0 pb-0 text-white bg-secondary'){
			$('#wpp').removeClass('bg-secondary');
			$('#wpp').addClass('bg-success');
		}else{
			$('#wpp').removeClass('bg-success');
			$('#wpp').addClass('bg-secondary');
		}
		$("#whatsapp").toggle();
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
	$('.telefone').mask(SPMaskBehavior, spOptions);

	$image_crop = $('#image_demo').croppie({
		enableExif: true,
		viewport:{
			width: 300,
			height: 300,
			type: 'circle'
		},
		boundary:{
			width: 300,
			height: 300
		}
	});
	$('#foto').on('change', function(){
		var reader = new FileReader();
		reader.onload = function(event){
			$image_crop.croppie('bind', {
				url: event.target.result
			});
		}
		reader.readAsDataURL(this.files[0]);
		$('#modalCorteImagem').modal('show');
	});
	$('#cortarImagem').click(function(event){
		$image_crop.croppie('result', {
			type: 'canvas',
			size: 'viewport'
		}).then(function(resposta){
			$.ajax({
				url: 'http://localhost/gcc/configuracoes/alteraImagem',
				type: 'POST',
				data: {"foto": resposta},
				success: function(dados){
					$('#modalCorteImagem').modal('hide');
					if(dados == "1"){
						swal({
							title: "Parabéns!", 
							text: "Imagem adicionada com sucesso.", 
							icon: "success",
							buttons: {
								confirm: {
								    text: "Obrigado! 🙌🏼",
								    value: true,
								    visible: true,
								    className: "bg-success",
								    closeModal: true
								}
							}
						})
						.then((ok) => {
							window.location.reload();
						});
					}else if(dados == "2"){
						swal({
							title: "Parabéns!", 
							text: "Imagem alterada com sucesso.", 
							icon: "success",
							buttons: {
								confirm: {
								    text: "Obrigado! 🙌🏼",
								    value: true,
								    visible: true,
								    className: "bg-success",
								    closeModal: true
								}
							}
						})
						.then((ok) => {
							window.location.reload();
						});
					}else{
						swal({
							title: "Erro!", 
							text: "A imagem não pôde ser alterada.", 
							icon: "error",
							buttons: {
								confirm: {
								    text: "Ok",
								    value: true,
								    visible: true,
								    className: "bg-danger",
								    closeModal: true
								}
							}
						});
					}
				}
			});
		})
	});
	$('#configInfos').click(function(event){
		event.preventDefault();

		var nome 		= $('#nome').val();
		var sobrenome 	= $('#sobrenome').val();
		var email 		= $('#email').val();

		if(nome != '' && sobrenome != '' && email != ''){
			if(nome.length < 3){
				swal({
					title: "Atenção!",
					text: "O campo NOME deve conter pelo menos 3 caracteres.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(!isNaN(nome)){
				swal({
					title: "Atenção!",
					text: "O campo NOME não permite números.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(sobrenome.length < 3){
				swal({
					title: "Atenção!",
					text: "O campo SOBRENOME deve conter pelo menos 3 caracteres.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(!isNaN(sobrenome)){
				swal({
					title: "Atenção!",
					text: "O campo SOBRENOME não permite números.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else if(!emailValido(email)){
				swal({
					title: "Atenção!",
					text: "Digite um E-MAIL válido.",
					icon: "warning",
					buttons: {
						confirm: {
						    text: "Ok, vou corrigir!",
						    value: true,
						    visible: true,
						    className: "bg-warning",
						    closeModal: true
						}
					}
				});
			}
			else{
				$.ajax({
					url: 'http://localhost/gcc/configuracoes/verificaCampos',
					dataType: 'json',
					success: function(dados){
						if(dados.nome != nome && dados.sobrenome != sobrenome && dados.email != email){
							$.ajax({
								url: 'http://localhost/gcc/configuracoes/alteraDados',
								type: 'POST',
								data: {nome:nome, sobrenome:sobrenome, email:email},
								success: function(dados){
									if(dados == "1"){
										swal({
											title: "Parabéns!", 
											text: "Dados alterados com sucesso.",
											icon: "success",
											buttons: {
												confirm: {
												    text: "Obrigado! 🙌🏼",
												    value: true,
												    visible: true,
												    className: "bg-success",
												    closeModal: true
												}
											}
										})
										.then((resposta) => {
											window.location.reload();
										});
									}
								}
							});
						}else{
							if(dados.nome == nome && dados.sobrenome == sobrenome && dados.email == email){
								swal({
									title: "Atenção!",
									text: "Todas as informações são atuais.",
									icon: "warning",
									buttons: {
										confirm: {
										    text: "Ok, obrigado!",
										    value: true,
										    visible: true,
										    className: "bg-warning",
										    closeModal: true
										}
									}
								});
							}else{
								if(dados.nome != nome && dados.sobrenome == sobrenome && dados.email == email){
									$.ajax({
										url: 'http://localhost/gcc/configuracoes/alteraNome',
										type: 'POST',
										data: {nome:nome},
										success: function(nome){
											if(nome == "1"){
												swal({
													title: "Parabéns!", 
													text: "Nome alterado com sucesso.",
													icon: "success",
													buttons: {
														confirm: {
														    text: "Obrigado! 🙌🏼",
														    value: true,
														    visible: true,
														    className: "bg-success",
														    closeModal: true
														}
													}
												})
												.then((resposta) => {
													window.location.reload();
												});
											}
										}
									});
								}
								else if(dados.nome == nome && dados.sobrenome != sobrenome && dados.email == email){
									$.ajax({
										url: 'http://localhost/gcc/configuracoes/alteraSobrenome',
										type: 'POST',
										data: {sobrenome:sobrenome},
										success: function(sobrenome){
											if(sobrenome == "1"){
												swal({
													title: "Parabéns!", 
													text: "Sobrenome alterado com sucesso.",
													icon: "success",
													buttons: {
														confirm: {
														    text: "Obrigado! 🙌🏼",
														    value: true,
														    visible: true,
														    className: "bg-success",
														    closeModal: true
														}
													}
												})
												.then((resposta) => {
													window.location.reload();
												});
											}
										}
									});
								}

								else if(dados.nome == nome && dados.sobrenome == sobrenome && dados.email != email){
									$.ajax({
										url: 'http://localhost/gcc/configuracoes/alteraEmail',
										type: 'POST',
										data: {email:email},
										success: function(email){
											if(email == "1"){
												swal({
													title: "Parabéns!", 
													text: "E-mail alterado com sucesso. Ele só passará a valer a partir do próximo login.",
													icon: "success",
													buttons: {
														confirm: {
														    text: "Obrigado! 🙌🏼",
														    value: true,
														    visible: true,
														    className: "bg-success",
														    closeModal: true
														}
													}
												})
												.then((resposta) => {
													window.location.reload();
												});
											}
										}
									});
								}
								else if(dados.nome != nome && dados.sobrenome != sobrenome && dados.email == email){

									$.ajax({
										url: 'http://localhost/gcc/configuracoes/alteraNomeSobrenome',
										type: 'POST',
										data: {nome:nome, sobrenome:sobrenome},
										success: function(dados){
											if(dados == "1"){
												swal({
													title: "Parabéns!", 
													text: "Nome e Sobrenome alterados com sucesso.",
													icon: "success",
													buttons: {
														confirm: {
														    text: "Obrigado! 🙌🏼",
														    value: true,
														    visible: true,
														    className: "bg-success",
														    closeModal: true
														}
													}
												})
												.then((resposta) => {
													window.location.reload();
												});
											}
										}
									});
								}
								else if(dados.nome != nome && dados.sobrenome == sobrenome && dados.email != email){
									$.ajax({
										url: 'http://localhost/gcc/configuracoes/alteraNomeEmail',
										type: 'POST',
										data: {nome:nome, email:email},
										success: function(dados){
											if(dados == "1"){
												swal({
													title: "Parabéns!", 
													text: "Nome e E-mail alterados com sucesso.",
													icon: "success",
													buttons: {
														confirm: {
														    text: "Obrigado! 🙌🏼",
														    value: true,
														    visible: true,
														    className: "bg-success",
														    closeModal: true
														}
													}
												})
												.then((resposta) => {
													window.location.reload();
												});
											}
										}
									});
								}else{
									$.ajax({
										url: 'http://localhost/gcc/configuracoes/alteraSobrenomeEmail',
										type: 'POST',
										data: {sobrenome:sobrenome, email:email},
										success: function(dados){
											if(dados == "1"){
												swal({
													title: "Parabéns!", 
													text: "Sobrenome e E-mail alterados com sucesso.",
													icon: "success",
													buttons: {
														confirm: {
														    text: "Obrigado! 🙌🏼",
														    value: true,
														    visible: true,
														    className: "bg-success",
														    closeModal: true
														}
													}
												})
												.then((resposta) => {
													window.location.reload();
												});
											}
										}
									});
								}
							}
						}
					}
				});
			}
		}else{
			swal({
				title: "Atenção!",
				text: "Todos os campos são obrigatórios.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}

		function emailValido($email){
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			return emailReg.test($email);
		}
	});
	$('#configSenha').click(function(event){
		event.preventDefault();

		var atual 		= $('#atual').val();
		var nova 		= $('#nova').val();
		var cnova 		= $('#cnova').val();

		if(atual != '' && nova != '' && cnova != ''){
			$.ajax({
				url: 'http://localhost/gcc/configuracoes/verificaSenhaAtual',
				type: 'POST',
				data: {senha:atual},
				success: function(senha){
					if(senha == "1"){
						if(nova == cnova){
							$.ajax({
								url: 'http://localhost/gcc/configuracoes/alteraSenha',
								type: 'POST',
								data: {senha:nova},
								success: function(senha){
									if(senha == "1"){
										swal({
											title: "Parabéns!", 
											text: "Senha alterada com sucesso.",
											icon: "success",
											buttons: {
												confirm: {
												    text: "Obrigado! 🙌🏼",
												    value: true,
												    visible: true,
												    className: "bg-success",
												    closeModal: true
												}
											}
										})
										.then((resposta) => {
											window.location.reload();
										});
									}else{
										swal({
											title: "Erro!", 
											text: "A senha não pôde ser alterada.",
											icon: "error",
											buttons: {
												confirm: {
												    text: "Ok",
												    value: true,
												    visible: true,
												    className: "bg-danger",
												    closeModal: true
												}
											}
										});
									}
								}
							});
						}else{
							swal({
								title: "Atenção!",
								text: "As NOVAS SENHAS não coincidem.",
								icon: "warning",
								buttons: {
									confirm: {
									    text: "Ok, vou corrigir!",
									    value: true,
									    visible: true,
									    className: "bg-warning",
									    closeModal: true
									}
								}
							});
						}
					}else{
						swal({
							title: "Atenção!",
							text: "Sua SENHA ATUAL está incorreta.",
							icon: "warning",
							buttons: {
								confirm: {
								    text: "Ok, vou corrigir!",
								    value: true,
								    visible: true,
								    className: "bg-warning",
								    closeModal: true
								}
							}
						});
					}
				}
			});
		}else{
			swal({
				title: "Atenção!",
				text: "Os campos de senha são obrigatórios.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok, vou corrigir!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
	});
});

//Controle de Empresas
function aceitaEmpresa(id){
	$.ajax({
		url: 'http://localhost/gcc/empresa/aceita',
		type: 'POST',
		data: {id:id},
		success: function(dados){
			if(dados == "1"){
				swal({
					title: "Parabéns!", 
					text: "Empresa aceita com sucesso.",
					icon: "success",
					buttons: {
						confirm: {
						    text: "Obrigado! 🙌🏼",
						    value: true,
						    visible: true,
						    className: "bg-success",
						    closeModal: true
						}
					}
				})
				.then((resposta) => {
					window.location.reload();
				});
			}else{
				swal({
					title: "Erro!", 
					text: "Empresa não pôde ser aceita.",
					icon: "error",
					buttons: {
						confirm: {
						    text: "Ok",
						    value: true,
						    visible: true,
						    className: "bg-danger",
						    closeModal: true
						}
					}
				});
			}
		}
	});
}
function excluiEmpresa(id){
	swal({
		title: "Atenção!",
		text: "Tem certeza que deseja excluir esta empresa?",
		icon: "warning",
		buttons: ["Não, cancelar.", "Sim, excluir."],
		dangerMode: true,
	})
	.then((deleta) => {
		if(deleta){
			$.ajax({
				url: 'http://localhost/gcc/empresa/exclui',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == "1"){
						swal({
							title: "Parabéns!", 
							text: "Empresa excluida com sucesso.",
							icon: "success",
							buttons: {
								confirm: {
								    text: "Obrigado! 🙌🏼",
								    value: true,
								    visible: true,
								    className: "bg-success",
								    closeModal: true
								}
							}
						})
						.then((resposta) => {
							window.location.reload();
						});
					}else{
						swal({
							title: "Erro!", 
							text: "Empresa não pôde ser excluida.",
							icon: "error",
							buttons: {
								confirm: {
								    text: "Ok",
								    value: true,
								    visible: true,
								    className: "bg-danger",
								    closeModal: true
								}
							}
						});
					}
				}
			});
		}
	});
}
function desativarEmpresa(id){
	swal({
		title: "Atenção!",
		text: "Tem certeza que deseja desativar esta empresa?",
		icon: "warning",
		buttons: {
			cancel: {
			    text: "Não, cancelar.",
			    value: false,
			    visible: true,
			    className: "",
			    closeModal: true,
			},
			confirm: {
			    text: "Sim, desativar.",
			    value: true,
			    visible: true,
			    className: "bg-warning",
			    closeModal: true
			}
		}
	})
	.then((desativa) => {
		if(desativa){
			$.ajax({
				url: 'http://localhost/gcc/empresa/desativar',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == "1"){
						swal({
							title: "Parabéns!",
							text: "Empresa desativada com sucesso.",
							icon: "success",
							buttons: {
								confirm: {
								    text: "Obrigado! 🙌🏼",
								    value: true,
								    visible: true,
								    className: "bg-success",
								    closeModal: true
								}
							}
						})
						.then((resposta) => {
							window.location.reload();
						});
					}else{
						swal({
							title: "Erro!",
							text: "Empresa não pôde ser desativada.",
							icon: "error",
							buttons: {
								confirm: {
								    text: "Ok",
								    value: true,
								    visible: true,
								    className: "bg-danger",
								    closeModal: true
								}
							}
						});
					}
				}
			});
		}else{

		}
	});
}
function reativarEmpresa(id){
	$.ajax({
		url: 'http://localhost/gcc/empresa/aceita',
		type: 'POST',
		data: {id:id},
		success: function(dados){
			if(dados == "1"){
				swal({
					title: "Parabéns!", 
					text: "Empresa reativada com sucesso.",
					icon: "success",
					buttons: {
						confirm: {
						    text: "Obrigado! 🙌🏼",
						    value: true,
						    visible: true,
						    className: "bg-success",
						    closeModal: true
						}
					}
				})
				.then((resposta) => {
					window.location.reload();
				});
			}else{
				swal({
					title: "Erro!", 
					text: "Empresa não pôde ser reativada.",
					icon: "error",
					buttons: {
						confirm: {
						    text: "Ok",
						    value: true,
						    visible: true,
						    className: "bg-danger",
						    closeModal: true
						}
					}
				});
			}
		}
	});
}