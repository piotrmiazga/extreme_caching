<?php
class APCCache implements Cache {

    private $_wasSuccessful = false;

    public funtion get($key) {
        return apc_fetch($key, $this->_wasSuccessful);    
    }

   public function isHit() {
       return $this->_wasSuccessful;
   }

   public function set($key, $value, $ttl = 0) {
       return apc_store($key, $value, $ttl);
   }

   public function delete($key) {
      return apc_delete($key);
   }

   public function add($key, $value, $ttl = 0) {
       return apc_add($key, $value, $ttl);
   }

}
