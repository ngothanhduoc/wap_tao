<?php

$cache_file['monitor'] = array('path' => APPPATH . '../public/assets/');

$cache_mem['system_info'] = array(
    'cfg' => array('random' => FALSE),
    'data' => array(
        array('host' => '127.0.0.1', 'port' => '11211')
    )
);

$cache_mem['user_info'] = array(
    'cfg' => array('random' => FALSE),
    'data' => array(
        array('host' => '127.0.0.1', 'port' => '11211')
    )
);


$config['cache']['file'] = $cache_file;
$config['cache']['memcache'] = $cache_mem;
?>
