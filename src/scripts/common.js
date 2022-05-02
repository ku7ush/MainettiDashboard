console.log('Common.js starting')

$(document).ready(function() { 

  $('.sidebar-menu #link-ordini').click(function(e){
    e.preventDefault()

    $("body .main-container").remove()

    $.post( "ajax_orders.php" ).done(function( data ) {
      $("body").append(data)
    })
  })

  $('.sidebar-menu #link-home').click(function(e){
    e.preventDefault()

    $("body .main-container").remove()

    $.post( "dashboard.php" ).done(function( data ) {
      $("body").append(data)
    })
  })

  $('.sidebar-menu #link-nuovo-ordine').click(function(e){
    e.preventDefault()

    $("body .main-container").remove()

    $.post( "nuovo-ordine.php" ).done(function( data ) {
      $("body").append(data)
    })
  })  
})