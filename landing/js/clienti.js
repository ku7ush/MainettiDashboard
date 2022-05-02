$(document).ready(function() { 
  $('.modifica-cliente-button').on("click", function(e){
  	e.preventDefault()
  	var id = {'id' : $(this).closest('tr').attr('id')}
  	$('#loaded-content').addClass('fadeOut')
  	console.log(id)

  	$.ajax({
        type: "POST",
        url: "../template/modifica_cliente.php",
        data: id,
        async: true,
        cache: false,
        headers: { "cache-control": "no-cache" },
        success: function(data)
        {
           	console.log("Called modifica_cliente.php")
           	$('#loaded-content').empty()
			      $('#loaded-content').append(data)
			      $('#content').find('#loaded-content').removeClass('fadeOut')    
        }
	})
  })
})