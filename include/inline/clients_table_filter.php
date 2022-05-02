<script>
	// TableFilter
	var tf = new TableFilter(document.querySelector('#clientsTable'), {
	    base_path: 'vendors/scripts/tablefilter/',
	    paging: {
          results_per_page: ['Utenti per pagina: ', [15, 25, 50, 100]]
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
		extensions: [{ name: 'sort' }],		
	});
	tf.init();
</script>