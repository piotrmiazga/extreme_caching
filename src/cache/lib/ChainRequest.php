<?php

class ChainRequest implements ChainRepo {
    const KEYNAME = 'chainmemcache';

    private $_repo;
    private $_data = [];

    public function __construct(ChainRepo $repo) {
       $this->_repo = $repo;       
    }


   public function get($key) {
      if (!$this->_keyExistsInCache($key)) {
          $this->_fetchKeyToCache($key);
      }
      return $this->_getKeyFromCache($key);
   }

   private function _keyExistsInCache($key) {
       return array_key_exists($key, $this->_data);
   }

   private function _fetchKeyToCache($key) {
       $this->_data[$key] = $this->_repo->get($key);
   }
   
   private function _getKeyFromCache($key) {
     return $this->_data[$key];
   }


}

