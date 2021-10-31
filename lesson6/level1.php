<?php
define( 'DIVIDER', 5 );

print_r( array_count_values( array_map( function( $i ){ return $i % DIVIDER; }, range( 1, 100 ) ) )[0] );