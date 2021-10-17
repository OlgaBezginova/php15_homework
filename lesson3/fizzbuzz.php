<?php

$handle = fopen ("php://stdin","r");
echo "Enter fizz number: ";
$fizz = (int) fgets($handle);
echo "Enter buzz number: ";
$buzz = (int) fgets($handle);
echo "Enter limit number: ";
$num = (int) fgets($handle);

for( $i = 1; $i <= $num; $i++ ) {

    if( ! ( $i % $fizz ) ) {
        echo 'F';
    }
    if( ! ( $i % $buzz ) ) {
        echo 'B';
    }
    if( ( $i % $fizz ) && ( $i % $buzz ) ){
        echo $i;
    }

    echo ' ';

}