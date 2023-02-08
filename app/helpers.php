<?php

declare(strict_types=1);

function formatDollarAmount(float $amount): string
{
    $isNegative = $amount < 0;

    return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
}

function formatDate(string $date): string
{
    return date('M j, Y', strtotime($date));
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