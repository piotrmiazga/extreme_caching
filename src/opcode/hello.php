<?php
  /** @file hello.php **/
  set_include_path(__DIR__ . PATH_SEPARATOR . 
                   __DIR__ . '/lib');

  require_once('util.php');
  hello('world');
