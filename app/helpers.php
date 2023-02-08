<?php

declare( strict_types = 1 );

function format_date( string $date ): string {
    return date( 'M j, Y', strtotime( $date ) );
}

function amount_color( float $amount ): string {
	if ( $amount > 0 ) {
		return 'green';
	} elseif ( $amount < 0 ) {
		return 'red';
	} else {
		return 'black';
	}
}

function format_amount( float $amount ): string {
    return number_format( $amount, 2 ) . '€';
}


//	Debug
if ( ! function_exists('vr_debug')) {
	function vr_debug ( $object , $name = '' ) {		
        if ( $name != '' ) {
            echo('\'' . $name . '\' : ');
        }

		if ( is_array ( $object ) ) {
			echo('<pre>');
			print_r( $object ); 
			echo('</pre>');
		} else {
			var_dump ( $object );
		}	
	}
}