<?php
include('../common/common.php');
class RaceCondition extends UseCase {
    const KEYNAME = 'racecondition';

    public function execute() {
       $logger = new OutputLogger();
       $cache = new VerboseCache($this->getMemcache(), $logger);
       
       $logger->log('START');
        $key = $cache->get(self::KEYNAME);
        /** some code **/
        if ($this->isUpdateRequest()) {
//            $cache->delete(self::KEYNAME);
            $this->updateOperation();
            $cache->delete(self::KEYNAME);
            $logger->log('DONE');
        }
    }

    private function isUpdateRequest() {
      return true;
    }
    

    private function updateOperation() {
        /** DB Operation can take a while **/
        sleep(1);
    }

}




$usecase = new RaceCondition();
$usecase->execute();







