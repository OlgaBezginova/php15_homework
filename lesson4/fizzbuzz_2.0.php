<?php

fizzbuzz_generator('input.txt', 'output.txt');

//read rows from the input file, calculate fizzbuzz, write to the output file
function fizzbuzz_generator($input_name, $output_name, $rows = 20) {
    if( ! file_exists( $input_name ) ) {
        input_file_generator( $input_name, $rows );
        echo "new file $input_name was generated\n";
    } else {
        echo "existed file $input_name was used\n";
    }

    if(  file_exists( $output_name ) ) {
        unlink($output_name);
    }

    $input = fopen($input_name, 'r');
    $output = fopen($output_name, 'a');
    while( ! feof( $input ) ){
        $input_string = fgets( $input );
        if( $input_string ) {
            $data = explode(' ', $input_string);
            fwrite($output, fizzbuzz( (int) $data[0], (int) $data[1], (int) $data[2]) . PHP_EOL);
        }
    }
};

//generate the input file from an array of random strings
function input_file_generator( $filename, $rows ) {
    $input_strings = random_rows_generator( $rows );
    $input = fopen( $filename, 'a' );
    $callback = function($row) use ($input) {
        fwrite( $input, $row.PHP_EOL );
    };
    array_map( $callback, $input_strings );
    fclose( $input );
}

//generate an array of random strings
function random_rows_generator( $rows, $min = 1, $max = 20 ) {
    $data = [];
    for($i = 0; $i < $rows; $i++ ) {
        $data[] = implode( ' ', [ rand( $min, $max ), rand( $min, $max ), rand( $min, $max ) ] );
    }
    return $data;
}

//calculate a fizzbuzz string
function fizzbuzz( $fizz, $buzz, $limit ) {
    $result = '';
    for( $i = 1; $i <= $limit; $i++ ) {
        if( ! ( $i % $fizz ) ) {
            $result .= 'F';
        }
        if( ! ( $i % $buzz ) ) {
            $result .= 'B';
        }
        if( ( $i % $fizz ) && ( $i % $buzz ) ){
            $result .= $i;
        }
        $result .= ' ';
    }
    return $result;
}