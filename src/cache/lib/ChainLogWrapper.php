<?php
class ChainLogWrapper extends ObjectWrapper implements ChainRepo {

   /**
    ( @var Logger
    */
   private $_logger;


   public function __construct(ChainRepo $repo, Logger $logger) {
       $this->_logger = $logger;
       parent::__construct($repo);
   }

    public function get($key) {
        $wrappedRepo = $this->getWrapped();
        $this->_logger->log(get_class($wrappedRepo) . "::get($key)");
	return $wrappedRepo->get($key);
    }
}
