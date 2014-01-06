<?php
/**
 * Created by PhpStorm.
 * User: raynor
 * Date: 05/01/14
 * Time: 11:53 PM
 */
include('../../src/common/ObjectWrapper.php');


class ObjectWrapperTest extends PHPUnit_Framework_TestCase {

    public function testGetter() {

        $mock = new stdClass();
        $mock->test = 1;
        $mock->second = 2;

        $wrapper = new ObjectWrapper($mock);

        $this->assertEquals(1, $wrapper->test);
        $this->assertEquals(2, $wrapper->second);
        $this->assertEquals(1, $wrapper->test);
    }


    public function testSetter() {
        $mock = new stdClass();
        $mock->test = 1;
        $mock->second = 2;
        $mock->third = 3;

        $wrapper = new ObjectWrapper($mock);
        $wrapper->test = 0;
        $wrapper->second++;
        $wrapper->third = 'x';

        $this->assertEquals(0, $mock->test);
        $this->assertEquals(3, $mock->second);
        $this->assertEquals('x', $mock->third);
    }

    public function testCallWithoutParam() {
        $mock = $this->getMock('stdClass', ['get']);
        $mock->expects($this->once())
             ->method('get')
             ->will($this->returnValue(1));

        $wrapper = new ObjectWrapper($mock);

        $this->assertEquals(1, $wrapper->get());

    }

    public function testCallWithParam() {
        $mock = $this->getMock('stdClass', ['get']);

        $mock->expects($this->once())
            ->method('get')
            ->with('test')
            ->will($this->returnValue(2));

        $wrapper = new ObjectWrapper($mock);
        $this->assertEquals(2, $wrapper->get('test'));
    }



}
 
