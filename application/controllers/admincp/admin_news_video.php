<?php

ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_news_video extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
        $this->load->model('m_backend');
        $this->_arrParam = $this->input->post(NULL, TRUE);
    }

    function index_news() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::news_video'] = time();

        $arrUser = $this->m_backend->jqxGets('user');
        $arr = array();
        foreach ($arrUser as $val) {
            $arr[$val['id_admin']] = $val['username'];
        }
        $data['users'] = $arr;

        $this->template->write_view('content', 'admincp/news_video/index_news', $data);
        $this->template->render();
    }

    function index_video() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::news_video'] = time();

        $arrUser = $this->m_backend->jqxGets('user');
        $arr = array();
        foreach ($arrUser as $val) {
            $arr[$val['id_admin']] = $val['username'];
        }
        $data['users'] = $arr;

        $this->template->write_view('content', 'admincp/news_video/index_video', $data);
        $this->template->render();
    }

    function add_video() {
        $data = array();
        //get platform

        $id = $this->input->get('id', TRUE);
        if (isset($id) && is_numeric($id)) {


            $rs = $this->m_backend->jqxGet('news_video', 'id_news_video', $this->input->get('id', TRUE));

            if (empty($rs) === FALSE) {
                $data['platform'] = @implode(',', @json_decode($rs['platform'], true));
                $data['type'] = $rs['type'];

                $data['data'] = $rs;
            }
        } else {
            $data['catName'] = '';
            $data['pubName'] = '';
            $data['platform'] = '';
            $data['data']['hot_game'] = 0;
            $data['data']['new_game'] = 0;
        }

        $this->template->write_view('content', 'admincp/news_video/add_video', $data);
        $this->template->render();
    }

    function add_news() {
        $data = array();
        //get platform

        $id = $this->input->get('id', TRUE);
        if (isset($id) && is_numeric($id)) {

            
                $rs = $this->m_backend->jqxGet('news_video', 'id_news_video', $this->input->get('id', TRUE));

                if (empty($rs) === FALSE) {
                    
                    $data['type'] = $rs['type'];

                    $data['data'] = $rs;
                }
           
        }

        $this->template->write_view('content', 'admincp/news_video/add_news', $data);
        $this->template->render();
    }

    function publisher() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::publisher'] = time();

        $numgame = $this->m_backend->get_num_game_publisher();

        $arrNum = array();
        if (empty($numgame) === FALSE) {
            foreach ($numgame as $val) {
                $arrNum[$val['id_publisher']] = $val['total'];
            }
        }

        $data['arrNum'] = $arrNum;

        $this->template->write_view('content', 'admincp/game/publisher', $data);
        $this->template->render();
    }

    function addpublisher() {
        $data = array();
        $id = $this->input->get('id', TRUE);

        $list = $this->m_backend->jqxGets('publisher');
        $arrPublisher = array();

        foreach ($list as $v) {
            $arrPublisher[$v['id_publisher']] = $v['full_name'];
        }
        $data['arrPublisher'] = $arrPublisher;

        if (isset($id) && is_numeric($id)) {
            $rs = $this->m_backend->jqxGet('publisher', 'id_publisher', $id);
            if (empty($rs) === FALSE) {
                $data['data'] = $rs;
            }
        }

        $this->template->write_view('content', 'admincp/game/addpublisher', $data);
        $this->template->render();
    }

    function category() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::game_category'] = time();

        $arrUser = $this->m_backend->jqxGets('user');
        $arr = array();
        foreach ($arrUser as $val) {
            $arr[$val['id_admin']] = $val['username'];
        }
        $data['users'] = $arr;
        $this->template->write_view('content', 'admincp/game/category', $data);
        $this->template->render();
    }

    function addcategory() {
        $data = array();
        $id = $this->input->get('id', TRUE);
        if (isset($id) && is_numeric($id)) {
            $rs = $this->m_backend->jqxGet('game_category', 'id_game_category', $id);
            if (empty($rs) === FALSE) {
                $data['data'] = $rs;
            }
        }

        $this->template->write_view('content', 'admincp/game/addcategory', $data);
        $this->template->render();
    }

    function platform() {
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::platform'] = time();
        $data = array();
        $this->template->write_view('content', 'admincp/game/view_platform', $data);
        $this->template->render();
    }

    function add_platform() {
        $data = array();
        $id = $this->input->get('id', TRUE);
        $flat = FALSE;
        if (isset($id) && is_numeric($id)) {
            $rs = $this->m_backend->jqxGet('platform', 'id_platform', $id);
            if (empty($rs) === FALSE) {
                $data['data'] = $rs;
                $flat = TRUE;
            } else {
                redirect(base_url('backend/game/platform'));
            }
        }





        $post = $this->input->post(NULL, TRUE);
        if (!empty($post['id_platform'])) {
            unset($post['id_platform']);
            $this->m_backend->_table = 'platform';
            $this->m_backend->_key = "id_platform";
            $status = $this->m_backend->update($id, $post);
            if ($status === 1)
                redirect(base_url('backend/game/platform'));
            else
                echo "<script> alert('Vui lòng kiểm tra lại!'); </script>";
        }else {
            if (!empty($post)) {
                unset($post['id_platform']);
                $this->m_backend->_table = 'platform';
                $post['creat_time'] = date("Y-m-d H:i:s");
                $status = $this->m_backend->insert($post);
                if (!empty($status))
                    redirect(base_url('backend/game/platform'));
                else
                    echo "<script> alert('Vui lòng kiểm tra lại!'); </script>";
            }
        }
        $this->template->write_view('content', 'admincp/game/view_add_platform', $data);
        $this->template->render();
    }

}
