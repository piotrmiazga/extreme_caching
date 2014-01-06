<?php
include('../common/common.php');

class ChainWithLog extends UseCase {


  public function execute() {
    $logger = new OutputLogger();
    $repoLayer     = new ChainLogWrapper(new ChainDB(), $logger);
    $memcacheLayer = new ChainLogWrapper(new ChainMemcache($repoLayer, $this->getMemcache()), $logger);
    $requestLayer  = new ChainLogWrapper(new ChainRequest($memcacheLayer), $logger);
    
    $logger->log('Get data for user:17');
    $logger->log($requestLayer->get('user:17'));
    $logger->log('Get data for user 18');
    $logger->log($requestLayer->get('user:18'));
    $logger->log('Get data for user:17');
    $logger->log($requestLayer->get('user:17'));



  }



}

$usecase = new ChainWithLog();
$usecase->execute();

