<?php

/**
 * Description of admin
 *
 * @author duocnt
 */
class M_wap extends MY_Model {

    var $_dbgroup = 'db';
    var $_table = 'game_app';
    private $configs;
    public $datatables_config;
    protected $_total;

    public function __construct() {
        parent::__construct();

        $this->configs["strJoin"] = "";
        $this->configs["strWhere"] = "WHERE TRUE";
        $this->configs["strGroupBy"] = "";
        $this->configs["strOrderBy"] = "";
        $this->configs["usingLimit"] = true;
        $this->configs["filterfields"] = array();
        $this->configs["fields"] = array();
        $this->configs["datefields"] = array();
    }

    public function config($params) {
        $this->datatables_config = array(
            "table" => $params['table'],
            "where" => "WHERE {$params['where']}",
            "limit" => isset($params['limit']) ? $params['limit'] : true,
        );

        return $this;
    }

    function jqxInsert($table, $param) {
        $this->db_slave->insert($table, $param);
    }

    function jqxInsertId($table, $param) {
        $this->db_slave->insert($table, $param);
        $id = $this->db_slave->insert_id();
        return $id;
    }

    function jqxUpdate($table, $field_id, $id, $param) {
        $this->db_slave->where($field_id, $id);
        $rs = $this->db_slave->update($table, $param); //die($this->db_slave->last_query());
        return $rs;
    }

    function jqxDelete($table, $field_id, $id) {
        $this->db_slave->where($field_id, $id);
        $rs = $this->db_slave->delete($table);
        return $rs;
    }

    function jqxDeleteKeyWord($table, $id_news, $type) {
        $this->db_slave->where('id_news', $id_news);
        $this->db_slave->where('type', $type);
        $rs = $this->db_slave->delete($table);
        return $rs;
    }

    function jqxGetId($table, $where, $select, $limit = '', $offset = '') {
        $this->db_slave->select($select);
        if (!empty($limit))
            $this->db_slave->limit($limit, $offset);
        if ($table == 'game_app') {
            $this->db_slave->order_by('order', 'DESC');
            $this->db_slave->order_by('id_game_app', 'DESC');
        }
        
        if ($table == 'news_video') {
            $this->db_slave->order_by('order', 'DESC');
            $this->db_slave->order_by('id_news_video', 'DESC');
        }
        $sql = $this->db_slave->get_where($table, $where);
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }
    function get_num_row($table, $where){
        $sql = $this->db_slave->get_where($table, $where);
        return $sql->num_rows();
    }
    function jqxGet($table, $field, $id) {
        $sql = $this->db_slave->select()
                ->from($table)
                ->where($field, $id)
                ->limit(1)
                ->get();
        if (is_object($sql)) {
            return $sql->row_array();
        }
    }

