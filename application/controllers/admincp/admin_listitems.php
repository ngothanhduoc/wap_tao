<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Listitems extends MY_Controller {

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
        $_SESSION[$controllerName . '::' . $actionName . '::list_items'] = time();
                
        $this->template->write_view('content', 'admincp/listitems/index', $data);
        $this->template->render();
    }
    function add($id = 0) {
        $data = array();     
        if (isset($id) && is_numeric($id)) {        
            $rs = $this->m_backend->jqxGet('list_items', 'id', $id);                       
            if (empty($rs) === FALSE) {
                $data['type'] = @$rs['type']; 
                $data['data'] = $rs;
            }
           
        } else {
            $data['type'] = '';            
        }        
        $this->template->write_view('content', 'admincp/listitems/add', $data);
        $this->template->render();
    }
}
