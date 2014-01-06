<?php
/**
 * Created by PhpStorm.
 * User: raynor
 * Date: 06/01/14
 * Time: 12:14 AM
 */
require_once('../../src/cache/lib/RequestCache.php');

class RequestCacheTest extends PHPUnit_Framework_TestCase {

    private $cache;


    public function setUp() {
        $this->cache = new RequestCache();
        $this->cache->flush();
    }

    public function testGetNonExistingKey() {
        $this->assertEquals($this->cache->get('test'), false);
        $this->assertEquals($this->cache->get('test'), false);
    }

    public function testSetAndGet() {
        $this->assertEquals($this->cache->get('test'), false);
        $this->assertEquals($this->cache->set('test', 'value'), true);
        $this->assertEquals($this->cache->get('test'), 'value');
    }

    public function testSetAndDeleteAndGet() {
        $this->assertEquals($this->cache->get('test'), false);
        $this->assertEquals($this->cache->set('test', 'value'), true);
        $this->cache->delete('test');
        $this->assertEquals($this->cache->get('test'), false);
    }


    public function testIsHitForMissReturnsFalse() {
        $this->assertEquals($this->cache->get('test'), false);
        $this->assertEquals($this->cache->isHit(), false);
    }

    public function testIsHitForHitReturnsFalse() {
        $this->cache->set('test', 'value');
        $this->cache->get('test');
        $this->assertEquals($this->cache->isHit(), true);
    }

    public function testIsMissAfterDeleteReturnsFalse() {
        $this->cache->set('test', 'value');
        $this->cache->delete('test');
        $this->assertEquals($this->cache->isHit(), false);
    }



}
 