<?php
//input filename: level1.php
//output filename: output.txt

writer( 'output.txt', reader( __FILE__ ) );

function reader( $filename ) {
    $data = [];
    $handle = fopen( $filename, 'r' );
    while( ! feof( $handle ) ) {
        $data[] = fgets( $handle );
    }
    fclose( $handle );
    return $data;
}

function writer( $filename, $data ) {
    if(  file_exists( $filename ) ) {
        unlink($filename);
    }

    $handle = fopen( $filename, 'a' );
    foreach( $data as $i => $string ) {
        if( ! ( $i % 2 ) ) {
            fwrite( $handle, $string );
        }
    }
    fclose( $handle );
}