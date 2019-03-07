<h3 style="margin-top:-10px; color:green"><a href="index.php" style="color:green;">Anasayfa</a> &raquo; Randevu Tercih Günlerinizi Belirleyin</h3>
<?php
include 'guvenlik.php';

	$takvim = guvenlik($_POST['takvim']);
	$saat   = guvenlik($_POST['saat']);
	$bilgi	= guvenlik($_POST['bilgi']);
	
	if(!empty($_POST['aproTamam'])) {
	echo 'Tarih Belirlenmiştir';

	mysql_query("INSERT INTO ogrtrandevular VALUES ('', '$_COOKIE[ogrtKim]', '$acek[ogrtAd]', '$acek[ogrtPosta]', '$takvim', '$saat', '$bilgi')");
	
	}
	else {
	$ogrtr = mysql_query("SELECT * FROM ogrtrandevular WHERE ogrtKim = '".$_COOKIE['ogrtKim']."'");
	
?>
<?php
	if($_REQUEST['ekle']) {
	echo '
<form name="form1" method="post" action="">
  <table id="support" width="100%" border="1">
    <tr>
      <td width="70%">
        <input type="date" name="takvim" />
        <input type="time" name="saat"/><br /><br />
		<textarea name="bilgi" cols="30" rows="5"></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" name="aproTamam" id="aproTamam" value="Kaydet">      </td>
    </tr>
  </table>
</form>';
	
	
	}
	else {

?>
<a href="?aProfil=musaitZaman&amp;ekle=yeniRandevu"><b><big>Yeni Randevu Ekle</big></b></a><br /><br />

  <table id="support" width="100%" border="1">
    <?php
	  while($rgetir = mysql_fetch_object($ogrtr)) {
	  echo '
    <tr>
      <td width="70%" align="left">      
        <input type="date" name="takvim" value="',$rgetir->randevuTarih,'" />
        <input type="time" name="saat" value="',$rgetir->randevuSaat,'" />
		</td>
    </tr>';
		}
		?>  
  </table>
<?php
	}
}
?>
