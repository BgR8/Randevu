<?php
include 'ayar.php';
setcookie("ogrtOturum",$oturum,time()-7200);
setcookie("ogrtKim",$satir['yonkim'],time()-7200);
mysql_query("UPDATE akademisyen SET ogrtOturum = ''
WHERE ogrtKim = '".$_COOKIE['ogrtKim']."'");
header('Location: index.php');
session_destroy();
?>