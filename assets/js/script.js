const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add('right-panel-active');
});

signInButton.addEventListener('click', () => {
    container.classList.remove('right-panel-active');
});

$(document).ready(function(){
	$("#cadastro").on("submit", function(e){
		e.preventDefault();

		if($("#nome").val() == ''){
			swal({
				title: "Atenção!",
				text: "O campo NOME é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(!isNaN($("#nome").val())){
			swal({
				title: "Atenção!",
				text: "O campo NOME não permite números.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if($("#nome").val().length < 3){
			swal({
				title: "Atenção!",
				text: "O campo NOME deve conter pelo menos 3 caracteres.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if($("#sobrenome").val() == ''){
			swal({
				title: "Atenção!",
				text: "O campo SOBRENOME é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(!isNaN($("#sobrenome").val())){
			swal({
				title: "Atenção!",
				text: "O campo SOBRENOME não permite números.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if($("#sobrenome").val().length < 3){
			swal({
				title: "Atenção!",
				text: "O campo SOBRENOME deve conter pelo menos 3 caracteres.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if($("#email").val() == ''){
			swal({
				title: "Atenção!",
				text: "O campo E-MAIL é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if(!emailValido($("#email").val())){
			swal({
				title: "Atenção!",
				text: "Digite um E-MAIL válido.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if($("#senha").val() == ''){
			swal({
				title: "Atenção!",
				text: "O campo SENHA é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
			$("#forcaSenha").html('');
		}
		else if(validarForcaSenha() < 70){
			swal({
				title: "Atenção!",
				text: "Para a segurança das suas informações, sua senha precisa ser mais forte.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if($("#cSenha").val() == ''){
			swal({
				title: "Atenção!",
				text: "O campo CONFIRMAR SENHA é obrigatório.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}
		else if($("#cSenha").val() != $("#senha").val()){
			swal({
				title: "Atenção!",
				text: "As senhas não coincidem.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}else{
			var nome 		= $("#nome").val();
			var sobrenome 	= $("#sobrenome").val();
			var email 		= $("#email").val();
			var senha 		= $("#senha").val();

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
							url: 'http://localhost/gcc/login/cadastro/',
							type: 'POST',
							data: {nome:nome, sobrenome:sobrenome, email:email, senha:senha},
							success: function(dados){
								swal({
									title: "Parabéns!", 
									text: "Cadastro realizado com sucesso.",
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
								});
								$("#cadastro")[0].reset();
								
								$("#oito").removeClass("text-danger");
								$("#oito").removeClass("text-warning");
								$("#oito").removeClass("text-success");
								$("#oito").addClass("text-black-50");

								$("#minuscula").removeClass("text-danger");
								$("#minuscula").removeClass("text-warning");
								$("#minuscula").removeClass("text-success");
								$("#minuscula").addClass("text-black-50");

								$("#numeros").removeClass("text-danger");
								$("#numeros").removeClass("text-warning");
								$("#numeros").removeClass("text-success");
								$("#numeros").addClass("text-black-50");

								$("#maiuscula").removeClass("text-danger");
								$("#maiuscula").removeClass("text-warning");
								$("#maiuscula").removeClass("text-success");
								$("#maiuscula").addClass("text-black-50");

								$("#especiais").removeClass("text-danger");
								$("#especiais").removeClass("text-warning");
								$("#especiais").removeClass("text-success");
								$("#especiais").addClass("text-black-50");

								$("#forcaSenha").html('');
							}
						});
					}
				}
			});
		}

		function emailValido($email){
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			return emailReg.test($email);
		}
	});

	$("#login").on("submit", function(e){
		e.preventDefault();

		var email = $.trim($("#lemail").val());
		var senha = $.trim($("#lsenha").val());

		if(email.length == '' || senha == ''){
			swal({
				title: "Atenção!",
				text: "Para acessar sua conta digite seu e-mail e senha.",
				icon: "warning",
				buttons: {
					confirm: {
					    text: "Ok!",
					    value: true,
					    visible: true,
					    className: "bg-warning",
					    closeModal: true
					}
				}
			});
		}else{
			$.ajax({
				url: 'http://localhost/gcc/login/logar',
				type: 'POST',
				data: {email:email, senha:senha},
				beforeSend: function() {
			        $("#carregando").show();
			    },
				success: function(dados){
					if(dados == 1){
						swal({
							title: "Parabéns!", 
							text: "Login realizado com sucesso.",
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
							window.location.href = 'http://localhost/gcc/painel/';
						});
					}else if (dados == 2){
						swal({
							title: "Atenção!",
							text: "Usuário ainda não confirmado. Verifique seu e-mail para confirmar seu cadastro.",
							icon: "warning",
							buttons: {
								confirm: {
								    text: "Ok, vou confirmar!",
								    value: true,
								    visible: true,
								    className: "bg-warning",
								    closeModal: true
								}
							}
						});
					}else{
						swal({
							title: "Atenção!",
							text: "E-mail e/ou senha inválidos.",
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
});

function validarForcaSenha(){
	var senha = $("#senha").val();
	var forca = 0;

	if(senha.length == 0){
		$("#forcaSenha").hide();
	}else{
		$("#forcaSenha").show();
	}
	
	if((senha.length >= 4) && (senha.length < 8)){
		forca += 10;
		$("#oito").removeClass("text-black-50");
		$("#oito").addClass("text-warning");
	}else if(senha.length >= 8){
		forca += 40;
		$("#oito").removeClass("text-warning");
		$("#oito").addClass("text-success");
	}else{
		$("#oito").removeClass("text-danger");
		$("#oito").removeClass("text-warning");
		$("#oito").removeClass("text-success");
		$("#oito").addClass("text-black-50");
	}

	if((senha.length > 0) && (senha.match(/[a-z]+/))){
		forca += 15;
		$("#minuscula").removeClass("text-black-50");
		$("#minuscula").addClass("text-success");
	}else{
		$("#minuscula").removeClass("text-danger");
		$("#minuscula").removeClass("text-warning");
		$("#minuscula").removeClass("text-success");
		$("#minuscula").addClass("text-black-50");
	}

	if((senha.length > 0) && (senha.match(/[0-9]+/))){
		forca += 10;
		$("#numeros").removeClass("text-black-50");
		$("#numeros").addClass("text-success");
	}else{
		$("#numeros").removeClass("text-danger");
		$("#numeros").removeClass("text-warning");
		$("#numeros").removeClass("text-success");
		$("#numeros").addClass("text-black-50");
	}

	if((senha.length > 0) && (senha.match(/[A-Z]+/))){
		forca += 15;
		$("#maiuscula").removeClass("text-black-50");
		$("#maiuscula").addClass("text-success");
	}else{
		$("#maiuscula").removeClass("text-danger");
		$("#maiuscula").removeClass("text-warning");
		$("#maiuscula").removeClass("text-success");
		$("#maiuscula").addClass("text-black-50");
	}

	if((senha.length > 0) && (senha.match(/[^a-z0-9]/i))){
		forca += 20;
		$("#especiais").removeClass("text-black-50");
		$("#especiais").addClass("text-success");
	}else{
		$("#especiais").removeClass("text-danger");
		$("#especiais").removeClass("text-warning");
		$("#especiais").removeClass("text-success");
		$("#especiais").addClass("text-black-50");
	}


	if(forca < 30){
		$("#forcaSenha").addClass("text-danger");
		$("#forcaSenha").html('Senha Fraca');
	}else if(forca >= 30 && forca < 50){
		$("#forcaSenha").html('Senha Média');
		$("#forcaSenha").removeClass("text-danger");
		$("#forcaSenha").addClass("text-warning");
	}else if(forca >= 50 && forca < 70){
		$("#forcaSenha").html('Senha Boa');
		$("#forcaSenha").removeClass("text-danger");
		$("#forcaSenha").removeClass("text-warning");
		$("#forcaSenha").addClass("text-info");
	}else if(forca >= 70 && forca <= 100){
		$("#forcaSenha").html('Senha Excelente');
		$("#forcaSenha").removeClass("text-danger");
		$("#forcaSenha").removeClass("text-warning");
		$("#forcaSenha").removeClass("text-info");
		$("#forcaSenha").addClass("text-success");
	}

	return forca;
}