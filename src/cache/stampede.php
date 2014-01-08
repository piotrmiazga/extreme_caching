<?php
include('../common/common.php');
/**
 * Created by PhpStorm.
 * User: raynor
 * Date: 07/01/14
 * Time: 11:33 AM
 */
class StampedeProtection extends UseCase {
    const KEY_NAME = 'key';

    public function execute() {
        $cache = $this->getMemcache();
        $logger = new OutputLogger();

        $result = $cache->get(self::KEY_NAME);
        if (!$cache->isHit()) {
            $lockKeyName = 'lock:' . self::KEY_NAME;

            $lock = $cache->add($lockKeyName, 1, 30);
            if (!$lock) {
                //someone added a lock
                //we lost
                //short sleep and re-fetch ?, how many tries ?
                //show less expensive content
                //throw an error
                $logger->log('Cannot lock');
                die;
            }
            $result = $this->_fetchFromRepo();
            $cache->set('key', $result, 84600);
            $cache->delete($lockKeyName);
        }
        $logger->log('Result : ' .  $result);
    }

    private function _fetchFromRepo() {
        return 'Hello';
    }
}

$usecase = new StampedeProtection();
$usecase->execute();