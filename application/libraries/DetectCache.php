<?php

class DetectCache {

    private $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('cache');
    }
    public function clearCache($table='news') {
        $cache = @$this->CI->cache->load('memcache', 'system_info'); 
        //$cacheF = @$this->CI->cache->load('file', 'monitor');
        //$arrTimer = @$cacheF->get('timepublic_'.$table);
        //$arrKeyd = @$cacheF->get('keymemcache_'.$table);
        
        $arrTimer = @$cache->get('timepublic_'.$table);
        $arrKeyd = @$cache->get('keymemcache_'.$table);
        
        if(empty($arrTimer) === FALSE){
            $timerP = reset($arrTimer);
            $timerC = strtotime(date('Y-m-d H:i:s'));
            if($timerP < $timerC){
                if($table == 'news'){
                    @$cache->delete('get_slide_home_5');
                    @$cache->delete('get_slide_home_3');
                }
                //clear cache
               if(empty($arrKeyd) === FALSE){
                    foreach($arrKeyd as $key => $val){
                        if(is_array($val) && empty($val) === FALSE){
                            foreach ($val as $k => $v){
                                @$cache->delete($v);
                                //unset($arrKeyd[$key][$k]);
                            }
                        }else{
                            @$cache->delete($val);
                            //unset($arrKeyd[$key]);
                        }
                    }
                    //$cacheF->save('keymemcache_'.$table,$arrKeyd);
                    $cache->save('keymemcache_'.$table,$arrKeyd);
                }                
                unset($arrTimer[$timerP]);
                ksort($arrTimer);
                $timeout = 60 * 60 * 24 * 360;
                //$cacheF->save('timepublic_'.$table,$arrTimer,$timeout);
                //$cache->save('timepublic_'.$table,$arrTimer,$timeout);
                $cache->save('timepublic_'.$table,$arrTimer);
            }
        }       
    }
    public function addKeys($key,$id,$table='news'){
        //$cacheF = @$this->CI->cache->load('file', 'monitor');
        $cacheF = @$this->CI->cache->load('memcache', 'system_info'); 
        $arrKeyd = @$cacheF->get('keymemcache_'.$table);
        if(empty($arrKeyd) === TRUE){
            $arrKeyd = array();
            $arrKeyd[$key][$id] = $key . '_' . $id;
        }else{
            $arrKeyd[$key][$id] = $key . '_' . $id;
        }
        $timeout = 60 * 60 * 24 * 360;
        //$cacheF->save('keymemcache_'.$table,$arrKeyd,$timeout);
        $cacheF->save('keymemcache_'.$table,$arrKeyd);
    }
    public function addKey($key, $value, $table='news'){
        //$cacheF = @$this->CI->cache->load('file', 'monitor');
        $cacheF = @$this->CI->cache->load('memcache', 'system_info'); 
        $arrKeyd = @$cacheF->get('keymemcache_'.$table);
        
        if(empty($arrKeyd) === TRUE){
            $arrKeyd = array();
            $arrKeyd[$key] = $value;
        }else{
            $arrKeyd[$key] = $value;
        }
        $timeout = 60 * 60 * 24 * 360;
        //$cacheF->save('keymemcache_'.$table,$arrKeyd,$timeout);
        $cacheF->save('keymemcache_'.$table,$arrKeyd);
    }
    public function clearCacheWeek($key, $table='news'){
        $cache = @$this->CI->cache->load('memcache', 'system_info'); 
        //$cacheF = @$this->CI->cache->load('file', 'monitor');
        //$arrKeyd = @$cacheF->get('keymemcache_'.$table);
        $arrKeyd = @$cache->get('keymemcache_'.$table);
        $val = @$arrKeyd[$key];
        if(empty($val) === FALSE){
            $arrVal = explode("-", $val);
            $timeL = @$arrVal[1] + 86400*7;
            $timeC = strtotime(date('Y-m-d H:i:s'));
            if($timeC > $timeL){
                @$cache->delete($val);
                //unset($arrKeyd[$key]);
            }
            //$cacheF->save('keymemcache_'.$table,$arrKeyd);
            $cache->save('keymemcache_'.$table,$arrKeyd);
        }
    }
    public function clearCacheOne($key, $table='news'){
        $cache = @$this->CI->cache->load('memcache', 'system_info'); 
        //$cacheF = @$this->CI->cache->load('file', 'monitor');
        //$arrKeyd = @$cacheF->get('keymemcache_'.$table);
        $arrKeyd = @$cache->get('keymemcache_'.$table);
        $val = @$arrKeyd[$key];
        if(empty($val) === FALSE){
            $arrVal = explode("-", $val);
            $timeL = $arrVal[1] + 86400*1;
            $timeC = strtotime(date('Y-m-d H:i:s'));
            if($timeC > $timeL){
                @$cache->delete($val);
                //unset($arrKeyd[$key]);
            }
            //$cacheF->save('keymemcache_'.$table,$arrKeyd);
            $cache->save('keymemcache_'.$table,$arrKeyd);
        }
    }
    public function clearCacheAll($table='news') {
        $cache = @$this->CI->cache->load('memcache', 'system_info'); 
        //$cacheF = @$this->CI->cache->load('file', 'monitor');
        //$arrKeyd = @$cacheF->get('keymemcache_'.$table); 
        $arrKeyd = @$cache->get('keymemcache_'.$table); 
       //clear cache
       if(empty($arrKeyd) === FALSE){
            foreach($arrKeyd as $key => $val){
                if(is_array($val) && empty($val) === FALSE){
                    foreach ($val as $k => $v){
                        @$cache->delete($v);
                        //unset($arrKeyd[$key][$k]);
                    }
                }else{
                    @$cache->delete($val);
                    //unset($arrKeyd[$key]);
                }
            }
            $cache->save('keymemcache_'.$table,$arrKeyd);
        }        
    }
    public function clearCacheKey($key,$table='news') {
        $cache = @$this->CI->cache->load('memcache', 'system_info'); 
        //$cacheF = @$this->CI->cache->load('file', 'monitor');
        //$arrKeyd = @$cacheF->get('keymemcache_'.$table);       
        $arrKeyd = @$cache->get('keymemcache_'.$table);       
       //clear cache
       if(empty($arrKeyd) === FALSE){
            if(empty($arrKeyd[$key]) === FALSE){
                if(is_array($arrKeyd[$key]) && empty($arrKeyd[$key]) === FALSE){
                    foreach ($arrKeyd[$key] as $k => $v){
                        @$cache->delete($v);
                        //unset($arrKeyd[$key][$k]);
                    }
                }else{
                    @$cache->delete($arrKeyd[$key]);
                    //unset($arrKeyd[$key]);
                }
            
            //$cacheF->save('keymemcache_'.$table,$arrKeyd);
            $cache->save('keymemcache_'.$table,$arrKeyd);
            }
        }        
    }

    
}

?>
