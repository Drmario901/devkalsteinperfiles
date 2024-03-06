jQuery(document).ready(function($){

	$(document).on('click', '#btnSavedInfoQuote', function(){
		$('.btn-generate').addClass('btn-generate-animado')
		
		var elementoTop = $('.btn-generate').offset().top;

		// Calcula la altura de la ventana del navegador
		var alturaVentana = $(window).height();

		// Ajusta la posición para que el elemento quede en el medio de la pantalla
		var posicionAjustada = elementoTop - (alturaVentana / 2) + ($('.btn-generate').outerHeight() / 2);

		// Anima el scroll hacia la posición ajustada
		$('html, body').animate({
			scrollTop: posicionAjustada
		}, 1000); // Duración de la animación
	})

	$(document).on('click', '.btnQuo', function(){
		$('.btnQuo').css({'animation' : 'none'})
		$('.cCategory').css({'animation' : 'none'})
	})

	$(document).on('click', '.generate-quote', function(){
		$(this).css({'animation' : 'none'})
		$('.product-search-bar .container ul form .nav-item').css({'animation': 'none'})
	})

	function consultQuoteQuantity(){

		$.ajax({
            url: plugin_dir + '/php/consultQuoteQuantity.php',
            type: 'POST',
        })
        .done(function(respuesta){
            let data = JSON.parse(respuesta)
			if (data.quoteMax === 'maximo'){
				$('.btnQuo').css({'animation' : 'none'})
				$('.cCategory').css({'animation' : 'none'})
				$('.generate-quote').css({'animation' : 'none'})
				$('.product-search-bar .container ul form .nav-item').css({'animation' : 'none'})
				$('.btn-generate').removeClass('btn-generate-animado')
			}
        })
        .fail(function(){
            console.log("error");
        })
	}

	setInterval(consultQuoteQuantity, 1000);
})