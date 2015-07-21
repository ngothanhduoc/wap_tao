<?php

//session_start();
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_newsevent extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
        $this->load->model('m_backend');
    }

    function index() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::news'] = time();
        
        //get game
        $listGame = $this->m_backend->jqxGets('game_app');
        $arrGame = array();
        foreach ($listGame as $v) {
            $arrGame[$v['id_game_app']] = $v['name'];            
        }
        $data['arrGame'] = $arrGame;
        
        $this->template->write_view('content', 'admincp/newsevent/index', $data);
        $this->template->render();
    }

    function add($id = 0) {
        $data = array();     
        //get platform
        $list = $this->m_backend->jqxGets('platform');
        $arrPlatform = array();
        foreach($list as $v){
            $arrPlatform[$v['id_platform']] = trim(str_replace(' ','',$v['alias']));
        }
        $data['arrPlatform'] = $arrPlatform;
        
        //get game
        $listGame = $this->m_backend->jqxGets('game_app');
        $arr = array();
        $arrGame = array();
        $arrGameName = array();
        foreach ($listGame as $v) {
            $arrGame[$v['id_game_app']] = $v['name'];
            $arrGameName[$v['name']] = $v['id_game_app'];
            $arr[] = $v['id_game_app'];
        }
        $data['arrGame'] = $arrGame;
        $data['arrGameName'] = $arrGameName;
               
        if (isset($id) && is_numeric($id)) {           
            $rs = $this->m_backend->jqxGet('news', 'id_news', $id);
                       
            if (empty($rs) === FALSE) {
                $data['platform'] = @implode(',',  @json_decode($rs['platform'],true));
                $data['id_game'] = @$rs['id_game']; 
                $data['game'] = @$arrGame[$rs['id_game']]; 
                $data['data'] = $rs;
            }
           
        } else {
            $data['platform'] = '';            
        }        
        $this->template->write_view('content', 'admincp/newsevent/add', $data);
        $this->template->render();
    }    
}
