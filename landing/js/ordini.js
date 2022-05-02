$(document).ready(function() { 
  $('.visualizza-ordine-button').on("click", function(e){
  	e.preventDefault()
  	var id = {'id' : $(this).closest('tr').attr('id')}
  	$('#loaded-content').addClass('fadeOut')
  	console.log(id)

  	$.ajax({
        type: "POST",
        url: "../template/visualizza_ordine.php",
        data: id,
        async: true,
        cache: false,
        headers: { "cache-control": "no-cache" },
        success: function(data)
        {
           	console.log("Called visualizza_ordine.php")
           	$('#loaded-content').empty()
			      $('#loaded-content').append(data)
			      $('#content').find('#loaded-content').removeClass('fadeOut')
        }
	  })
  })

  $('.riordina-ordine-button').on("click", function(e){
    e.preventDefault()
    var id = {'id' : $(this).closest('tr').attr('id')}
    //$('#loaded-content').addClass('fadeOut')
    console.log('Riordino: ' + id)

    $.ajax({
        type: "POST",
        url: "../functions/riordina_ordine.php",
        data: id,
        async: true,
        cache: false,
        headers: { "cache-control": "no-cache" },
        success: function(data)
        {
            console.log("Called riordina_ordine.php")
            console.log(data)
            /*$('#loaded-content').empty()
            $('#loaded-content').append(data)
            $('#content').find('#loaded-content').removeClass('fadeOut')*/
        }
    })
  })
})