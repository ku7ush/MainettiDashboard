<?php

session_start();

include		"../functions/actions.php";

$content =
'<form id="lineForm" class="editRow" data-row="' . $_POST['name'] . '">'.
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Prodotto</label>' .
		'<select id="product_modal_select" disabled class="custom-select col-12 form-control">' .				
			'<option value="' .$_POST['name']. '">' .$_POST['name'] . '</option>' .
    '</select>' .
	'</div>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Prezzo unitario</label>' .
		'<input type="text" class="form-control" disabled id="prezzou" name="prezzou" value="'. $_POST['prezzo'] .'"/>'.
	'</div>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Quantità</label>' .
		'<input type="text" disabled class="form-control" id="qty" name="qty" min="1" value="' . $_POST['qty'] . '"/>'.
	'</div>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Sconto</label>' .
		'<input type="text" disabled class="form-control" id="discount" name="discount" min="0" value="' . $_POST['discount'] . '"/>' .
	'</div>' .
	'<br>' .
	'<br>' .
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Subtotale</label>' .
		'<input type="text" class="form-control" disabled id="parziale" name="parziale" value="'. $_POST['subtotal'] .'"/>' .
	'</div>' .	
	'<div class="form-group row">' .
		'<label class="col-sm-12 col-md-4 col-form-label">Totale</label>' .
		'<input type="text" class="form-control" disabled id="total" name="total" value="' . $_POST['total'] . '"/>' .
	'</div>' .
	'<br>' .
	'<br>' .	
'</form>
<script>
	$(document).ready(function() {
		$("#product_modal_select").val("' . $_POST['name'] . '")		
	})
</script>'
;

echo $content;

?>