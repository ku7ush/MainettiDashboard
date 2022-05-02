<?php
function console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        //$output = implode( ',', $output);
    	$output = json_encode($output);


    echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
}

?>