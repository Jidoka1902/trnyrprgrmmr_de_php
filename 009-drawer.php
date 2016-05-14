<?php
  /**
   *
   */
  class BoxFactory
  {
    public function createBoxes($amount){
      
    }
  }

  class Box
  {
    //corners bottom left, bottom richt, upper right, upper left
    private $upperLeft;
    private $size;

    public function __construct(Size $size, $color){
      $this->upperLeft = new Coordinate(0,0);
      $this->size = $size;
    }

    public function getUpperLeftCoord(){
      return $this->upperLeft;
    }

    public function getBottomRightCoord(){
      $bottomRight = clone $this->upperLeft;
      return $bottomRight->substractY($this->size->getHeight())->addX($this->size->getWidth());
    }
  }

  class Size
  {
    private $height, $width;

    public function __construct($height, $width){
      $this->height = $height;
      $this->width = $width;
    }

    public function getHeight(){
      return $this->height;
    }

    public function getWidth(){
      return $this->width;
    }
  }

  class Quadrat extends Size
  {
    public function __construct($height){
      parent::__construct($height, $height);
    }
  }

  class Coordinate
  {
    private $x;
    private $y;

    public function __construct($x, $y){
      $this->x = $x;
      $this->y = $y;
    }

    public function getX(){
      return $this->x;
    }

    public function getY(){
      return $this->y;
    }

    public function substractSize(Size $size){
      $this->x -= $size->getWidth;
      $this->y -= $site->getHeight;
    }

    public function addSize(Size $size){
      $this->x += $size->getWidth;
      $this->y += $site->getHeight;
    }

    public function addX($x){
      $this->x += $x;
      return $this;
    }

    public function substractX($x){
      $this->x -= $x;
      return $this;
    }
    public function addY($y){
      $this->y += $y;
      return $this;
    }

    public function substractY($y){
      $this->y -= $y;
      return $this;
    }
  }
 ?>
