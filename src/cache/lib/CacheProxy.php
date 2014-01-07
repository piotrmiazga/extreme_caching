<?php

class CacheWrapper extends ObjectWrapper {

    /**
     * @var Cache
     */
    protected $_cache;
    /**
     * @var int
     */
    protected $ttl;

    public function __construct($object, Cache $cache, $ttl = 0) {
        $this->_cache = $cache;
        $this->_ttl = $ttl;
        parent::__construct($object);
    }

    public function __call($method, $arguments) {
        $parts = explode('_', $method);
        $param = array_shift($parts);
        $wrappedMethod = implode('_', $method);

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
            $this->_cache->set($cacheKeyName, $returnValue, $this->ttl);
        }
        return $returnValue;
    }

    private function _createKey($method, $arguments) {
        $printableArguments = implode(',', $arguments);
        return sprintf('%s::%s(%s)', $this->getWrapped(), $method, $printableArguments);
    }

    private function _flushCache($method, $arguments) {
        return $this->_cache->delete($this->_createKey($method, $arguments));
    }
}


class SessionHandler implements SessionHandlerInterface {

    public bool close()
    public bool destroy( string $session_id )
    public bool gc( int $maxlifetime )
    public bool open( string $save_path , string $session_id )
    public strin gread( string $session_id )
    public bool write( string $session_id , string $session_data )
}