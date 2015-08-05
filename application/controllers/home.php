<?php



if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Home extends CI_Controller {

    public $cate;

    public function __construct() {

        parent::__construct();
        $this->template->set_template('wap');
        $this->load->model('m_wap');
        $this->cate['game_cate'] = $this->m_wap->jqxGetId('cate', array('type' => 'game', 'status' => 'active'), 'id_cate, title, alias');
        $this->cate['app_cate'] = $this->m_wap->jqxGetId('cate', array('type' => 'app', 'status' => 'active'), 'id_cate, title, alias');
    }



    public function index() {

        $data['game_fav'] = $this->m_wap->jqxGetId('game_app', array('favorite' => 'active', 'type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, description', 10);

        $data['game_new'] = $this->m_wap->jqxGetId('game_app', array('set_new' => 'active', 'type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size', 5);

        $data['app'] = $this->m_wap->jqxGetId('game_app', array('set_new' => 'active', 'type' => 'app', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size', 5);

        $data['news'] = $this->m_wap->jqxGetId('news_video', array('set_home' => 'active', 'type' => 'news', 'status' => 'active'), 'id_news_video, name, image, description', 5);

        $data['videos'] = $this->m_wap->jqxGetId('news_video', array('set_home' => 'active', 'type' => 'video', 'status' => 'active'), 'id_news_video, name, image, description', 5);
        
        $data['cate'] = $this->cate;
        
        $this->template->write_view('content', 'view_home', $data);

        $this->template->render();

    }



    public function game() {

        $data['game'] = $this->m_wap->jqxGetId('game_app', array('type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size', 10);

//        die(json_encode($data));

        $this->template->write_view('content', 'game/view_game', $data);

        $this->template->render();

    }



    public function game_detail($params) {

        $id = check_id($params);

        $data['game'] = $this->m_wap->jqxGetId('game_app', array('id_game_app' => $id, 'type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, slide_image, description, content, count_download, size, download_url');

//        die(json_encode($data));

        $this->template->write_view('content', 'game/view_game_detail', $data);

        $this->template->render();

    }



    public function app() {

        $data['app'] = $this->m_wap->jqxGetId('game_app', array('type' => 'app', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size', 10);

//        die(json_encode($data));

        $this->template->write_view('content', 'game/view_app', $data);

        $this->template->render();

    }

     public function app_detail($params) {

        $id = check_id($params);

        $data['app'] = $this->m_wap->jqxGetId('game_app', array('id_game_app' => $id, 'type' => 'app', 'status' => 'active'), 'id_game_app, name, icon, slide_image, description, content, count_download, size, download_url');

//        die(json_encode($data));

        $this->template->write_view('content', 'game/view_app_detail', $data);

        $this->template->render();

    }

    public function video() {

        $data['video'] = $this->m_wap->jqxGetId('news_video', array('type' => 'video', 'status' => 'active'), 'id_news_video, name, image, description', 10);

//        die(json_encode($data));

        $this->template->write_view('content', 'video/view_video', $data);

        $this->template->render();

    }

    

     public function video_detail($params) {

        $id = check_id($params);

        $data['video'] = $this->m_wap->jqxGetId('news_video', array('id_news_video' => $id, 'type' => 'video', 'status' => 'active'), 'id_news_video, name, image, description, content, youtube_id');

//        die(json_encode($data));

        $this->template->write_view('content', 'video/view_video_detail', $data);

        $this->template->render();

    }

    

    public function news() {

        $data['news'] = $this->m_wap->jqxGetId('news_video', array('type' => 'news', 'status' => 'active'), 'id_news_video, name, image, description', 10);

//        die(json_encode($data));

        $this->template->write_view('content', 'news/view_news', $data);

        $this->template->render();

    }

    

     public function news_detail($params) {

        $id = check_id($params);

        $data['news'] = $this->m_wap->jqxGetId('news_video', array('id_news_video' => $id, 'type' => 'news', 'status' => 'active'), 'id_news_video, name, image, description, content, youtube_id');

//        die(json_encode($data));

        $this->template->write_view('content', 'news/view_news_detail', $data);

        $this->template->render();

    }

}

