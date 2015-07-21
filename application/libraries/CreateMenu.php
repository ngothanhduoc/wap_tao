<?php

/**
 * Description of admin
 *
 * @author tailm
 */
class CreateMenu {

    private $CI;

    function __construct() {
        $this->CI = & get_instance();
    }

    public function buildArray($sourceArr, $parents = 0) {
        $resultArr = array();
        $this->recursive($sourceArr, $parents, 1, $resultArr);

        return $resultArr;
    }

    public function recursive($sourceArr, $parents = 0, $level = 1, &$resultArr) {
        if (count($sourceArr) > 0) {
            foreach ($sourceArr as $key => $value) {
                if ($value['parent'] == $parents) {
                    $value['level'] = $level;
                    $resultArr[] = $value;
                    $newParents = $value['id_category'];
                    unset($sourceArr[$key]);
                    $this->recursive($sourceArr, $newParents, $level + 1, $resultArr);
                }
            }
        }
    }

    public function createMenu($sourceArr, $parents = 0) {
        $sourceArr = $this->buildArray($sourceArr);
        $newMenu = "";
        $str = "";
        $this->recursiveMenu($sourceArr, $parents = 0, $newMenu, $str);
        return str_replace('<ul></ul>', '', $newMenu);
    }

    public function recursiveMenu($sourceArr, $parents = 0, &$newMenu, &$str) {
        if (count($sourceArr) > 0) {
            $idUL = 'ulGroup_' . $parents;
            if ($newMenu == "") {
                $newMenu .= '<ul id="menuTiny" class="menuTiny">';
            } else {
                $newMenu .= '<ul>';
            }
            foreach ($sourceArr as $key => $value) {
                if ($value['parent'] == $parents) {
                    $liMenu = 'liMenu_' . $value['id_category'];
                    if ($value['parent'] == 0) {
                        $str = "";
                        $str .= '/' . $value['alias'] . '/';
                        $link = '/' . $value['alias'] . '.moi';
                        //if(isset($sourceArr[$key + 1]) && $sourceArr[$key + 1]['parent'] == $value['id_category']){
                        //$newMenu .= '<li page="'.$value['alias'].'" class="sub"><a href="'.$link.'" class="menuTinyLink">' . $value['title'] . '</a>';
                        //}else{
                        $newMenu .= '<li page="' . $value['alias'] . '"><a title="' . $value['title'] . '" href="' . $link . '" class="menuTinyLink">' . $value['title'] . '</a>';
                        //}
                    }/* else{

                      $link = $str . $value['alias'] . '.html';
                      $newMenu .= '<li sub-page="'.$value['alias'].'"><a href="' . $link . '" class="menuTinyLink">' . $value['title'] . '</a>';
                      } */

                    $newParents = $value['id_category'];
                    unset($sourceArr[$key]);
                    $this->recursiveMenu($sourceArr, $newParents, $newMenu, $str);
                    $newMenu .= '</li>';
                }
            }
            $newMenu .= '</ul>';
        }
    }

}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
