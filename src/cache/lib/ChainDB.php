<?php
  
class ChainDB implements ChainRepo {


    public function get($key) {
       sleep(3);
       return "Example message got from ChainDB, getting $key";
    }

  }


?>
