<?php
include('../common/common.php');

class Chain extends UseCase {


  public function execute() {
    $logger = new OutputLogger();

    $repoLayer     = new ChainDB();
    $memcacheLayer = new ChainMemcache($repoLayer, $this->getMemcache());
    $requestLayer  = new ChainRequest($memcacheLayer);


    $logger->log('Get data for user:17');
    $logger->log($requestLayer->get('user:17'));
    $logger->log('Get data for user:18');
    $logger->log($requestLayer->get('user:18'));
    $logger->log('Get data for user:17');
    $logger->log($requestLayer->get('user:17'));
  }



}

$usecase = new Chain();
$usecase->execute();

