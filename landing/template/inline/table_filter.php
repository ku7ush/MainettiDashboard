<script>
	// TableFilter
	var tf = new TableFilter(document.querySelector('#ordersTable'), {
	    base_path: '../vendor/tablefilter/',
	    alternate_rows: true,
	    paging: {
          results_per_page: ['Ordini per pagina: ', [10, 25, 50, 100]]
        },
	    loader: true,
	    no_results_message: false,
        auto_filter: true,
		col_types: [
	        'number',
	        'string',
	        'string',
	        { type: 'formatted-number', decimal: '.', thousands: ',' },
	        { type: 'formatted-number', decimal: '.', thousands: ',' },
	        'string'
		],							
		extensions: [{ name: 'sort' }],
		help_instructions: false,		
	});
	tf.init();
</script>