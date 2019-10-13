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
		$("#erroNome").html('');
		$("#erroEmail").html('');
		$("#erroSenha").html('');
		$("#erroCSenha").html('');

		if($("#nome").val() == ''){
			$("#erroNome").html('*O campo <b>Nome Completo</b> é obrigatório.');
		}
		else if(!isNaN($("#nome").val())){
			$("#erroNome").html('*O campo <b>Nome Completo</b> não permite números.');
		}
		else if($("#nome").val().length < 3){
			$("#erroNome").html('*O campo <b>Nome Completo</b> deve conter pelo menos 3 caracteres.');
		}
		else if($("#email").val() == ''){
			$("#erroEmail").html('*O campo <b>E-mail</b> é obrigatório.');
		}
		else if(!emailValido($("#email").val())){
			$("#erroEmail").html('*Digite um <b>E-mail</b> válido.');
		}
		else if($("#senha").val() == ''){
			$("#erroSenha").html('*O campo <b>Senha</b> é obrigatório.');
		}
		else if(validarForcaSenha() < 70){
			$("#erroSenha").html('*Para a segurança das suas informações, sua senha precisa ser mais forte.');
		}
		else if($("#cSenha").val() == ''){
			$("#erroCSenha").html('*O campo <b>Confirmar Senha</b> é obrigatório.');
		}
		else if($("#cSenha").val() != $("#senha").val()){
			$("#erroCSenha").html('*As senhas não coincidem.');
		}else{

			var nome = $("#nome").val();
			var email = $("#email").val();
			var senha = $("#senha").val();

			$.ajax({
				url: 'http://localhost/gcc/login/cadastro/',
				type: 'POST',
				data: {nome:nome, email:email, senha:senha},
				success: function(dados){
					swal("Parabéns!", "Cadastro realizado com sucesso.", "success");
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
			swal("Aviso!", "Para acessar sua conta é necessário um e-mail e senha.", "warning");
			return false;
		}else{
			$.ajax({
				url: 'http://localhost/gcc/login/index',
				type: 'POST',
				data: {email:email, senha:senha},
				success: function(dados){
					window.location.href = 'http://localhost/gcc/painel/';
				}
			});
		}
	});
});

function validarForcaSenha(){
	var senha = $("#senha").val();
	var forca = 0;
	
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