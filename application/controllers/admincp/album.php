<?php
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Album extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
        $this->load->model('m_backend');
        $this->_arrParam = $this->input->post(NULL, TRUE);
    }
    function list_album() {
        $data = array();
        $controllerName = $this->router->fetch_class();
        $actionName = $this->router->fetch_method();
        $_SESSION[$controllerName . '::' . $actionName . '::cate'] = time();

        $arrUser = $this->m_backend->jqxGets('cate');
        
        $this->template->write_view('content', 'admincp/category/list_category', $data);
        $this->template->render();
    }
    function add_list_album() {
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
        foreach ($listGame as $v) {
            $arr[] = $v['id_game_app'];
        }
        
        $id = $this->input->get('id', TRUE);
        if (isset($id) && is_numeric($id)) {

            if (in_array($this->input->get('id', TRUE), $arr)) {
                $rs = $this->m_backend->jqxGet('game_app', 'id_game_app', $this->input->get('id', TRUE));
                if (empty($rs) === FALSE) {
                    $data['platform'] = @implode(',',  @json_decode($rs['platform'],true));
                    $data['type'] = $rs['type']; 
                    $data['data'] = $rs;
                }
            } else {
                $data['type'] = '';
                $data['platform'] = '';
                
            }
        } else {
            $data['catName'] = '';
            $data['pubName'] = '';
            $data['platform'] = '';
            $data['data']['hot_game'] = 0;
            $data['data']['new_game'] = 0;
        }

        $this->template->write_view('content', 'admincp/game/addcategory', $data);
        $this->template->render();
    }
    

}
