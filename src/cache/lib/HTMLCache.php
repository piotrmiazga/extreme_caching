<?php
require_once('Cache.php');


class HTMLCache {
    /**
     * @var Cache
     */
    private static $_cache;
    private static $_defaultTTL;

    private static $isListening = false;
    private static $listeningCacheKeyName = null;


    public static function initialize(Cache $cache, $defaultTTL) {
        self::$_cache = $cache;
        self::$_defaultTTL = $defaultTTL;
        self::_resetListener();
    }

    public static function get($key) {
        if (self::$isListening) {
            throw new RuntimeException('Inception');
        }
        $content = self::$_cache->get($key);

        if (!self::$_cache->isHit()) {
            return self::_startListening($key);
        } else {
            return self::_outputContent($content);
        }
    }

    private static function _startListening($key) {
        self::$isListening = true;
        self::$listeningCacheKeyName = $key;
        ob_start();
        return false;
    }

    private static function _outputContent($content) {
        echo $content;
        return true;
    }


    public static function write() {
        if (!self::$isListening) {
            throw new RuntimeException('HTMLCache is not collecting output. Call get() first');
        }
        $content = ob_get_clean();
        self::$_cache->set(self::$listeningCacheKeyName, $content, self::$_defaultTTL);
        self::_resetListener();
        return self::_outputContent($content);
    }

    private static function _resetListener() {
        self::$isListening = false;
        self::$listeningCacheKeyName = null;
    }




}
