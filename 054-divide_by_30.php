<?php
  $range = range(1,5,1);

  $current = 1;
  $divided = false;
  while(!$divided){
    $faults = 0;
    foreach ($range as $number) {
      // echo "Number: " . $number."\n";
      $modulo = $current % $number;
      // echo "Modulo: " . $modulo."\n";
      if($modulo != 0){
        $faults++;
      }
    }
    if($faults === 0){
      $divided = true;
    }
    $current++;
    echo "Current: " . $current."\n";
  }

  if($divided){
    echo $current . "ist durch alle Zahlen von 1 bis 30 teilbar!";
  }
