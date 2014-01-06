<?php
/**
 * Created by PhpStorm.
 * User: raynor
 * Date: 06/01/14
 * Time: 12:14 AM
 */
require_once('../../src/cache/lib/HTMLCache.php');
require_once('../../src/cache/lib/RequestCache.php');

class RequestCacheTest extends PHPUnit_Framework_TestCase {


    public function setUp() {
        $cache = new RequestCache();
        $cache->flush();
	HTMLCache::initialize($cache, 60);
    }

    public function testCacheForNonExistingKey() {
        $response = HTMLCache::get('test');
	$this->assertEquals($response, false);
    }


    public function testGetAndWriteToCache() {
        $response1 = HTMLCache::get('test');
        ob_start();
        if (!$response1) {
          echo 'TEST';
          HTMLCache::write();
        }
        $content1 = ob_get_clean();
	ob_start();
        $response2 = HTMLCache::get('test');
        $content2 = ob_get_clean();

        $this->assertEquals($response1, false);
        $this->assertEquals($response2, true);
        $this->assertEquals($content1, 'TEST');
        $this->assertEquals($content2, 'TEST');
    }


    public function testTwoGets() {

        ob_start();
        $response1 = HTMLCache::get('test');
        if (!$response1) {
          echo 'TEST';
          HTMLCache::write();
        }
        $content1 = ob_get_clean();

        ob_start();
        $response2 = HTMLCache::get('test');
        if (!$response2) {
            ob_flush();
            $this->fail('Caching is not working');
        }
        $content2 = ob_get_clean();


        $this->assertEquals($response1, false);
        $this->assertEquals($response2, true);
        $this->assertEquals($content1, 'TEST');
        $this->assertEquals($content2, 'TEST');
    }

}
 
