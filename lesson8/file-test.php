<?php

define( 'INPUT_NAME', 'input.txt' );
define( 'STRINGS', 20 );
define( 'MIN_COUNT', 2 );
define( 'MAX_COUNT', 10 );
define( 'MIN_NUM', 1 );
define( 'MAX_NUM', 100 );

generate_input( INPUT_NAME, STRINGS ) ;
test_file( INPUT_NAME ) ;

function generate_input( $file_name, $strings ) {
    if(  file_exists( $file_name ) ) {
        unlink( $file_name );
    }
    $input_file = fopen( $file_name, 'a' );
    for ( $i = 0; $i < $strings; $i++ ) {
        $input_string = generate_string(MIN_COUNT, MAX_COUNT,  MIN_NUM, MAX_NUM );
        $input_string .=  ( $i < $strings - 1 ) ? "\n" : '';
        fwrite( $input_file, $input_string );

    }
    fclose( $input_file );
}

function generate_string( $min_count, $max_count, $min_num, $max_num) {  // right/wrong string generation
    $input = [];
    for ( $i = 0; $i < rand( $min_count, $max_count ); $i++ ) {
        $input[] = rand( $min_num, $max_num );
    }

    $result = [];
    if ( rand( 0, 1 ) ) {
        $result[] =  intval( array_sum( $input ) / count( $input ) );
        $result[] =  array_sum( $input ) % count( $input );
    } else {
        $result[] =  rand( $min_num, $max_num );
        $result[] =  rand( $min_num, $max_num );
    }

    return implode( ' ', $input ) . ';' . implode( ' ', $result );
}

function test_file( $file_name ) {
    $input_file = fopen( $file_name, 'r' );
    while ( ! feof($input_file) ) {
        $input_string = fgets( $input_file );
        echo trim( $input_string ) . ' | ';
        echo test_string( $input_string ) . "\n";
    }
    fclose( $input_file );
}

function test_string( $string ) {
    list( $input, $result ) = explode( ';', $string );

    $input = explode( ' ', $input );
    array_map( 'intval', $input );

    $result = explode( ' ', $result );
    array_map( 'intval', $result );

    $integer = intval( array_sum( $input ) / count( $input ) );
    $remainder = array_sum( $input ) % count( $input );

    if ( $integer == (int) $result[0] && $remainder == (int) $result[1] ) {
        return 'TRUE';
    } else {
        return 'FALSE';
    }
}