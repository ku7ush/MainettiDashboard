$(document).ready(function() { 
	console.log('Aggiungi linea js loaded')
	$("#product_modal_select option").first().prop("selected",true)
	$("#qty").val(1)
	$("#qty").trigger("change")
})