urlSite = window.location.href;
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
			warning("Para redefinir sua senha é importante que nos envie seu e-mail cadastrado no sistema.");
		}else{
			$.ajax({
				url: urlSite+'/verificaEmail/',
				type: 'POST',
				data: {email:email},
				success: function(dados){
					if(dados == "1"){
						$.ajax({
							url: urlSite+'/redefinirSenha/',
							type: 'POST',
							data: {email:email},
							success: function(dados){
								if(dados == "1"){
									successRedefinicaoSenha("Encaminhamos para seu e-mail um passo a passo do que você deverá fazer para redefinir sua senha.");
								}else{
									
								}
							}
						});
					}else{
						warning("O e-mail que você digitou não consta em nosso sistema.");
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
			warning("Para redefinir sua senha digite o código de verificação enviado por e-mail.");
		}else{
			$.ajax({
				url: urlSite+'/verificaCodigo/',
				type: 'POST',
				data: {codigo:codigo, hash:hash},
				success: function(dados){
					if(dados == "1"){
						$("#codigos").hide();
						$("#novasenha").show();
					}else{
						warning("O código que você digitou não consta em nosso sistema.");
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
					url: urlSite+'/redefinir/',
					type: 'POST',
					data: {senha:nova, hash:hash},
					success: function(senha){
						if(senha == "1"){
							successRedefinicaoSenha("Senha redefinida com sucesso.");
						}else{
							errorRedefinicaoSenha("A senha não pôde ser redefinida. Tente novamente mais tarde.");
						}
					}
				});
			}else{
				warning("As NOVAS SENHAS não coincidem.");
			}
		}else{
			warning("Para redefinir sua senha é necessário preencher os campos.");
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
				warning("Digite um e-mail válido.");
			}
			else if(senha == ''){
				warning("O campo SENHA é obrigatório.");
			}
			else if(csenha == ''){
				warning("O campo COMFIRMAR SENHA é obrigatório.");
			}
			else if(csenha != senha){
				warning("As senhas não coincidem.");
			}else{
				$.ajax({
					url: urlSite+'/adminAddU/',
					type: 'POST',
					data: {nome:nome, sobrenome:sobrenome, email:email, senha:senha},
					success: function(dados){
						if(dados == 1){
							success("Usuário adicionado com sucesso!");
						}
						else if(dados == 2){
							warning("O e-mail que você digitou já consta em nosso sistema.");
						}
						else{
							error("O usuário não pôde ser adicionado.");
						};
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
				warning("Os campos não podem estar vazios.");
			}else{
				if(novaSenha != cNovaSenha){
					warning("As senhas não coincidem.");
				}else{
					$.ajax({
						url: urlSite+'/adminEdita/',
						type: 'POST',
						data: {senha:novaSenha, id:id},
						success: function(dados){
							if(dados == 1){
								success("Senha alterada com sucesso!");
							}else{
								error("A senha não pôde ser alterada.");
							}
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
				url: urlSite+'/adminExcluiU/',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == 1){
						success("Usuário excluído com sucesso!");
					}else{
						error("Usuário não pôde ser excluído.");
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
				warning("O campo PERGUNTA não pode estar vazio.");
			}else if(resposta == ''){
				warning("O campo RESPOSTA não pode estar vazio.");
			}else{
				$.ajax({
					url: urlSite+'/addFaqs/',
					type: 'POST',
					data: {pergunta:pergunta, resposta:resposta},
					success: function(dados){
						if(dados == "1"){
							success("Pergunta Frequente adicionada com sucesso.");
						}else{
							error("Pergunta Frequente não pôde ser adicionada.");
						}
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
		$("#novapergunta").val(pergunta);
		$("#novaresposta").val(resposta);

		$("#salvarAlteracoes").on("click", function(){
		  	var novapergunta = $("#novapergunta").val();
		  	var novaresposta = $("#novaresposta").val();

			if(novapergunta == '' && novaresposta == ''){
				warning("Para editar é necessário que pelo menos um campo seja preenchido.");
			}else{
				$.ajax({
					url: urlSite+'/adminEditaPF/',
					type: 'POST',
					data: {pergunta:novapergunta, resposta:novaresposta, id:id},
					success: function(dados){
						if(dados == 1){
							success("Pergunta Frequente alterada com sucesso!");
						}else{
							warning("Os dados enviados são atuais.");
						}
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
				url: urlSite+'/adminExcluiPF/',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == 1){
						success("Pergunta Frequente excluída com sucesso!");
					}else{
						error("A pergunta frequente não pôde ser excluída.");
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
		
		$("#adicionaEmpresa").on("submit", function(event){
			event.preventDefault();
			var nomeEmpresa 		= $("#nomeEmpresa").val();
			var emailEmpresa 		= $("#emailEmpresa").val();
			var siteEmpresa 		= $("#siteEmpresa").val();
			var telefoneEmpresa 	= $("#telefoneEmpresa").val();
			var whatsappEmpresa 	= $("#whatsappEmpresa").val();
			var idGerente 			= $("#gerente option:selected").val();
			var slug 				= string_to_slug(nomeEmpresa);

			if(nomeEmpresa == ''){
				warning("O campo NOME DA EMPRESA é obrigatório.");
			}
			else if(nomeEmpresa.length < 3){
				warning("O campo NOME DA EMPRESA deve conter pelo menos 3 caracteres.");
			}
			else if(!isNaN(nomeEmpresa)){
				warning("O campo NOME DA EMPRESA não permite números.")
			}
			else if(emailEmpresa == ''){
				warning("O campo E-MAIL é obrigatório.");
			}
			else if(!emailValido(emailEmpresa)){
				warning("Digite um E-MAIL válido.");
			}
			else if(!urlValido(siteEmpresa)){
				warning("Digite um SITE válido.");
			}
			else if(telefoneEmpresa == ''){
				warning("O campo TELEFONE é obrigatório.");
			}
			else if(idGerente == ''){
				warning("O campo GERENTE é obrigatório.");
			}
			else{
				$.ajax({
					url: urlSite+'/adminAddEmpresa/',
					type: 'POST',
					data: {nomeEmpresa:nomeEmpresa, emailEmpresa:emailEmpresa, siteEmpresa:siteEmpresa, telefoneEmpresa:telefoneEmpresa, whatsappEmpresa:whatsappEmpresa, idGerente:idGerente, slug:slug},
					success: function(dados){
						if(dados == 1){
							success("Empresa adicionada com sucesso!");
						}else{
							error("A empresa não pôde ser adicionada. Tente novamente mais tarde!");
						};
					}
				});
			}
			function urlValido($siteEmpresa) {
				var urlReg = /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
				return urlReg.test($siteEmpresa);
			}
			function emailValido($emailEmpresa){
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				return emailReg.test($emailEmpresa);
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

		$("#cancela").on("click", function(){
			$("#adicionaUsuario")[0].reset();
		});
	});
	$('#deleteEmpresa').on('show.bs.modal', function(event){
		var button = $(event.relatedTarget);
		var id = button.data('id');
		var nome = button.data('nome');
		var modal = $(this);

		modal.find('.modal-title').text('Excluir Empresa!');
		modal.find('.texto-confirmacao').html("Tem certeza que deseja excluir a empresa <span class=text-danger>'"+nome+"'</span>?\nTodas as informações dessa empresa serão perdidas.");

		$("#excluirSU").on("click", function(){
			$.ajax({
				url: urlSite+'/AdminDeleteEmpresa/',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == 1){
						success("Empresa excluída com sucesso!");
					}else{
						error("A empresa não pôde ser excluída.");
					}
				}
			});
		});
	});

	$("#voltaAoInicio").click(function(){
		window.location.href = window.location.hostname+"/gcc/painel";
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

		if(nome == ''){
			warning("O campo NOME não pode estar vazio.")
		}
		else if(nome.length < 3){
			warning("O campo NOME deve conter pelo menos 3 caracteres.");
		}
		else if(!isNaN(nome)){
			warning("O campo NOME não permite números.");
		}
		else if(sobrenome == ''){
			warning("O campo SOBRENOME não pode estar vazio.")
		}
		else if(sobrenome.length < 3){
			warning("O campo SOBRENOME deve conter pelo menos 3 caracteres.");
		}
		else if(!isNaN(sobrenome)){
			warning("O campo SOBRENOME não permite números.");
		}
		else if(email == ''){
			warning("O campo E-MAIL não pode estar vazio.")
		}
		else if(!emailValido(email)){
			warning("Digite um E-MAIL válido.");
		}
		else{
			$.ajax({
				url: urlSite+'/alteraDados/',
				type: 'POST',
				data: {nome:nome, sobrenome:sobrenome, email:email},
				success: function(dados){
					if(dados == 1){
						success("Dados alterados com sucesso.");
					}else{
						warning("Os dados enviados são atuais.");
					}
				}
			});
		}

		function emailValido($email){
			var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
			return emailReg.test($email);
		}
	});
	$('#configSenhas').click(function(event){
		event.preventDefault();

		var atual 		= $('#atual').val();
		var nova 		= $('#nova').val();
		var cnova 		= $('#cnova').val();

		if(atual != '' && nova != '' && cnova != ''){
			$.ajax({
				url: urlSite+'/verificaSenhaAtual/',
				type: 'POST',
				data: {senha:atual},
				success: function(senha){
					if(senha == 1){
						if(nova == cnova){
							$.ajax({
								url: urlSite+'/alteraSenha/',
								type: 'POST',
								data: {senha:nova},
								success: function(senha){
									if(senha == 1){
										success("Senha alterada com sucesso.");
									}else{
										warning("A senha que você digitou é a senha atual.");
									}
								}
							});
						}else{
							warning("As NOVAS SENHAS não coincidem.");
						}
					}else{
						warning("Sua SENHA ATUAL está incorreta.");
					}
				}
			});
		}else{
			warning("Preencha todos os campos para alterar sua senha.");
		}
	});
});

//Controle de Empresas
function aceitaEmpresa(id){
	$.ajax({
		url: urlSite+'/aceita/',
		type: 'POST',
		data: {id:id},
		success: function(dados){
			if(dados == "1"){
				success("Empresa aceita com sucesso.");
			}else{
				error("Empresa não pôde ser aceita.");
			}
		}
	});
}
function excluiEmpresa(id){
	afirmaExclusaoEmpresa("Tem certeza que deseja excluir esta empresa?");
}
function desativarEmpresa(id){
	afirmaDesativacaoEmpresa("Tem certeza que deseja desativar esta empresa?", id);
}
function reativarEmpresa(id){
	$.ajax({
		url: urlSite+'/aceita/',
		type: 'POST',
		data: {id:id},
		success: function(dados){
			if(dados == "1"){
				success("Empresa reativada com sucesso.");
			}else{
				error("Empresa não pôde ser reativada.");
			}
		}
	});
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
function successRedefinicaoSenha(text){
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
		window.location.href = window.location.hostname+"/gcc/";
	});
}
function errorRedefinicaoSenha(text){
	swal({
		title: "Erro!",
		text: text,
		icon: "error",
		buttons: {
			confirm: {
				text: "Ok!",
				value: true,
				visible: true,
				className: "bg-danger",
				closeModal: true
			}
		}
	})
	.then((resposta) => {
		window.location.href = window.location.hostname+"/gcc/";
	});
}
function afirmaDesativacaoEmpresa(text, id){
	swal({
		title: "Atenção!",
		text: text,
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
				url: urlSite+'/desativar/',
				type: 'POST',
				data: {id:id},
				success: function(dados){
					if(dados == "1"){
						success("Empresa desativada com sucesso.");
					}else{
						error("Empresa não pôde ser desativada.");
					}
				}
			});
		}else{

		}
	});
}
function string_to_slug (nome) {
    nome = nome.replace('/^\s+|\s+$/g', ''); // trim
    nome = nome.toLowerCase();
  
    // remove accents, swap ñ for n, etc
    var from = "ãàáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        nome = nome.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    nome = nome.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return nome;
}