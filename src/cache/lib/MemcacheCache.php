<?php
class MemcacheCache extends Memcached implements Cache {


    public function isHit() {
        return $this->getResultCode() != Memcached::RES_NOTFOUND;
    }


}