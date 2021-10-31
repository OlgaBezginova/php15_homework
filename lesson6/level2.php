<?php
$start = microtime( true );

define( 'PRIMES', 100 );

$sum = 2;
$primes = PRIMES;
$num = 2;
while ( $primes - 1 ) {
    $num++;
    if ( ! ( $num % 2 ) ) {
        continue;
    }
    if ( is_prime( $num ) ) {
        $sum += $num;
        $primes--;
    }
}

function is_prime( $num ) {
    for ( $i = 3; $i <= ceil( sqrt( $num ) ); $i++ ) {
        if( ! ( $num % $i ) ) {
            return false;
        }
    }
    return true;
}

echo $sum;

$time = microtime( true ) - $start;
echo ' ' . $time;