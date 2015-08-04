<?php

date_default_timezone_set('Asia/Bangkok');
//session_start();
ini_set("display_errors", '1');
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_Ajax extends MY_Controller {

    protected $_arrParam;

    function __construct() {
        parent::__construct();
        $this->check_permission();
        $this->load->model('m_backend');
    }

    public function get_list($table = 'game') {
        $table = $this->check_security($table);

        $this->m_backend->datatables_config = array(
            "table" => $table,
                //"where" => "where `status` != 0",
                //"order_by" => "ORDER BY id DESC",
        );

        $list = $this->m_backend->jqxBinding();
        foreach ($list['rows'] as $key => $value) {
            unset(
                    $list['rows'][$key]['content'], $list['rows'][$key]['contentafterscan'], $list['rows'][$key]['keywordscan']
            );
        }
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function listgame() {
        $this->m_backend->datatables_config = array(
            "table" => 'game_app',
            //"where" => "where id_game IN (" . $str . ")",
            "order_by" => "ORDER BY id_game_app DESC",
        );


        $list = $this->m_backend->jqxBinding();
//        die(json_encode($list));
        foreach ($list['rows'] as $key => $value) {
            $a = json_decode($value['platform'], TRUE);
            $list['rows'][$key]['platform'] = implode(', ', $a);
        }
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function listnews() {
        $this->m_backend->datatables_config = array(
            "table" => 'news_video',
            "where" => "where type= 'news' ",
            "order_by" => "ORDER BY id_news_video DESC",
        );


        $list = $this->m_backend->jqxBinding();
//        die(json_encode($list));

        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function listvideo() {
        $this->m_backend->datatables_config = array(
            "table" => 'news_video',
            "where" => "where type= 'video' ",
            "order_by" => "ORDER BY id_news_video DESC",
        );


        $list = $this->m_backend->jqxBinding();
//        die(json_encode($list));

        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function listhistory($table) {
        $arrParam = $this->input->get(NULL, TRUE);
        if ($table == 'history_rotation') {
            $this->m_backend->datatables_config = array(
                "table" => $table,
                "where" => "where id_user_app = '" . $arrParam['id_user_app'] . "' AND date(create_time) >= '" . $arrParam['start_time'] . "' AND date(create_time) <= '" . $arrParam['end_time'] . "'",
                "order_by" => "ORDER BY id_history_rotation DESC",
            );
        } elseif ($table == 'change_gift') {
            $this->m_backend->datatables_config = array(
                "table" => $table,
                "where" => "where user_id = '" . $arrParam['id_user_app'] . "' AND date(create_time) >= '" . $arrParam['start_time'] . "' AND date(create_time) <= '" . $arrParam['end_time'] . "'",
                "order_by" => "ORDER BY id_change_gift DESC",
            );
        } elseif ($table == 'action_event') {
            $this->m_backend->datatables_config = array(
                "table" => $table,
                "where" => "where user_name = '" . $arrParam['id_user_app'] . "' AND date(create_time) >= '" . $arrParam['start_time'] . "' AND date(create_time) <= '" . $arrParam['end_time'] . "'",
                "order_by" => "ORDER BY id_action_event DESC",
            );
        } elseif ($table == 'history_gift_login') {
            $this->m_backend->datatables_config = array(
                "table" => $table,
                "where" => "where user_name = '" . $arrParam['id_user_app'] . "' AND date(create_time) >= '" . $arrParam['start_time'] . "' AND date(create_time) <= '" . $arrParam['end_time'] . "'",
                "order_by" => "ORDER BY id_history_gift DESC",
            );
        } elseif ($table == 'user_app') {
            $this->m_backend->datatables_config = array(
                "table" => $table,
                "where" => "where date(create_time) >= '" . $arrParam['start_time'] . "' AND date(create_time) <= '" . $arrParam['end_time'] . "'",
                "order_by" => "ORDER BY id_user_app DESC",
            );
        }
        $list = $this->m_backend->jqxBinding();
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function totalhistory($table) {
        $arrParam = $this->input->get(NULL, TRUE);
        $result = $this->m_backend->jqxGetTotalPlatform($table, $arrParam);
        $html = '<ul class="total-platform">';
        if (empty($result) === FALSE) {
            foreach ($result as $val) {
                $html .= '<li>' . $val['platform'] . ': <span>' . $val['total'] . '</span></li>';
            }
        }
        $html .= '</ul>';
        echo json_encode($html);
        exit();
    }

    public function chart($table) {
        $arrParam = $this->input->post(NULL, TRUE);
        $response['code'] = -1;
        $response['message'] = 'Load dữ liệu thất bại!';

        $data = $this->m_backend->detail_total_device($arrParam['start_time'], $arrParam['end_time']);
        if (empty($data) === FALSE) {
            $response['code'] = 0;
            $response['data_chart'] = "['Android', " . @$data['android'] . "],['Ios'," . @$data['ios'] . "],['WindowPhone', " . @$data['wp'] . "]";
            $response['android'] = @$data['android'];
            $response['ios'] = @$data['ios'];
            $response['wp'] = @$data['wp'];
        }



        echo json_encode($response);
        exit();
    }

    public function listnewsevent() {
        $user_info = $this->session->userdata("user_info");

        $this->m_backend->datatables_config = array(
            "table" => 'news',
            "order_by" => "ORDER BY id_news DESC",
        );

        $list = $this->m_backend->jqxBinding();
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function listvideos() {
        $this->m_backend->datatables_config = array(
            "select" => 'SELECT SQL_CALC_FOUND_ROWS v.id_video, v.title, v.id_game, v.id_category, v.id_youtube, v.duration, v.create_time, v.timer, v.hot_video, v.active_slide, v.status',
            "from" => 'FROM videos AS v',
            //"table" => 'news',
            "order_by" => "ORDER BY v.id_video DESC",
        );

        $list = $this->m_backend->jqxBinding();
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function listgiftcode() {
        $this->m_backend->datatables_config = array(
            "select" => 'SELECT SQL_CALC_FOUND_ROWS v.id_name, v.name, v.id_game, v.id_publisher, v.total, v.is_slider, v.create_time, v.display_game, v.create_user, v.status',
            "from" => 'FROM codes_name AS v',
            //"table" => 'news',
            "order_by" => "ORDER BY v.id_name DESC",
        );

        $list = $this->m_backend->jqxBinding();
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function listcomments($type = 1) {
        $table = $this->check_security($type);
        if ($type == 1) {
            $join = "join news n on c.id_news=n.id_news";
        } else {
            $join = "join videos n on c.id_news=n.id_video";
        }
        $this->m_backend->datatables_config = array(
            "select" => 'SELECT SQL_CALC_FOUND_ROWS c.*, u.full_name, n.title',
            "from" => 'from news_comments c',
            'join' => "join users u on c.id_users=u.id " . $join,
            "where" => "where c.type = " . $type,
            "order_by" => "ORDER BY id_comment DESC",
        );

        $list = $this->m_backend->jqxBinding();
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function updatestatusgame($ctr, $act, $table = '', $field = '') {
        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ 1';

        if ($this->session->userdata['user_info']['name'] != 'admin') {
            $response['message'] = 'Bạn không có quyền sử dụng tính năng này!';
            goto end;
        }



        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);

        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit;
        }

        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $st = (!empty($_GET['st']) ? ($this->input->get('st', TRUE)) : 0);

        $id = $this->security->xss_clean($id);
        $st = $this->security->xss_clean($st);



        $this->m_backend->_table = $table;


        $Params[$_GET['field']] = $st;



        $data = $this->m_backend->jqxUpdate($table, $field, $id, $Params);


        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }

        end:
        echo json_encode($response);
        exit();
    }

    public function updatestatus($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit;
        }
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $st = (!empty($_GET['st']) ? ($this->input->get('st', TRUE)) : 0);

        $id = $this->security->xss_clean($id);
        $st = $this->security->xss_clean($st);

        $this->m_backend->_table = $table;

        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $data = $this->m_backend->jqxUpdate($table, $field, $id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
            if ($ctr == 'admin_giftcode' and $table == 'codes_name' and $st == 1) {
                $this->push_notify_giftcode($id);
            }
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function deletegame($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit;
        }

        $gameUser = $this->m_backend->jqxGetId('user_has_game', 'id_admin', $this->session->userdata['user_info']['id_admin']);
        $arr = array();
        if (empty($gameUser) === FALSE) {
            foreach ($gameUser as $val) {
                $arr[] = $val['id_game'];
            }
        }
        $id = $this->input->get('id', TRUE);
        if (!in_array($id, $arr)) {
            exit;
        }

        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);

        $data = $this->m_backend->jqxDelete($table, $field, $id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function delete($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            redirect(base_url() . 'logout');
        }
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);

        $data = $this->m_backend->jqxDelete($table, $field, $id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addpublisher() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/publisher';
        $response['message']['full_name'] = '';
        $response['message']['address'] = '';
        $response['message']['phone'] = '';
        $response['message']['id_country'] = '';
        $response['message']['logo'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];

            $this->form_validation->set_rules('full_name', 'full_name', 'callback_xss_check|trim|required');
            //$this->form_validation->set_rules('address', 'address', 'callback_xss_check|trim|required');
            //$this->form_validation->set_rules('phone', 'phone', 'callback_phone_check|trim|required');
            $this->form_validation->set_rules('id_country', 'id_country', 'callback_xss_check|trim|required');
            //$this->form_validation->set_rules('logo', 'logo', 'trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {



                if (empty($Id) === TRUE) {
                    $Params = array();
                    //$Params['phone'] = $this->security->xss_clean($arrParam['phone']);
                    $Params['full_name'] = $this->security->xss_clean($arrParam['full_name']);
                    //$Params['address'] = $this->security->xss_clean($arrParam['address']);
                    $Params['website'] = $this->security->xss_clean($arrParam['website']);
                    $Params['note'] = $arrParam['note'];
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $Params['id_country'] = $this->security->xss_clean($arrParam['id_country']);
                    $Params['logo'] = $this->security->xss_clean($arrParam['logo']);

                    $this->m_backend->jqxInsert('publisher', $Params);
                } else {
                    $Params = array();
                    //$Params['phone'] = $this->security->xss_clean($arrParam['phone']);
                    $Params['full_name'] = $this->security->xss_clean($arrParam['full_name']);
                    //$Params['address'] = $this->security->xss_clean($arrParam['address']);
                    $Params['website'] = $this->security->xss_clean($arrParam['website']);
                    $Params['note'] = $arrParam['note'];
                    $Params['id_country'] = $this->security->xss_clean($arrParam['id_country']);
                    //$Params['logo'] = $this->security->xss_clean($arrParam['logo']);

                    $this->m_backend->jqxUpdate('publisher', 'id_publisher', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['full_name'] = trim(str_replace($badchars, '', form_error('full_name')));
                //$response['message']['address'] = trim(str_replace($badchars, '', form_error('address')));
                //$response['message']['phone'] = trim(str_replace($badchars, '', form_error('phone')));
                $response['message']['id_country'] = trim(str_replace($badchars, '', form_error('id_country')));
                $response['message']['logo'] = trim(str_replace($badchars, '', form_error('logo')));
                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addgame() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/index';
        $response['message']['type'] = '';
        $response['message']['name'] = '';
        $response['message']['code_game'] = '';
        $response['message']['platform'] = '';
        $response['message']['system'] = '';
        $response['message']['id_game'] = 0;

        $response['message']['order'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post();
            $Id = $arrParam['id'];
//            die(json_encode($arrParam));
            //get publisher
            $this->m_backend->datatables_config = array(
                "table" => 'publisher',
                "order_by" => "ORDER BY id_publisher DESC",
            );
            $this->form_validation->set_rules('code_game', 'code_game', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('name', 'name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('platform', 'platform', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('type', 'type', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('description', 'description', 'callback_xss_check');
            $this->form_validation->set_rules('order', 'order', 'callback_num_check|trim');
            $this->form_validation->set_rules('cate', 'cate', 'callback_num_check|trim');

            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Params = array();
                if (isset($arrParam['set_new'])) {
                    $Params['set_new'] = $arrParam['set_new'];
                } else {
                    $Params['set_new'] = 'block';
                }
                if (isset($arrParam['favorite'])) {
                    $Params['favorite'] = $arrParam['favorite'];
                } else {
                    $Params['favorite'] = 'block';
                }
                $Params['name'] = $this->security->xss_clean($arrParam['name']);
                $Params['code_game'] = $this->security->xss_clean($arrParam['code_game']);
                $Params['platform'] = json_encode(explode(',', $this->security->xss_clean($arrParam['platform'])));
                $Params['download_url'] = json_encode($this->security->xss_clean($arrParam['url_download']));
                $Params['package_name'] = json_encode($this->security->xss_clean($arrParam['package_name']));
                $Params['size'] = ($this->security->xss_clean($arrParam['size']));
                $Params['cate'] = ($this->security->xss_clean($arrParam['cate']));

                $Params['description'] = $this->security->xss_clean($arrParam['description']);
                $Params['type'] = $this->security->xss_clean($arrParam['type']);
                $Params['icon'] = $this->security->xss_clean($arrParam['icon']);
                $Params['slide_image'] = json_encode($this->security->xss_clean($arrParam['slide']));

                $Params['count_download'] = $arrParam['count_download'];

                $Params['order'] = $arrParam['order'];
                $user_info = $this->session->userdata("user_info");

                $Params['content'] = $arrParam['content'];

                //image               
                $subject = $Params['content'];
                $pattern = '#.*<img.*src="(.*)".*>#imsU';
                preg_match_all($pattern, $subject, $matches);
                $data['arrImg'] = $matches[1];

                if (empty($matches[1]) === FALSE) {
                    foreach ($matches[1] as $k => $v) {
                        if (strpos($v, 'http') !== false) {
                            continue;
                        } else {
                            $badchars = '"' . $v . '"';
                            $rep = '"' . 'http://' . $_SERVER['HTTP_HOST'] . $v . '"';
                            $subject = str_replace($badchars, $rep, $subject);
                        }
                    }
                }

                $Params['content'] = $subject;

                if (empty($Id) === TRUE) {

                    $Params['status'] = 'active';
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $Params['create_user'] = $this->session->userdata['user_info']['username'];

                    $id_game = $this->m_backend->jqxInsertId('game_app', $Params);
                    $id_forkey = $id_game;

                    $response['code'] = 0;
                    $response['message']['id_game'] = $id_game;
                } else {
                    $id_forkey = $Id;
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $id_game = $this->m_backend->jqxUpdate('game_app', 'id_game_app', $Id, $Params);
                    $response['code'] = 0;
                    $response['message']['id_game'] = $Id;
                }
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['code_game'] = trim(str_replace($badchars, '', form_error('code_game')));
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                $response['message']['type'] = trim(str_replace($badchars, '', form_error('type')));
                $response['message']['platform'] = trim(str_replace($badchars, '', form_error('platform')));
                $response['message']['description'] = trim(str_replace($badchars, '', form_error('description')));
                $response['message']['icoin_download'] = trim(str_replace($badchars, '', form_error('icoin_download')));
                $response['message']['icoin_share'] = trim(str_replace($badchars, '', form_error('icoin_share')));
                $response['message']['order'] = trim(str_replace($badchars, '', form_error('order')));
                $response['code'] = 1;
            }
        }
        
        end:
            
        echo json_encode($response);
        exit;
    }

    private function _dateFormat($date) {
        $date = explode('/', $date);
        return $date[2] . '-' . $date[1] . '-' . $date[0];
    }

    public function addgameimage() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/index';
        $response['message']['logo_game'] = '';
        $response['message']['home_image'] = '';
        $response['message']['sub_image'] = '';
        $response['message']['background_game'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id_game'];

            $this->form_validation->set_rules('logo_game', 'logo_game', 'trim|required');
            //$this->form_validation->set_rules('home_image', 'home_image', 'trim|required');
            $this->form_validation->set_rules('sub_image', 'sub_image', 'trim|required');
            //$this->form_validation->set_rules('background_game', 'background_game', 'trim|required');
            //$this->form_validation->set_rules('image_slide_game', 'image_slide_game', 'trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {

                if (empty($Id) === FALSE && is_numeric($Id)) {

                    if (empty($arrParam['slide_image']) === FALSE) {
                        $arrSlide = array();
                        foreach ($arrParam['slide_image'] as $val) {
                            if ($val != '') {
                                $arrSlide[] = $val;
                            }
                        }
                        $arrParam['slide_image'] = json_encode($arrSlide);
                    } else {
                        $arrParam['slide_image'] = '';
                    }

                    $Id = $arrParam['id_game'];
                    unset($arrParam['id_game']);
                    if (empty($arrParam['sub_image']) === TRUE)
                        $arrParam['sub_image'] = '/frontend/assets/images/no-image-game.png';
                    if (empty($arrParam['forum_image']) === TRUE)
                        $arrParam['forum_image'] = '/frontend/assets/images/no-image-game.png';

                    //$compressed_png_content = $this->compress_png('assets/images/vinhtt/images/game-banner.png');
                    //file_put_contents('assets/images/vinhtt/images/logo-game22.png', $compressed_png_content);

                    $this->m_backend->jqxUpdate('game', 'id_game', $Id, $arrParam);
                    $response['code'] = 0;
                }
            }else {
                $badchars = array('<p>', '</p>');
                $response['message']['logo_game'] = trim(str_replace($badchars, '', form_error('logo_game')));
                //$response['message']['home_image'] =  trim(str_replace($badchars, '', form_error('home_image')));
                $response['message']['sub_image'] = trim(str_replace($badchars, '', form_error('sub_image')));
                //$response['message']['background_game'] = trim(str_replace($badchars, '', form_error('background_game')));
                //$response['message']['image_slide_game'] =  trim(str_replace($badchars, '', form_error('image_slide_game')));


                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addgameimagewap() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/index';
        $response['message']['home_image_wap'] = '';
        $response['message']['background_game_wap'] = '';
        $response['message']['menu_bg'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);

            $Id = $arrParam['id_game_wap'];

            //$this->form_validation->set_rules('home_image_wap', 'home_image_wap', 'trim|required');
            $this->form_validation->set_rules('background_game_wap', 'background_game_wap', 'trim|required');
            //$this->form_validation->set_rules('menu_bg', 'menu_bg', 'trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {

                if (empty($Id) === FALSE && is_numeric($Id)) {
                    /*
                      if(empty($arrParam['slide_image_wap']) === FALSE){
                      $arrSlide = array();
                      foreach($arrParam['slide_image_wap'] as $val){
                      if($val != ''){
                      $arrSlide[] = $val;
                      }
                      }
                      $arrParam['slide_image_wap'] = json_encode($arrSlide);
                      }else{
                      $arrParam['slide_image_wap'] = '';
                      }
                     */

                    unset($arrParam['id_game_wap']);
                    if (empty($arrParam['menu_bg']) === TRUE)
                        $arrParam['menu_bg'] = '/frontend/assets/wap/image/detail-menu-bg.png';
                    $this->m_backend->jqxUpdate('game', 'id_game', $Id, $arrParam);
                    $response['code'] = 0;
                }
            }else {
                $badchars = array('<p>', '</p>');
                //$response['message']['home_image_wap'] =  trim(str_replace($badchars, '', form_error('home_image_wap')));
                $response['message']['background_game_wap'] = trim(str_replace($badchars, '', form_error('background_game_wap')));
                //$response['message']['menu_bg'] =  trim(str_replace($badchars, '', form_error('menu_bg')));

                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addrating() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/game/index';
        $response['message']['home_image_wap'] = '';
        $response['message']['background_game_wap'] = '';
        $response['message']['menu_bg'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id_game_rating'];

            if (empty($Id) === FALSE && is_numeric($Id)) {
                $arr = array();
                unset($arrParam['dotuongthichdes'][count($arrParam['dotuongthichdes']) - 1]);
                unset($arrParam['hinhanhdes'][count($arrParam['hinhanhdes']) - 1]);
                unset($arrParam['amthanhdes'][count($arrParam['amthanhdes']) - 1]);
                unset($arrParam['gameplaydes'][count($arrParam['gameplaydes']) - 1]);
                unset($arrParam['congdongdes'][count($arrParam['congdongdes']) - 1]);

                if (empty($arrParam['dotuongthichdes'][0]))
                    $arrParam['dotuongthichdes'] = '';
                if (empty($arrParam['hinhanhdes'][0]))
                    $arrParam['hinhanhdes'] = '';
                if (empty($arrParam['amthanhdes'][0]))
                    $arrParam['amthanhdes'] = '';
                if (empty($arrParam['gameplaydes'][0]))
                    $arrParam['gameplaydes'] = '';
                if (empty($arrParam['congdongdes'][0]))
                    $arrParam['congdongdes'] = '';

                $rate_writer_description['hinhanh'] = ($arrParam['hinhanhdes']);
                $rate_writer_description['amthanh'] = ($arrParam['amthanhdes']);
                $rate_writer_description['gameplay'] = ($arrParam['gameplaydes']);
                $rate_writer_description['congdong'] = ($arrParam['congdongdes']);
                $rate_writer_description['dotuongthich'] = ($arrParam['dotuongthichdes']);

                $arr['dotuongthich'] = $arrParam['dotuongthich'];
                $arr['hinhanh'] = $arrParam['hinhanh'];
                $arr['amthanh'] = $arrParam['amthanh'];
                $arr['gameplay'] = $arrParam['gameplay'];
                $arr['congdong'] = $arrParam['congdong'];
                $arrP = array();
                $arrP['rate_writer_description'] = json_encode($rate_writer_description);
                $arrP['rate_writer'] = json_encode($arr);
                $arrP['rate_writer_medium'] = ((float) $arrParam['dotuongthich'] + (float) $arrParam['hinhanh'] + (float) $arrParam['amthanh'] + (float) $arrParam['gameplay'] + (float) $arrParam['congdong']) / 5;
                $this->m_backend->jqxUpdate('game', 'id_game', $Id, $arrP);
                $response['code'] = 0;
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addarticle() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/article/index';
        $response['message']['title'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post();
            $Id = $arrParam['id'];

            $this->form_validation->set_rules('title', 'title', 'callback_xss_check|trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {

                $Params = array();
                $Params['title'] = $this->security->xss_clean($arrParam['title']);
                $Params['fulltext'] = $arrParam['fulltext'];

                if (empty($Id) === TRUE) {
                    $this->load->library('session');
                    $user_info = $this->session->userdata('user_info');
                    $Params['status'] = 1;
                    $Params['created'] = date('Y-m-d H:i:s');
                    $Params['created_by'] = $user_info['id_admin'];

                    $this->m_backend->jqxInsert('article', $Params);
                } else {
                    $this->load->library('session');
                    $user_info = $this->session->userdata('user_info');
                    $Params['modified'] = date('Y-m-d H:i:s');
                    $Params['modified_by'] = $user_info['id_admin'];
                    $this->m_backend->jqxUpdate('article', 'id', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['title'] = trim(str_replace($badchars, '', form_error('title')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addgamecategory() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/category/list_category';

        $response['message']['title'] = '';
        $response['message']['type'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];






            $this->form_validation->set_rules('title', 'title', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('type', 'type', 'callback_xss_check');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {



                $Params = array();
                $Params['title'] = $this->security->xss_clean($arrParam['title']);
                $Params['type'] = $this->security->xss_clean($arrParam['type']);

                if (empty($Id) === TRUE) {
                    $this->load->library('session');
                    $user_info = $this->session->userdata('user_info');
                    $Params['alias'] = utf8_to_ascii($Params['title']);
                    $Params['create_time'] = date('Y-m-d H:i:s');


                    $this->m_backend->jqxInsert('cate', $Params);
                } else {
                    $this->m_backend->jqxUpdate('cate', 'id_cate', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['title'] = trim(str_replace($badchars, '', form_error('title')));
                $response['message']['type'] = trim(str_replace($badchars, '', form_error('type')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addaccount() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/account/index';
        $response['message']['id_group'] = '';
        $response['message']['username'] = '';
        $response['message']['full_name'] = '';
        $response['message']['password'] = '';
        $response['message']['system'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->security->xss_clean($this->input->post(NULL, TRUE));
            $Id = $arrParam['id'];
            $this->form_validation->set_rules('id_group', 'id_group', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('username', 'username', 'callback_username_check|trim|required');
            $this->form_validation->set_rules('full_name', 'full_name', 'callback_xss_check|trim|required');
            if (empty($Id) === TRUE) {
                $this->form_validation->set_rules('password', 'password', 'trim|required');
            }
            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {

                if (isset($_FILES["ImageFile"]["name"]) && empty($_FILES["ImageFile"]["name"]) === FALSE) {
                    $arrParam['Image-name'] = $_FILES["ImageFile"]["name"];
                } else {
                    $arrParam['Image-name'] = '';
                }
                if ($arrParam['Image-name'] != '') {
                    //crop image
                    $this->load->library('UploadImage');
                    $dirUpload = 'assets/images/upload/';
                    $dirFix = 'assets/images/upload/fix/';
                    $this->uploadimage->crop_image($arrParam['Image-name'], $dirUpload, $dirFix, $_FILES["ImageFile"]["type"], $arrParam['x'], $arrParam['y'], $arrParam['w'], $arrParam['h']);
                }


                $Params = array();
                $Params['username'] = $arrParam['username'];
                $Params['full_name'] = $arrParam['full_name'];
                $Params['id_group'] = $arrParam['id_group'];
                $Params['penname'] = htmlspecialchars($arrParam['penname']);
                $Params['description'] = htmlspecialchars($arrParam['description']);
                if ($arrParam['Image-name'] != '') {
                    $Params['avatar'] = $arrParam['Image-name'];
                }
                if (empty($Id) === TRUE) {
                    $Params['password'] = md5($arrParam['password']);
                    $Params['status'] = 0;
                    $Params['create_time'] = date('Y-m-d H:i:s');

                    $rs = $this->m_backend->jqxInsertId('user', $Params);
                } else {
                    $rs = $arrParam['id'];
                    $Params['update_time'] = date('Y-m-d H:i:s');

                    if ($arrParam['password'] != '') {
                        $Params['password'] = md5($arrParam['password']);
                    }
                    $this->m_backend->jqxUpdate('user', 'id_admin', $Id, $Params);

                    $this->m_backend->jqxDelete('user_has_function', 'id_admin', $Id);

                    $this->m_backend->jqxDelete('user_has_game', 'id_admin', $Id);
                }
                /*
                  if(isset($arrParam['mid'])){
                  foreach($arrParam['mid'] as $v){
                  $Pas = array();
                  $Pas['id_admin'] = $rs;
                  $Pas['id_function'] = $v;
                  $r = $this->m_backend->jqxInsert('user_has_function',$Pas);
                  }
                  }
                 */
                if (isset($arrParam['gid'])) {
                    foreach ($arrParam['gid'] as $v) {
                        $Pas = array();
                        $Pas['id_admin'] = $rs;
                        $Pas['id_game'] = $v;
                        $Pas['status'] = 1;
                        $Pas['create_time'] = date('Y-m-d H:i:s');
                        $r = $this->m_backend->jqxInsert('user_has_game', $Pas);
                    }
                }


                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['id_group'] = trim(str_replace($badchars, '', form_error('id_group')));
                $response['message']['username'] = trim(str_replace($badchars, '', form_error('username')));
                $response['message']['full_name'] = trim(str_replace($badchars, '', form_error('full_name')));
                if (empty($Id) === TRUE) {
                    $response['message']['password'] = trim(str_replace($badchars, '', form_error('password')));
                }
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addmenu() {
        $this->load->library('form_validation');
        $response['code'] = -1;

        $response['redirect'] = '/backend/menu/index';
        $response['message']['group_name'] = '';
        $response['message']['name_display'] = '';
        $response['message']['url'] = '';
        $response['message']['name'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];
            $this->form_validation->set_rules('group_name', 'group_name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('name_display', 'name_display', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('name', 'name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('url', 'url', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Params = array();
                $Params['parent_id'] = $arrParam['group_name'];
                $Params['name_display'] = $arrParam['name_display'];
                $Params['url'] = $arrParam['url'];
                $Params['name'] = $arrParam['name'];

                $badchars = '#/#';
                $Params['alias'] = trim(preg_replace($badchars, '-', substr($arrParam['url'], 1)));
                if (empty($Id) === FALSE) {
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $this->m_backend->jqxUpdate('function', 'id_function', $Id, $Params);
                } else {
                    $Params['is_leaf'] = 0;
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $this->m_backend->jqxInsert('function', $Params);
                }
                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['group_name'] = trim(str_replace($badchars, '', form_error('group_name')));
                $response['message']['name_display'] = trim(str_replace($badchars, '', form_error('name_display')));
                $response['message']['url'] = trim(str_replace($badchars, '', form_error('url')));
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function num_check($str = '') {
        if ($str == 0) {
            return TRUE;
        }
        $str = $this->check_security($str);
        $validate = preg_match('#^[1-9]{1}\d{0,}$#', $str);
        if (!$validate) {
            $this->form_validation->set_message('num_check', 'Phải là chử số!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function username_check($str = '') {
        $str = $this->check_security($str);
        $validate = preg_match('#^[0-9a-zA-Z._-]{2,20}$#', $str);
        if (!$validate) {
            $this->form_validation->set_message('username_check', 'Viết liền nhau không dấu, nhiều hơn 2 ký tự!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function date_check($str = '') {
        $str = $this->check_security($str);
        $validate = preg_match('#^[0-9]{2} / [0-9]{2} / [0-9]{4}$#', $str);
        if (!$validate) {
            $this->form_validation->set_message('date_check', 'Không hợp lệ!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function phone_check($str = '') {
        $str = $this->check_security($str);
        $validate = preg_match('#^[0-9._-]{10,12}$#', $str);
        if (!$validate) {
            $this->form_validation->set_message('phone_check', 'Không hợp lệ!');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function xss_check($str = '') {
        $str = $this->check_security($str);
        if ($str != '') {
            $validate = preg_match('#^[^\*@\#\$%&<>()\']{1,1000}$#', $str);
            if (!$validate) {
                $this->form_validation->set_message('xss_check', 'Không được nhập ký tự đặc biệt!');
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function updatenews($table) {
        $table = $this->check_security($table);
        //-- Check user have permission to delete ------------------------------
        $id = $this->input->get('id', TRUE);
        $st = $this->input->get('st', TRUE);
        $id = (!empty($id) ? $id : 0);
        $st = (!empty($st) ? $st : 0);
        $this->m_backend->_table = $table;


        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $data = $this->m_backend->jqxUpdatenews($id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $solrUpdate = $this->m_backend->addNewsintoSolrDocument($id);
            $response['solr'] = $solrUpdate;
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function deletenews($table) {
        $table = $this->check_security($table);
        $id = $this->input->get('id', TRUE);
        $id = (!empty($id) ? $id : 0);
        $this->m_backend->_table = $table;
        $data = $this->m_backend->jqxDeletenews($id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addnewsevent() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/newsevent/index';
        $response['message']['id_game'] = '';
        $response['message']['title'] = '';
        $response['message']['code_game'] = '';
        $response['message']['platform'] = '';
        $response['message']['system'] = '';
        $response['message']['id_game'] = 0;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post();
            $Id = $arrParam['id'];

            $this->form_validation->set_rules('title', 'title', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('platform', 'platform', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('id_game', 'id_game', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('description', 'description', 'callback_xss_check');

            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Params = array();
                $Params['title'] = $this->security->xss_clean($arrParam['title']);
                $Params['platform'] = json_encode(explode(',', $this->security->xss_clean($arrParam['platform'])));
                $Params['icon'] = json_encode($this->security->xss_clean($arrParam['icon']));
                $Params['description'] = $this->security->xss_clean($arrParam['description']);
                $Params['id_game'] = $this->security->xss_clean($arrParam['id_game']);
                $Params['icon'] = $this->security->xss_clean($arrParam['icon']);
                $user_info = $this->session->userdata("user_info");

                $Params['content'] = $arrParam['content'];

                //image               
                $subject = $Params['content'];
                $pattern = '#.*<img.*src="(.*)".*>#imsU';
                preg_match_all($pattern, $subject, $matches);
                $data['arrImg'] = $matches[1];

                if (empty($matches[1]) === FALSE) {
                    foreach ($matches[1] as $k => $v) {
                        if (strpos($v, 'http') !== false) {
                            continue;
                        } else {
                            $badchars = '"' . $v . '"';
                            $rep = '"' . 'http://' . $_SERVER['HTTP_HOST'] . $v . '"';
                            $subject = str_replace($badchars, $rep, $subject);
                        }
                    }
                }

                $Params['content'] = $subject;

                if (empty($Id) === TRUE) {

                    $Params['status'] = 'active';
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $Params['user_create'] = $this->session->userdata['user_info']['username'];
                    $id_news = $this->m_backend->jqxInsertId('news', $Params);

                    $response['code'] = 0;
                    $response['message']['id_news'] = $id_news;
                } else {
                    $id_forkey = $Id;
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $id_game = $this->m_backend->jqxUpdate('news', 'id_news', $Id, $Params);
                    $response['code'] = 0;
                    $response['message']['id_news'] = $Id;
                }
            } else {
                $badchars = array('<p>', '</p>');

                $response['message']['title'] = trim(str_replace($badchars, '', form_error('title')));
                $response['message']['id_game'] = trim(str_replace($badchars, '', form_error('id_game')));
                $response['message']['platform'] = trim(str_replace($badchars, '', form_error('platform')));
                $response['message']['description'] = trim(str_replace($badchars, '', form_error('description')));

                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addnewseventimage() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/newsevent/index';
        $response['message']['image_slide'] = '';
        $response['message']['image_banner'] = '';
        $response['message']['facebook_thumbnail'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);

            $this->form_validation->set_rules('image_banner', 'Image Banner', 'trim|required');
            $this->form_validation->set_rules('facebook_thumbnail', 'facebook_thumbnail', 'trim|required');
            $this->form_validation->set_rules('image_slide', 'Image Slide', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id_news'];
                $Params['image_banner'] = $arrParam['image_banner'];
                $Params['facebook_thumbnail'] = $arrParam['facebook_thumbnail'];
                $Params['image_slide'] = $arrParam['image_slide'];
                //$Params['order_slide'] = $arrParam['order_slide'];
                $Params['active_slide'] = $arrParam['active_slide'];

                if ($Params['image_slide'] != '') {
                    $this->load->library('UploadImage');
                    $info = $this->m_backend->jqxGet('news', 'id_news', $Id);
                    $arrImage = array();
                    if ($info['image_wap'] == '') {
                        $arrImage['thumb'] = $Params['image_slide'];
                        $arrImage['content'] = '';
                    } else {
                        $arrImage = json_decode($info['image_wap'], true);
                        $arrImage['thumb'] = $Params['image_slide'];
                    }

                    $Params['image_wap'] = json_encode($arrImage);
                    /*
                      $infoWeb = pathinfo($Params['image_banner']);
                      $extensionWeb = $infoWeb['extension'];
                      $filenameWeb = $infoWeb['basename'];
                      $arrDirWeb = explode('assets', $infoWeb['dirname']);
                      $dirUploadWeb = 'assets' . @$arrDirWeb[1] . '/';
                      $arrDirWeb = explode("/", $dirUploadWeb);
                      $dirFixWeb = 'assets/images/upload/wap/' . @$arrDirWeb[2] . '/';
                     */
                    $info = pathinfo($Params['image_slide']);
                    $extension = $info['extension'];
                    //crop image
                    $filename = $info['basename'];
                    $arrDir = explode('assets', $info['dirname']);
                    $dirUpload = 'assets' . @$arrDir[1] . '/';
                    //$dirUpload = substr($info['dirname'], 1) . '/';

                    $arrDir = explode("/", $dirUpload);

                    $dirFix = 'assets/images/upload/wap/' . @$arrDir[2] . '/';
                    $widthSize = 640;
                    $heightSize = 640;
                    /*
                      if ($extensionWeb == 'jpeg' || $extensionWeb == 'jpg')
                      $this->uploadimage->copyandresize($filenameWeb, $dirUploadWeb, $dirFixWeb, $widthSize, $heightSize);
                      elseif ($extensionWeb == 'png') {
                      $this->uploadimage->reducePNG($dirUploadWeb . $filenameWeb, $dirFixWeb, $filenameWeb); //Wap
                      } else {

                      }
                     * 
                     */
                    //if ($extension == 'jpeg' || $extension == 'jpg')
                    $this->uploadimage->copyandresize($filename, $dirUpload, $dirFix, $widthSize, $heightSize);
                    //elseif ($extension == 'png') {
                    //$this->uploadimage->reducePNG($dirUpload . $filename, $dirFix, $filename); //Wap
                    //} else {
                    //}
                }

                if (empty($Id) === FALSE && is_numeric($Id)) {
                    $this->m_backend->jqxUpdate('news', 'id_news', $Id, $Params);
                }
                $response['code'] = 0;
            } else {
                $response['code'] = 1;
                $response['message']['image_banner'] = $this->form_validation->error('image_banner', ' ', ' ');
                $response['message']['facebook_thumbnail'] = $this->form_validation->error('facebook_thumbnail', ' ', ' ');
                $response['message']['image_slide'] = $this->form_validation->error('image_slide', ' ', ' ');
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addnewscategory() {
        $this->load->library('form_validation');
        $this->load->helper('text');
        $response['code'] = -1;
        $response['message']['title'] = '';
        $response['message']['parent'] = '';
        $response['redirect'] = '/backend/newsevent/category';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('parent', 'Parent', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id_category'];
                $Params['title'] = $this->security->xss_clean($arrParam['title']);
                $Params['description'] = $this->security->xss_clean($arrParam['description']);
                $Params['image'] = $this->security->xss_clean($arrParam['image']);
                $Params['status'] = $this->security->xss_clean($arrParam['status']);
                $Params['order'] = $this->security->xss_clean($arrParam['order']);

                $this->m_backend->_table = 'news_category';
                $cat = $this->m_backend->jqxGetcatname($this->security->xss_clean($arrParam['parent']));
                if (empty($cat) !== TRUE) {
                    $Params['parent'] = $cat['id_category'];
                } else {
                    $Params['parent'] = 0;
                }
                $Params['alias'] = utf8_to_ascii($Params['title']);

                $info = $this->session->userdata('user_info');
                $Params['create_user'] = $info['username'];

                if (empty($Id) === FALSE && is_numeric($Id)) {
                    $this->m_backend->jqxUpdate('news_category', 'id_category', $Id, $Params);
                } else {
                    $id_category = $this->m_backend->jqxInsertId('news_category', $Params);
                }
                $response['code'] = 0;
            } else {
                $response['message']['title'] = $this->form_validation->error('title', ' ', ' ');
                $response['message']['parent'] = $this->form_validation->error('parent', ' ', ' ');
                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function updatemenugroup($table) {
        $table = $this->check_security($table);
        //-- Check user have permission to delete ------------------------------
        $id = $this->input->get('id', TRUE);
        $st = $this->input->get('st', TRUE);
        $id = (!empty($id) ? $id : 0);
        $st = (!empty($st) ? $st : 0);
        $this->m_backend->_table = $table;

        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $data = $this->m_backend->jqxUpdatemenugroup($id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function deletemenugroup($table) {
        $table = $this->check_security($table);
        $id = $this->input->get('id', TRUE);
        $id = (!empty($id) ? $id : 0);
        $this->m_backend->_table = $table;
        $data = $this->m_backend->jqxDeletemenugroup($id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addmenugroup() {
        $this->load->library('form_validation');
        $response['code'] = -1;

        $response['redirect'] = '/backend/menu/group';
        $response['message']['display_name'] = '';
        $response['message']['alias'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $this->form_validation->set_rules('display_name', 'display_name', 'trim|required');
            $this->form_validation->set_rules('alias', 'alias', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id'];
                $Params = array();
                $this->m_backend->_table = "function_group";
                $Params['display_name'] = $arrParam['display_name'];
                $Params['order'] = $arrParam['order'];
                $Params['class'] = $arrParam['class'];
                $Params['alias'] = $arrParam['alias'];
                $Params['is_display'] = $arrParam['is_display'];

                if (empty($Id) === FALSE) {
                    $rs = $this->m_backend->jqxUpdatemenugroup($Id, $Params);
                } else {
                    $rs = $this->m_backend->jqxInsert('function_group', $Params);
                }
                $response['code'] = 0;
            } else {
                $response['code'] = 1;
                $response['message']['display_name'] = $this->form_validation->error('display_name', ' ', ' ');
                $response['message']['alias'] = $this->form_validation->error('alias', ' ', ' ');
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function update_news_category() {
        //-- Check user have permission to delete ------------------------------

        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $st = (!empty($_GET['st']) ? ($this->input->get('st', TRUE)) : 0);

        $this->m_backend->_table = "news_category";

        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$this->input->get('field', TRUE)] = $st;
        $data = $this->m_backend->jqxu_update_news_category($id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function delete_news_category() {
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $this->m_backend->_table = "news_category";
        $this->m_backend->_key = "id_category";
        $data = $this->m_backend->delete($id);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function changepass() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['message']['oldpass'] = '';
        $response['message']['password'] = '';
        $response['message']['repassword'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $this->form_validation->set_rules('oldpass', 'oldpass', 'trim|required|md5');
            $this->form_validation->set_rules('password', 'password', 'trim|required|matches[repassword]|md5');
            $this->form_validation->set_rules('repassword', 'repassword', 'trim|required|md5');
            if ($this->form_validation->run() == TRUE) {
                if (md5($arrParam['oldpass']) == $this->session->userdata['user_info']['password']) {
                    $Id = $this->session->userdata['user_info']['id_admin'];
                    $Params['password'] = md5($arrParam['password']);
                    $this->m_backend->_table = 'user';
                    $rs = $this->m_backend->jqxUpdateuser($Id, $Params);
                    $response['code'] = 0;
                } else {
                    $response['code'] = 1;
                    $response['message']['oldpass'] = 'Old pass is not correct';
                }
            } else {
                $response['code'] = 1;
                $response['message']['oldpass'] = $this->form_validation->error('oldpass', ' ', ' ');
                $response['message']['password'] = $this->form_validation->error('password', ' ', ' ');
                $response['message']['repassword'] = $this->form_validation->error('repassword', ' ', ' ');
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function addgroupuser() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/account/groupuser';
        $response['message']['name'] = '';
        $response['message']['full_name'] = '';
        $response['message']['system'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->security->xss_clean($this->input->post(NULL, TRUE));

            $Id = $arrParam['id'];
            $this->form_validation->set_rules('name', 'name', 'callback_username_check|trim|required');
            $this->form_validation->set_rules('full_name', 'full_name', 'callback_xss_check|trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {

                $Params = array();

                if (isset($arrParam['is_admin'])) {
                    $Params['is_admin'] = 1;
                } else {
                    $Params['is_admin'] = 0;
                }

                $Params['name'] = $arrParam['name'];
                $Params['full_name'] = $arrParam['full_name'];
                if (isset($arrParam['mid'])) {
                    $Params['permission'] = json_encode($arrParam['mid']);
                }
                if (empty($Id) === TRUE) {
                    $Params['status'] = 1;
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $rs = $this->m_backend->jqxInsertId('user_group', $Params);
                } else {
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $this->m_backend->jqxUpdate('user_group', 'id_group', $Id, $Params);
                }
                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                $response['message']['full_name'] = trim(str_replace($badchars, '', form_error('full_name')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addgiftcode() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/giftcode/index';
        $response['message']['csv_name'] = '';
        $response['message']['name'] = '';
        $response['message']['id_publisher'] = '';
        $response['message']['id_game'] = '';
        $response['message']['system'] = '';
        $response['message']['id_name'] = 0;
        $user_info = $this->session->userdata("user_info");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);

            if (isset($_FILES["csv"]["name"]) && empty($_FILES["csv"]["name"]) === FALSE) {
                $arrParam['csv-name'] = $_FILES["csv"]["name"];
                $info = pathinfo($arrParam['csv-name']);
                $extension = $info['extension'];
            } else {
                $arrParam['csv-name'] = '';
                $extension = '';
            }

            $this->form_validation->set_rules('id_publisher', 'id_publisher', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('id_game', 'id_game', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('name', 'name', 'callback_xss_check|trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id'];
                $par = array();
                $par['name'] = htmlspecialchars($arrParam['name']);
                $par['id_publisher'] = $arrParam['id_publisher'];
                $par['id_game'] = $arrParam['id_game'];
                $par['image'] = $arrParam['image'];
                $par['image_slider'] = $arrParam['image_slider'];
                $par['facebook_thumbnail'] = $arrParam['facebook_thumbnail'];
                $par['content'] = $this->input->post('content');
                $par['description'] = $arrParam['description'];
                $par['create_user'] = $this->session->userdata['user_info']['id_admin'];
                $keyword = $this->security->xss_clean($arrParam['seo_keyword']);
                if ($arrParam['seo_keyword'] != '') {
                    $arrKeyword = explode(",", $arrParam['seo_keyword']);
                    $par['seo_keyword'] = json_encode($arrKeyword);
                    $badchars = array('#', '\\');
                    for ($i = 0; $i < count($arrKeyword); $i++) {
                        $key_exist = $this->m_backend->jqxGet('keywords_primary', 'name', $arrKeyword[$i]);
                        if (empty($key_exist) === TRUE) {
                            $key_params['name'] = trim(str_replace($badchars, '', $arrKeyword[$i]));
                            ;
                            $key_params['create_time'] = date('Y-m-d H:i:s');
                            $key_params['update_time'] = date('Y-m-d H:i:s');
                            $key_params['create_by'] = $this->session->userdata['user_info']['id_admin'];
                            $key_params['update_by'] = $this->session->userdata['user_info']['id_admin'];
                            $key_params['alias'] = utf8_to_ascii($key_params['name']);
                            $this->m_backend->jqxInsert('keywords_primary', $key_params);
                        }
                    }
                }



                if (empty($Id) === FALSE && isset($Id)) {
                    $id_forkey = $Id;
                    $par['update_time'] = date('Y-m-d H:i:s');
                    $this->m_backend->jqxUpdate('codes_name', 'id_name', $Id, $par);
                    $response['code'] = 0;
                } else {

                    if ($arrParam['csv-name'] != '') {

                        if ($extension == 'csv' || $extension == 'txt' || $extension == 'xlsx') {

                            if (@$_FILES[csv][size] > 0) {

                                $file = @$_FILES[csv][tmp_name];
                                $handle = fopen($file, "r");

                                $Params = array();
                                $stt = 0;
                                do {
                                    if (@$data[0]) {
                                        $Params[$stt]['code'] = htmlspecialchars(addslashes($data[0]));
                                        $stt += 1;
                                    }
                                } while ($data = @fgetcsv($handle, 1000, ",", "'"));

                                $c = count($Params);

                                //insert_id code name

                                $par['status'] = 0;
                                $par['create_time'] = date('Y-m-d H:i:s');
                                $par['total'] = $c;

                                $id_name = $this->m_backend->jqxInsertId('codes_name', $par);
                                $id_forkey = $id_name;
                                if (empty($id_name) === FALSE) {
                                    if ($c > 10) {
                                        $b = 10;
                                    } else {
                                        $b = 1;
                                    }

                                    $du = $c % $b;
                                    $m = (int) ($c - $du) / $b;
                                    for ($i = 0; $i < $b; $i++) {
                                        if ($i == $b - 1) {
                                            $n = $i * $m + $m + $du;
                                        } else {
                                            $n = $i * $m + $m;
                                        }

                                        $l = $i * $m;
                                        $str = "";
                                        for ($j = $l; $j < $n; $j++) {
                                            if (isset($Params[$j]['code'])) {
                                                if ($str == "") {
                                                    $str .= "('', " . $arrParam['id_game'] . ", " . $id_name . ", " . $arrParam['id_publisher'] . ", '" . $Params[$j]['code'] . "', '" . $arrParam['name'] . "', '" . date('Y-m-d H:i:s') . "', 0, " . $this->session->userdata['user_info']['id_admin'] . ")";
                                                } else {
                                                    $str .= ",('', " . $arrParam['id_game'] . ", " . $id_name . ", " . $arrParam['id_publisher'] . ", '" . $Params[$j]['code'] . "', '" . $arrParam['name'] . "', '" . date('Y-m-d H:i:s') . "', 0, " . $this->session->userdata['user_info']['id_admin'] . ")";
                                                }
                                            }
                                        }
                                        if ($str != "") {

                                            if ($this->m_backend->inser_giftcode($str)) {
                                                $response['code'] = 0;
                                            } else {
                                                $response['message']['csv_name'] = 'File không hợp lệ!';
                                                $response['code'] = 1;
                                            }
                                        }
                                    }
                                } else {
                                    $response['message']['name'] = 'không hợp lệ!';
                                    $response['code'] = 1;
                                }
                            }
                        } else {
                            $response['message']['csv_name'] = 'File không hợp lệ!';
                            $response['code'] = 1;
                        }
                    } else {
                        $response['message']['csv_name'] = 'File không hợp lệ!';
                        $response['code'] = 1;
                    }
                }
                $solrUpdate = $this->m_backend->addGiftcodeintoSolrDocument($id_forkey);

                $response['message']['id_name'] = $id_forkey;
                $arrKeyword = explode(',', $keyword);

                if (empty($arrKeyword) === FALSE) {
                    $this->m_backend->jqxDeleteKeyWord('keywords', $id_forkey, 'giftcode');
                    $this->m_backend->deleteKeywordsintoSolrDocument($id_forkey, 'giftcode');
                    $badchars = array('#', '\\');
                    for ($i = 0; $i < count($arrKeyword); $i++) {
                        $paramsKw['name'] = trim(str_replace($badchars, '', $arrKeyword[$i]));
                        $paramsKw['create_time'] = date('Y-m-d H:i:s');
                        $paramsKw['update_time'] = date('Y-m-d H:i:s');
                        $paramsKw['update_by'] = (empty($user_info) !== TRUE) ? $user_info['id_admin'] : NULL;
                        $paramsKw['create_by'] = (empty($user_info) !== TRUE) ? $user_info['id_admin'] : NULL;
                        $paramsKw['alias'] = utf8_to_ascii($arrKeyword[$i]);
                        $paramsKw['type'] = 'giftcode';
                        $paramsKw['id_news'] = $id_forkey;

                        $kwID = $this->m_backend->jqxInsertId('keywords', $paramsKw);
                        $this->m_backend->addKeywordsintoSolrDocument($kwID, $paramsKw['name'], $paramsKw['alias'], 0, $id_forkey, 'giftcode');
                    }
                }
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                $response['message']['id_publisher'] = trim(str_replace($badchars, '', form_error('id_publisher')));
                $response['message']['id_game'] = trim(str_replace($badchars, '', form_error('id_game')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function getgameofpublisher() {
        $id_publisher = $this->input->get('id_publisher', TRUE);
        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        $response['data'] = '';
        if (isset($id_publisher)) {
            $this->m_backend->datatables_config = array(
                "table" => 'game',
                "where" => "where id_publisher = '" . $id_publisher . "'",
                "order_by" => "ORDER BY full_name ASC",
            );

            $listGame = $this->m_backend->jqxBinding();

            if (empty($listGame) === FALSE) {
                $arrGame = array();
                foreach ($listGame['rows'] as $v) {
                    $arrGame[$v['id_game']] = $v['full_name'];
                }
                $response['data'] = json_encode($arrGame);
                $response["code"] = 0;
                $response["message"] = "Set thành công.";
            } else {
                $response["code"] = -1;
                $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
            }
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function getgiftofgame() {
        $id_game = $this->input->get('id_game', TRUE);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        $response['data'] = '';
        if (isset($id_game)) {

            $this->m_backend->datatables_config = array(
                "table" => 'codes_name',
                "where" => "where id_game = '" . $id_game . "'",
                "order_by" => "ORDER BY id_name DESC",
            );

            $listGift = $this->m_backend->jqxBinding();

            if (empty($listGift) === FALSE) {
                $arrGift = array();
                foreach ($listGift['rows'] as $v) {
                    $arrGift[$v['id_name']] = $v['name'];
                }
                $response['data'] = json_encode($arrGift);
                $response["code"] = 0;
                $response["message"] = "Set thành công.";
            } else {
                $response["code"] = -1;
                $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
            }
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addshop() {
        $this->load->library('form_validation');
        $response['code'] = -1;

        $response['redirect'] = '/backend/shop/index';

        $response['message']['id_publisher'] = '';
        $response['message']['id_game'] = '';
        $response['message']['id_name'] = '';
        $response['message']['name'] = '';
        $response['message']['total'] = '';
        $response['message']['price'] = '';
        $response['message']['system'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];
            $this->form_validation->set_rules('id_publisher', 'id_publisher', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('id_game', 'id_game', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('id_name', 'id_name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('name', 'name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('total', 'total', 'callback_num_check|trim|required');
            $this->form_validation->set_rules('price', 'price', 'callback_num_check|trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');

            if ($this->form_validation->run() == TRUE) {
                unset($arrParam['id']);

                if (empty($Id) === FALSE) {
                    $arrParam['update_user'] = $this->session->userdata['user_info']['id_admin'];
                    $this->m_backend->jqxUpdate('shops', 'id', $Id, $arrParam);
                } else {
                    $arrParam['create_user'] = $this->session->userdata['user_info']['id_admin'];
                    $arrParam['update_user'] = $this->session->userdata['user_info']['id_admin'];
                    $arrParam['create_time'] = date('Y-m-d H:i:s');
                    $this->m_backend->jqxInsert('shops', $arrParam);
                }
                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['id_publisher'] = trim(str_replace($badchars, '', form_error('id_publisher')));
                $response['message']['id_game'] = trim(str_replace($badchars, '', form_error('id_game')));
                $response['message']['id_name'] = trim(str_replace($badchars, '', form_error('id_name')));
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                $response['message']['total'] = trim(str_replace($badchars, '', form_error('total')));
                $response['message']['price'] = trim(str_replace($badchars, '', form_error('price')));

                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function getChildCategory() {
        $arrr = array();
        $title = $this->security->xss_clean($this->input->get('title', TRUE));
        $arr = explode('.', $title);
        $where = '';
        for ($i = 0; $i < count($arr); $i++) {
            if (count($arr) == 1)
                $where = 'p.title="' . $arr[$i] . '"';
            else {
                if ($i == 0)
                    $where .= 'p.title="' . $arr[$i] . '"';
                else
                    $where .= ' OR p.title="' . $arr[$i] . '"';
            }
        }
        $this->m_backend->datatables_config = array(
            "table" => 'news_category',
            "where" => "where parent IN (SELECT p.id_category FROM news_category as p WHERE " . $where . " )",
                //"order_by" => "ORDER BY id DESC",
        );
        $child = $this->m_backend->jqxBinding();
        foreach ($child['rows'] as $c) {
            $arrr[$c['id_category']] = $c['title'] . '-' . $c['id_category'];
        }
        echo json_encode($arrr);
    }

    public function getVote() {
        $params = $this->input->get(NULL, TRUE);
        $maxRows = $params['maxRows'];
        $keyword = $params['name_startsWith'];
        $votes = $this->m_backend->jqxGetLike('vote', 'name', $keyword, $maxRows);
        echo json_encode($votes);
    }

    /*
     *  Thêm vote mới
     */

    public function addvote() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/vote/index';
        $response['message']['name'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post();
            //print_r($arrParam);
            $Id = $arrParam['id'];
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('criteria', 'Tiêu chí', 'required');
            $this->form_validation->set_message('required', 'Không được rỗng');

            //kiem tra tieu chi
            if (empty($arrParam['criteria'][0]['name']) || empty($arrParam['criteria'][1]['name']))
                $_POST['criteria'] = '';

            if ($this->form_validation->run() == TRUE) {
                $curr_user = $this->session->userdata('user_info');
                $Params = array();
                $Params['name'] = $this->security->xss_clean($arrParam['name']);
                $Params['style_vote'] = intval($arrParam['style_vote']);
                $Params['get_info_user'] = intval($arrParam['get_info_user']);
                $Params['status'] = intval($arrParam['status']);
                $Params['content'] = $arrParam['content'];
                if (!empty($Id)) {
                    $item_old = $this->m_backend->jqxGet('vote', 'id', $Id);
                    if (!empty($item_old['criteria'])) {
                        $item_old['criteria'] = json_decode($item_old['criteria'], true);
                        $Params['criteria'] = $item_old['criteria'];
                    } else {
                        $Params['created'] = date('Y-m-d H:i:s');
                        $Params['created_id'] = $curr_user['id_admin'];
                        $Params['created'] = date('Y-m-d H:i:s');
                    }
                } else {
                    $Params['created'] = date('Y-m-d H:i:s');
                    $Params['created_id'] = $curr_user['id_admin'];
                }
                $Params['modified'] = date('Y-m-d H:i:s');
                $Params['modified_id'] = $curr_user['id_admin'];
                //lay danh sach tieu chi
                $i = 0;
                $Params['criteria'] = array();
                foreach ($arrParam['criteria'] as $item) {
                    if (!empty($item['name'])) {
                        $Params['criteria'][$i]['name'] = $this->security->xss_clean($item['name']);
                        $Params['criteria'][$i]['order'] = intval($item['order']);
                        $Params['criteria'][$i]['total'] = intval($item['total']);
                        $i++;
                    } else {
                        break;
                    }
                }
                $Params['criteria'] = json_encode($Params['criteria']);
                //set thoi gian
                if (empty($arrParam['start_time']))
                    $Params['start_time'] = date('Y-m-d H:i:s');
                else
                    $Params['start_time'] = date('Y-m-d H:i:s', strtotime($arrParam['start_time']));
                //set end time
                if (empty($arrParam['end_time']))
                    $Params['end_time'] = date('Y-m-d H:i:s');
                else
                    $Params['end_time'] = date('Y-m-d H:i:s', strtotime($arrParam['end_time']));


                if (empty($Id) === TRUE) { //insert
                    $this->m_backend->jqxInsert('vote', $Params);
                } else { //update
                    $this->m_backend->jqxUpdate('vote', 'id', $Id, $Params);
                }
                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                $response['message']['criteria'] = trim(str_replace($badchars, '', form_error('criteria')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function getgamebypublisher() {
        $arrr = array();
        $title = $this->security->xss_clean($this->input->get('name', TRUE));

        if (empty($title) === TRUE) {
            echo json_encode($arrr);
            exit;
        }
        $arr = explode('***', $title);
        $where = '';
        for ($i = 0; $i < count($arr); $i++) {
            if (count($arr) == 1)
                $where = 'p.full_name="' . $arr[$i] . '"';
            else {
                if ($i == 0)
                    $where .= 'p.full_name="' . $arr[$i] . '"';
                else
                    $where .= ' OR p.full_name="' . $arr[$i] . '"';
            }
        }
        //$publisher = $this->m_backend->jqxGet('publisher', 'full_name', $title);
        $this->m_backend->datatables_config = array(
            "table" => 'game',
            "where" => "where id_publisher IN (SELECT p.id_publisher FROM publisher as p WHERE " . $where . ")",
                //"order_by" => "ORDER BY id DESC",
        );
        $game = $this->m_backend->jqxBinding();
        foreach ($game['rows'] as $c) {
            $arrr[$c['id_game']] = $c['full_name'];
        }
        echo json_encode($arrr);
    }

    public function getkeywords() {
        $keyword = $this->input->get('keyword', TRUE);
        $keywords = $this->m_backend->jqxGetLike('keywords', 'name', $keyword, 1000);
        $arr = array();
        foreach ($keywords as $k) {
            $arr[] = $k['name'];
        }
        echo json_encode($arr);
    }

    public function getgamekeywords() {
        $name = $this->input->post('game', TRUE);
        $response['code'] = 0;
        $game = $this->m_backend->jqxGet('game', 'full_name', html_entity_decode($name, null, 'UTF-8'));
        if (empty($game) === TRUE) {
            echo json_encode($response);
            exit;
        }
        $response['code'] = 1;
        $response['result'] = $game;
        echo json_encode($response);
    }

    public function addkeyword() {
        $this->load->library('form_validation');
        $response['code'] = -1;

        $response['redirect'] = '/backend/keyword/index';
        $response['message']['name'] = '';
        $response['message']['alias'] = '';
        $response['message']['url'] = '';
        $user_info = $this->session->userdata("user_info");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('alias', 'alias', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id'];
                $Params = array();
                $this->m_backend->_table = "keywords_primary";
                $badchars = array('#', '\\');
                $Params['name'] = trim(str_replace($badchars, '', $arrParam['name']));
                $Params['alias'] = $arrParam['alias'];
                if ($arrParam['url'] != '') {
                    $validate = preg_match('#^(http:\/\/|https:\/\/)#', $arrParam['url']);
                    if (!$validate) {
                        $response['code'] = 1;
                        $response['message']['url'] = 'Không hợp lệ!';
                        goto end;
                    } else {
                        $Params['url'] = $arrParam['url'];
                    }
                }
                if (empty($Id) === FALSE) {
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $Params['update_by'] = (empty($user_info) !== TRUE) ? $user_info['id_admin'] : NULL;
                    $rs = $this->m_backend->jqxUpdatemenugroup($Id, $Params);
                } else {
                    $Params['keywordglobal'] = 1;
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $Params['create_by'] = (empty($user_info) !== TRUE) ? $user_info['id_admin'] : NULL;
                    $rs = $this->m_backend->jqxInsert('keywords_primary', $Params);
                }
                $response['code'] = 0;
            } else {
                $response['code'] = 1;
                $response['message']['name'] = $this->form_validation->error('name', ' ', ' ');
                $response['message']['alias'] = $this->form_validation->error('alias', ' ', ' ');
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addkeywriter() {
        $this->load->library('form_validation');
        $response['code'] = -1;

        $response['redirect'] = '/backend/keyword/keywriter';
        $response['message']['name'] = '';
        $response['message']['alias'] = '';
        $response['message']['url'] = '';
        $user_info = $this->session->userdata("user_info");
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('alias', 'alias', 'trim|required');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
                $Id = $arrParam['id'];
                $Params = array();
                $this->m_backend->_table = "keywords";
                $badchars = array('#', '\\');
                $Params['name'] = trim(str_replace($badchars, '', $arrParam['name']));
                $Params['alias'] = $arrParam['alias'];
                if ($arrParam['url'] != '') {
                    $validate = preg_match('#^(http:\/\/|https:\/\/)#', $arrParam['url']);
                    if (!$validate) {
                        $response['code'] = 1;
                        $response['message']['url'] = 'Không hợp lệ!';
                        goto end;
                    } else {
                        $Params['url'] = $arrParam['url'];
                    }
                }
                if (empty($Id) === FALSE) {
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $Params['update_by'] = (empty($user_info) !== TRUE) ? $user_info['id_admin'] : NULL;
                    $rs = $this->m_backend->jqxUpdatemenugroup($Id, $Params);
                }
                $response['code'] = 0;
            } else {
                $response['code'] = 1;
                $response['message']['name'] = $this->form_validation->error('name', ' ', ' ');
                $response['message']['alias'] = $this->form_validation->error('alias', ' ', ' ');
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function update_sitemap() {
        $id = $this->input->get('id', TRUE);
        $response['code'] = -1;
        if (empty($id) === FALSE && is_numeric($id)) {
            $news = $this->m_backend->jqxGet('news', 'id_news', $id);
            if (empty($news) === FALSE) {
                $category = $this->m_backend->jqxGet('news_category', 'id_category', $news['id_category_primary']);
                if (empty($category) === FALSE) {
                    if ($news['is_export_sitemap'] == 0) {
                        $update['is_export_sitemap'] = 1;
                        $this->m_backend->jqxUpdate('news', 'id_news', $news['id_news'], $update);

                        $lastmod = new DateTime($news['timer']);
                        $url = base_url() . $category['alias'] . '/' . (($news['seo_url'] != '') ? utf8_to_ascii($news['seo_url']) : utf8_to_ascii($news['title'])) . '-tingame-' . $news['id_news'] . '.moi';
                        $this->load->library('sitemap');
                        $this->sitemap = new sitemap(base_url());
                        $this->sitemap->sitemapFileName = 'sitemap_detail.xml';
                        $this->sitemap->isFirst = true;
                        $this->sitemap->addUrl($url, $lastmod->format('Y-m-d\TH:i:sP'), 'daily', '0.5');
                        // create sitemap
                        $content = @simplexml_load_file(base_url() . 'sitemap_detail.xml');
                        if (empty($content) === FALSE) {
                            $this->sitemap->createSitemap($content->asXML());
                        } else {
                            $this->sitemap->createSitemap();
                        }
                        // write sitemap as file
                        $this->sitemap->writeSitemap();

                        //sitemap tag
                        $tags = json_decode($news['seo_keyword'], true);
                        $this->sitemap = new sitemap(base_url());
                        $this->sitemap->sitemapFileName = 'sitemap_tag.xml';
                        $this->sitemap->isFirst = true;
                        foreach ($tags as $t) {
                            $tag = $this->m_backend->jqxGetId('keywords', 'name', $t);
                            if (count($tag) == 1)
                                $this->sitemap->addUrl(base_url() . utf8_to_ascii($t) . '.html', null, 'daily', '0.7');
                        }
                        $content = @simplexml_load_file(base_url() . 'sitemap_tag.xml');
                        if (empty($content) === FALSE) {
                            $this->sitemap->createSitemap($content->asXML());
                        } else {
                            $this->sitemap->createSitemap();
                        }
                        // write sitemap as file
                        $this->sitemap->writeSitemap();

                        $response['code'] = 0;
                    }
                }
            }
        }
        echo json_encode($response);
    }

    //tailm
    public function scan_keyword() {
        $response['code'] = -1;
        $response['message'] = '';


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrPa = $this->input->post(NULL, TRUE);
            $id = $arrPa['id_news_key'];
            if (empty($id) === FALSE) {
                $news = $this->m_backend->jqxGet('news', 'id_news', $id);
                //input tags
                $this->load->model('frontend/m_home');
                $arrKey = array();
                $stt = 0;
                $this->m_backend->_table = 'keywords';
                $arrKeywordMain = $this->m_backend->jqxGetkeyprimary('keywords_primary');

                $arrKeyPri = array();
                if (empty($arrKeywordMain) === FALSE) {
                    foreach ($arrKeywordMain as $val) {
                        $arrKeyPri[] = $val['name'] . '::' . $val['priority'];
                        $arrKey[$stt]['name'] = $val['name'];
                        $arrKey[$stt]['alias'] = $val['alias'];
                        if ($val['url'] != '') {
                            $arrKey[$stt]['url'] = $val['url'];
                        } else {
                            $arrKey[$stt]['url'] = base_url() . $val['alias'] . '.html';
                        }
                        $stt += 1;
                    }
                }


                $arrKeyNews = $this->m_backend->jqxGetkeynews($id);

                if (empty($arrKeyNews) === FALSE) {
                    foreach ($arrKeyNews as $val) {
                        if ($val != '') {
                            $arrKey[$stt]['name'] = $val['name'];
                            $arrKey[$stt]['alias'] = $val['alias'];
                            if ($val['url'] != '') {
                                $arrKey[$stt]['url'] = $val['url'];
                            } else {
                                $arrKey[$stt]['url'] = base_url() . $val['alias'] . '.html';
                            }

                            $stt += 1;
                        }
                    }
                }
                $news['content'] = str_replace("&nbsp;", " ", $news['content']);
                $news['content'] = html_entity_decode($news['content'], null, 'UTF-8');


                if (empty($arrKey) === FALSE) {
                    foreach ($arrKey as $k) {
                        $cont = @preg_replace("#(<p>[^<]{1,}|<p style=\"text-align:justify\">[^<]{1,}|<p style=\"text-align:left\">[^<]{1,}|<p style=\"text-align:right\">[^<]{1,}|<p style=\"text-align:center\">[^<]{1,})(\s|\()(" . trim($k['name']) . ")(\s|\.|\,|\?|\!|\-|\_|\))(.*<\/p>)#imsU", '$1$2<a href="' . $k['url'] . '" title="$3" target="_blank">$3</a>$4$5', $news['content'], 1);
                        if ($cont != '') {
                            $news['content'] = $cont;
                        } else {
                            continue;
                        }
                    }
                }

                $arrParam['contentafterscan'] = $news['content'];
                $arrParam['keywordscan'] = json_encode($arrKeyPri);

                $this->m_home->update_news($id, $arrParam);

                $response['code'] = 1;
                $response['message'] = 'Thành công';
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    //tailm
    public function scan_keyword_giftcode() {
        $response['code'] = -1;
        $response['message'] = '';


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrPa = $this->input->post(NULL, TRUE);
            $id = $arrPa['id_name'];
            if (empty($id) === FALSE) {
                $news = $this->m_backend->jqxGet('codes_name', 'id_name', $id);
                //input tags
                $this->load->model('frontend/m_home');
                $arrKey = array();
                $stt = 0;
                $this->m_backend->_table = 'keywords';
                $arrKeywordMain = $this->m_backend->jqxGetkeyprimary('keywords_primary');

                $arrKeyPri = array();
                if (empty($arrKeywordMain) === FALSE) {
                    foreach ($arrKeywordMain as $val) {
                        $arrKeyPri[] = $val['name'] . '::' . $val['priority'];
                        $arrKey[$stt]['name'] = $val['name'];
                        $arrKey[$stt]['alias'] = $val['alias'];
                        if ($val['url'] != '') {
                            $arrKey[$stt]['url'] = $val['url'];
                        } else {
                            $arrKey[$stt]['url'] = base_url() . $val['alias'] . '.html';
                        }
                        $stt += 1;
                    }
                }


                $arrKeyNews = $this->m_backend->jqxGetkey($id, 'giftcode');

                if (empty($arrKeyNews) === FALSE) {
                    foreach ($arrKeyNews as $val) {
                        if ($val != '') {
                            $arrKey[$stt]['name'] = $val['name'];
                            $arrKey[$stt]['alias'] = $val['alias'];
                            if ($val['url'] != '') {
                                $arrKey[$stt]['url'] = $val['url'];
                            } else {
                                $arrKey[$stt]['url'] = base_url() . $val['alias'] . '.html';
                            }

                            $stt += 1;
                        }
                    }
                }

                $news['content'] = html_entity_decode($news['content'], null, 'UTF-8');
                if (empty($arrKey) === FALSE) {
                    foreach ($arrKey as $k) {
                        //$cont = @preg_replace("#(<p.*>[^<]{1,})(\s|\()(" . trim($k['name']) . ")(\s|\.|\,|\?|\!|\-|\_|\))(.*<\/p>)#imsU", '$1$2<a href="' . $k['url'] . '" title="$3" target="_blank">$3</a>$4$5', $news['content'], 1);
                        $cont = @preg_replace("#(<p>[^<]{1,}|<p style=\"text-align:justify\">[^<]{1,}|<p style=\"text-align:left\">[^<]{1,}|<p style=\"text-align:right\">[^<]{1,}|<p style=\"text-align:center\">[^<]{1,})(\s|\()(" . trim($k['name']) . ")(\s|\.|\,|\?|\!|\-|\_|\))(.*<\/p>)#imsU", '$1$2<a href="' . $k['url'] . '" title="$3" target="_blank">$3</a>$4$5', $news['content'], 1);
                        if ($cont != '') {
                            $news['content'] = $cont;
                        } else {
                            continue;
                        }
                    }
                }

                $arrParam['contentafterscan'] = $news['content'];
                $arrParam['keywordscan'] = json_encode($arrKeyPri);

                $this->m_home->update_giftcode($id, $arrParam);

                $response['code'] = 1;
                $response['message'] = 'Thành công';
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    //tailm
    public function scan_keyword_video() {
        $response['code'] = -1;
        $response['message'] = '';


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrPa = $this->input->post(NULL, TRUE);
            $id = $arrPa['id_video_scan'];
            if (empty($id) === FALSE) {
                $news = $this->m_backend->jqxGet('videos', 'id_video', $id);
                //input tags
                $this->load->model('frontend/m_home');
                $arrKey = array();
                $stt = 0;
                $this->m_backend->_table = 'keywords';
                $arrKeywordMain = $this->m_backend->jqxGetkeyprimary('keywords_primary');

                $arrKeyPri = array();
                if (empty($arrKeywordMain) === FALSE) {
                    foreach ($arrKeywordMain as $val) {
                        $arrKeyPri[] = $val['name'] . '::' . $val['priority'];
                        $arrKey[$stt]['name'] = $val['name'];
                        $arrKey[$stt]['alias'] = $val['alias'];
                        if ($val['url'] != '') {
                            $arrKey[$stt]['url'] = $val['url'];
                        } else {
                            $arrKey[$stt]['url'] = base_url() . $val['alias'] . '.html';
                        }
                        $stt += 1;
                    }
                }


                $arrKeyNews = $this->m_backend->jqxGetkey($id, 'video');

                if (empty($arrKeyNews) === FALSE) {
                    foreach ($arrKeyNews as $val) {
                        if ($val != '') {
                            $arrKey[$stt]['name'] = $val['name'];
                            $arrKey[$stt]['alias'] = $val['alias'];
                            if ($val['url'] != '') {
                                $arrKey[$stt]['url'] = $val['url'];
                            } else {
                                $arrKey[$stt]['url'] = base_url() . $val['alias'] . '.html';
                            }

                            $stt += 1;
                        }
                    }
                }

                $news['description_detail'] = html_entity_decode($news['description_detail'], null, 'UTF-8');
                if (empty($arrKey) === FALSE) {
                    foreach ($arrKey as $k) {
                        //$cont = @preg_replace("#(<p.*>[^<]{1,})(\s|\()(" . trim($k['name']) . ")(\s|\.|\,|\?|\!|\-|\_|\))(.*<\/p>)#imsU", '$1$2<a href="' . $k['url'] . '" title="$3" target="_blank">$3</a>$4$5', $news['content'], 1);

                        $cont = @preg_replace("#(<p>[^<]{1,}|<p style=\"text-align:justify\">[^<]{1,}|<p style=\"text-align:left\">[^<]{1,}|<p style=\"text-align:right\">[^<]{1,}|<p style=\"text-align:center\">[^<]{1,})(\s|\()(" . trim($k['name']) . ")(\s|\.|\,|\?|\!|\-|\_|\))(.*<\/p>)#imsU", '$1$2<a href="' . $k['url'] . '" title="$3" target="_blank">$3</a>$4$5', $news['description_detail'], 1);

                        if ($cont != '') {
                            $news['description_detail'] = $cont;
                        } else {
                            continue;
                        }
                    }
                }

                $arrParam['contentafterscan'] = $news['description_detail'];
                $arrParam['keywordscan'] = json_encode($arrKeyPri);

                $this->m_home->update_video($id, $arrParam);

                $response['code'] = 1;
                $response['message'] = 'Thành công';
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    //tailm
    public function url_preview() {
        $response['code'] = -1;
        $response['url'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $id = $arrParam['id'];
            $news = $this->m_backend->jqxGeturlnews($id);
            if (empty($news) === FALSE) {
                if ($news['alias'] == 'game-thu') {
                    $cate_link = 'cong-dong';
                } else {
                    $cate_link = $news['alias'];
                }
                $token = (time() + 2511) * 3;
                $response['url'] = '/' . $cate_link . '/' . (($news['seo_url'] != '') ? utf8_to_ascii($news['seo_url']) : utf8_to_ascii($news['title']));
                $response['url'] = $response['url'] . '-tingame-' . $id . '.moi?pv=' . $token;
                $response['code'] = 0;
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    //tailm
    public function url_preview_video() {
        $response['code'] = -1;
        $response['url'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $id = $arrParam['id'];
            $video = $this->m_backend->jqxGeturlvideo($id);
            if (empty($video) === FALSE) {
                $token = (time() + 2511) * 3;
                $response['url'] = '/video/' . utf8_to_ascii($video['title']) . '-' . $video['id_video'] . '.moi?pv=' . $token;
                $response['code'] = 0;
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    //tailm
    public function url_preview_giftcode() {
        $response['code'] = -1;
        $response['url'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $id = $arrParam['id'];
            $giftcode = $this->m_backend->jqxGeturlgiftcode($id);
            if (empty($giftcode) === FALSE) {
                $token = (time() + 2511) * 3;
                $response['url'] = '/gmo/' . utf8_to_ascii($giftcode['name']) . '-' . $giftcode['id_name'] . '.moi?pv=' . $token;
                $response['code'] = 0;
            }
        }
        end:
        echo json_encode($response);
        exit;
    }

    public function getEmbedNews() {
        $params = $this->input->get(NULL, TRUE);
        $response['code'] = -1;
        if (empty($params['id']) === FALSE && empty($params['type']) === FALSE) {
            $table = 'news';
            $field = 'id_news';
            if ($params['type'] == 2) {
                $table = 'videos';
                $field = 'id_video';
            } elseif ($params['type'] == 3) {
                $table = 'codes_name';
                $field = 'id_name';
            } else {
                
            }
            $result = $this->m_backend->jqxGet($table, $field, $params['id']);
            if (empty($result) === FALSE) {
                $response['data'] = $result;
                $response['code'] = 0;
            }
        }
        echo json_encode($response);
    }

    public function push_notify_giftcode($id) {
        $db = $this->m_backend->get_game_info_of_giftcode($id);
        if (!empty($db['full_name_vn']))
            $db['full_name'] = $db['full_name_vn'];
        $message = $db['full_name'] . " vừa có giftcode mới. Nhận ngay!";
        $this->load->library('push_notify_api');
        $plaform = json_decode($db['platform'], TRUE);
        foreach ($plaform as $value) {
            $a[] = $this->push_notify_api->index(strtolower($value), $message);
        }
    }

    public function addTempContent() {
        $params = $this->input->post(NULL, TRUE);
        $response['code'] = -1;
        $table = 'temp_content';
        $id_news = (($params['id_news'] != '') ? $params['id_news'] : 0);
        $content = $this->input->post('content');
        if (empty($content) === FALSE) {
            $user_info = $this->session->userdata("user_info");
            if (empty($user_info) === FALSE) {
                $temp = $this->m_backend->jqxGetTempbyUserAndNews($user_info['id_admin'], $id_news);
                $Params['id_user'] = $user_info['id_admin'];
                $Params['id_news'] = $id_news;
                $Params['content'] = $this->input->post('content');
                if (empty($temp) === FALSE) {
                    $update = $this->m_backend->jqxUpdate($table, 'id', $temp['id'], $Params);
                    if ($update)
                        $response['code'] = 0;
                } else {
                    if ($id_news != 0) {
                        $temp = $this->m_backend->jqxGet($table, 'id_user', $user_info['id_admin']);
                        if (empty($temp) === FALSE) {
                            $update = $this->m_backend->jqxUpdate($table, 'id', $temp['id'], $Params);
                            if ($update)
                                $response['code'] = 0;
                        }else {
                            $id = $this->m_backend->jqxInsertId($table, $Params);
                            if ($id > 0)
                                $response['code'] = 0;
                        }
                    } else {
                        $id = $this->m_backend->jqxInsertId($table, $Params);
                        if ($id > 0)
                            $response['code'] = 0;
                    }
                }
            }
        }
        echo json_encode($response);
    }

    // vinhtt
    public function getTempContent() {
        $id_news = $this->input->get('id_news', TRUE);
        $response['code'] = -1;
        if (empty($id_news) === TRUE || $id_news == '')
            $id_news = 0;
        $user_info = $this->session->userdata("user_info");
        if (empty($user_info) === FALSE) {
            $temp = $this->m_backend->jqxGetTempbyUserAndNews($user_info['id_admin'], $id_news);
            if (empty($temp) === FALSE) {
                $response['temp'] = $temp;
                $response['code'] = 0;
            }
        }
        echo json_encode($response);
    }

    //vinhtt
    public function removetabbypublisher() {
        $full_name = $this->input->get('name', TRUE);
        $response['code'] = -1;
        if (empty($full_name) === FALSE) {
            $publisher = $this->m_backend->jqxGet('publisher', 'full_name', $full_name);
            $games = $this->m_backend->jqxGetId('game', 'id_publisher', $publisher['id_publisher']);
            $arr = array();
            foreach ($games as $g) {
                $tags = (array) json_decode($g['keyword'], true);
                if (count($arr) == 0)
                    $arr = $tags;
                else
                    $arr = array_merge($arr, $tags);
            }
            $response['data'] = $arr;
            $response['code'] = 0;
        }
        echo json_encode($response);
    }

    public function reduceImage() {
        $data = $this->input->post('data', TRUE);
        $dir = $this->input->post('dir', TRUE);
        $dirr = substr($dir, 1, strlen($dir) - 1);
        if (empty($data) === FALSE) {
            $arr = explode('***', $data);
            for ($i = 0; $i < count($arr); $i++) {
                $path = trim("$dirr/{$arr[$i]}");
                $info = pathinfo(trim("$dir/{$arr[$i]}"));
                $extension = $info['extension'];
                if (strtolower($extension) == 'png') {
                    $compressed_png_content = $this->compress_png($path);
                    file_put_contents($path, $compressed_png_content);
                }
            }
        }
        echo json_encode(0);
    }

    protected function compress_png($path_to_png_file, $max_quality = 90) {
        if (!file_exists($path_to_png_file)) {
            $this->errorMsg("File does not exist: $path_to_png_file");
        }

        // guarantee that quality won't be worse than that.
        $min_quality = 60;

        // '-' makes it use stdout, required to save to $compressed_png_content variable
        // '<' makes it read from the given file path
        // escapeshellarg() makes this safe to use with any path
        $compressed_png_content = shell_exec("pngquant --quality=$min_quality-$max_quality - < " . escapeshellarg($path_to_png_file));
        if (!$compressed_png_content) {
            $this->errorMsg(error_reporting(1));
        }

        return $compressed_png_content;
    }

    public function updateavatar() {
        $response['code'] = -1;
        $response['message']['Image-name'] = '';
        $response['message']['system'] = '';
        $response['message']['filename'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);

            if (isset($_FILES["ImageFile"]["name"]) && empty($_FILES["ImageFile"]["name"]) === FALSE) {
                $arrParam['Image-name'] = $_FILES["ImageFile"]["name"];
            } else {
                $arrParam['Image-name'] = '';
            }

            if ($arrParam['Image-name'] != '') {
                $this->load->library('UploadImage');
                if (!$this->uploadimage->do_upload('ImageFile')) {
                    //echo $error = $this->uploadimage->getError();
                    $response['code'] = 1;
                    $response['message']['system'] = 'Vui lòng thử lại do mất kết nối server!';
                } else {
                    $dataImg = $this->uploadimage->getData();
                    $file_name = $dataImg['file_name'];
                    $response['message']['filename'] = $file_name;
                    $response['code'] = 0;
                }
            }

            echo json_encode($response);
            exit;
        }
    }

    public function autocompleteGame() {
        $q = $this->input->get('q', TRUE);
        $callback = $this->input->get('callback', TRUE);
        $response = '';
        //$response['code'] = -1;
        if (empty($q) === FALSE) {
            $result = $this->m_backend->jqxGetAutocompleteGame('full_name', $q, 12);
            if (empty($result) === FALSE) {
                foreach ($result as $key => $val) {
                    $response[$key] = $val['full_name'];
                }
                //$response['code'] = 0;
            }
        }
        echo $callback . "(" . json_encode($response) . ")";
    }

    public function addvotegame() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/vote/votegame';
        $response['message']['name'] = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post();
            //print_r($arrParam);
            $Id = $arrParam['id'];
            $this->form_validation->set_rules('name', 'name', 'trim|required');
            $this->form_validation->set_rules('criteria', 'Tiêu chí', 'required');
            $this->form_validation->set_message('required', 'Không được rỗng');

            //kiem tra tieu chi
            if (empty($arrParam['criteria'][0]['name']) || empty($arrParam['criteria'][1]['name']))
                $_POST['criteria'] = '';

            if ($this->form_validation->run() == TRUE) {
                $curr_user = $this->session->userdata('user_info');
                $Params = array();
                $Params['title'] = $this->security->xss_clean($arrParam['name']);
                $Params['status'] = intval($arrParam['status']);
                if (!empty($Id)) {
                    $item_old = $this->m_backend->jqxGet('votegame', 'id', $Id);
                    if (!empty($item_old['criteria'])) {
                        $item_old['criteria'] = json_decode($item_old['criteria'], true);
                        $Params['criteria'] = $item_old['criteria'];
                    } else {
                        $Params['create_time'] = date('Y-m-d H:i:s');
                        $Params['create_by'] = $curr_user['id_admin'];
                        $Params['timer'] = date('Y-m-d H:i:s');
                    }
                } else {
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $Params['create_by'] = $curr_user['id_admin'];
                    $Params['timer'] = date('Y-m-d H:i:s');
                }
                $Params['update_time'] = date('Y-m-d H:i:s');
                $Params['update_by'] = $curr_user['id_admin'];
                //lay danh sach tieu chi
                $i = 0;
                $Params['criteria'] = array();
                foreach ($arrParam['criteria'] as $item) {
                    if (!empty($item['name'])) {
                        $Params['criteria'][$i]['name'] = $this->security->xss_clean($item['name']);
                        $Params['criteria'][$i]['order'] = intval($item['order']);
                        $Params['criteria'][$i]['total'] = intval($item['total']);
                        $Params['criteria'][$i]['datetime'] = $item['datetime'];
                        $i++;
                    } else {
                        break;
                    }
                }
                $Params['criteria'] = json_encode($Params['criteria']);

                if (empty($Id) === TRUE) { //insert
                    $this->m_backend->jqxInsert('votegame', $Params);
                } else { //update
                    $this->m_backend->jqxUpdate('votegame', 'id', $Id, $Params);
                }
                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                $response['message']['criteria'] = trim(str_replace($badchars, '', form_error('criteria')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function listvotegameresult($id_votegame = 1) {
        $id_votegame = $this->check_security($id_votegame);
        $this->m_backend->datatables_config = array(
            "select" => 'SELECT SQL_CALC_FOUND_ROWS r.*, u.full_name, u.phone, u.email',
            "from" => 'FROM votegame_result r',
            'join' => "JOIN users u ON r.id_facebook=u.id_facebook ",
            "where" => "WHERE r.id_votegame = " . $id_votegame,
                //"order_by" => "ORDER BY r.create_time DESC",
        );

        $list = $this->m_backend->jqxBinding();
        echo $_GET['callback'] . '(' . json_encode($list) . ');';
        exit();
    }

    public function updatestatusvideo($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit;
        }
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $st = (!empty($_GET['st']) ? ($this->input->get('st', TRUE)) : 0);

        $id = $this->security->xss_clean($id);
        $st = $this->security->xss_clean($st);

        $this->m_backend->_table = $table;

        if ($table == 'videos') {
            $this->load->library('cache');

            //$cache = $this->cache->load('file', 'monitor');
            $cache = @$this->cache->load('memcache', 'system_info');

            $arrTimer = $cache->get('timepublic_videos');
            if (empty($arrTimer) === TRUE) {
                $arrTimer = array();
            }
            if ($_GET['field'] == 'timer') {
                $arrTimer[strtotime($st)] = strtotime($st);
                ksort($arrTimer);
                $timeout = 60 * 60 * 360;
                //$cache->save('timepublic_videos', $arrTimer, $timeout);
                $cache->save('timepublic_videos', $arrTimer);
            } elseif ($_GET['field'] == 'status' || $_GET['field'] == 'active_slide') {
                $news = $this->m_backend->jqxGet('videos', 'id_video', $id);
                $arrTimer[strtotime($news['timer'])] = strtotime($news['timer']);
                ksort($arrTimer);
                $timeout = 60 * 60 * 360;
                //$cache->save('timepublic_videos', $arrTimer, $timeout);
                $cache->save('timepublic_videos', $arrTimer);
            }
        }
        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $data = $this->m_backend->jqxUpdate($table, $field, $id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $solrUpdate = $this->m_backend->addVideointoSolrDocument($id);
            $response['solr'] = $solrUpdate;
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function updatestatusgiftcode($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit;
        }
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $st = (!empty($_GET['st']) ? ($this->input->get('st', TRUE)) : 0);

        $id = $this->security->xss_clean($id);
        $st = $this->security->xss_clean($st);

        $this->m_backend->_table = $table;

        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $data = $this->m_backend->jqxUpdate($table, $field, $id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $this->load->library('push_notify_api');
            $solrUpdate = $this->m_backend->addGiftcodeintoSolrDocument($id);
            $response['solr'] = $solrUpdate;
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
            $this->push_notify_giftcode($id);
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addListGiftcodetoSolr() {
        try {
            $giftcodes = $this->m_backend->jqxGets('codes_name');

            if (empty($giftcodes) === FALSE) {
                $this->config->load('solr');
                $solr = $this->config->item('solr');
                $options = array
                    (
                    'hostname' => $solr['SOLR_SERVER_HOSTNAME'], //dinh nghia trong file bootstrap
                    'login' => $solr['SOLR_SERVER_USERNAME'], //dinh nghia trong file bootstrap
                    'password' => $solr['SOLR_SERVER_PASSWORD'], //dinh nghia trong file bootstrap
                    'port' => $solr['SOLR_SERVER_PORT'], //dinh nghia trong file bootstrap
                    'path' => 'solr/giftcode' //$solr['SOLR_SERVER_PATH'] dinh nghia trong file bootstrap
                );
                $client = new SolrClient($options);
                foreach ($giftcodes as $giftcode) {
                    if ($giftcode['status'] == 1) {
                        $doc = new SolrInputDocument();
                        $doc->addField('id_name', $giftcode['id_name']);
                        $doc->addField('name', $giftcode['name']);
                        $doc->addField('image', $giftcode['image']);
                        $doc->addField('create_time', $giftcode['create_time']);
                        $doc->addField('seo_keyword', $giftcode['seo_keyword']);
                        $doc->addField('id_game', $giftcode['id_game']);
                        $doc->addField('total', $giftcode['total']);
                        $doc->addField('uses', $giftcode['uses']);
                        $doc->addField('content', strip_tags(preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $giftcode['content'])));
                        $game = $this->m_backend->jqxGet('game', 'id_game', $giftcode['id_game']);
                        ((empty($game) === FALSE) ? $doc->addField('full_name', $game['full_name']) : $doc->addField('full_name', ''));
                        $updateResponse = $client->addDocument($doc);
                        $client->commit();
                        //return $updateResponse->getResponse();
                    } else {
                        $client->deleteById($giftcode['id_name']);
                        $client->commit();
                    }
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function addListVideotoSolr() {
        try {
            $videos = $this->m_backend->jqxGets('videos');
            if (empty($videos) === FALSE) {
                $this->config->load('solr');
                $solr = $this->config->item('solr');
                $options = array
                    (
                    'hostname' => $solr['SOLR_SERVER_HOSTNAME'], //dinh nghia trong file bootstrap
                    'login' => $solr['SOLR_SERVER_USERNAME'], //dinh nghia trong file bootstrap
                    'password' => $solr['SOLR_SERVER_PASSWORD'], //dinh nghia trong file bootstrap
                    'port' => $solr['SOLR_SERVER_PORT'], //dinh nghia trong file bootstrap
                    'path' => 'solr/videos' //$solr['SOLR_SERVER_PATH'] dinh nghia trong file bootstrap
                );
                $client = new SolrClient($options);

                foreach ($videos as $video) {
                    if ($video['status'] == 1 && $video['timer'] <= date('Y-m-d H:i:s')) {
                        $doc = new SolrInputDocument();
                        $doc->addField('id_video', $video['id_video']);
                        $doc->addField('title', $video['title']);
                        $doc->addField('image', $video['image']);
                        $doc->addField('timer', $video['timer']);
                        $doc->addField('description', $video['description']);
                        $doc->addField('seo_keyword', $video['seo_keyword']);
                        $doc->addField('view_count', $video['view_count']);
                        $doc->addField('id_category', $video['id_category']);
                        $doc->addField('description_detail', strip_tags(preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $video['description_detail'])));
                        $category = $this->m_backend->jqxGet('news_category', 'id_category', $video['id_category']);
                        ((empty($category) === FALSE) ? $doc->addField('category', $category['title']) : $doc->addField('category', ''));
                        $updateResponse = $client->addDocument($doc);
                        $client->commit();
                    } else {
                        $client->deleteById($video['id_video']);
                        $client->commit();
                    }
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function addListNewstoSolr() {
        try {
            $newses = $this->m_backend->jqxGets('news');
            if (empty($newses) === FALSE) {
                $this->config->load('solr');
                $solr = $this->config->item('solr');
                $options = array
                    (
                    'hostname' => $solr['SOLR_SERVER_HOSTNAME'], //dinh nghia trong file bootstrap
                    'login' => $solr['SOLR_SERVER_USERNAME'], //dinh nghia trong file bootstrap
                    'password' => $solr['SOLR_SERVER_PASSWORD'], //dinh nghia trong file bootstrap
                    'port' => $solr['SOLR_SERVER_PORT'], //dinh nghia trong file bootstrap
                    'path' => 'solr/news' //$solr['SOLR_SERVER_PATH'] dinh nghia trong file bootstrap
                );
                $client = new SolrClient($options);
                foreach ($newses as $news) {
                    if ($news['status'] == 1 && $news['timer'] <= date('Y-m-d H:i:s')) {
                        $doc = new SolrInputDocument();
                        $doc->addField('id_news', $news['id_news']);
                        $doc->addField('title', $news['title']);
                        $doc->addField('image_banner', $news['image_banner']);
                        $doc->addField('timer', $news['timer']);
                        $doc->addField('description', $news['description']);
                        $doc->addField('seo_keyword', $news['seo_keyword']);
                        $doc->addField('content', strip_tags(preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $news['content'])));
                        $doc->addField('id_category', $news['id_category_primary']);
                        $category = $this->m_backend->jqxGet('news_category', 'id_category', $news['id_category_primary']);
                        if (empty($category)) {
                            $doc->addField('alias', '');
                            $doc->addField('category', '');
                        } else {
                            $doc->addField('alias', $category['alias']);
                            $doc->addField('category', $category['title']);
                        }
                        $updateResponse = $client->addDocument($doc);
                        $client->commit();
                    } else {
                        $client->deleteById($news['id_news']);
                        $client->commit();
                    }
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function addListGametoSolr() {
        try {
            $games = $this->m_backend->jqxGets('game');
            if (empty($games) === FALSE) {
                $this->config->load('solr');
                $solr = $this->config->item('solr');
                $options = array
                    (
                    'hostname' => $solr['SOLR_SERVER_HOSTNAME'],
                    'login' => $solr['SOLR_SERVER_USERNAME'],
                    'password' => $solr['SOLR_SERVER_PASSWORD'],
                    'port' => $solr['SOLR_SERVER_PORT'],
                    'path' => 'solr/game' //$solr['SOLR_SERVER_PATH']
                );
                $client = new SolrClient($options);
                foreach ($games as $game) {
                    if ($game['status'] == 1) {
                        $doc = new SolrInputDocument();
                        $doc->addField('id_game', $game['id_game']);
                        $doc->addField('full_name', $game['full_name']);
                        $doc->addField('logo_game', $game['logo_game']);
                        $doc->addField('rate_public', $game['rate_public']);
                        $doc->addField('full_name_vn', $game['full_name_vn']);
                        $doc->addField('description', $game['description']);
                        $doc->addField('keyword', $game['keyword']);
                        $doc->addField('id_game_category', $game['id_game_category']);
                        $doc->addField('id_publisher', $game['id_publisher']);
                        $doc->addField('platform', $game['platform']);
                        $doc->addField('url_download', $game['url_download']);
                        $doc->addField('content', strip_tags(preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $game['content'])));

                        $game_category = $this->m_backend->jqxGet('game_category', 'id_game_category', $game['id_game_category']);
                        ((empty($game_category) === FALSE) ? $doc->addField('title', $game_category['title']) : $doc->addField('title', ''));
                        $publisher = $this->m_backend->jqxGet('publisher', 'id_publisher', $game['id_publisher']);
                        ((empty($publisher) === FALSE) ? $doc->addField('publisher', $publisher['full_name']) : $doc->addField('publisher', ''));

                        $updateResponse = $client->addDocument($doc);
                        $client->commit();
                    } else {
                        $client->deleteById($game['id_game']);
                        $client->commit();
                    }
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function addListKeywordtoSolr() {
        try {
            $keywords = $this->m_backend->jqxGets('keywords');
            if (empty($keywords) === FALSE) {
                $this->config->load('solr');
                $solr = $this->config->item('solr');
                $options = array
                    (
                    'hostname' => $solr['SOLR_SERVER_HOSTNAME'],
                    'login' => $solr['SOLR_SERVER_USERNAME'],
                    'password' => $solr['SOLR_SERVER_PASSWORD'],
                    'port' => $solr['SOLR_SERVER_PORT'],
                    'path' => 'solr/keywords' //$solr['SOLR_SERVER_PATH']
                );
                $client = new SolrClient($options);
                foreach ($keywords as $keyword) {
                    $doc = new SolrInputDocument();
                    $doc->addField('id', $keyword['id']);
                    $doc->addField('name', $keyword['name']);
                    $doc->addField('alias', $keyword['alias']);
                    $doc->addField('id_news', $keyword['id_news']);
                    $doc->addField('type', $keyword['type']);
                    $doc->addField('priority', $keyword['priority']);
                    $updateResponse = $client->addDocument($doc);
                    $client->commit();
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function addcard() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/card/campaign';
        $response['message']['publisher'] = '';
        $response['message']['price'] = '';
        $response['message']['serial'] = '';
        $response['message']['pin'] = '';
        $response['flat'] = 1;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];

            $this->form_validation->set_rules('publisher', 'publisher', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('price', 'price', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('name', 'name', 'callback_xss_check|trim|required');
            //$this->form_validation->set_rules('pin', 'pin', 'callback_xss_check|trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');
            $this->form_validation->set_message('trim', 'Không được có khoảng trắng ở đầu và cuối');

            if ($this->form_validation->run() == TRUE) {
                if (empty($Id) === TRUE) {
                    if (isset($_FILES["csv"]["name"]) && empty($_FILES["csv"]["name"]) === FALSE) {
                        $arrParam['csv-name'] = $_FILES["csv"]["name"];
                        $info = pathinfo($arrParam['csv-name']);
                        $extension = $info['extension'];
                    } else {
                        $arrParam['csv-name'] = '';
                        $extension = '';
                    }


                    $arrCard = array();

                    if ($arrParam['csv-name'] != '') {

                        if ($extension == 'csv') {

                            if (@$_FILES[csv][size] > 0) {

                                $file = @$_FILES[csv][tmp_name];
                                $handle = fopen($file, "r");

                                $Params = array();
                                $stt = 0;
                                do {
                                    if (@$data[0]) {
                                        $arrCard[$stt]['serial'] = htmlspecialchars(addslashes($data[0]));
                                        $arrCard[$stt]['pin'] = htmlspecialchars(addslashes($data[1]));
                                        $stt += 1;
                                    }
                                } while ($data = @fgetcsv($handle, 1000, ",", "'"));

                                $c = count($arrCard);
                            }
                        } else {
                            $response['message']['serial'] = 'File không hợp lệ!';
                            $response['code'] = -1;
                            goto end;
                        }
                    } else {
                        $response['message']['serial'] = 'Vui lòng chọn file!';
                        $response['code'] = -1;
                        goto end;
                    }
                    //insert_id code name
                    $par = array();
                    $par['name'] = htmlspecialchars($arrParam['name']);
                    $par['status'] = 1;
                    $par['create_time'] = date('Y-m-d H:i:s');
                    $par['total'] = $c;
                    $par['uses'] = $c;
                    $par['create_user'] = $this->session->userdata['user_info']['username'];
                    $par['price'] = $arrParam['price'];
                    $par['publisher'] = $arrParam['publisher'];

                    $id_card = $this->m_backend->jqxInsertId('card_name', $par);

                    if (empty($id_card) === FALSE) {

                        foreach ($arrCard as $val) {
                            //check pin
                            $pinE = $this->m_backend->jqxCheckpincard($val['pin'], $arrParam['publisher']);
                            $pinS = $this->m_backend->jqxCheckserialcard($val['serial'], $arrParam['publisher']);
                            if (empty($pinE) === FALSE && empty($pinS) === FALSE) {
                                $response['message']['pin'] = 'Mã PIN ' . $val['pin'] . ' của nhà mạng này đã tồn tại!';
                                $response['message']['serial'] = 'Serial ' . $val['serial'] . ' của nhà mạng này đã tồn tại!';
                                $response['flat'] = 0;
                                break;
                            } elseif (empty($pinE) === FALSE) {
                                $response['message']['pin'] = 'Mã PIN ' . $val['pin'] . ' của nhà mạng này đã tồn tại!';
                                $response['flat'] = 0;
                                break;
                            } elseif (empty($pinS) === FALSE) {
                                $response['message']['serial'] = 'Serial ' . $val['serial'] . ' của nhà mạng này đã tồn tại!';
                                $response['flat'] = 0;
                                break;
                            }

                            $Params = array();
                            $Params['publisher'] = $arrParam['publisher'];
                            $Params['price'] = $arrParam['price'];
                            $Params['serial'] = $val['serial'];
                            $Params['pin'] = $val['pin'];
                            $Params['create_time'] = date('Y-m-d H:i:s');
                            $Params['update_time'] = date('Y-m-d H:i:s');
                            $Params['create_by'] = $this->session->userdata['user_info']['username'];
                            $Params['card_id'] = $id_card;
                            $Params['card_name'] = htmlspecialchars($arrParam['name']);
                            $id = $this->m_backend->jqxInsertId('card_sms', $Params);
                            if (empty($id) === FALSE) {
                                checkcode:
                                $code = $this->generateSecurityCode(6, true);
                                $codeE = $this->m_backend->jqxCheckcodecard($code);
                                if (empty($codeE) === FALSE) {
                                    goto checkcode;
                                } else {
                                    goto updatecode;
                                }
                                updatecode:
                                $Par['code'] = $this->generateSecurityCode(6, true);
                                $this->m_backend->jqxUpdate('card_sms', 'id', $id, $Par);
                            }
                        }
                        if ($response['flat'] == 0) {
                            $response['code'] = -1;
                        } else {
                            $response['code'] = 0;
                        }
                        goto end;
                    } else {
                        $response['message']['serial'] = 'Vui lòng thử lại!';
                        $response['code'] = -1;
                        goto end;
                    }
                } else {
                    /*
                      $Params = array();
                      $rs = $this->m_backend->jqxGet('card_sms', 'id', $Id);
                      if ($rs['publisher'] != $arrParam['publisher']) {
                      //check pin & serial
                      $pinE = $this->m_backend->jqxCheckpincard($arrParam['pin'], $arrParam['publisher']);
                      $pinS = $this->m_backend->jqxCheckserialcard($arrParam['serial'], $arrParam['publisher']);
                      if (empty($pinE) === FALSE && empty($pinS) === FALSE) {
                      $response['message']['pin'] = 'Mã PIN của nhà mạng này đã tồn tại!';
                      $response['message']['serial'] = 'Serial của nhà mạng này đã tồn tại!';
                      goto end;
                      } elseif (empty($pinE) === FALSE) {
                      $response['message']['pin'] = 'Mã PIN của nhà mạng này đã tồn tại!';
                      goto end;
                      } elseif (empty($pinS) === FALSE) {
                      $response['message']['serial'] = 'Serial của nhà mạng này đã tồn tại!';
                      goto end;
                      }
                      } else {
                      if ($rs['pin'] != $arrParam['pin']) {
                      $pinE = $this->m_backend->jqxCheckpincard($arrParam['pin'], $arrParam['publisher']);
                      if (empty($pinE) === FALSE) {
                      $response['message']['pin'] = 'Mã PIN của nhà mạng này đã tồn tại!';
                      goto end;
                      }
                      }
                      if ($rs['serial'] != $arrParam['serial']) {
                      $pinS = $this->m_backend->jqxCheckserialcard($arrParam['serial'], $arrParam['publisher']);
                      if (empty($pinS) === FALSE) {
                      $response['message']['serial'] = 'Serial của nhà mạng này đã tồn tại!';
                      goto end;
                      }
                      }
                      }
                      $Params = array();
                      $Params['publisher'] = $arrParam['publisher'];
                      $Params['price'] = $arrParam['price'];
                      $Params['serial'] = $arrParam['serial'];
                      $Params['pin'] = $arrParam['pin'];
                      $Params['update_time'] = date('Y-m-d H:i:s');
                      $Params['update_by'] = $this->session->userdata['user_info']['username'];

                      $this->m_backend->jqxUpdate('card_sms', 'id', $Id, $Params);
                      $response['code'] = 0;

                     * 
                     */
                    $Params = array();
                    $Params['publisher'] = $arrParam['publisher'];
                    $Params['price'] = $arrParam['price'];
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $Params['update_user'] = $this->session->userdata['user_info']['username'];

                    $up = $this->m_backend->jqxUpdate('card_name', 'id', $Id, $Params);
                    if (empty($up) === FALSE) {
                        $Params = array();
                        $Params['publisher'] = $arrParam['publisher'];
                        $Params['price'] = $arrParam['price'];
                        $Params['update_time'] = date('Y-m-d H:i:s');
                        $Params['update_by'] = $this->session->userdata['user_info']['username'];
                        $upc = $this->m_backend->jqxUpdate('card_sms', 'card_id', $Id, $Params);
                        if (empty($upc) === FALSE) {
                            $response['code'] = 0;
                        } else {
                            $response['message']['serial'] = 'Vui lòng thử lại!';
                            $response['code'] = -1;
                            goto end;
                        }
                    } else {
                        $response['message']['serial'] = 'Vui lòng thử lại!';
                        $response['code'] = -1;
                        goto end;
                    }
                }
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['publisher'] = trim(str_replace($badchars, '', form_error('publisher')));
                $response['message']['price'] = trim(str_replace($badchars, '', form_error('price')));
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                //$response['message']['pin'] = trim(str_replace($badchars, '', form_error('pin')));
                $response['code'] = 1;
            }
        }

        end:

        echo json_encode($response);
        exit();
    }

    private function generateSecurityCode($length, $have_num = true) {
        if ($have_num) {
            $seeks = '0123456789abcdefghiklmnopqstvxuyz';
        } else {
            $seeks = 'abcdefghiklmnopqstvxuyz';
        }
        $max = strlen($seeks) - 1;
        $str = '';
        for ($i = 0; $i < $length; ++$i) {
            $str .= $seeks[mt_rand(0, $max)];
        }
        return $str;
    }

    public function updatestatuscard($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit;
        }
        if ($field == 'del') {
            $rs = $this->m_backend->jqxGet('card_sms', 'id', $this->input->get('id', TRUE));
            if ($rs['public'] == 1) {
                exit;
            }
        }
        $_SESSION['sess'] = 'y';

        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $st = (!empty($_GET['st']) ? ($this->input->get('st', TRUE)) : 0);

        $id = $this->security->xss_clean($id);
        $st = $this->security->xss_clean($st);

        $this->m_backend->_table = $table;

        //$Params['update_time'] = date('Y-m-d H:i:s');
        $Params[$_GET['field']] = $st;
        $Params['update_by'] = $this->session->userdata['user_info']['username'];
        $data = $this->m_backend->jqxUpdatecard($table, $field, $id, $Params);

        $response['code'] = -1;
        $response['message'] = 'Dữ liệu không hợp lệ';
        if ($data) {
            $response["code"] = 0;
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
            $response["message"] = "Lỗi hệ thống. Vui lòng kiểm tra lại thông tin.";
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function checkpass() {
        $this->load->model('m_account');
        $result = $this->m_account->get_by_username($this->session->userdata['user_info']['username']);
        $response = array();
        $arrParam = $this->input->post(NULL, TRUE);

        if (md5($arrParam['pass']) == $result['password']) {
            $response["code"] = 0;
            $response["id_action"] = $arrParam['id_action'];
            $response["name_action"] = $arrParam['name_action'];
            $response["pass"] = md5($arrParam['pass']);
            $response["message"] = "Set thành công.";
        } else {
            $response["code"] = -1;
        }

        end:
        echo json_encode($response);
        exit();
    }

    public function deletecampaign($ctr, $act, $table = '', $field = '') {
        $ctr = $this->check_security($ctr);
        $act = $this->check_security($act);
        $table = $this->check_security($table);
        $field = $this->check_security($field);
        //-- Check user have permission to delete ------------------------------
        if (!isset($_SESSION[$ctr . '::' . $act . '::' . $table])) {
            exit;
        }
        $id = (!empty($_GET['id']) ? ($this->input->get('id', TRUE)) : 0);
        $id = $this->security->xss_clean($id);
        $rs = $this->m_backend->jqxCheckcardpublic($id);

        if (empty($rs) === TRUE) {
            $table = 'card_name';
            $field_id = 'id';
            $rsUp = $this->m_backend->jqxUpdate($table, $field_id, $id, array('status' => 0));
            if (empty($rsUp) === FALSE) {
                $table = 'card_sms';
                $field_id = 'card_id';
                $rsUpcard = $this->m_backend->jqxUpdate($table, $field_id, $id, array('del' => 1));
                if (empty($rsUpcard) === FALSE) {
                    $response['code'] = 0;
                    $response['message'] = 'Đã xóa xong';
                } else {
                    $response["code"] = -1;
                    $response["message"] = "Lỗi hệ thống. Vui lòng thử lại.";
                }
            } else {
                $response["code"] = -1;
                $response["message"] = "Lỗi hệ thống. Vui lòng thử lại.";
            }
        } else {
            $response['code'] = -1;
            $response['message'] = 'Card của chiến dịch này đã được phát nên không thể xóa';
            goto end;
        }

        end:
        echo json_encode($response);
        exit();
    }

    public function addevent() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/event/index';
        $response['message']['name'] = '';
        $response['message']['image_banner'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];

            $this->form_validation->set_rules('name', 'name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('image_banner', 'image_banner', 'callback_xss_check|trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');
            $this->form_validation->set_message('trim', 'Không được có khoảng trắng ở đầu và cuối');
            if ($this->form_validation->run() == TRUE) {
                $Params['name'] = $arrParam['name'];
                $Params['image_banner'] = $arrParam['image_banner'];
                $eventList = array();
                $arrtype = $arrParam['type'];
                $arrArticletype = $arrParam['articletype'];
                $arrArticle = $arrParam['id_article'];
                $arrVideo = $arrParam['id_youtube'];
                $arrAutoplay = $arrParam['autoplay'];

                for ($i = 0; $i < count($arrtype) - 1; $i++) {
                    $eventList[$i]['type'] = $arrtype[$i];
                    if ($arrtype[$i] == 'video') {
                        $eventList[$i]['value'] = $arrVideo[$i];
                        $eventList[$i]['autoplay'] = $arrAutoplay[$i];
                    } else if ($arrtype[$i] == 'article') {
                        $eventList[$i]['value']['type'] = $arrArticletype[$i];
                        $eventList[$i]['value']['id'] = $arrArticle[$i];
                    } else if ($arrtype[$i] == 'image_slide') {
                        $arrList = $arrParam['list' . $i];
                        unset($arrList[count($arrList) - 1]);
                        $eventList[$i]['value'] = $arrList;
                    }
                }
                $Params['event_list'] = json_encode($eventList);
                if (empty($Id) === TRUE) {
                    $Params['timer'] = date('Y-m-d H:i:s');
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $Params['create_by'] = $this->session->userdata['user_info']['username'];
                    $Params['update_by'] = $this->session->userdata['user_info']['username'];
                    $id = $this->m_backend->jqxInsertId('events', $Params);
                } else {
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $Params['update_by'] = $this->session->userdata['user_info']['username'];

                    $this->m_backend->jqxUpdate('events', 'id', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['name'] = trim(str_replace($badchars, '', form_error('name')));
                $response['message']['image_banner'] = trim(str_replace($badchars, '', form_error('image_banner')));
                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addtygia() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/listitems/index';
        $response['message']['type'] = '';
        $response['message']['value'] = '';
        $response['message']['icoin'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];

            $this->form_validation->set_rules('type', 'type', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('value', 'value', 'callback_num_check|trim|required');
            $this->form_validation->set_rules('icoin', 'icoin', 'callback_num_check|trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');
            $this->form_validation->set_message('trim', 'Không được có khoảng trắng ở đầu và cuối');
            if ($this->form_validation->run() == TRUE) {
                $Params = array();
                $Params['type'] = $arrParam['type'];
                $Params['value'] = $arrParam['value'];
                $Params['icoin'] = $arrParam['icoin'];

                if (empty($Id) === TRUE) {
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $Params['create_user'] = $this->session->userdata['user_info']['username'];
                    $id = $this->m_backend->jqxInsertId('list_items', $Params);
                } else {
                    $Params['update_time'] = date('Y-m-d H:i:s');
                    $Params['create_user'] = $this->session->userdata['user_info']['username'];
                    $this->m_backend->jqxUpdate('list_items', 'id', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['type'] = trim(str_replace($badchars, '', form_error('type')));
                $response['message']['value'] = trim(str_replace($badchars, '', form_error('value')));
                $response['message']['icoin'] = trim(str_replace($badchars, '', form_error('icoin')));
                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addintroapp() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/introapp/index';
        $response['message']['type'] = '';
        $response['message']['icoin'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);
            $Id = $arrParam['id'];

            $this->form_validation->set_rules('type', 'type', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('icoin', 'icoin', 'callback_num_check|trim|required');

            $this->form_validation->set_message('required', 'Không được rỗng');
            $this->form_validation->set_message('trim', 'Không được có khoảng trắng ở đầu và cuối');
            if ($this->form_validation->run() == TRUE) {
                $Params = array();
                $Params['type'] = $arrParam['type'];
                $Params['icoin'] = $arrParam['icoin'];
                $Params['content'] = $arrParam['content'];
                //image               
                $subject = $Params['content'];
                $pattern = '#.*<img.*src="(.*)".*>#imsU';
                preg_match_all($pattern, $subject, $matches);
                $data['arrImg'] = $matches[1];

                if (empty($matches[1]) === FALSE) {
                    foreach ($matches[1] as $k => $v) {
                        if (strpos($v, 'http') !== false) {
                            continue;
                        } else {
                            $badchars = '"' . $v . '"';
                            $rep = '"' . 'http://' . $_SERVER['HTTP_HOST'] . $v . '"';
                            $subject = str_replace($badchars, $rep, $subject);
                        }
                    }
                }
                $Params['content'] = $subject;
                if (empty($Id) === FALSE) {
                    $Params['create_time'] = date('Y-m-d H:i:s');
                    $this->m_backend->jqxUpdate('intro_app', 'id', $Id, $Params);
                }
                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['type'] = trim(str_replace($badchars, '', form_error('type')));
                $response['message']['icoin'] = trim(str_replace($badchars, '', form_error('icoin')));
                $response['code'] = 1;
            }
        }
        end:
        echo json_encode($response);
        exit();
    }

    public function addnews() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/news_video/index_news';

        $response['message']['name'] = '';
//        $response['message']['type'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL);

            $Id = @$arrParam['id'];


            $this->form_validation->set_rules('name', 'name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('image', 'image', 'callback_xss_check|trim|required');
//            $this->form_validation->set_rules('type', 'type', 'callback_xss_check');
            $this->form_validation->set_rules('description', 'description', 'callback_xss_check');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
//                die(json_encode($arrParam));
                $Params = array();
                $Params['name'] = $this->security->xss_clean($arrParam['name']);
                $Params['image'] = $this->security->xss_clean($arrParam['image']);
                $Params['type'] = 'news';
                $Params['content'] = $arrParam['content'];
                $Params['description'] = $this->security->xss_clean($arrParam['description']);

                if (empty($Id) === TRUE) {
                    $this->load->library('session');
                    $user_info = $this->session->userdata('user_info');
                    $Params['create_time'] = date('Y-m-d H:i:s');

                    $this->m_backend->jqxInsert('news_video', $Params);
                } else {
                    $this->m_backend->jqxUpdate('news_video', 'id_news_video', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['title'] = trim(str_replace($badchars, '', form_error('title')));
                $response['message']['type'] = trim(str_replace($badchars, '', form_error('type')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    public function addvideo() {
        $this->load->library('form_validation');
        $response['code'] = -1;
        $response['redirect'] = '/backend/news_video/index_video';

        $response['message']['name'] = '';
//        $response['message']['type'] = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $arrParam = $this->input->post(NULL, TRUE);

            $Id = @$arrParam['id'];


            $this->form_validation->set_rules('name', 'name', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('image', 'image', 'callback_xss_check|trim|required');
            $this->form_validation->set_rules('youtube_id', 'youtube_id', 'callback_xss_check');
            $this->form_validation->set_rules('description', 'description', 'callback_xss_check');
            $this->form_validation->set_message('required', 'Không được rỗng');
            if ($this->form_validation->run() == TRUE) {
//                die(json_encode($arrParam));
                $Params = array();
                $Params['name'] = $this->security->xss_clean($arrParam['name']);
                $Params['youtube_id'] = $this->security->xss_clean($arrParam['youtube_id']);
                $Params['image'] = $this->security->xss_clean($arrParam['image']);
                $Params['type'] = 'video';
                $Params['content'] = $arrParam['content'];
                $Params['description'] = $this->security->xss_clean($arrParam['description']);

                if (empty($Id) === TRUE) {
                    $this->load->library('session');
                    $user_info = $this->session->userdata('user_info');
                    $Params['create_time'] = date('Y-m-d H:i:s');

                    $this->m_backend->jqxInsert('news_video', $Params);
                } else {
                    $this->m_backend->jqxUpdate('news_video', 'id_news_video', $Id, $Params);
                }

                $response['code'] = 0;
            } else {
                $badchars = array('<p>', '</p>');
                $response['message']['title'] = trim(str_replace($badchars, '', form_error('title')));
                $response['message']['type'] = trim(str_replace($badchars, '', form_error('type')));
                $response['code'] = 1;
            }
        }

        end:
        echo json_encode($response);
        exit;
    }

    function ajax_get_cat() {
        $arrParam = $this->input->get(NULL, TRUE);
        $id = @$arrParam['type'];
        $data = $this->m_backend->jqxGetId('cate', 'type', strtolower($id));
        $result = "<select name='cate'>";
        if(!empty($data))
            foreach ($data as $key => $value) {
                $result .= '<option value="'.$value['id_cate'].'">'.$value['title'].'</option>';
            }
       $result .= "</select>";
       echo $result;
        die();
    }

}

?>