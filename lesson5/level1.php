<?php
$array = array_rand(  range( 1, 1000 ), 10 );
shuffle( $array ) ;

print_r( $array );
print_r( array_max( $array ) );

$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$string_array = [];
for( $i = 0; $i < 10; $i++ ) {
    $string = '';
    $length = rand( 1, 100 );
    for ( $j = 0; $j < $length; $j++ ) {
        $string .= $chars[rand( 0, strlen( $chars ) )];
    }
    $string_array[] = $string;
}

print_r( $string_array );
print_r( longest( $string_array ) );

function array_max( $array ) {
    $max = $array[0];
    for( $i = 1; $i < count( $array ); $i++ )  {
        if( $array[$i] >= $max ) {
            $max = $array[$i];
        }
    }
    return $max;
}

function longest( $array ) {
    $longest_str = $array[0];
    for( $i = 1; $i < count( $array ); $i++ )  {
        if( strlen( $array[$i] ) >= strlen( $longest_str) ) {
            $longest_str = $array[$i];
        }
    }
    return $longest_str;
}