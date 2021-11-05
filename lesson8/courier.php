<?php
$handle = fopen('php://stdin', 'r');

echo "Please enter a flat number:\n";
$flat_num = (int) fgets($handle);
echo "Please enter number of flats on a floor:\n";
$flats_on_floor = (int) fgets($handle);
echo "Please enter number of floors:\n";
$floors = (int) fgets($handle);

find_flat( $flat_num, $flats_on_floor, $floors);

function find_flat( $flat_num, $flats_on_floor, $floors ) {
  //find entrance
  $flats_in_entrance = $flats_on_floor * $floors;
  $entrance = intval( $flat_num / $flats_in_entrance );
  if ( $flat_num % $flats_in_entrance ) { 
    $entrance++;
  }  
  //find floor
  $floor = ceil( ( $flat_num / $flats_on_floor ) - ($entrance - 1) * $floors );  
 
  echo "The flat № $flat_num is in the $entrance entrance on the $floor floor";
}