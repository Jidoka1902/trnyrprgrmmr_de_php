<?php
  /**
   *
   */
  class NumberGuesser
  {
    private $numberToGuess;
    private $low;
    private $high;

    function __construct($low, $high)
    {
      $this->low = $log;
      $this->high = $high;
      $this->numberToGuess = rand($low, $high);
    }

    public function start(){
      echo "Bitte erraten Sie die gesuchte Zahl, sie befindet sich zwischen {$this->low} und {$this->high}.\n";
      $count = 1;
      while(true){
        echo "Ihr {$count}. Versuch: ";
        $count++;
        $input = trim(fgets(STDIN));
        if($input > $this->numberToGuess){
          echo "Die gesuchte Zahl ist Kleiner.\n";
        }
        elseif($input < $this->numberToGuess){
          echo "Die gesuchte Zahl ist Grösser.\n";
        }
        else{
          echo "Glückwunsch, die von Ihnen eingegebene Zahl ({$input}) stimmt mit der gesuchten zahl überein.";
          break;
        }
      }
    }
  }

  $guesser = new NumberGuesser(1,100);
  $guesser->start();
