<?php
Interface Cache {

    /**
     * Gets key from cache
     * @param $key
     * @return mixed
     */
    public function get($key);

    /**
     * If previous get() function call was hit returns true otherwise false
     * @return bool
     */
    public function isHit();

    /**
     * Sets key in cache
     *
     * @param $key string
     * @param $value mixed
     * @param $ttl int
     * @return bool
     */
    public function set($key, $value, $ttl = 0);

    /**
     * Removes key from cache
     *
     * @param $key string
     * @return bool
     */
    public function delete($key);

}