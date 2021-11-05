<?php
echo "Please enter a non-negative odd number:\n";

$handler = fopen( 'php://stdin', 'r' );

while ( true ) {
  $num = (int) fgets( $handler );
  if ( $num < 0 || ! ( $num % 2 ) ) {
    echo "Wrong number! Try again:\n";
  } else {
    diamond( $num );
    break;
  }
}

function diamond( $num ){
  for ( $i = 1; $i < $num; $i += 2 ){
    $empties = ( $num - $i) / 2;
    echo str_repeat( ' ',  $empties ).str_repeat( '*',  $i ).str_repeat( ' ',  $empties )."\n";
  }

  for ( $i = $num; $i > 0; $i -= 2 ){
    $empties = ( $num - $i) / 2;
    echo str_repeat( ' ',  $empties ).str_repeat( '*',  $i ).str_repeat( ' ',  $empties )."\n";
  }
}