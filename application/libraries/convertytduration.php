<?php

class convertytduration {

    public function index($duration) {
        $h = 0;
        $m = 0;
        $s = 0;
        $time = '';
        if (preg_match('/PT(.*)H/', $duration, $matches)) {
            $h = $matches[1];
        }
        if (preg_match('/H(.*)M/', $duration, $matches)) {
            $m = $matches[1];
        } else {
            if (preg_match('/PT(.*)M/', $duration, $matches)) {
                $m = $matches[1];
            }
        }
        if (preg_match('/M(.*)S/', $duration, $matches)) {
            $s = $matches[1];
        } else {
            if (preg_match('/H(.*)S/', $duration, $matches)) {
                $s = $matches[1];
            } else {
                if (preg_match('/PT(.*)S/', $duration, $matches)) {
                    $s = $matches[1];
                }
            }
        }
        //$duration = preg_replace("#PT|S|pt|s|Pt|pT#", '', $duration);
        //$duration = preg_replace("#H|M|h|m#", ':', $duration);
        $time = gmdate("H:i:s", (($h * 60 + $m) * 60 + $s));
        $time = preg_replace('#00:00:|^00:#', '', $time);

        return $time;
    }

}
?>