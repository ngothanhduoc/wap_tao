<?php
class Vbb_Client {

    private $_instance;

    // Setting
    protected $_endpoint = '';
    protected $_apikey = '';
    protected $_clientname = '';
    protected $_clientversion = '';
    protected $_platformname = '';
    protected $_platformversion = '';
    protected $_uniqueid = '';

    // Params for every session
    private $_apiclientid = '';
    private $_apiaccesstoken = '';
    private $_secret;

    private $_curl;

    private $_userinfo = array(
            'userid' => null,
            'sessionhash' => null,
    );

    function __construct(/*$endpoint, $apikey, $clientname, $clientversion, $platformname, $platformversion, $uniqueid*/) {
        $endpoint = 'diendan.mobo.vn';
        //$endpoint = 'diendan.mgo.vn';
        //$apikey = 'EZAZj4VD';
        $apikey = 'kjhtWh8U';
		$clientname = 'getforum';
		$clientversion = '1.0';
		$platformname = 'iPhone OS';
		$platformversion = '4.1.8';
		$uniqueid = '5772A52A-E955-5A6C-A1F3-702E17583033';
		$this->_endpoint = $endpoint;
		$this->_apikey = $apikey;
		$this->_clientname = $clientname;
		$this->_clientversion = $clientversion;
		$this->_platformname = $platformname;
		$this->_platformversion = $platformversion;
		$this->_uniqueid = $uniqueid;

		$this->_curl = curl_init();
    }

    private function init() {
	$requestparams = array(
	'api_m' => 'api_init',
	'clientname' => $this->_clientname,
	'clientversion' => $this->_clientversion,
	'platformname' => $this->_platformname,
	'platformversion' => $this->_platformversion,
	'uniqueid' => $this->_uniqueid
	);
	ksort( $requestparams );

	$result = $this->runRequest( $requestparams );

	$this->_apiclientid = $result->apiclientid;
	$this->_apiaccesstoken = $result->apiaccesstoken;
	$this->_secret = $result->secret;

	return $result;
    }

    public function login($username, $password) {
            $password = '';
            $r = $this->call( 'login_login', array( 'vb_login_username' => $username, 'vb_login_password' => $password ), false );
            
            if ( $r->response->errormessage[0] == 'redirect_login' ) {
                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $this->_userinfo['userid'] = $r->session->userid;
                    $_SESSION['userid'] = $this->_userinfo['userid'];
                    $this->_userinfo['sessionhash'] = $r->session->dbsessionhash;
                    $_SESSION['sessionhash'] = $this->_userinfo['sessionhash'];
                    return true;
            }
            return false;
    }
    
    /*
     * check login vbb
     */
    public function checkLogin(){
        if( !empty( $_SESSION['userid']) && !empty( $_SESSION['sessionhash'] ) ){
            $this->_userinfo['userid'] = $_SESSION['userid'];
            $this->_userinfo['sessionhash'] = $_SESSION['sessionhash'];
            return true;
        }
        return false;
       
    }





    public function call($method_name, $params = array(), $isPost = false) {

            // there is no session establish, then make api_init first
            if ( $this->_apiclientid == '' || $this->_apiaccesstoken == '' || $this->_secret == '' ) {
            $this->init();
            }

            $params['api_m'] = $method_name;
            if ($isPost === true) {
            $signature = $this->buildSignature( array('api_m' => $method_name) );
            } else {
            $signature = $this->buildSignature( $params );
            }

            $params['api_c'] = $this->_apiclientid;
            $params['api_s'] = $this->_apiaccesstoken;
            $params['api_sig'] = $signature;
            $result = $this->runRequest( $params, $isPost);
            return $result;
    }

    private function runRequest($method_call_params, $isPost = false) {
            curl_setopt($this->_curl, CURLOPT_URL, ($isPost === true)
            ? $this->getMethodUrl(array('api_m' => $method_call_params['api_m']))
            : $this->getMethodUrl( $method_call_params ) );
            curl_setopt($this->_curl, CURLOPT_RETURNTRANSFER, 1);
            if ( $isPost === true ) {
                    //echo 	$this->getMethodUrl(array('api_m' => $method_call_params['api_m']));
                    //print_r($method_call_params);
            curl_setopt($this->_curl, CURLOPT_POST, 1);
            curl_setopt($this->_curl, CURLOPT_HTTPGET, 0);
            curl_setopt($this->_curl, CURLOPT_POSTFIELDS, $method_call_params);
            } else {
            curl_setopt($this->_curl, CURLOPT_POST, 0);
            curl_setopt($this->_curl, CURLOPT_HTTPGET, 1);
            }
            return $this->verifyResult(curl_exec($this->_curl));
    }

    private function verifyResult($result) {
            /* error check */
            $result = json_decode($result);
            if ( isset( $result->response->errormessage ) && !empty( $result->response->errormessage ) ) {
            /*
            if ( $result->response->errormessage[0] != 'redirect_login' ) {
            
            throw new Exception($result->response->errormessage[1]);
            }*/
            }
            return $result;
    }

    private function buildSignature( $method_params ) {
            ksort($method_params);
            return md5( http_build_query( $method_params , '', '&' ) . $this->_apiaccesstoken . $this->_apiclientid . $this->_secret . $this->_apikey );
    }

    private function getMethodUrl($requestparams = array() ) {
            return 'http://' . $this->_endpoint . '/api.php?' . http_build_query( $requestparams, '', '&' );
    }
}


/*
 * ham loc dau tieng viet
 */
function createAlias($str) {
    $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
    $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
    $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
    $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
    $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
    $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
    $str = preg_replace("/(đ)/", 'd', $str);
    $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
    $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
    $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
    $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
    $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
    $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
    $str = preg_replace("/(Đ)/", 'D', $str);
    $str = preg_replace("/[\s\,]/", '-', $str);

    return $str;
}
