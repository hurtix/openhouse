$(document).on("ready",function(){
	/*$( ".circle" ).hover(
		function() {
			$( this ).find('.hover').fadeIn(200);
		}, function() {
			$( this ).find('.hover').fadeOut(200);
		}
	);*/

	$(".atras").on("click",function(){
		$.fn.fullpage.moveSectionUp();
	});


	// $("#fp-nav ul li").each(function(i){
	// 	var n = $("#fp-nav ul li").index($("#fp-nav ul li a.active").parent());
	// 	console.log(n.index('a.active'));
		
	// 	if($(this).find("a").hasClass("active")){
	// 		$(this).find("a").click(true);
	// 	}else{
	// 		$(this).find("a").click(false);
	// 	}
		
	// });
});