    function jqxGets($table) {
        $sql = $this->db_slave->select()
                ->from($table)
                //->limit(500, 5500)
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    function jqxGetgame($id) {
        $query = $this->db_slave->where('id_game', $id)->get($this->_table)->row_array();
        return $query;
    }

    function jqxGetgamename($name) {
        $query = $this->db_slave->where('full_name', $name)->get($this->_table)->row_array();
        return $query;
    }

    function jqxGetnews($id) {
        $query = $this->db_slave->where('id_news', $id)->get($this->_table)->row_array();
        return $query;
    }

    function jqxGetcategory($id) {
        $query = $this->db_slave->where('id_category', $id)->get($this->_table)->row_array();
        return $query;
    }

    function jqxGetcatname($name) {
        $query = $this->db_slave->where('title', $name)->get($this->_table)->row_array();
        return $query;
    }

    function jqxDeletenews($id) {
        $count = $this->db_slave->where('id_news', $id)->delete($this->_table);
        if ($count == 1)
            return true;
        return false;
    }

    function jqxUpdatenews($id, $params) {
        $count = $this->db_slave->where('id_news', $id)->update($this->_table, $params);
        if ($count >= 0)
            return true;
        return false;
    }

    function jqxGetmenugroup($id) {
        $query = $this->db_slave->where('id', $id)->get($this->_table)->row_array();
        return $query;
    }

    function jqxUpdatemenugroup($id, $params) {
        $count = $this->db_slave->where('id', $id)->update($this->_table, $params);
        if ($count >= 0)
            return true;
        return false;
    }

    function jqxDeletemenugroup($id) {
        $count = $this->db_slave->where('id', $id)->delete($this->_table);
        if ($count == 1)
            return true;
        return false;
    }

    function jqxUpdateuser($id, $params) {
        $count = $this->db_slave->where('id_admin', $id)->update($this->_table, $params);
        if ($count >= 0)
            return true;
        return false;
    }

    function jqxGetkeymain() {
        $query = $this->db_slave->where('type', 'main')->get($this->_table)->result_array();
        return $query;
    }

    function jqxGetkeynews($id) {
        $query = $this->db_slave->where('type', 'news')->where('id_news', $id)->order_by('priority asc')->get($this->_table)->result_array();
        return $query;
    }

    function jqxGetkeyprimary($table) {
        $sql = $this->db_slave->select()
                ->from($table)
                ->where('keywordglobal', 1)
                ->order_by('priority asc')
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    function jqxGetkey($id, $type) {
        $query = $this->db_slave->where('type', $type)->where('id_news', $id)->order_by('priority asc')->get($this->_table)->result_array();
        return $query;
    }

    function jqxGeturlnews($id) {
        $sql = $this->db_slave->select('n.*, c.title AS title_cate, c.alias, c.parent')
                ->from('news n')
                ->join('news_category c', 'n.id_category_primary = c.id_category', 'left')
                ->where('n.id_news', $id)
                ->get();
        if (is_object($sql)) {
            return $sql->row_array();
        }
    }

    public function jqxGeturlvideo($id) {
        $sql = $this->db_slave->select('v.*, c.title AS title_cate, c.alias')
                ->from('videos v')
                ->join('news_category c', 'v.id_category = c.id_category', 'left')
                ->where('v.id_video', $id)
                ->limit(1)
                ->get();
        return $sql->row_array();
    }

    public function jqxGeturlgiftcode($id) {
        $sql = $this->db_slave->select('c.*')
                ->from('codes_name c')
                ->where('c.id_name', $id)
                ->limit(1)
                ->get();
        return $sql->row_array();
    }

    public function jqxCheckpincard($pin, $publisher) {
        $sql = $this->db_slave->select()
                ->from('card_sms')
                ->where('pin', $pin)
                ->where('publisher', $publisher)
                ->where('del', 0)
                ->limit(1)
                ->get();
        return $sql->row_array();
    }

    public function jqxCheckserialcard($serial, $publisher) {
        $sql = $this->db_slave->select()
                ->from('card_sms')
                ->where('serial', $serial)
                ->where('publisher', $publisher)
                ->where('del', 0)
                ->limit(1)
                ->get();
        return $sql->row_array();
    }

    public function jqxCheckcodecard($code) {
        $sql = $this->db_slave->select()
                ->from('card_sms')
                ->where('code', $code)
                ->where('del', 0)
                ->limit(1)
                ->get();
        return $sql->row_array();
    }

    function jqxUpdatecard($table, $field_id, $id, $param) {
        $this->db_slave->where($field_id, $id)->where('public', 0);
        $rs = $this->db_slave->update($table, $param);
        return $rs;
    }

    public function jqxCheckcardpublic($card_id) {
        $sql = $this->db_slave->select()
                ->from('card_sms')
                ->where('card_id', $card_id)
                ->where('public', 1)
                ->get();
        return $sql->result_array();
    }

    public function jqxGetTotalPlatform($table, $arrParam) {
        if ($table == 'user_app') {
            $sql = $this->db_slave->select("count(*) total, platform")
                    ->from($table)
                    ->where("date(create_time) >= '" . $arrParam['start_time'] . "'")
                    ->where("date(create_time) <= '" . $arrParam['end_time'] . "'")
                    ->group_by("platform")
                    ->get();
        } else {
            $sql = $this->db_slave->select("count(*) total, platform")
                    ->from($table)
                    ->where('user_name', $arrParam['id_user_app'])
                    ->where("date(create_time) >= '" . $arrParam['start_time'] . "'")
                    ->where("date(create_time) <= '" . $arrParam['end_time'] . "'")
                    ->group_by("platform")
                    ->get();
        }
        return $sql->result_array();
    }

    function jqxBinding() {
        //$method = $this->security->xss_clean($_REQUEST);
        $method = $this->security->xss_clean($_GET);

        $pagenum = isset($method['pagenum']) ? $method['pagenum'] : 0;
        $pagesize = isset($method['pagesize']) ? $method['pagesize'] : 10;
        $start = $pagenum * $pagesize;
        if (!empty($this->datatables_config)) {
            if (!empty($this->datatables_config["select"])) {
                $FstrSQL = $select = (!empty($this->datatables_config["select"]) ? $this->datatables_config["select"] : "")
                        . " " .
                        (!empty($this->datatables_config["from"]) ? $this->datatables_config["from"] : "");
            } else {
                $FstrSQL = "SELECT SQL_CALC_FOUND_ROWS `{$this->datatables_config["table"]}`.* FROM `{$this->datatables_config["table"]}`";
            }
            /**
             * Thêm tính năng join table
             * @author vinhtt
             * 
             */
            $join = (!empty($this->datatables_config["join"]) ? $this->datatables_config["join"] : "");
            $where = (!empty($this->datatables_config["where"]) ? $this->datatables_config["where"] : "Where true");
            $strgroupby = (!empty($this->datatables_config["group_by"]) ? $this->datatables_config["group_by"] : "");
            $orderby = (!empty($this->datatables_config["order_by"]) ? $this->datatables_config["order_by"] : "");
            $fields = (!empty($this->datatables_config["columnmaps"]) ? $this->datatables_config["columnmaps"] : array());
            $datefields = (!empty($this->datatables_config["datefields"]) ? $this->datatables_config["datefields"] : array());
            $limit = "";
            if (isset($this->datatables_config["limit"]) && $this->datatables_config["limit"]) {
                $limit = "LIMIT $start, $pagesize";
            } else {
                if ($pagesize == 10)
                    $pagesize = 1000;
                $limit = "LIMIT $start, $pagesize";
            }
        }else {
            $FstrSQL = $this->configs["strQuery"];
            $select = $this->configs["strQuery"];
            $where = $this->configs["strWhere"];
            $join = $this->configs["strJoin"];
            $strgroupby = $this->configs["strGroupBy"];
            $orderby = $this->configs["strOrderBy"];
            $fields = $this->configs["fields"];
            $datefields = $this->configs["datefields"];
            $limit = "";
            if (isset($this->configs["usingLimit"]) && $this->configs["usingLimit"]) {
                $limit = "LIMIT $start, $pagesize";
            } else {
                $limit = "LIMIT 1000";
            }
        }



        if (isset($method['filterscount'])) {
            $filterscount = $method['filterscount'];

            if ($filterscount > 0) {
                $where.= " AND (";
                $tmpdatafield = "";
                $tmpfilteroperator = "";
                for ($i = 0; $i < $filterscount; $i++) {
                    // get the filter's value.
                    $filtervalue = $method["filtervalue" . $i];
                    // get the filter's condition.
                    $filtercondition = $method["filtercondition" . $i];
                    // get the filter's column.
                    $filterdatafield = $method["filterdatafield" . $i];
                    // get the filter's operator.
                    $filteroperator = $method["filteroperator" . $i];

                    if ($filterdatafield[0] === "_" && $filterdatafield[strlen($filterdatafield) - 1] === "_") {
                        $filterdatafield = substr($filterdatafield, 1, -1);
                    }


                    if (count($datefields) > 0 && in_array($filterdatafield, $datefields)) {
                        $tmp = explode("GMT", $filtervalue);
                        if (isset($tmp[0])) {
                            $filtervalue = date("Y-m-d H:i:s", strtotime($tmp[0]));
                        }
                    }
                    //$filtervalue = $this->db->escape_str($filtervalue);
                    if (count($fields) > 0 && isset($fields[$filterdatafield])) {
                        $filterdatafield = $fields[$filterdatafield];
                    } else {
                        $filterdatafield = "`$filterdatafield`";
                    }

                    //check filterdatafield
                    if ($tmpdatafield == "") {
                        $tmpdatafield = $filterdatafield;
                    } else if ($tmpdatafield <> $filterdatafield) {
                        $where .= " ) AND ( ";
                    } else if ($tmpdatafield == $filterdatafield) {
                        if ($tmpfilteroperator == 0) {
                            $where .= " AND ";
                        } else
                            $where .= " OR ";
                    }

                    // build the "WHERE" clause depending on the filter's condition, value and datafield.
                    // possible conditions for string filter: 
                    //      'EMPTY', 'NOT_EMPTY', 'CONTAINS', 'CONTAINS_CASE_SENSITIVE',
                    //      'DOES_NOT_CONTAIN', 'DOES_NOT_CONTAIN_CASE_SENSITIVE', 
                    //      'STARTS_WITH', 'STARTS_WITH_CASE_SENSITIVE',
                    //      'ENDS_WITH', 'ENDS_WITH_CASE_SENSITIVE', 'EQUAL', 
                    //      'EQUAL_CASE_SENSITIVE', 'NULL', 'NOT_NULL'
                    // 
                    // possible conditions for numeric filter: 'EQUAL', 'NOT_EQUAL', 'LESS_THAN',
                    //  'LESS_THAN_OR_EQUAL', 'GREATER_THAN', 'GREATER_THAN_OR_EQUAL', 
                    //  'NULL', 'NOT_NULL'
                    //  
                    // possible conditions for date filter: 'EQUAL', 'NOT_EQUAL', 'LESS_THAN', 
                    // 'LESS_THAN_OR_EQUAL', 'GREATER_THAN', 'GREATER_THAN_OR_EQUAL', 'NULL', 
                    // 'NOT_NULL'                         

                    switch ($filtercondition) {
                        case "NULL":
                            $where .= " ($filterdatafield is null)";
                            break;
                        case "EMPTY":
                            $where .= " ($filterdatafield is null) or ($filterdatafield='')";
                            break;
                        case "NOT_NULL":
                            $where .= " ($filterdatafield is not null)";
                            break;
                        case "NOT_EMPTY":
                            $where .= " ($filterdatafield is not null) and ($filterdatafield <>'')";
                            break;
                        case "CONTAINS_CASE_SENSITIVE":
                        case "CONTAINS":
                            $where .= " $filterdatafield LIKE '%$filtervalue%'";
                            break;
                        case "DOES_NOT_CONTAIN_CASE_SENSITIVE":
                        case "DOES_NOT_CONTAIN":
                            $where .= " $filterdatafield NOT LIKE '%$filtervalue%'";
                            break;
                        case "EQUAL_CASE_SENSITIVE":
                        case "EQUAL":
                            $where .= " $filterdatafield = '$filtervalue'";
                            break;
                        case "NOT_EQUAL":
                            $where .= " $filterdatafield <> '$filtervalue'";
                            break;
                        case "GREATER_THAN":
                            $where .= " $filterdatafield > '$filtervalue'";
                            break;
                        case "LESS_THAN":
                            $where .= " $filterdatafield < '$filtervalue'";
                            break;
                        case "GREATER_THAN_OR_EQUAL":
                            $where .= " $filterdatafield >= '$filtervalue'";
                            break;
                        case "LESS_THAN_OR_EQUAL":
                            $where .= " $filterdatafield <= '$filtervalue'";
                            break;
                        case "STARTS_WITH_CASE_SENSITIVE":
                        case "STARTS_WITH":
                            $where .= " $filterdatafield LIKE '$filtervalue%'";
                            break;
                        case "ENDS_WITH_CASE_SENSITIVE":
                        case "ENDS_WITH":
                            $where .= " $filterdatafield LIKE '%$filtervalue'";
                            break;
                        default:
                            $where .= " $filterdatafield LIKE '%$filtervalue%'";
                    }

                    if ($i == $filterscount - 1) {
                        $where .= ")";
                    }

                    $tmpfilteroperator = $filteroperator;
                    $tmpdatafield = $filterdatafield;
                }
                // build the query.
            }
        }
        /**
         * Thêm parameter join
         * @author vinhtt
         */
        if (isset($method['sortdatafield'])) {
            $sortfield = $method['sortdatafield'];
            //fix sortfield
            if ($sortfield[0] === "_" && $sortfield[strlen($sortfield) - 1] === "_") {
                $sortfield = substr($sortfield, 1, -1);
            }

            if (count($fields) > 0 && isset($fields[$sortfield])) {
                $sortfield = $fields[$sortfield];
            } else {
                $sortfield = "`$sortfield`";
            }
            $sortorder = $method['sortorder'];
            if ($sortorder == "desc") {
                $SQLquery = "$FstrSQL $join $where $strgroupby ORDER BY $sortfield DESC $limit";
            } elseif ($sortorder == "asc") {
                $SQLquery = "$FstrSQL $join $where $strgroupby ORDER BY $sortfield ASC $limit";
            } else {
                $SQLquery = "$FstrSQL $join $where $strgroupby $orderby $limit";
            }
        } else {
            $SQLquery = "$FstrSQL $join $where $strgroupby $orderby $limit";
        }

        $_SESSION["debug"]["SQLquery"] = $SQLquery;
        //$result['sQuery'] = $SQLquery;

        $query = $this->db_slave->query($SQLquery);



        if (is_object($query)) {
            $sql = "SELECT FOUND_ROWS() AS `found_rows`;";

            $resultTotal = $this->db_slave->query($sql);

            $rows = $resultTotal->result();

            $total_rows = (int) $rows[0]->found_rows;

            $result['rows'] = $query->result_array();
            $result['totalrecords'] = $total_rows;
            $result['pagenum'] = (int) $pagenum;
            $result['pagesize'] = (int) $pagesize;
            $result['totalpages'] = ceil($result['totalrecords'] / $result['pagesize']);
            return $result;
        }
    }

    function get_groupmenu() {
        $sql = $this->db_slave->select('g.id, g.display_name')
                ->from('function_group g')
                ->where('is_display', 1)
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    function get_menu($groupId) {
        $sql = $this->db_slave->select('f.id_function, f.name_display')
                ->from('function f')
                ->where('f.parent_id', $groupId)
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    function get_adminmenu($id_admin) {
        $sql = $this->db_slave->select('h.id_function')
                ->from('user_has_function h')
                ->where('h.id_admin', $id_admin)
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    function get_num_game_publisher() {
        $sql = $this->db_slave->select('g.id_publisher, COUNT(id_publisher) as total')
                ->from('game g')
                ->group_by('g.id_publisher')
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    //Duocnt
    function jqxu_update_news_category($id, $params) {
        $count = $this->db_slave->where('id_category', $id)->update($this->_table, $params);
        if ($count >= 0)
            return true;
        return false;
    }

    function inser_giftcode($str) {
        $SQLquery = "INSERT INTO `codes` (`id`, `id_game`, `id_name`, `id_publisher`, `code`, `name`, `create_time`, `status`, `create_user`) VALUES " . $str;
        $rs = $this->db_slave->query($SQLquery);
        return $rs;
    }

    function get_num_code_name() {
        $sql = $this->db_slave->select('c.id_name, COUNT(id_name) as total')
                ->from('codes c')
                ->where('c.status', 1)
                ->group_by('c.id_name')
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    function get_user_admin() {
        $sql = $this->db_slave->select('u.id_admin')
                ->from('user u')
                ->join("user_group g", "u.id_group = g.id_group")
                ->where('g.is_admin', 1)
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    function jqxGetLike($table, $field, $id, $limit) {
        $sql = $this->db_slave->select('id, name')
                ->from($table)
                ->like($field, $id)
                ->limit($limit)
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    public function detail_total_device($start_time, $end_time) {
        $sql = $this->db_slave->select('platform, count(*) as total')
                ->from('user_app')
                ->where("date(create_time) <=", $end_time)
                ->where("date(create_time) >=", $start_time)
                ->group_by("platform")
                ->get();
        if (is_object($sql)) {
            $db = $sql->result_array();
            $total = 0;
            foreach ($db as $key => $value) {
                $re[$value['platform']] = $value['total'];
                $total += $value['total'];
            }
            $re['total_device'] = $total;
            return $re;
        }
    }

    function jqxGetTempbyUserAndNews($id_user, $id_news) {
        $sql = $this->db_slave->select()
                ->from('temp_content')
                ->where('id_user', $id_user)
                ->where('id_news', $id_news)
                ->limit(1)
                ->get();
        if (is_object($sql)) {
            return $sql->row_array();
        }
    }

    public function get_game_info_of_giftcode($id_code_name) {

        $sql = $this->db_slave->select('g.full_name, g.platform')
                ->from("game g")
                ->join('codes_name n', 'n.id_game = g.id_game')
                ->where('n.id_name', $id_code_name)
                ->limit(1)
                ->get();

        return $sql->row_array();
    }

    function jqxGetAutocompleteGame($field, $id, $limit) {
        $sql = $this->db_slave->select('id_game, full_name')
                ->from('game')
                ->like($field, $id)
                ->limit($limit)
                ->get();
        if (is_object($sql)) {
            return $sql->result_array();
        }
    }

    public function addGameintoSolrDocument($id_game) {
        try {
            $game = $this->jqxGet('game', 'id_game', $id_game);
            if (empty($game) === FALSE) {
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
                    return $updateResponse->getResponse();
                } else {
                    $client->deleteById($game['id_game']);
                    return $client->commit();
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function addNewsintoSolrDocument($id_news) {
        try {
            $news = $this->jqxGet('news', 'id_news', $id_news);
            if (empty($news) === FALSE) {
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
                    $category = $this->jqxGet('news_category', 'id_category', $news['id_category_primary']);
                    if (empty($category)) {
                        $doc->addField('alias', '');
                        $doc->addField('category', '');
                    } else {
                        $doc->addField('alias', $category['alias']);
                        $doc->addField('category', $category['title']);
                    }
                    $updateResponse = $client->addDocument($doc);
                    $client->commit();
                    return $updateResponse->getResponse();
                } else {
                    $client->deleteById($news['id_news']);
                    return $client->commit();
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function addVideointoSolrDocument($id_video) {
        try {
            $video = $this->jqxGet('videos', 'id_video', $id_video);
            if (empty($video) === FALSE) {
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
                    return $updateResponse->getResponse();
                } else {
                    $client->deleteById($video['id_video']);
                    return $client->commit();
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function addGiftcodeintoSolrDocument($id_name) {
        try {
            $giftcode = $this->jqxGet('codes_name', 'id_name', $id_name);
            if (empty($giftcode) === FALSE) {
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
                    return $updateResponse->getResponse();
                } else {
                    $client->deleteById($giftcode['id_name']);
                    return $client->commit();
                }
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function addKeywordsintoSolrDocument($id, $name, $alias, $priority, $id_news, $type) {
        try {
            if (empty($id) === FALSE && is_numeric($id)) {
                $this->config->load('solr');
                $solr = $this->config->item('solr');
                $options = array
                    (
                    'hostname' => $solr['SOLR_SERVER_HOSTNAME'], //dinh nghia trong file bootstrap
                    'login' => $solr['SOLR_SERVER_USERNAME'], //dinh nghia trong file bootstrap
                    'password' => $solr['SOLR_SERVER_PASSWORD'], //dinh nghia trong file bootstrap
                    'port' => $solr['SOLR_SERVER_PORT'], //dinh nghia trong file bootstrap
                    'path' => 'solr/keywords' //$solr['SOLR_SERVER_PATH'] dinh nghia trong file bootstrap
                );
                $client = new SolrClient($options);

                $doc = new SolrInputDocument();
                $doc->addField('id', $id);
                $doc->addField('name', $name);
                $doc->addField('alias', $alias);
                $doc->addField('type', $type);
                $doc->addField('priority', $priority);
                $doc->addField('id_news', $id_news);
                $updateResponse = $client->addDocument($doc);
                $client->commit();
                return $updateResponse->getResponse();
            } else {
                return FALSE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function deleteKeywordsintoSolrDocument($id_news, $type) {
        try {
            $this->config->load('solr');
            $solr = $this->config->item('solr');
            $options = array
                (
                'hostname' => $solr['SOLR_SERVER_HOSTNAME'], //dinh nghia trong file bootstrap
                'login' => $solr['SOLR_SERVER_USERNAME'], //dinh nghia trong file bootstrap
                'password' => $solr['SOLR_SERVER_PASSWORD'], //dinh nghia trong file bootstrap
                'port' => $solr['SOLR_SERVER_PORT'], //dinh nghia trong file bootstrap
                'path' => 'solr/keywords' //$solr['SOLR_SERVER_PATH'] dinh nghia trong file bootstrap
            );
            $client = new SolrClient($options);

            $client->deleteByQuery("id_news:$id_news AND type:$type");
            return $client->commit();
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function search($key){
        $sql = $this->db_slave->select('id_game_app, name, icon, description, count_download, size, platform, download_url,type')
            ->from('game_app')
            ->where('status', 'active')
            ->like('name', $key)
            ->get();
        if (is_object($sql)) {
//            die($this->db_slave->last_query());
            return $sql->result_array();
        }
    }

}
