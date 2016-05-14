<?php
  class RomanNumberConverter
  {
    private $symbols;

    public function __construct()
    {
      $this->symbols = array(
        1 => 'I', 5 => 'V', 10 => 'X', 50 => 'L', 100 => 'C',
        500 => 'D', 1000 => 'M'
      );
    }

    public function convert($number){
      if($this->isRomanNumber($number)){
        // echo "identified roman number input\n";
        return $this->convertToArabicNumber($number);
      }elseif($this->isArabicNumber($number)){
        if($number > 3999){
          throw new Exception("Numbers larger than 3999 unsupported!");
        }
        // echo "identified arabic number input\n";
        return $this->convertToRomanNumber($number);
      }
    }

    private function isRomanNumber($number){
      $pattern = "/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/";
      return preg_match($pattern, $number) ? true : false;
    }

    private function isArabicNumber($number){
      return is_numeric($number);
    }

    private function convertToArabicNumber($number){
      $romanInput = $number;
      $translations = array_flip($this->symbols);

      $arabicEquivalent = 0;
      $lastValue = 0;
      for ($i=strlen($romanInput)-1; $i >= 0; $i--) {
        if($lastValue <= $translations[$romanInput[$i]]){
          $arabicEquivalent += $translations[$romanInput[$i]];
        }else{
          $arabicEquivalent -= $translations[$romanInput[$i]];
        }
        $lastValue = $translations[$romanInput[$i]];
      }
      return $arabicEquivalent;
    }

    //seems much more complex than other converter, any possibility to ease this?
    private function convertToRomanNumber($number){
      $converted = "";
      $translation = $this->symbols;
      krsort($translation);
      // $buffer = "";
      $prev = $minusTwo = array('arabic' => '', 'roman' => '');
      //iterate from greatest to smallest number
      foreach ($translation as $arabic => $roman) {
        $buffer = "";

        $numberLen = strlen((string)$number);
        $prevLen = strlen((string)$prev['arabic']);
        $sub = $prev['arabic'] / 10;
        //case last number before number of digits gets expanded
        if($numberLen < $prevLen and $number >= ($prev['arabic'] - $sub)){
          $buffer = $translation[$sub] . $prev['roman'];
          $number -= ($prev['arabic'] - $sub);
        }elseif($number >= $arabic){
          $quotient = $number / $arabic;
          //case for appending up to 3 single signs
          if($quotient < 4){
            while($number >= $arabic){
              $buffer .= $roman;
              $number -= $arabic;
            }
          //case for signs which follows the prepend single sign rule
          }elseif($quotient < 5){
            $buffer = $roman . $prev['roman'];
            $number -= 4*$arabic;
          }

        }
        $converted .= $buffer;
        $prev = array('arabic' => $arabic, 'roman' => $roman);
      }
      return $converted;
    }
  }
  $converter = new RomanNumberConverter();

  while(true){
    echo "Geben Sie eine Zahl ein: ";
    $input = trim(fgets(STDIN));
    if($input == ""){
      echo "Converter exited\n";
      break;
    }
    $converted = $converter->convert($input);
    echo "entspricht: {$converted}\n";
  }
