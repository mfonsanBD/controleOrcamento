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
});