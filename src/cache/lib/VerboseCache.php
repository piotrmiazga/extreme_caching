<?php
class VerboseCache extends ObjectWrapper implements Cache {

    /**
     * @var Logger
     */
    private $_logger;
   

    public function __construct($object, Logger $logger) {
      $this->_logger = $logger;
      parent::__construct($object);
    }

    public function get($key) {
      $this->_logger->log("GET:$key");
      return $this->getWrapped()->get($key);
    }

    public function isHit() {
        $this->_logger->log("ISHIT");
        return $this->getWrapped()->isHit();
    }

    public function set($key, $value, $ttl = 0) {
        $this->_logger->log("SET:$key=$value(TTL=$ttl)");
        return $this->getWrapped()->set($key, $value, $ttl);
    }
    
    public function delete($key) {
      $this->_logger->log("DELETE:$key");
      return $this->getWrapped()->delete($key);
    }
  

    public function add($key, $var, $ttl = 0) {
      $this->_logger->log("ADD:$key");
      return $this->getWrapped()->add($key);
    }

}
