$(document).ready(function() { 
  console.log("Clients JS")

  $("#nuovo-cliente .save-link").click(function(){          
    $.confirm({
      title: '',
      content: 'Vuoi salvare questo cliente?',
      buttons: {
          si: function () {              
              $("#newClientForm").submit()
              console.log('Submitting new client form')
          },
          no: function () {
          }
      }
    });    
  })

  $("#modifica-cliente .save-link").click(function(){          
    $.confirm({
      title: '',
      content: 'Vuoi modificare questo cliente?',
      buttons: {
          si: function () {              
              $("#newClientForm").submit()
              console.log('Submitting new client form')
          },
          no: function () {
          }
      }
    });       
  })

  $('.custom-checkbox').click(function(){
    if($(this).attr("value") == 0 || $(this).attr("value") == null) {
      $(this).attr("value", 1)  
    } else {
      $(this).attr("value", 0)  
    }    
  })



})
  

