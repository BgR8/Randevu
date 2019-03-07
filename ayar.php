<?php
$veri = @mysql_connect("localhost","root","");
if (!$veri)
  {
  exit('Baglanti Saglanamadi: ' . @mysql_error());
  }

@mysql_select_db("randevu", $veri);

?>