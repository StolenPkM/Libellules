<?php

    function isReserved($result, $date): bool {
        $d = strtotime($date);
        foreach($result as $r) {
            $e = strtotime($r['entry_date']);
            $o = strtotime($r['out_date']);
            if ($d >= $e && $d <= $o) {
                return true;
            }
        }
        return false;
    }
?>