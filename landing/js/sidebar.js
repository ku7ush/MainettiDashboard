$(document).ready(function() {    

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
 		// La sidebar scompare toccando altrove
	    $('.masthead').on("click", function(e){    	
	    	if ($('#sidebar').hasClass('show')) {
	    		$('#sidebar').toggleClass('show')
	    	}
	    })
	}

    // TRIGGERS AJAX

    $('#home-button').on("click", function(e){
    	e.preventDefault()

    	$(this).closest('.components').find('li.active').removeClass('active')
    	$(this).closest('li').addClass('active')

    	$('#loaded-content').addClass('fadeOut')

    	$.ajax({
	      type: "POST",
	      url: '../template/home.php',
	      async: true,
	      success: function(data)
	      {
	        //console.log(data)
	        $('#loaded-content').empty()
	        $('#loaded-content').append(data)
	        $('#content').find('#loaded-content').removeClass('fadeOut')
	      },
	      error: function(data)
	      {
	      	//console.log(data)
	      }
	    })
    })

    $('.menu-item').on("click", function(e){
    	e.preventDefault()
    	url = $(this).attr('href')
    	console.log(url)

    	$(this).closest('.components').find('li.active').removeClass('active')
    	$(this).closest('li').addClass('active')

    	$('#content').find('#loaded-content').addClass('fadeOut')

    	$.ajax({
	      type: "POST",
	      url: url,
	      async: true,
	      success: function(data)
	      {
	        //console.log(data)
	        $('#loaded-content').empty()
	        $('#loaded-content').append(data)
	        $('#loaded-content').removeClass('fadeOut')
	      },
	      error: function(data)
	      {
	      	//console.log(data)
	      }
	    })
    })
})