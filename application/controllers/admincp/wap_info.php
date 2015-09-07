<?php
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wap_info extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
        $this->load->model('m_backend');
        $this->_arrParam = $this->input->post(NULL, TRUE);
    }
    function list_info() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::info_wap'] = time();

//        $arrUser = $this->m_backend->jqxGets('info_wap');
        
        $this->template->write_view('content', 'admincp/wap_info/list_info', $data);
        $this->template->render();
    }
    function add_info() { 
        $data = array();     
        $id = $this->input->get('id', TRUE);
        if (isset($id) && is_numeric($id)) {
            $data['data'] = $this->m_backend->jqxGet('info_wap', 'id', $id);
        } 
//        die(json_encode($data));
        $this->template->write_view('content', 'admincp/wap_info/add_info', $data);
        $this->template->render();
    }
    

}
