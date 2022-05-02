$(document).ready(function() { 
  $("#loginForm").submit(function(e) {

    e.preventDefault()
    var form = $(this)    
    var url = form.attr('action')

    $.ajax({
      type: "POST",
      url: url,
      async: true,
      data: form.serialize(),
      success: function(data)
      {
        console.log(data)
        if (data == true) {
          //console.log(data)
          window.location = "http://localhost/landing/pages/dashboard.php"  
        } else if (data == false) {
          //console.log(data)
          $('.error-box').addClass("animated fadeIn")
          //window.location = "http://localhost/landing/pages/login.php"
        }        
      }
    })
  })
})