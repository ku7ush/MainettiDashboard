console.log('crea ordine js')
$(document).ready(function() { 
	// Add line
	$('#add-newline-button').on("click", function(e){
		e.preventDefault()
		console.log('Add line cliccato')

		$.ajax({
            type: "POST",
            url: "../template/aggiungi_linea.php",
            async: true,
            cache: false,
        	headers: { "cache-control": "no-cache" },
            success: function(data)
            {
                console.log("Add line modal shown")
                //console.log(data)
				$('.custom-modal-content').empty()
				$('.custom-modal-content').append(data)
				$('.custom-modal').removeClass('below')
				$('.custom-modal').addClass('showme')
            }
      	})

	})

	// Close the modal	

	$('.close-modal').on("click", function(e){
		e.preventDefault()
		$('.custom-modal').removeClass('showme')
		$('.custom-modal').addClass('below')
	})

	// Back to Clienti
	$('.icon-options-link a.back-link').on("click", function(e){
		console.log('back')
		e.preventDefault()
		$('#sidebar #ordini-menu-item').trigger("click")
	})

	// Salva nuovo ordine
	$('.save-link').on("click", function(e){
		e.preventDefault()
		var form = $('#orderForm')
		var dataForm = form.serialize()

		$.ajax({
            type: "POST",
            url: "../functions/salva_ordine.php",
            data: dataForm,
            async: true,
            success: function(data)
            {
               console.log("Saving order lines")

               $('#orderProductsTable tbody tr').each(function(i){
		          var linesPayload = {
		            update : $(this).data('update'),
		            order_id : data,
		            line_id : $(this).find('td[data-product-lineid]').data('product-lineid'),
		            prodotto_id : $(this).find('td[data-product-id]').data('product-id'),
		            product_name : $(this).find('td[data-product-name]').data('product-name'),
		            discount: $(this).find('td[data-discount]').data('discount'),
		            qty : $(this).find('td[data-qty]').data('qty'),
		            price_unit : $(this).find('td[data-prezzo-unita]').data('prezzo-unita'),
		            price_total : $(this).find('td[data-totale]').data('totale')
		          }
		          console.log(linesPayload)

		          $.ajax({
		            type: "POST",
		            url: "../functions/salva_linea_ordine.php",
		            data: linesPayload,
		            async: false,
		            success: function(data)
		            {
		               console.log("Order line saved")
		            }
		          })
		        })
                
                $('#sidebar #ordini-menu-item').trigger("click")
            }
          })
	})

	// Client selector Select
	$( "#client-selector" ).on("change", function() {        
	    console.log("Hai cambiato il cliente")
	    console.log("Fetch Indirizzi")

	    $( "#address-selector" ).empty()

	    selezionata = $(this).children("option:selected").val();

	    $.post( "/functions/get_address.php", {'id' : selezionata}).done(function( data ) {
	        
	        postData = JSON.parse(data)

	        //console.log(postData)

	        $.each(postData, function(i, v){
	          $( "#address-selector" ).append(
	            '<option selected=" " value="'+ this.id + '">' + this.street + '</option>'
	          )
	        })

	        
	    });

  	}).trigger( "change" )

  	$('.custom-modal-content').on( "change", "#qty", function() {
	    console.log("qty change")
	    $("#lineForm #total").val(
	      ($("#prezzou").val() * $("#qty").val()).toFixed(2)

	    )
	    $("#lineForm #parziale").val(
	      ($("#prezzou").val() * $("#qty").val()).toFixed(2)

	    )

	     $('#lineForm #discount').trigger("change")
	}).trigger("change");

	$('.custom-modal-content').on( "change", "#discount", function() {    
	  qty = $("#lineForm #qty").val()
	  unitprice = $("#lineForm #prezzou").val()
	  price = unitprice * qty
	  discount = $("#lineForm #discount").val()
	  discountAmount = price * discount /100
	  afterDiscount = price - discountAmount;

	  $("#lineForm #parziale").val(
	    price.toFixed(2)
	  )  

	  $("#lineForm #sconto").val(
	    discountAmount.toFixed(2)
	  )  

	  $("#lineForm #total").val(
	    afterDiscount.toFixed(2)
	  )  
	}).trigger("change");

	$( ".custom-modal-content" ).on( "change", "#product_modal_select", function() {  
		console.log("Hai cambiato il prodotto")
		console.log("Fetch Prezzo unitario")

		$( "#prezzou" ).empty()

		selezionata = $('#product_modal_select').children("option:selected").val()

		$.post( "../functions/get_price_single.php", {'id' : selezionata}).done(function( data ) {

		    $( "#prezzou" ).val(data)

		    savedQty = $('#line-modal #qty').val()
		    
		    $('.custom-modal-content').find('#qty').trigger('change')
		});
	}).trigger( "change" )

	$('.add-line-to-order').click(function(e){
		e.preventDefault()
		console.log('add line to order')

		lineData = 
		'<tr data-update="false">' +
	        '<td class="input-prodid" data-product-id="' + $('#product_modal_select').find('option:selected').val() + '" hidden></td>' +
	        '<td class="input-name" data-product-name="' + $('#product_modal_select').find('option:selected').text() + '">' +
	        $('#product_modal_select').find('option:selected').text() +
	        '</td>' + 
	        '<td class="input-prezzo" data-prezzo-unita="' + $('#prezzou').val() + '">' +
	        $('#prezzou').val() +
	        '</td>' + 
	        '<td class="input-qty" data-qty="' + $('#qty').val() + '">' +
	        $('#qty').val() +
	        '</td>' + 
	        '<td class="input-subtotal" data-subtotale="' + $('#parziale').val() + '">' +
	        $('#parziale').val() +
	        '</td>' + 
	        '<td class="input-discount" data-discount="' + $('#discount').val() + '">' +
	        $('#discount').val() +
	        '</td>' + 
	        '<td class="input-total" data-totale="' + $('#total').val() + '">' +
	        $('#total').val() +
	        '</td>' + 
	        '<td class="order-icons">' +
	        '<i class="edit-line fa fa-edit"></i>' +
	        '<i class="delete-line fa fa-trash-alt"></i>' +
	        '</td>' + 
        '</tr>'

        if ($('.custom-modal').hasClass('edit-line-modal')) {
        	$('#orderProductsTable').find('tr.edited').replaceWith(lineData)
        } else {
        	$('#orderProductsTable tbody').append(
	        	lineData
	    	)	
        }		

		$('.close-modal').click()
	})

	// Order icons
    $('#orderProductsTable').on("click", ".delete-line", function(e){    	
		if ($(this).closest('tr').data('update') == false) {
			trToRemove = $(this).closest('tr')
			trToRemove.attr("data-update", "ignore")
            trToRemove.css("display", "none")
            console.log('Linea ordine rimossa')
		}
	})

	$('#orderProductsTable').on("click", ".edit-line", function(e){    	
		e.preventDefault()
		console.log('Edit line cliccato')

		line = $(this).closest('tr')
		line.addClass('edited')

		//console.log(line)

		lineData = {
			prodId: line.find('.input-prodid').attr('data-product-id'),
			qty: line.find('.input-qty').attr('data-qty'),
			discount: line.find('.input-discount').attr('data-discount')
		}

		//console.log(lineData)

		$.ajax({
            type: "POST",
            url: "../template/modifica_linea.php",
            async: true,
            cache: false,
            data: lineData,
        	headers: { "cache-control": "no-cache" },
            success: function(data)
            {
                console.log("Edit line modal shown")
                //console.log(data)
				$('.custom-modal-content').empty()
				$('.custom-modal-content').append(data)
				$('.custom-modal').removeClass('below')
				$('.custom-modal').addClass('showme edit-line-modal')
            }
      	})
	})

	// Edit existing line
	$('#add-newline-button').on("click", function(e){
		e.preventDefault()
		console.log('Add line cliccato')

		$.ajax({
            type: "POST",
            url: "../template/aggiungi_linea.php",
            async: true,
            cache: false,
        	headers: { "cache-control": "no-cache" },
            success: function(data)
            {
                console.log("Add line modal shown")
                //console.log(data)
				$('.custom-modal-content').empty()
				$('.custom-modal-content').append(data)
				$('.custom-modal').removeClass('below')
				$('.custom-modal').addClass('showme')
            }
      	})

	})

})