<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->template->set_template('wap');
        $this->load->model('m_wap');
    }

    public function index() {
        $data['game_fav'] = $this->m_wap->jqxGetId('game_app',array('favorite' => 'active', 'type' => 'game'),'id_game_app, name, icon, description', 10);
        $data['game_new'] = $this->m_wap->jqxGetId('game_app',array('set_new' => 'active', 'type' => 'game'),'id_game_app, name, icon, description, count_download, size', 5);
        $data['app'] = $this->m_wap->jqxGetId('game_app',array('set_new' => 'active', 'type' => 'app'),'id_game_app, name, icon, description, count_download, size', 5);
        $data['news'] = $this->m_wap->jqxGetId('news_video',array('set_home' => 'active', 'type' => 'news'),'id_news_video, name, image, description', 5);
        $data['videos'] = $this->m_wap->jqxGetId('news_video',array('set_home' => 'active', 'type' => 'video'),'id_news_video, name, image, description', 5);
        $this->template->write_view('content', 'view_home', $data);
        $this->template->render();
    }

    public function game() {

        $this->template->write_view('content', 'game/view_game', array());
        $this->template->render();
    }

}
