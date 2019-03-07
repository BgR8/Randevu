<?php
include 'ayar.php';
setcookie("ogrOturum",$oturum,time()-7200);
setcookie("ogrKim",$satir['yonkim'],time()-7200);
mysql_query("UPDATE ogrenci SET ogrOturum = ''
WHERE ogrKim = '".$_COOKIE['ogrKim']."'");
header('Location: index.php');
session_destroy();
?>