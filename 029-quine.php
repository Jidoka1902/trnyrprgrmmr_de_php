<?php
  /**
   *
   */
  class Quine
  {

    function __construct()
    {

    }

    public function printMyself(){
      $str = file_get_contents(__FILE__);
      echo $str;
    }
  }

  $quine = new Quine();
  $quine->printMyself();
