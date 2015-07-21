<?php
//session_start();
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Account extends MY_Controller {

    protected $_arrParam;
    function __construct() {
        parent::__construct();
            $this->check_permission();		
    }


    function index() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName.'::'.$actionName.'::user'] = time();
        
        $this->load->model('m_backend');
        
        $result = $this->m_backend->jqxGets('user_group');
	$arr = array();
        foreach ($result as $val){
            $arr[$val['id_group']] = $val['full_name'];
        }
       
        $data['user_group'] = $arr;
        
        $this->template->write_view('content', 'admincp/account/index', $data);
        $this->template->render();
    }
    function add(){
        $data = array();
	$this->load->model('m_backend');
        
        
        //get category
        $listG = $this->m_backend->jqxGets('user_group');
                
        $arrGroup = array();
        $arrGroupName = array();
        foreach ($listG as $v) {
            $arrGroup[$v['id_group']] = $v['full_name'];
            $arrGroupName[$v['full_name']] = $v['id_group'];
        }
        $data['arrGroup'] = $arrGroup;
        $data['arrGroupName'] = $arrGroupName;
               
       
        $arrGis = array();
        
        
        $id = $this->input->get('id', TRUE);
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('user','id_admin',$this->input->get('id',TRUE));
            $data['data'] = $rs;
            $data['groupName'] = $arrGroup[$rs['id_group']];
            
            $gis = $this->m_backend->jqxGetId('user_has_game', 'id_admin', $rs['id_admin']);
            
            if(empty($gis) === FALSE){
                foreach($gis as $val){
                    $arrGis[] = $val['id_game'];
                }
            }
           
        }
   	$this->template->write_view('content', 'admincp/account/add', $data);
        $this->template->render();        
    }
    function groupuser() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName.'::'.$actionName.'::user_group'] = time();
        
        $this->template->write_view('content', 'admincp/account/groupuser', $data);
        $this->template->render();
    }
    function addgroupuser(){
        $data = array();
        $this->load->model('m_backend');
        $id = $this->input->get('id', TRUE);
        $arrAd = array();
        if(isset($id) && is_numeric($id)){
            $rs = $this->m_backend->jqxGet('user_group','id_group',$this->input->get('id',TRUE));
            $data['data'] = $rs;
           
            $adminmenu = json_decode($rs['permission'],true);
           
            if(empty($adminmenu) === FALSE){
                foreach($adminmenu as $val){
                        $arrAd[] = $val;
                }
            }
            
        }
        //list function
        $arr = array();
        $arrG = $this->m_backend->get_groupmenu();
        
        foreach($arrG as $key => $val){
            $val['level'] = 0;
            $arr[] = $val;
            $arrM = $this->m_backend->get_menu($val['id']);
            foreach($arrM as $key => $vl){
                    if(in_array($vl['id_function'],$arrAd)){
                            $vl['checked'] = 1;
                    }else{
                            $vl['checked'] = 0;
                    }
                    $vl['level'] = 1;
                    $arr[] = $vl;
            }
        }

        $data['menu'] = $arr;
        
        
        
        $this->template->write_view('content', 'admincp/account/addgroupuser', $data);
        $this->template->render();
    }
    
}