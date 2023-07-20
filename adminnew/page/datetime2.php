<?php 

     function xTimeAgo ($oldTime, $newTime, $timeType) {
            $timeCalc = strtotime($newTime) - strtotime($oldTime);       
            if ($timeType == "x") {
                if ($timeCalc = 60) {
                    $timeType = "m";
                }
                if ($timeCalc = (60*60)) {
                    $timeType = "h";
                }
                if ($timeCalc = (60*60*24)) {
                    $timeType = "d";
                }
            }       
            if ($timeType == "s") {
                $timeCalc .= " seconds ago";
            }
            if ($timeType == "m") {
                $timeCalc = round($timeCalc/60) . " menit";
            }       
            if ($timeType == "h") {
                $timeCalc = round($timeCalc/60/60);
            }
            if ($timeType == "d") {
                $timeCalc = round($timeCalc/60/60/24) . " hari";
            }       
            return $timeCalc;
        }

    function timeAgo($timestamp){
        date_default_timezone_set('Asia/Jakarta');
        $skrg=date("Y-m-d H:i:s");
        $isi= str_replace("-","",xTimeAgo($skrg,$timestamp,"h"));
        $go="$isi";
       
        return $go;
    } 

//echo timeAgo('2015-03-13 10:47:42');
?>