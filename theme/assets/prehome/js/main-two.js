$(document).ready(function(){
	$('.frm_search').validate({
		rules:{
			year: {required:true},
			tipo: {required:true}
		},
		messages:{
			year:{
				required:"Ingresa tu identificacion"
			},
			tipo:{
                required:"Ingrese su nombre"
            }
		},
		onkeyup : false,
  		onclick : false,
  		errorPlacement: function(error, element) {
			if(error.text()!='') {
				element.parent().addClass("color_error");
		    }
		},
		success : function(label, element){
      		$(element).parent().removeClass('color_error');
  		},
  		submitHandler: function(form) {
    		$.post(form.getAttribute('action'), $("form[name='frm_login']").serializeArray(), function(response){
	      		if(response.cod == 1){
	        		form.reset();
	      		}else{
	        		form.reset();
	      		}
    		}, 'json')
    		.fail(function(){

    		});
    	return false;
  		}
	});
	
});

window.onload = function(){
	$(".mainbanner-titl").animate({
		top:"13%",
		opacity:1
	},1000,"easeOutSine");

	$(".item-vaso").delay(900).animate({
		right:"0px",
		opacity:1
	},1000,"easeOutSine");

	$('.pointone').waypoint(function(direction) {
		if (direction == 'down') {
			$(".item-text1").delay(100).animate({
				top:"30%",
				opacity:1
			},1000,"easeOutSine");

			$(".item-text2").delay(1000).animate({
				top:"40%",
				opacity:1
			},1200,"easeOutSine");


		}else{
			// $(".item-text1").delay(100).animate({
			// 	top:"49%",
			// 	opacity:0
			// },200,"easeOutSine");

			// $(".item-text2").delay(300).animate({
			// 	top:"55%",
			// 	opacity:0
			// },400,"easeOutSine");
		}
	});

	$('.pointtwo').waypoint(function(direction) {
		if (direction == 'down') {
			$(".product1 .innerproduct").delay(1000).animate({
				left:"1%",
				opacity:1
			},1200,"easeOutSine");

			$(".product2 .innerproduct").delay(2000).animate({
				left:"0%",
				opacity:1
			},1200,"easeOutSine");

			$(".product3 .innerproduct").delay(3000).animate({
				right:"0%",
				opacity:1
			},1200,"easeOutSine");

			$(".product4 .innerproduct").delay(4000).animate({
				right:"0",
				opacity:1
			},1200,"easeOutSine");
		}else{
			// $(".product1").delay(100).animate({
			// 	left:"-30%",
			// 	opacity:0
			// },200,"easeOutSine");

			// $(".product2").delay(200).animate({
			// 	left:"-10%",
			// 	opacity:0
			// },400,"easeOutSine");

			// $(".product3").delay(300).animate({
			// 	right:"-10%",
			// 	opacity:0
			// },600,"easeOutSine");

			// $(".product4").delay(400).animate({
			// 	right:"-15%",
			// 	opacity:1
			// },800,"easeOutSine");
		}
	});
}
