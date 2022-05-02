<script>
	// TableFilter
	var tf = new TableFilter(document.querySelector('#clientsTable'), {
	    base_path: '../vendor/tablefilter/',
	    paging: {
          results_per_page: ['Utenti per pagina: ', [10, 20, 50, 100]]
        },
	    alternate_rows: true,
	    loader: true,
	    no_results_message: false,
        auto_filter: true,
		col_types: [
	        'number',
	        'string',
	        'string',
	        'number',
	        'string',
	        'number',
	        'none'
		],
		help_instructions: false,			
		extensions: [{ name: 'sort' }],
		col_widths: [, , , , , , "10%"]
	});
	tf.init();
</script>