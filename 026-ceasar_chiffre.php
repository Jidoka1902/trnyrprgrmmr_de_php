<?php
  /**
   *
   */
  class CaesarEncoder
  {

    public function encode($plainText, $offset){
      $encoded = "";
      for ($i=0; $i < strlen($plainText); $i++) {
        $ascii = ord($plainText[$i])+$offset;
        $encoded .= chr($ascii);
      }
      return $encoded;
    }

  }

  $encoder = new CaesarEncoder();

  while(true){
    echo "Geben Sie einen Text ein: ";
    $text = trim(fgets(STDIN));
    if($text == ""){
      echo "Encoder exited\n";
      break;
    }
    echo "Um wie viele Stellen soll verschoben werden: ";
    $offset = trim(fgets(STDIN));

    echo "Ergebnis: {$encoder->encode($text, $offset)}\n";
  }
