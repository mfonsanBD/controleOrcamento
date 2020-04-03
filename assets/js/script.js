const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
    container.classList.add('right-panel-active');
});

signInButton.addEventListener('click', () => {
    container.classList.remove('right-panel-active');
});

urlSite = window.location.href;

$(document).ready(function(){
	$("#cadastro").on("submit", function(e){
		e.preventDefault();
		var nome 			= $("#nome").val();
		var sobrenome 		= $("#sobrenome").val();
		var email 			= $("#email").val();
		var senha 			= $("#senha").val();
		var confirmaSenha	= $("#cSenha").val();

		if(nome == ''){
			warning("O campo NOME é obrigatório.");
		}
		else if(!isNaN(nome)){
			warning("O campo NOME não permite números.");
		}
		else if(nome.length < 3){
			warning("O campo NOME deve conter pelo menos 3 caracteres.");
		}
		else if(sobrenome == ''){
			warning("O campo SOBRENOME é obrigatório.");
		}
		else if(!isNaN(sobrenome)){
			warning("O campo SOBRENOME não permite números.");
		}
		else if(sobrenome.length < 3){
			warning("O campo SOBRENOME deve conter pelo menos 3 caracteres.");
		}
		else if(email == ''){
			warning("O campo E-MAIL é obrigatório.");
		}
		else if(!emailValido(email)){
			warning("Digite um E-MAIL válido.");
		}
		else if(senha == ''){
			warning("O campo SENHA é obrigatório.");
			$("#forcaSenha").html('');
		}
		else if(validarForcaSenha() < 70){
			warning("Para a segurança das suas informações, sua senha precisa ser mais forte.");
		}
		else if(confirmaSenha == ''){
			warning("O campo CONFIRMAR SENHA é obrigatório.");
		}
		else if(confirmaSenha != senha){
			warning("As senhas não coincidem.");
		}else{
			$.ajax({
				url: urlSite+'/verificaEmail/',
				type: 'POST',
				data: {email:email},
				success: function(dados){
					if(dados == "1"){
						warning("O e-mail que você digitou já consta em nosso sistema.");
					}else{
						$.ajax({
							url: urlSite+'/cadastro/',
							type: 'POST',
							data: {nome:nome, sobrenome:sobrenome, email:email, senha:senha},
							success: function(dados){
								if(dados == 1){
									success("Cadastro realizado com sucesso.");
									resetaSenhaCadastro();
								}else{
									error("Não foi possível realizar seu cadastro. Tente novamente mais tarde!");
									resetaSenhaCadastro();
								}
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
function warning(text){
	swal({
		title: "Atenção!",
		text: text,
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
function error(text){
	swal({
		title: "Erro!", 
		text: text, 
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
		window.location.reload();
	});
}
function success(text){
	swal({
		title: "Parabéns!", 
		text: text, 
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
function resetaSenhaCadastro(){
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