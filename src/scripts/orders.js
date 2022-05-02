$(document).ready(function() { 
  // Click triggers

  $('.order-icons i.fa-eye').click(function(){
    line = $(this).closest('tr')
    lineData = {
      'name': line.find('.input-name').text(),
      'prezzo': line.find('.input-prezzo').text(),
      'qty': line.find('.input-qty').text(),
      'subtotal': line.find('.input-subtotal').text(),
      'discount': line.find('.input-discount').text(),
      'total': line.find('.input-total').text()
    }

    $.post('/functions/show_line.php', lineData , function(data) {      
      $( "#line-modal .modal-body" ).append(
        data
      )
    })

    $('#line-modal').toggleClass("show")
  })

  $('.modal-header button.close').click(function(){
    $('#line-modal').toggleClass("show")
    $('#line-modal .modal-body').empty()
  })

  $("#ordini .save-link").click(function(){
    $.confirm({
      title: '',
      content: 'Vuoi salvare questo ordine?',
      buttons: {
          si: function () {              
              $("#orderForm").submit()
              console.log('Submitting order form')
          },
          no: function () {
          }
      }
    });        
  })

  $('.newline-suggest a').click(function(){
    //console.log('clicked newline')
    $( "#line-modal .modal-body" ).empty()

    $.post( "/functions/add_line.php").done(function( data ) {
      $( "#line-modal .modal-body" ).append(
        data
      )

      $('#line-modal').toggleClass("show")
    })    

    
  })


  $('#orderProductsTable').on( "click", "i.delete-line", function() {    
    line = $(this).parents('tr')
    $.confirm({
      title: '',
      content: 'Vuoi davvero cancellare questa linea ordine?',
      buttons: {
          si: function () {              
              line.attr("data-update", "unlink")
              line.css("display", "none")    
              console.log('deleting line')
          },
          no: function () {
          }
      }
    });    
  });

 

  $('.nuovo-ordine .orders-list').on( "click", ".edit-line", function() {    
    linea = $(this).closest('tr');
    linea.addClass('edited');
    $.ajax({
      method: "POST",
      url: "/functions/edit_line.php",
      data: {
        "id" : linea.find('.input-prodid').data('product-id'),
        "loaded" : true,
        "row" : linea.index(),
        "name" : linea.find('.input-name').data('product-name'),
        "standard_price": linea.find('.input-prezzo').data('prezzo-unita'),
        "qty":  linea.find('.input-qty').data('qty'),
        "discount":  linea.find('.input-discount').data('discount')
      }
    }).done(function( data ) {
      //alert(data)
      $( "#line-modal .modal-body" ).append(          
        data
      )        
      $('#line-modal #qty').trigger("change")
      $('#line-modal').toggleClass("show")
    })      
  })

  $('.modifica-ordine .orders-list').on( "click", ".edit-line", function() {    
    linea = $(this).closest('tr');
    linea.addClass('edited');
    $.ajax({
      method: "POST",
      url: "/functions/edit_line.php",
      data: {
        "id" : linea.find('.input-prodid').data('product-id'),
        "loaded" : true,
        "row" : linea.index(),
        "name" : linea.find('.input-name').data('product-name'),
        "standard_price": linea.find('.input-prezzo').data('prezzo-unita'),
        "qty":  linea.find('.input-qty').data('qty'),
        "discount":  linea.find('.input-discount').data('discount')
      }
    }).done(function( data ) {
      //alert(data)
      $( "#line-modal .modal-body" ).append(          
        data
      )        
      $('#line-modal #qty').trigger("change")
      $('#line-modal').toggleClass("show")
    })      
  })


  // change triggers


  $( "#client-selector" ).change(function() {        
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

   
  $('#line-modal').on( "change", "#qty", function() {
    console.log("qty change")
    $("#lineForm #total").val(
      ($("#prezzou").val() * $("#qty").val()).toFixed(2)

    )
    $("#lineForm #parziale").val(
      ($("#prezzou").val() * $("#qty").val()).toFixed(2)

    )

     $('#line-modal #discount').trigger("change")
  }).trigger("change");



  $('#line-modal').on( "change", "#discount", function() {    
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

  $( "#line-modal" ).on( "change", "#product_modal_select", function() {  
    console.log("Hai cambiato il prodotto")
    console.log("Fetch Prezzo unitario")

    $( "#prezzou" ).empty()

    selezionata = $('#product_modal_select').children("option:selected").val()

    $.post( "/functions/get_price_single.php", {'id' : selezionata}).done(function( data ) {
        
        //postData = JSON.parse(data)

        //alert(data)

        $( "#prezzou" ).val(data)

        savedQty = $('#line-modal #qty').val()
        
        $('#line-modal').find('#qty').trigger('change')
    });
  }).trigger( "change" )


  // FORM SUBMIT


  $(".modifica-ordine #orderForm").submit(function(e) {

    e.preventDefault()
    var form = $(this)    
    var url = form.attr('action')

    $.ajax({
      type: "POST",
      url: url,
      async: true,
      data: form.serialize(), // serializes the form's elements.
      success: function(data)
      {
        console.log("Ordine inserito")
        console.log(data)

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
            url: "/functions/save_order_line.php",
            data: linesPayload,
            async: false,
            success: function(data)
            {
               console.log("Ajax call")
               console.log(data)
               $.alert({
                  title: '',
                  content: 'Il tuo ordine è stato salvato',
                  buttons: {
                    ok: function () {
                        window.location.assign("orders.php")
                    }
                  }
              });               
            }
          })
        })
      }
    })
  })

  $(".nuovo-ordine #orderForm").submit(function(e) {

    e.preventDefault()
    var form = $(this)    
    var url = form.attr('action')

    $.ajax({
      type: "POST",
      url: url,
      async: true,
      data: form.serialize(), // serializes the form's elements.
      success: function(data)
      {
        console.log("Ordine inserito")
        console.log(data)

        $('#orderProductsTable tbody tr').each(function(i){
          var linesPayload = {
            update : "false",
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
            url: "/functions/save_order_line.php",
            data: linesPayload,
            async: false,
            success: function(data)
            {
               console.log("Ajax call")
               console.log(data)
               $.alert({
                  title: '',
                  content: 'Il tuo ordine è stato salvato',
                  buttons: {
                    ok: function () {
                        window.location.assign("orders.php")
                    }
                  }
              });               
            }
          })
        })
      }
    })
  })

  // SALVA LINEA
  $('#button_save_line').click(function(){    
    if($(this).closest('.modal-content').find('#lineForm').hasClass("editRow")){
      oldId = $(this).closest('.modal-content').find('#lineForm').data("row")
      newId = $(this).parents('#line-modal').find('#product_modal_select').val()
      line = $('#orderProductsTable').find('tr.edited')
      lineId = line.find('.input-lineid').data("productLineid")

      console.log("newId: " + newId)
      console.log("oldId: " + oldId)
      console.log("lineid: " + lineId)

      rowToReplace = $('#orderProductsTable tbody').find('tr[data-product-id = ' + oldId + ']')
      
      /*console.log(rowToReplace)*/

      line.replaceWith(
        '<tr data-update="true">' +     
        '<td class="input-prodid" data-product-id="' + newId + '" hidden></td>' +
        '<td class="input-lineid" data-product-lineid="' + lineId + '" hidden></td>' +
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
      )

      $("#orderProductsTable").find("tr.edited").removeClass("edited")
    } else {
      $('#orderProductsTable').append(
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
      )
    }

    $('#line-modal .close').click()
  }) 
})
  

