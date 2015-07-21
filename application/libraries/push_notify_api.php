<?php

/**
 * Description of admin
 *
 * @author duocnt
 */
class push_notify_api {

    private $CI;
    private $url = "http://api-push.gomobi.vn/PushGateway/message/omga/condition?";
    var $key = "73b7a0c5-b1c1-11e4-b27e-00505695454e";
    var $partner  = '4';
    var $app = '16';
    var $package_name = array(
        'ios' => 'vn.me.omga.giftcode',
        'android' => 'vn.me.omga.giftcode',
        'wp' => 'vn.me.omga.giftcode',
    );
    var $platform = array(
        'ios' => 2,
        'android' => 1,
        'wp' => 3,
    );
    var $store = 'vn.mecorp.omga.giftcode';
    
    function __construct() {
        $this->CI = & get_instance();
    }

    public function index($platform, $message, $env = 3) {
        $data = array(
            $this->package_name[$platform],
            '',
        );
        
        $params = array(
            'message' => $message,
            'type' => 1,
            'data' => json_encode($data),
            'env' => $env,
            'os' => $this->platform[$platform],
            'app' => $this->app,
            'partnerId' => $this->partner,
        );
        
        
        $params['token'] = md5($params['message'] . $params['type'] . $params['data'] . $params['env'] . $params['os'] . $params['app'] . $this->key) ;
        
        $link = $this->url . http_build_query($params);
        
        $data = $this->_get_to_url($link);
        return $data;
        
    }

    private function _get_to_url($url) {
        $ch = curl_init() or die(curl_error());
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch) or die(curl_error());
        curl_close($ch);
        return $result;
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
