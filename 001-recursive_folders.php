<?php
  /**
   *
   */
  class RecursivFolderPrinter
  {
    public function doPrint($path){
      if(!file_exists($path)){
        throw new Exception("File/Folder {$path} does not exist.");
      }
      //the only output call is here
      echo realpath($path) . "\n";
      //here goes the recursive logic
      if(is_dir($path)){
          $files = scandir($path);
          foreach ($files as $file) {
            if($file != "." and $file != ".."){
              //here the root path must be prepended to prevent infinite loops
              //in case of a child folder has the same name as it's parent.
              //furthermore it's necessary to jump in to deeper levels.
              $this->doPrint($path."/".$file);
          }
        }
      }
    }
  }

  $folderPrinter = new RecursivFolderPrinter();
  $folderPrinter->doPrint("./");
