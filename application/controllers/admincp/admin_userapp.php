<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Userapp extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
        $this->load->model('m_backend');
        $this->_arrParam = $this->input->post(NULL, TRUE);
    }

    function index() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::user_app'] = time();
        
        $user = $this->m_backend->jqxGets('user_app');
        $arrUser = array();
        $arrUserId = array();
        foreach($user as $val){
            $arrUser[$val['id_user_app']] = $val['user_name'];
            $arrUserId[$val['user_name']] = $val['id_user_app'];
        }
        
        $data['arrUser'] = $arrUser;
        $data['arrUserId'] = $arrUserId;
        $this->template->write_view('content', 'admincp/userapp/index', $data);
        $this->template->render();
    }
    function create_time() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::user_app'] = time();
               
        $this->template->write_view('content', 'admincp/userapp/create_time', $data);
        $this->template->render();
    }
    function login_time() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::user_app'] = time();
               
        $this->template->write_view('content', 'admincp/userapp/login_time', $data);
        $this->template->render();
    }
    
}

