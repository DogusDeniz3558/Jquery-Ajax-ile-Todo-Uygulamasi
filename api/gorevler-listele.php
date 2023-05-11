<?php
require_once ("../baglan.php");
$VeriSor = $db->prepare("SELECT * FROM yapilacaklar ORDER BY id DESC ");
$VeriSor->execute();
$Veri = $VeriSor->fetchAll(PDO::FETCH_ASSOC);

echo  json_encode($Veri);