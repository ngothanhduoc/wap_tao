<?php
session_start();
$client_id = "223510387745409";

if(isset($_GET['act']) AND $_GET['act'] === 'login'){
	//lay link chuyen toi
	if(isset( $_GET['redirect_uri'] ))
		$_SESSION['redirect_uri'] = $_GET['redirect_uri'];
	
		

	$link = "http://id.mobo.vn";	
	header("location: {$link}/oauth.html?client_id={$client_id}&register={$_GET['register']}");

	exit;
}

if( empty($_SESSION['redirect_uri']) )
	$_SESSION['redirect_uri'] = 'http://diendan.mobo.vn/forum/main-category';
	
else if(isset($_GET['mobo_access_token'])){
	
	$key = "fcRNBPI2";
	$token = md5($_GET['mobo_access_token'] . $key);
	$link = "http://oauth.mobo.vn/?control=oauth&func=valid_access_token&access_token={$_GET['mobo_access_token']}&app=diendan.mobo.vn&token={$token}";	
	$data = json_decode(file_get_contents($link),true);	
	if($data['data']['client_id'] == $client_id){
		$_SESSION['mobo_access_token'] = $_GET['mobo_access_token'];
		$_SESSION['phone'] = $data['data']['phone'];
		header('location: http://diendan.mobo.vn/update_info.php');
		exit;
	}else{
		header('location: '.$_SESSION['redirect_uri']);
		exit;
	}	
}
class oAuthAPI {

    /**
     *
     * @var CI_Controller
     */
    private $CI;
    private $url_api = 'http://oauth.mobo.vn/api/';
    private $url_3t_api="http://service.3t.mobo.vn/account";
    private $app = 'transit.3t.mobo.vn';
    private $app_serect = '4wdkccoed4yyr9e';
    private $last_link_request;

    public function register_authorization_code($client_id, $username) {
        $data = $this->_call_api('oauth', 'register_authorization_code', array('client_id' => $client_id, 'username' => $username));
        if (empty($data) === FALSE) {
            $result = json_decode($data, TRUE);
            if (is_array($result) === TRUE) {
                if ($result['code'] == 2) {
                    $output['status'] = 0;
                    $output['code'] = $result['data']['code'];
                    $output['redirect_uri'] = $result['data']['redirect_uri'];
                    $output['url'] = $this->last_link_request;
                    $output['content'] = $data;
                    return $output;
                }
            }
        }
        $output['status'] = 1;
        $output['url'] = $this->last_link_request;
        $output['content'] = $data;
        return $output;
    }
    
    public function exchange_code($client_id,$client_secret, $code,$state=NULL) {
        $data = $this->_call_api('oauth', 'exchange_code', array('client_id' => $client_id,'client_secret' => $client_secret, 'code' => $code));
        if (empty($data) === FALSE) {
            $result = json_decode($data, TRUE);
            if (is_array($result) === TRUE) {
                if ($result['code'] == 40) {
					/*
					 * Call api from service.3t to mapping mobo account and trial account
					 * if state param exists and have part of "signature"
					 */					
                    $output['status'] = 0;
                    $output['access_token'] = $result['data']['access_token'];
                    $output['expires'] = $result['data']['expires'];
                    $output['state'] = $result['data']['state'];
                    $output['url'] = $this->last_link_request;
                    $output['content'] = $data;
                    //$output['game_access_token']=$this->load_game_access_token($result['data']['access_token']);
                    return $output;
                }else{
                    $output['status'] = 1;
                    $output['error'] = $result['desc'];
                    $output['error_description'] = $result['message'];
                    $output['url'] = $this->last_link_request;
                    $output['content'] = $data;
                }
            }
        }
        $output['status'] = 1;
        $output['url'] = $this->last_link_request;
        $output['content'] = $data;

        return $output;
    }

    private function _call_api($control, $function, $params) {
        $params['service'] = $service_name;
        $this->last_link_request = $this->url_api . '?control=' . $control . '&func=' . $function . '&' . http_build_query($params) . '&app=' . $this->app . '&token=' . md5(implode('', $params) . $this->app_serect);
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->last_link_request);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,2);
        $result = curl_exec($ch);
        return $result;
    }
    private function load_game_access_token($token){
        $url=$this->url_3t_api . "/get_accesstoken/" .$token;
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,2);
        $json_result = curl_exec($ch);
        if($json_result==null)  return null;
        $result=json_decode($json_result);
        if($result->error==0){
            return $result->message->game_access_token;
        }
        return null;
    }
    /*
     * func : map_account
     * @param : $sign (string)
     * @param : $token (string:mobo_access_token)
     */
    public  function map_account($sign,$token){
        $url=$this->url_3t_api . "/map/".urlencode($sign)."/" .$token;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,2);
        $json_result = curl_exec($ch);
        if($json_result==null)  return false;
        $result=json_decode($json_result);
        if($result->error==0){
            return true;
        }
        return false;
    }

}
$oauth = new oAuthAPI();
$result = $oauth->exchange_code('223510387745406','dtegffghertwggs',$_GET['code'],$_GET['state']);
if ($result['status'] == 0) {
	if($result['access_token']){
        echo 'redirect ...';
		//echo '<a href="mgo223510387745406://valid_type=2&access_token='.$result['game_access_token'].'&mobo_access_token='.$result['access_token'].'&expires='.strtotime($result['expires']).'">aaaaaa</a>' ;
		echo '<meta http-equiv="refresh" content="0; url=http://diendan.mobo.vn/authorize.php?mobo_access_token='.$result['access_token'].'&expires='.strtotime($result['expires']) . '">';
	}else{
		header('Content-type: application/json');
		echo $data;
	}
} else {
	echo json_encode(array(
		'error' => $result['error'],
		'error_description' => $result['error_description']
	));
}
?>