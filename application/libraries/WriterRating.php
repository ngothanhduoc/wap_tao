<?php
/**
 * Description of admin
 *
 * @author tailm
 */

class WriterRating {

    private $CI;
    
    function __construct() {
        $this->CI = & get_instance();        
    }
    
    public function getRating($score){
        $result = '';
        if($score < 5){
            $result = 'Dở';
        }elseif ($score < 7) {
            $result = 'Tạm';
        }elseif ($score < 8) {
            $result = 'Khá';
        }  else {
            $result = 'Tốt';
        }
        
        return $result;
    }
    public function getClassRating($score){
        $result = '';
        if($score < 5){
            $result = 'score-1-5';
        }elseif ($score < 7) {
            $result = 'score-5-6';
        }elseif ($score < 8) {
            $result = 'score-6-7';
        }elseif($score < 9){
            $result = 'score-8-9';
        }else {        
            $result = 'score-10';
        }
        
        return $result;
    }
    	
}

?>
