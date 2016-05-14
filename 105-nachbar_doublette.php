<?php
  function countDoubles(array $input){

    $doubles = 0;
    $buffer = null;
    foreach ($input as $value) {
      $isDouble = false;
      if($buffer !== null){
        //do compasirion only if buffer is initialized
        if($buffer === $value){
          $doubles++;
          $isDouble = true;
        }
      }
      //if current index is a double, do not remember for comparison with next one
      if($isDouble){
        $buffer = null;
      }else{
        $buffer = $value;
      }
    }
    return $doubles;
  }

  $input = array(3,3,7);
  echo countDoubles($input) . "\n";
  $input = array(3,3,3,3);
  echo countDoubles($input) . "\n";
  $input = array(0, 3, 3, 3, 2, 7, 7, 7, 7, 3, 2, 1, 1, -2, 4, 4, 8, 9, 8, 6);
  echo countDoubles($input) . "\n";
