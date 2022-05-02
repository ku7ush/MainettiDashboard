$(document).ready(function() { 
	console.log('Modifica linea js loaded')	
	$("#product_modal_select").find('option[selected="selected"]').prop("selected",true)
	$("#product_modal_select").trigger('change')
	$("#qty").trigger("change")
})