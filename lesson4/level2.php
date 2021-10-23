<?php

$strings = reader( __FILE__ );
$lengths = measure( $strings );
$average = array_sum( $lengths ) / count( $lengths );

$long_strings = [];
foreach( $strings as $string) {
    if( strlen( $string ) > $average ) {
        $long_strings[] = $string;
    }
}

writer( 'output.txt', $long_strings );

function reader( $filename ) {
    return file( $filename );
}

function measure( $strings ) {
    $lengths = [];
    foreach ( $strings as $string) {
        $lengths[] = strlen( $string );
    }
    return $lengths;
}

function writer( $filename, $strings ) {
    if(  file_exists( $filename ) ) {
        unlink($filename);
    }
    $handle = fopen( $filename, 'a' );
    foreach( $strings as $string ) {
        fwrite( $handle, $string );
    }
    fclose( $handle );
}