<?php


class PaginationWapTab{


	public function paging($count,$per_page,$cur_page,$tab,$url)
	{
           $paging = '';
            if (($count / $per_page) > 1) {
                $previous_btn = true;
                $next_btn = true;
                $first_btn = true;
                $last_btn = true;

                $no_of_paginations = ceil($count / $per_page);

                if ($cur_page >= 3) {
                    $start_loop = $cur_page - 1;
                    if ($no_of_paginations > $cur_page + 1)
                        $end_loop = $cur_page + 1;
                    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 2) {
                        $start_loop = $no_of_paginations - 2;
                        $end_loop = $no_of_paginations;
                    } else {
                        $end_loop = $no_of_paginations;
                    }
                } else {
                    $start_loop = 1;
                    if ($no_of_paginations > 3)
                        $end_loop = 3;
                    else
                        $end_loop = $no_of_paginations;
                }

                $paging .= "<div class='pag' style='border-top: #e3e3e3 solid 0px; padding: 10px 0px; margin: 0px auto; text-align: center'>";

                // FOR ENABLING THE FIRST BUTTON
                if ($first_btn && $cur_page > 1) {
                    $paging .= "<span p='1' class='inactive first'><a href='" . base_url() . $url . "?t=".$tab."&trang=1'>&nbsp;</a></span>";
                } else if ($first_btn) {
                    $paging .= "<span p='1' class='inactive first'><a href='" . base_url() . $url . "?t=".$tab."&trang=1'>&nbsp;</a></span>";
                }

                // FOR ENABLING THE PREVIOUS BUTTON
                if ($previous_btn && $cur_page > 1) {
                    $pre = $cur_page - 1;
                    //$paging .= "<span p='" . $pre . "' class='inactive pre'><a href='" . base_url() . "?trang=" . $pre . "'>&nbsp;</a></span>";
                } else if ($previous_btn) {
                    //$paging .= "<span class='pre'><a href='javascript:void(0)'>&nbsp;</a></span>";
                }
                $curp = 1;
                for ($i = $start_loop; $i <= $end_loop; $i++) {
                    if ($cur_page == $i) {
                        $curp = $i;
                        $paging .= "<span p='" . $i . "' class='active'><a href='javascript:void(0)'>" . $i . "</a></span>";
                    } else {
                        $paging .= "<span p='$i' class='inactive'><a href='" . base_url() . $url . "?t=".$tab."&trang=" . $i . "'>" . $i . "</a></span>";
                    }
                }

                // TO ENABLE THE NEXT BUTTON
                if ($next_btn && $cur_page < $no_of_paginations) {
                    $nex = $cur_page + 1;
                    //$paging .= "<li p='" . $nex . "' class='inactive next'><a href='" . base_url() . "?trang=" . $nex . "'>&nbsp;</a></li>";
                } else if ($next_btn) {
                    //$paging .= "<li class='next'><a href='javascript:void(0)'>&nbsp;</a></li>";
                }

                // TO ENABLE THE END BUTTON
                if ($last_btn && $cur_page < $no_of_paginations) {
                    $paging .= "<span p='" . $no_of_paginations . "' class='inactive last'><a href='" .  base_url() . $url . "?t=".$tab."&trang=" . $no_of_paginations . "'>&nbsp;</a></span>";
                } else if ($last_btn) {
                    $paging .= "<span p='$no_of_paginations' class='inactive last'><a href='" . base_url() . $url . "?t=".$tab."&trang=" . $no_of_paginations . "'>&nbsp;</a></span>";
                }
                $paging .= "</div>";
            }           
            
            return $paging;
	}	
}