<?php
  function calculateRecursive($numbers, $level=1, $maxDepth){
    $counters = array();
    if(!is_string($numbers)){
      throw new Exception("Input must be a String");
    }
    echo $level.". Folge: " . $numbers."\n";
    $result = "";
    /**
     * the $i-loop sets the comparison start and DOES NOT ++ as usual. But
     * snaps to the last $j cursor if it breaks.
     */
    for ($i=0; $i < strlen($numbers); $i=$j) {
      $doubles = 0;
      for ($j=$i; $j < strlen($numbers); $j++) {
        if($numbers[$i] == $numbers[$j]){
          $doubles++;
          continue;
        }
        $result .= $doubles;
        break;
      }
    }
    $result .= $numbers;
    /**
     * $maxDepth defines here the maximum number of sequences calculated.
     */
    if($level < $maxDepth){
      calculate($result, $level+=1, $maxDepth);
    }
  }

  $firstSequence = "112";
  calculateRecursive($firstSequence, 1, 15);
