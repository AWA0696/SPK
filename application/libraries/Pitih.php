<?php

class Pitih{  
function formatrupiah($angka) { 
    if(is_numeric($angka)) {
        $format_rupiah = 'Rp. ' . number_format($angka, '0', ',', '.');
        return $format_rupiah;
    }
    else {
        echo "$angka" ;
    }
}
}
