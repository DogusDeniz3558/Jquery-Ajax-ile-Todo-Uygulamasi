<?php
if (isset($_POST['id'])) {
    require_once ("../baglan.php");
    $id = Filtrele($_POST['id']);
    $durum = Filtrele($_POST['durum']);
    if ($durum === "true"){
        $durum = 1;
    }else{
        $durum = 0;
    }

    $Guncelle = $db->prepare("UPDATE yapilacaklar SET durum = ? WHERE id = ?");
    $Guncelle->execute([
        $durum,
        $id
    ]);
}