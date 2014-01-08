<?php
include('../common/common.php');

class CacheWrapperExample extends UseCase {

    public function execute() {
        $cache = $this->getMemcache();
        $logger = new OutputLogger();

        $repo = new ChainDB();

        $cached = new CacheWrapper($repo, $cache);

        $logger->log('Without cache : ' . $cached->get('key_a'));
        $logger->log('With cache : '. $cached->cached_get('key_a'));
        $logger->log('Key name : ' . $cached->key_get('key_a'));

        $logger->log('Cache local method call : ' . $this->getCachedHeavyOperation());
    }





    public function heavyOperation() {
        sleep(5);
        return 'Heavy';
    }

    public function getCachedHeavyOperation() {
      $cached = new CacheWrapper($this, $this->getMemcache());
      return $cached->cached_heavyOperation();

    }




}

$usecase = new CacheWrapperExample();
$usecase->execute();
