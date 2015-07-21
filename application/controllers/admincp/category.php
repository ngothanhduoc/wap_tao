<?php

ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Category extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
        $this->load->model('m_backend');
        $this->_arrParam = $this->input->post(NULL, TRUE);
    }

    function list_category() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::cate'] = time();

        $arrUser = $this->m_backend->jqxGets('cate');

        $this->template->write_view('content', 'admincp/category/list_category', $data);
        $this->template->render();
    }

    function add_list_category($id = '') {
        $data = array();


        $id = $this->security->xss_clean($id);
        if (isset($id) && is_numeric($id)) {
            $rs = $this->m_backend->jqxGet('cate', 'id_cate', $id);
//            die(json_encode($rs));
            if (empty($rs) === FALSE) {
                $data['data'] = $rs;
                $data['type'] = $rs['type'];
            }
        } else {
            $data['catName'] = '';
            $data['pubName'] = '';
            $data['platform'] = '';
            $data['data']['hot_game'] = 0;
            $data['data']['new_game'] = 0;
        }

        $this->template->write_view('content', 'admincp/category/addcategory', $data);
        $this->template->render();
    }

}
