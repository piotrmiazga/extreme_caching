<?php

$cache = new Memcached();
$cache->addServer('localhost', 11211);

//GET key from cache

$data = $cache->get('gtaphp');

if ($data === false&&
    $cache->getResultCode() !== Memcached::RES_SUCCESS) {
    echo "MISS !<br>\n";
    $data = 'Data ' . date('Y-m-d H:i:s') . 'date';
    $cache->set('gtaphp', false, 10);

} else {
    echo "HIT <br>$data<br>\n";
}



$gotLock = $cache->add('meetup', 1, 15);

if ($gotLock === true) {
    echo "GOT A LOCK<BR>\n";
    sleep(5);
    $cache->delete('meetup');
} else {
    echo "CANNOT LOCK<BR>\n";
}