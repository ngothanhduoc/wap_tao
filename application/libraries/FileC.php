<?php

class FileC {

    private $CI;

    function __construct() {
        $this->CI = & get_instance();
    }
    public function saveCache($key, $data, $timeout = 300) {
        $this->CI->load->driver('cache');
        $this->CI->cache->file->save($key, $data, $timeout);
    }

    public function loadCache($key) {
        $this->CI->load->driver('cache');
        return $this->CI->cache->file->get($key);
    }
    
}

?>
