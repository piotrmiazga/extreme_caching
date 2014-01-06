<?php
include('../common/common.php');

class Chain extends UseCase {




  public function execute() {
    $logger = new OutputLogger();

    $repoLayer     = new ChainLogWrapper(new ChainDB(), $logger);
    $memcacheLayer = new ChainLogWrapper(new ChainMemcache($repoLayer, $this->getMemcache()), $logger);
    $requestLayer  = new ChainLogWrapper(new ChainRequest($memcacheLayer), $logger);

//    $repoLayer     = new ChainDB();
//    $memcacheLayer = new ChainMemcache($repoLayer, $this->getMemcache());
//    $requestLayer  = new ChainRequest($memcacheLayer);
    

    $logger->log('First call');
    $logger->log($requestLayer->get('key'));
    $logger->log('Second call');
    $logger->log($requestLayer->get('key'));
  }



}

$usecase = new Chain();
$usecase->execute();

