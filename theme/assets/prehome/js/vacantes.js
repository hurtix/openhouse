$(document).ready(function(){
	/*Interna vacantes*/
	var open_description = $(".info-vacant ");
	var listado_vacantes = $(".wrapper-type-vacant");
	var vacantes = "";
	open_description.on("click",function(){
		datacity = $(this).data("city");
		listado_vacantes.each(function(){
			if($(this).data("listcity") == datacity){
				$(this).slideToggle(500);
				$(".wrapper-type-vacant").not(this).css({"display":"none"});
			}
		});
	});
	/*Fin interna vacantes*/
});