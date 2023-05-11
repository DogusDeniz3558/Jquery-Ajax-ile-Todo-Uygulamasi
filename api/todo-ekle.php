<?php
if (isset($_POST['gorev'])){
    require_once("../baglan.php");
    $Gorev = Filtrele($_POST['gorev']);

    if ($Gorev != null){
        $Ekle = $db->prepare("INSERT INTO yapilacaklar SET gorevler = ?, durum = ?, tarih = ?");
        $Ekle->execute([
            $Gorev,
            0,
            date("Y-m-d")
        ]);

        if ($Ekle){
            echo  "Eklendi";
        }else{
            echo "Eklenmedi";
        }
    }else{
        echo  "Boş";
    }




}
