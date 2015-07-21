<?php


class Pagination{


	public function paging($X,$B,$A,$link)
	{
            $C=ceil($A/$B);
            $abc='<center id="pag_gift">';

            if($C > 1)
            {
		$F=1;
		$D=$X/$B + 1;
		//$abc.="<li><span>$D/$C</span></li>";
		//if($D != 1)
		//{
			$abc.="<span class='inactive first'><a href='$link?trang=1'><img src='/frontend/assets/images/first-page-btn.png' alt='Trang đầu'></a></span>";
			//$Y=$X - $B;
			//$abc.= "<li><a href='$link?start=$Y'><<</a></li>";
			if($D > 3)
                        {
                            $F=$D-2;
                            //$abc.= "<li><span>...</span></li>";
			}
		//}
		$G=$D;
		if($G < ($C-2))
		{
                    if($G==1)
                        $G=$D+4;
                    else if($G==2)
                        $G=$D+3;
                    else
                        $G=$D+2;
                }else{
                    if($G>5){
                        if($G==($C-1))
                            $F=$D-3;
                        else if($G==$C)
                            $F=$D-4;
                    }
                    $G=$C;
		}
		for($I=$F;$I<=$G;$I++)
		{
                    if($I==$D)
                    {
                        $abc.= "<span class='active'><a class='active'>$I</a></span>";
                    }else{
			$Y=($I - 1)*$B;
			$abc.= "<span class='inactive'><a href='$link?trang=$I'>$I</a></span>";
                    }
		}
		//if($D != $C)
		//{
                    //if($D < ($C-2))
                    //{
                        //$abc.= "<li><span>...</span></li>";;
                    //}
                    //$Y=$X + $B;
                    //$abc.= "<li><a href='$link?start=$Y'>>></a></li>";			
                    $L=($C - 1)*$B;	
                    $abc.= "<span class='inactive first'><a href='$link?trang=$C'><img src='/frontend/assets/images/last-page-btn.png' alt='Trang cuối'></a></span>";
		//}
            }
            $abc.='</center>';
            return $abc;
	}	
}