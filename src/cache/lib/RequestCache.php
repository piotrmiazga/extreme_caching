<?php
require_once('Cache.php');

class RequestCache implements Cache {

    private static $cache = [];
    private static $isHit = null;

    /**
     * Gets key from cache
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        self::$isHit = array_key_exists($key, self::$cache);
        return self::$isHit ? self::$cache[$key] : false;
    }

    /**
     * If previous get() function call was hit returns true otherwise false
     * @return bool
     */
    public function isHit()
    {
        return self::$isHit;
    }

    /**
     * Sets key in cache
     *
     * @param $key string
     * @param $value mixed
     * @param $ttl int
     * @return bool
     */
    public function set($key, $value, $ttl = 0)
    {
        self::$cache[$key] = $value;
        return true;
    }

    /**
     * Removes key from cache
     *
     * @param $key string
     * @return bool
     */
    public function delete($key)
    {
        unset(self::$cache[$key]);
    }

    public function flush() {
        self::$cache = [];
        self::$isHit = null;
    }

}
