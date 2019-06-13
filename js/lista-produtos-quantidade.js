let clickNome = false;
let clickQuantidade = false;

$("#busca").on("keyup", function(event) {
	let val = $(this).val();
	let filtro = $("#parametroFiltro").val().toUpperCase();

	if(val != ""){
		val = val.toUpperCase();
	}

	let url = "get-produto-cadastrado-quantidade.php?busca=" + val + "&filtro=" + filtro + "&parametroOrdenacao=";

	var request = $.ajax({
		url: url,
		cache: false
	});

	request.done(function(msg) {
		$("table tbody").remove();
		$("table").append("<tbody>");
		$("table tbody").append(msg);
		$("table").append("</tbody>");
	});

	request.fail(function(jqXHR, textStatus) {
		alertify.error('Falha ao buscar produtos');
	});
	

});

$(".ordenavel").on("click", function(event)
{
	let semestre = $(".semestres").text();
	let semestreIndividual = semestre.split(" ");
	let nomeCampo = $(this).text();

	if (nomeCampo != "")
	{
		nomeCampo = nomeCampo.toUpperCase();
	}

	let url = "get-produto-cadastrado-quantidade.php?busca=&filtro=&parametroOrdenacao=";

	if(nomeCampo == "NOME"){
		if(clickNome == false){
			url += 1;
			$("#setaNome").attr("src","img/setaCima.png");
		}else{
			url += -1;
			$("#setaNome").attr("src","img/setaBaixo.png");
		}

		clickNome = !clickNome;

		var request = $.ajax({
			url: url,
			cache: false
		});

		request.done(function(msg) {
			$('table tbody').remove();
			$('table').append("<tbody>");
			$('table tbody').append(msg);
			$('table').append("</tbody>");
		});

		request.fail(function(jqXHR, textStatus) {
			alertify.error('Falha ao ordenar produtos');
		});
	}	
});