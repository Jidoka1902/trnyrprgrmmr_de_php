<?php
  class Rainfall
  {
    private $month;
    private $quantity;
    public function __construct($month, $quantity){
      $this->month = $month;
      $this->quantity = $quantity;
    }

    public function getMonth(){
      return $this->month;
    }

    public function getQuantity(){
      return $this->quantity;
    }
  }

  class RainMeter
  {
    private $rainfall;

    public function __construct(){
      $this->rainfall = array();
    }

    public function addRainfall(Rainfall $rainfall){
      $this->rainfall[] = $rainfall;
    }

    public function getRainfall(){
      return $this->rainfall;
    }

    public function getAverageRainfall(){
      $total = 0;
      $count = 0;
      foreach ($this->rainfall as $rainfall) {
        $total += $rainfall->getQuantity();
        $count++;
      }
      return $total / $count;
    }
  }

  $rainMeter = new RainMeter();
  $rainMeter->addRainfall(new Rainfall("April", 12));
  $rainMeter->addRainfall(new Rainfall("Mai  ", 14));
  $rainMeter->addRainfall(new Rainfall("Juni ", 8));

  foreach ($rainMeter->getRainfall() as $rainfall) {
    echo "Niederschlag im " . $rainfall->getMonth() . ":\t" . $rainfall->getQuantity() . "\n";
  }

  echo "Durchschnitt:\t\t" . $rainMeter->getAverageRainfall()."\n";
