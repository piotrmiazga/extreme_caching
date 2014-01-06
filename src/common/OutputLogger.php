<?php

class OutputLogger implements Logger {
   
   private static $_endline;

   private function getEndlineCharacter() {
     if (self::$_endline === null) {
         self::$_endline = (php_sapi_name() == 'cli' ? '' : '<br>') . PHP_EOL;
     }
     return self::$_endline;
   }


    public function log($what) {
      echo $what . $this->getEndlineCharacter();
    }


}
