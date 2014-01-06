<?php

abstract class UseCase {
    private $_memcacheCache;
    private $_requestCache;

    public function __construct() {
        $this->init();
    }

    protected function init() {
    }

    protected function getMemcache() {
       if ($this->_memcacheCache === null) {
           $this->_memcacheCache = new MemcacheCache();
           $this->_memcacheCache->addServer('localhost', 11211);
       }
       return $this->_memcacheCache;
    }

    abstract public function execute();
}
