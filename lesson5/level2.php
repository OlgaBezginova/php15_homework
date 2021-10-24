<?php

$chars = 'abcdefghijklmnopqrstuvwxyz';

$string_array = [];
$results_array = [];

for( $i = 0; $i < 10; $i++ ) {
    $string = '';
    $length = rand( 1, 10 );
    for ( $j = 0; $j < $length; $j++ ) {
        $string .= $chars[rand( 0, strlen( $chars ) )];
    }
    $string_array[] = $string;
}

foreach( $string_array as $string ){
    $results_array[$string] = symbols_count( $string );
}

print_r( $results_array ) ;

function symbols_count( $string ) {
    $symbols_count = [];
    $symbols = str_split( $string, 1 );
    foreach( $symbols as $symbol ) {
        $symbols_count[$symbol] = substr_count( $string, $symbol );
    }
    return $symbols_count;
}