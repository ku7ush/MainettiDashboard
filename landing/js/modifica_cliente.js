console.log('modifica cliente js')
$(document).ready(function() { 

	// Back to Clienti
	$('.back-link').on("click", function(e){
		e.preventDefault()
		$('#sidebar #clienti-menu-item').trigger("click")
	})


	// Salva cliente
	$('.save-link').on("click", function(e){
		e.preventDefault()
		var form = $('#newClientForm')
		var dataForm = form.serialize()

		$.ajax({
            type: "POST",
            url: "../functions/update_cliente.php",
            data: dataForm,
            async: true,
            success: function(data)
            {
               console.log("Saving")
               console.log(data)
               
               $('#sidebar #clienti-menu-item').trigger("click")
            }
          })

	})
})