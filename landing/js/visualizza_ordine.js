console.log('visualizza ordine js')
$(document).ready(function() { 

	// Back to Clienti
	$('.back-link').on("click", function(e){
		e.preventDefault()
		$('#sidebar #ordini-menu-item').trigger("click")
	})

	// Close the modal	

	$('.close-modal').on("click", function(e){
		e.preventDefault()
		$('.custom-modal').removeClass('showme')
	})

	$('.visualizza-linea-button').on("click", function(e){
		e.preventDefault()		 
		var idLinea = {'id' : $(this).closest('tr').attr('id')}
		console.log('clicked vis linea with id: ' + idLinea)

		$.ajax({
        type: "POST",
        url: "../functions/visualizza_linea.php",
        data: idLinea,
        async: true,
        cache: false,
        headers: { "cache-control": "no-cache" },
        success: function(data)
	        {
	           	console.log("Called visualizza_linea.php")	           	
	           	$('.custom-modal-content').empty()
				$('.custom-modal-content').append(data)
				$('.custom-modal').addClass('showme')
	        }
	  	})		
	})
	
})