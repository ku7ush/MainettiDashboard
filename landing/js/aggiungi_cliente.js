console.log('aggiungi cliente js')
$(document).ready(function() { 

	// Back to Clienti
	$('.back-link').on("click", function(e){
		e.preventDefault()
		$('#sidebar #clienti-menu-item').trigger("click")
	})


	// Salva nuovo cliente
	$('.save-link').on("click", function(e){
		e.preventDefault()
		var form = $('#newClientForm')
		var dataForm = form.serialize()

		$.ajax({
            type: "POST",
            url: "../functions/salva_cliente.php",
            data: dataForm,
            async: true,
            success: function(data)
            {
               console.log("Saving")
               console.log(data)
               /*$.alert({
                  title: '',
                  content: 'Il tuo ordine è stato salvato',
                  buttons: {
                    ok: function () {
                        $('#sidebar #clienti-menu-item').trigger("click")
                    }
                  }
              })*/
                $('#sidebar #clienti-menu-item').trigger("click")
            }
          })

	})
})