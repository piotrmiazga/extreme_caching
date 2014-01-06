<?php
set_include_path(get_include_path() . PATH_SEPARATOR .
                 __DIR__ . PATH_SEPARATOR . 
                 'lib' . DIRECTORY_SEPARATOR . PATH_SEPARATOR);


function __autoload($className) {
  require_once($className . '.php');
}

