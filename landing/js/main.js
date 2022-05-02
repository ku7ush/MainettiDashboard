$(document).ready(function() {    
    $(window).scroll( function(){    		    		
        	if ($(this).scrollTop() >= 400) {        		
        		$('#backToTop').addClass("animated fadeInUp")
            } else if ($(this).scrollTop() <= 399){        		
        		$('#backToTop').addClass("fadeOut")
        		$('#backToTop').removeClass("animated fadeOut fadeInUp")
            }        
    })

    $('.navbar-nav').hover(function(){
    	$(this).find('.social-items').toggleClass('showme')
    })
})