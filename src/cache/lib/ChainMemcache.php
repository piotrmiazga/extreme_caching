<?php

class ChainMemcache implements ChainRepo {
    const KEYNAME = 'chainmemcache';

    private $_repo;
    private $_cache;


    public function __construct(ChainRepo $repo, Cache $cache) {
       $this->_repo = $repo;       
       $this->_cache = $cache;
    }


   public function get($key) {
      $keyname = $this->_createCacheKeyname($key);
      
      $data = $this->_cache->get($keyname);
      if (!$this->_cache->isHit()) {
          $data = $this->_fetchIntoCacheAndReturn($key);
      }
      
      return $data;
   }

   
   private function _fetchIntoCacheAndReturn($key) {
      $keyname = $this->_createCacheKeyname($key);
      $data = $this->_repo->get($key);
      $this->_cache->set($keyname, $data, 60);
      return $data;
   }

   private function _createCacheKeyname($key) {
      return self::KEYNAME . "_$key";
   }


}

