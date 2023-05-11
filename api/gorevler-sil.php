<?php
if (isset($_POST['id'])){
 require_once ("../baglan.php");
 $id = Filtrele($_POST['id']);
 $Sil = $db->prepare("DELETE FROM yapilacaklar WHERE id = ? ");
 $Sil->execute([$id]);
 if ($Sil){
     echo "Silindi";
 }
}