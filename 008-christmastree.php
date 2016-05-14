<?php
/**
 *
 */
class TreeBuilder
{

  public function buildTree($height, $stepHeight){
    if($height < 3){
      throw new Exception("Tree must have a minimum height of 3");
    }
    $tree = array();
    $rest = $height;
    $initialWidth = 1;
    # Tree Builder Loop until total hight-1 is builded
    while($rest > 1){
      # build the last smaller step, remove one unit of height for stem
      if($rest < $stepHeight){
        $stepHeight = $rest-1;
      }
      $rest -= $stepHeight;
      # build each step in a seperate logic block
      $step = $this->buildStep($initialWidth, $stepHeight);

      # add the built stem to the whole tree and calculate the initial with for
      # the next step
      foreach ($step as $key => $line) {
        $tree[] = $line;
        if($key == (count($step)-1)){
          $initialWidth = strlen($line)-2;
        }
      }
    }
    # add a stem and fulfill total height
    $tree[] = "###";
    # center builded tree
    $tree = $this->centerTree($tree);
    return $tree;
  }

  private function buildStep($initialWidth, $height){
    $step = array();
    $width = $initialWidth;
    for ($i=0; $i < $height; $i++) {
      $step[] = $this->makeLine($width);
      $width += 2;
    }
    return $step;
  }

  private function makeLine($length){
    $line = "";
    for ($i=0; $i < $length; $i++) {
      $line .= "*";
    }
    return $line;
  }

  private function centerTree(array $tree){
    $maxWidth = 0;
    foreach ($tree as $line) {
      $currentWidth = strlen($line);
      if($maxWidth < $currentWidth){
        $maxWidth = $currentWidth;
      }
    }
    $centeredTree = $tree;
    for ($i=0; $i < count($centeredTree); $i++) {
      $diff = $maxWidth - strlen($centeredTree[$i]);
      $padLeft = $diff / 2;
      for ($j=0; $j < $padLeft; $j++) {
        $centeredTree[$i] = " " . $centeredTree[$i];
      }
    }
    return $centeredTree;
  }

  public function printTree(array $tree){
    foreach ($tree as $line) {
      echo $line . "\n";
    }
  }

}

$treeBuilder = new TreeBuilder();
$tree = $treeBuilder->buildTree(10,3);
$treeBuilder->printTree($tree);
