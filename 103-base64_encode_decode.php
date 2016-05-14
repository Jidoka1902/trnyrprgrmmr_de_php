<?php
  class Base64Example
  {
    private $symbols;

    public function __construct(){
      $this->symbols = array(
        0 => "A", 1 => "B", 2 => "C", 3 => "D",  4 => "E", 5 => "F", 6 => "G",
        7 => "H", 8 => "I", 9 => "J", 10 => "K", 11 => "L", 12 => "M", 13 => "N",
        14 => "O", 15 => "P", 16 => "Q", 17 => "R", 18 => "S", 19 => "T", 20 => "U",
        21 => "V", 22 => "W", 23 => "X", 24 => "Y", 25 => "Z",
        26 => "a", 27 => "b", 28 => "c", 29 => "d", 30 => "e", 31 => "f", 32 => "g",
        33 => "h", 34 => "i", 35 => "j", 36 => "k", 37 => "l", 38 => "m", 39 => "n",
        40 => "o", 41 => "p", 42 => "q", 43 => "r", 44 => "s", 45 => "t", 46 => "u",
        47 => "v", 48 => "w", 49 => "x", 50 => "y", 51 => "z", 52 => "0", 53 => "1",
        54 => "2", 55 => "3", 56 => "4", 57 => "5", 58 => "6", 59 => "7", 60 => "8",
        61 => "9", 62 => "+", 63 => "/",
      );
    }
    /**
     * encodes an input string into a base64 string
     */
    public function encode($data){
      $bytes = strlen($data);
      echo "input Data is {$bytes} Bytes long \n";
      $rest = $bytes % 3;
      $bytesToAppend = 3 - $rest;
      echo $bytesToAppend . " Bytes must be appended \n";
      $byteArray = array();

      //1. convert $data to base-2 bytes
      for ($i=0; $i < $bytes; $i++) {
        $byteArray[] = str_pad(base_convert(ord($data[$i]), 10, 2), 8, "0", STR_PAD_LEFT);
      }
      //2. append 0-filled byte(s) to become divisible by 3
      for ($i=0; $i < $bytesToAppend; $i++) {
        $byteArray[] = "00000000";
      }

      $base64Array = array();
      $byteString = implode($byteArray, "");

      //3. rearrange 8-bit parts into 6-bit parts
      while (!empty($byteString)) {
        $base64Array[] = substr($byteString, 0, 6);
        $byteString = substr($byteString, 6);
      }

      //4. build encoded result, replace fill-bytes with "="
      foreach ($base64Array as &$base64Encoding) {
        if($base64Encoding !== "000000"){
          $base64Encoding = $this->symbols[base_convert($base64Encoding, 2, 10)];
        }else{
          $base64Encoding = "=";
        }
      }
      return implode($base64Array, "");

    }
    /**
     * takes an base64 encoded string and decodes it into an binary file format
     */
    public function decode($data){
      $base64Array = array();
      $values = array_flip($this->symbols);
      $fillBytes = 0;
      //1.translate characters into 6-bit blocks
      for ($i=0; $i < strlen($data); $i++) {
        if($data[$i] != "="){
          $base64Array[] = str_pad(base_convert($values[$data[$i]], 10, 2), 6, "0", STR_PAD_LEFT);
        }else{
          $base64Array[] = "000000";
          $fillBytes++;
        }
      }

      //2. rearrange 6-bit blocks into 8 bit blocks
      $base64ByteString = implode($base64Array, "");
      $decodedByteArray = array();

      while(!empty($base64ByteString)){
        $decodedByteArray[] = substr($base64ByteString, 0, 8);
        $base64ByteString = substr($base64ByteString, 8);
      }

      //3. remove appended fill block(s)
      for ($i=0; $i < $fillBytes; $i++) {
        unset($decodedByteArray[count($decodedByteArray)-1]);
      }
      $result = "";
      //4. translate into decoded result
      foreach ($decodedByteArray as $decodedByte) {

        $result .= chr(base_convert($decodedByte, 2, 10));
      }
      return $result;
    }
  }

  $input = "Polyfon zwitschernd aßen Mäxchens Vögel Rüben, Joghurt und Quark";
  $baseCoder = new Base64Example();
  $base64String = $baseCoder->encode($input);
  echo $base64String . "\n";
  //double-check result with spl implementation
  echo base64_encode($input) . "\n";

  echo $baseCoder->decode($base64String);
