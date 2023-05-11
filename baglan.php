<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=yapilacaklar-uygulamasi", "root", "");
    //echo "Bağlantı Başarılı";
} catch ( PDOException $e ){
    print $e->getMessage();
}


function filtrele($value){
    $A = trim($value);
    $B = strip_tags($A);
    $C = htmlspecialchars($B, ENT_QUOTES);
    $D = $C;
    return $D;
}