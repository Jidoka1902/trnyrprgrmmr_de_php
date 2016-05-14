<?php
  class CrossSumCalculator
  {
    public function calculate($number){
      if(!is_numeric($number)){
        throw new Exception("Input must be a Number!");
      }
      $number = (string)$number;
      $sum = 0;
      for ($i=0; $i < strlen($number); $i++) {
        $sum += $number[$i];
      }
      return $sum;
    }
  }

  $calculator = new CrossSumCalculator();

  //Part 1: Calculate Crosssums from 0 to 99
  foreach (range(0, 99, 1) as $number) {
    echo "Die Quersumme von {$number} ist: {$calculator->calculate($number)}\n";
  }

  //Part 2: Calculate Crosssums for Console-Inputs
  while(true){
    echo "Quersumme berechnen von: ";
    $input = trim(fgets(STDIN));
    if($input == ""){
      echo "Calculator exited\n";
      break;
    }
    echo "Die Quersumme von {$input} ist: {$calculator->calculate($input)}\n";
  }
