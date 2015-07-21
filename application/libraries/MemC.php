<?php

class MemC {

    private $CI;
    private $memcache;

    public function __construct() {
        $this->CI = &get_instance();
        $this->memcache = memcache_connect('127.0.0.1', 11211);
    }
    public function store($key, $class, $func, $params = array()){
        $key = md5($key);
        if ($this->memcache) {
            $value = @$this->memcache->get($key);
            if(empty($value) === FALSE){
                return $value;
            }else{
                $value = call_user_func_array(array($class, $func), $params);
                if(empty($value) === FALSE){
                    $this->memcache->set($key,$value);
                }
                return $value;
            }            
        }else{
             $value = call_user_func_array(array($class, $func), $params);
             return $value;
        } 
    }
    public function delete($id) {
        if (is_array($id) === TRUE)
            $id = $id['key'];
        $id = md5($id);
        return $this->memcache->delete($id);
    }
     public function clean() {
        return $this->memcache->flush();
    }
}