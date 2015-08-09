<?php


if (!defined('BASEPATH'))

    exit('No direct script access allowed');


class Home extends CI_Controller
{

    public $cate;
    public $limit = 10;
    public $fav;
    public $data;

    public function __construct()
    {

        parent::__construct();

        $this->load->model('m_wap');
        $this->cate['game_cate'] = $this->m_wap->jqxGetId('cate', array('type' => 'game', 'status' => 'active'), 'id_cate, title, alias');
        $this->cate['app_cate'] = $this->m_wap->jqxGetId('cate', array('type' => 'app', 'status' => 'active'), 'id_cate, title, alias');
        $this->fav = $this->m_wap->jqxGetId('game_app', array('favorite' => 'active', 'type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, description, download_url', 10);
        $num = rand(0,9);
        $_SESSION['banner'] = $this->fav[$num];
        $this->template->set_template('wap');
//        die(json_encode($this->data['banner']));
    }


    public function index()
    {

        $this->data['game_fav'] = $this->fav;

        $this->data['game_new'] = $this->m_wap->jqxGetId('game_app', array('set_new' => 'active', 'type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size, download_url', 5);

        $this->data['app'] = $this->m_wap->jqxGetId('game_app', array('set_new' => 'active', 'type' => 'app', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size, download_url', 5);

        $this->data['news'] = $this->m_wap->jqxGetId('news_video', array('set_home' => 'active', 'type' => 'news', 'status' => 'active'), 'id_news_video, name, image, description', 5);

        $this->data['videos'] = $this->m_wap->jqxGetId('news_video', array('set_home' => 'active', 'type' => 'video', 'status' => 'active'), 'id_news_video, name, image, description', 5);

        $this->data['cate'] = $this->cate;



        $this->template->write_view('content', 'view_home', $this->data);

        $this->template->render();

    }


    public function game()
    {

        $this->data['game'] = $this->m_wap->jqxGetId('game_app', array('type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size, download_url', $this->limit);

//        die(json_encode($this->data));

        $this->template->write_view('content', 'game/view_game', $this->data);

        $this->template->render();

    }


    public function game_detail($params)
    {

        $id = check_id($params);

        $this->data['game'] = $this->m_wap->jqxGetId('game_app', array('id_game_app' => $id, 'type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, slide_image, description, content, count_download, size, download_url');

//        die(json_encode($this->data));

        $this->template->write_view('content', 'game/view_game_detail', $this->data);

        $this->template->render();

    }


    public function app()
    {

        $this->data['app'] = $this->m_wap->jqxGetId('game_app', array('type' => 'app', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size, download_url', $this->limit);

//        die(json_encode($this->data));

        $this->template->write_view('content', 'game/view_app', $this->data);

        $this->template->render();

    }

    public function app_detail($params)
    {

        $id = check_id($params);

        $this->data['app'] = $this->m_wap->jqxGetId('game_app', array('id_game_app' => $id, 'type' => 'app', 'status' => 'active'), 'id_game_app, name, icon, slide_image, description, content, count_download, size, download_url');

//        die(json_encode($this->data));

        $this->template->write_view('content', 'game/view_app_detail', $this->data);

        $this->template->render();

    }

    public function video()
    {

        $this->data['video'] = $this->m_wap->jqxGetId('news_video', array('type' => 'video', 'status' => 'active'), 'id_news_video, name, image, description', $this->limit);

//        die(json_encode($this->data));

        $this->template->write_view('content', 'video/view_video', $this->data);

        $this->template->render();

    }


    public function video_detail($params)
    {

        $id = check_id($params);

        $this->data['video'] = $this->m_wap->jqxGetId('news_video', array('id_news_video' => $id, 'type' => 'video', 'status' => 'active'), 'id_news_video, name, image, description, content, youtube_id');

//        die(json_encode($this->data));

        $this->template->write_view('content', 'video/view_video_detail', $this->data);

        $this->template->render();

    }


    public function news()
    {

        $this->data['news'] = $this->m_wap->jqxGetId('news_video', array('type' => 'news', 'status' => 'active'), 'id_news_video, name, image, description', $this->limit);

//        die(json_encode($this->data));

        $this->template->write_view('content', 'news/view_news', $this->data);

        $this->template->render();

    }


    public function news_detail($params)
    {

        $id = check_id($params);

        $this->data['news'] = $this->m_wap->jqxGetId('news_video', array('id_news_video' => $id, 'type' => 'news', 'status' => 'active'), 'id_news_video, name, image, description, content, youtube_id');

//        die(json_encode($this->data));

        $this->template->write_view('content', 'news/view_news_detail', $this->data);

        $this->template->render();

    }

    public function app_cate($params)
    {
        $id = check_id($params);
        $this->data['app'] = $this->m_wap->jqxGetId('game_app', array('cate' => $id, 'type' => 'app', 'status' => 'active'), 'id_game_app, name, icon, slide_image, description, content, count_download, size, download_url', $this->limit);

        $this->template->write_view('content', 'game/view_app_cate', $this->data);
        $this->template->render();
    }

    public function game_cate($params)
    {
        $id = check_id($params);
        $this->data['game'] = $this->m_wap->jqxGetId('game_app', array('cate' => $id, 'type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, slide_image, description, content, count_download, size, download_url', $this->limit);
        $this->data['cate'] = $this->m_wap->jqxGetId('cate', array('id_cate' => $id, 'status' => 'active'), 'title');

        $this->template->write_view('content', 'game/view_game_cate', $this->data);
        $this->template->render();
    }

    public function loadmore()
    {
        $params = $this->input->get(NULL, TRUE);
        $data = $result = '';
        $offset = check_offset($params['page'], $this->limit);
        if ($params['menu'] == 'game') {
            $data = $this->m_wap->jqxGetId('game_app', array('type' => 'game', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size', $this->limit, $offset);
            $num_row = $this->m_wap->get_num_row('game_app', array('type' => 'game', 'status' => 'active'));


            if (!empty($data))
                foreach ($data as $key => $value) {
                    $result .= '
                            <li class="ui-li-has-alt ui-li-has-thumb">
                                <a href="' . base_url('game/' . utf8_to_ascii($value['name']) . '-' . $value['id_game_app'] . '.html') . '" class="ui-btn">
                                    <img src="' . base_url($value["icon"]) . '" />
                                    <h2>' . $value['name'] . '</h2>
                                    <p id="info-game"> ' . $value["count_download"] . 'tải | ' . $value['size'] . ' kb</p>
                                    <p id="descript-game">' . limit_text($value["description"], 20) . '</p>
                                </a>
                                <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop" aria-haspopup="true" aria-owns="purchase" aria-expanded="false" class="ui-btn ui-btn-icon-notext ui-icon-gear ui-btn-a" title=""></a>
                                <div class="free-download">FREE</div>
                            </li>
                    ';
                }
        }
        if ($params['menu'] == 'app') {
            $data = $this->m_wap->jqxGetId('game_app', array('type' => 'app', 'status' => 'active'), 'id_game_app, name, icon, description, count_download, size', $this->limit, $offset);
            $num_row = $this->m_wap->get_num_row('game_app', array('type' => 'app', 'status' => 'active'));


            if (!empty($data))
                foreach ($data as $key => $value) {
                    $result .= '
                            <li class="ui-li-has-alt ui-li-has-thumb">
                                <a href="' . base_url('ung-dung/' . utf8_to_ascii($value['name']) . '-' . $value['id_game_app'] . '.html') . '" class="ui-btn">
                                    <img src="' . base_url($value["icon"]) . '" />
                                    <h2>' . $value['name'] . '</h2>
                                    <p id="info-game"> ' . $value["count_download"] . 'tải | ' . $value['size'] . ' kb</p>
                                    <p id="descript-game">' . limit_text($value["description"], 20) . '</p>
                                </a>
                                <a href="#purchase" data-rel="popup" data-position-to="window" data-transition="pop" aria-haspopup="true" aria-owns="purchase" aria-expanded="false" class="ui-btn ui-btn-icon-notext ui-icon-gear ui-btn-a" title=""></a>
                                <div class="free-download">FREE</div>
                            </li>
                    ';
                }
        }


        $array_result = array(
            'isLoadmore' => check_last_page($offset, $num_row),
            'html' => $result,
            'page' => $params['page'] + 1,
        );

        die(json_encode($array_result));

    }

    public function download()
    {
        $params = $this->input->get(NULL, TRUE);
        $db = $this->m_wap->jqxGetId('game_app', array('id_game_app' => $params['id'], 'status' => 'active'), 'id_game_app, download_url, count_download, count_install');
        $url = json_decode($db[0]['download_url'], TRUE);
        $link = base_url($url[$params['platform']]);
        if(link_copy($url[$params['platform']]) === FALSE){
            $link = $url[$params['platform']];
        }
        $data_update = array(
            'count_download' => $db[0]['count_download'] + 1,
            'count_install' => $db[0]['count_install'] + 1,
        );
        $this->m_wap->jqxUpdate('game_app', 'id_game_app', $params['id'], $data_update);
        header('Location: '. $link);
        die();
    }


}

