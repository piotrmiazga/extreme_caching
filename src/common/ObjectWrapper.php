<?php
class ObjectWrapper {

    private $_object;

    public function __construct($object) {
        $this->_object = $object;
    }

    public function __call($method, $arguments) {
        return call_user_func_array(array($this->_object, $method), $arguments);
    }

    public function __get($property) {
        return $this->_object->$property;
    }

    public function __set($property, $newValue) {
        $this->_object->$property = $newValue;
    }

    protected function getWrapped() {
        return $this->_object;
    }


}
