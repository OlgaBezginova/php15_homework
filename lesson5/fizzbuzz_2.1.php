<?php
//lesson 4
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
        unlink( $output_name );
    }

    $input = file( $input_name );
    $output = fopen($output_name, 'a');

    $func = function( $input_string ) use ( $output ) {
        if( $input_string ) {
            fwrite( $output, fizzbuzz( $input_string ) . PHP_EOL );
        }
    };

    array_map($func, $input);
};

//generate the input file from an array of random strings
function input_file_generator( $filename, $rows ) {
    $input_strings = random_rows_generator( $rows );
    $input = fopen( $filename, 'a' );
    $callback = function( $row ) use ( $input ) {
        fwrite( $input, $row . PHP_EOL );
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
function fizzbuzz( $string ) {

    $data = explode( ' ', $string );

    list($fizz, $buzz, $limit) = $data;

    $data = range( 1, $limit );

    $func = function( $i ) use ( $fizz, $buzz ) {
        $result = '';
        if( ! ( $i % $fizz ) ) {
            $result .= 'F';
        }
        if( ! ( $i % $buzz ) ) {
            $result .= 'B';
        }
        if( ( $i % $fizz ) && ( $i % $buzz ) ) {
            $result = $i;
        }
        return $result;
    };

    $data = array_map( $func, $data );

    return implode( ' ', $data );
}