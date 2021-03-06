<?php

class CacheWrapper extends ObjectWrapper {

    /**
     * @var Cache
     */
    protected $_cache;
    /**
     * @var int
     */
    protected $_ttl;

    public function __construct($object, Cache $cache, $ttl = 0) {
        $this->_cache = $cache;
        $this->_ttl = $ttl;
        parent::__construct($object);
    }

    public function __call($method, $arguments) {
        $parts = explode('_', $method);
        $param = array_shift($parts);
        $wrappedMethod = implode('_', $parts);
           

        switch($param) {
            case 'flush' :
                return $this->_flushCache($wrappedMethod, $arguments);
            case 'key' :
                return $this->_createKey($wrappedMethod, $arguments);
            case 'cached' :
                return $this->_fetchFromCache($wrappedMethod, $arguments);
            default :
                return parent::__call($method, $arguments);
        }
    }

    private function _fetchFromCache($method, $arguments) {
        $cacheKeyName = $this->_createKey($method, $arguments);
        $returnValue = $this->_cache->get($cacheKeyName);
        if (!$this->_cache->isHit()) {
            $returnValue = parent::__call($method, $arguments);
            $this->_cache->set($cacheKeyName, $returnValue, $this->_ttl);
        }
        return $returnValue;
    }

    private function _createKey($method, $arguments) {
        $printableArguments = implode(',', $arguments);
        return sprintf('%s::%s(%s)', get_class($this->getWrapped()), $method, $printableArguments);
    }

    private function _flushCache($method, $arguments) {
        return $this->_cache->delete($this->_createKey($method, $arguments));
    }
}

