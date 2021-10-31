<?php
$start = microtime( true );

define( 'PRIMES', 546 );

$numbers = range( 2, PRIMES );

function delete_composite( &$numbers, $p ) {
    for ( $i = 2 * $p; $i <= PRIMES; $i += $p ) {
        unset( $numbers[array_search( $i, $numbers)] );
    }
}

foreach ( $numbers as $num ) {
    if ( $num * $num < PRIMES ) {
        delete_composite( $numbers, $num );
    }
}

$numbers = array_merge( [2], $numbers );

print_r( array_sum( $numbers ) );

$time = microtime( true ) - $start;
echo ' ' . $time;