<h3 style="margin-top:-10px; color:green"><a href="index.php" style="color:green;">Anasayfa</a> &raquo; Randevularım</h3>
<?php
include 'guvenlik.php';
$rSor = mysql_query("
  SELECT * FROM (ogrenci INNER JOIN randevu ON ogrenci.ogrKim = randevu.ogrKim) 
  INNER JOIN akademisyen ON akademisyen.ogrtKim = randevu.ogrtKim WHERE randevu.ogrtKim = '".$_COOKIE['ogrtKim']."' ORDER By randevuTarih ASC");
echo '
  <table id="" width="100%" border="1">';
  while($rcek = mysql_fetch_object($rSor)) {
  
  if($_REQUEST['rOnay'] == $rcek->randevuKim) {
  mysql_query("UPDATE randevu SET randevuOnay = 1 WHERE randevuKim = '".$_REQUEST['rOnay']."'");
  header('Location: index.php?aProfil=randevum');
  }
  if($_REQUEST['rOnayKaldir'] == $rcek->randevuKim) {
  mysql_query("UPDATE randevu SET randevuOnay = 0 WHERE randevuKim = '".$_REQUEST['rOnayKaldir']."'");
  header('Location: index.php?aProfil=randevum');
  }
  if($_REQUEST['gonder']) {  		
		echo '
		<form name="form1" method="post" action="?aProfil=randevum&gonder=ileti2">
  <table id="support" width="100%" border="1">
    <tr>
      <td width="70%" align="center">
		<textarea name="bilgi" cols="30" rows="5"></textarea>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" name="aproTamam" id="aproTamam" value="Kaydet">      </td>
    </tr>
  </table>
</form>';
	if($_REQUEST['gonder'] == 'ileti2') {
		
		$bilgi = guvenlik($_POST['bilgi']);
		
  		mysql_query("UPDATE randevu SET randevuDurum = '$bilgi' WHERE randevuKim = '".$rcek->randevuKim."' AND ogrtKim = '".$_COOKIE['ogrtKim']."'");
		echo 'Başarıyla Gönderilmiştir.';
  	}
  
  
  }
  else {
  
  echo '
   <tr style="font-weight:bolder; font-size:12px;">
      <td width="15%" valign="top" align="left">
	  <big><b>'. $rcek->randevuKonu . '</b></big></td>
	  <td valign="top">'.$rcek->randevuTarih.'<br />'.$rcek->randevuSaat.'</td>
	  <td valign="top">',$rcek->ogrAd,'&nbsp;',$rcek->ogrSoyad,'</td>
	  <td valign="top">';
	  if($rcek->randevuOnay == 0) {
	  echo '
	  <a href="?aProfil=randevum&amp;rOnay=',$rcek->randevuKim,'" style="color: green;">Onayla</a>';
	  }
	  if($rcek->randevuOnay == 1) {
	  echo '
	  <a href="?aProfil=randevum&amp;rOnayKaldir=',$rcek->randevuKim,'" style="color:red;">Onaylama</a>';
	  }
	  echo '</td>
	  <td valign="top"><a href="?aProfil=randevum&amp;gonder=ileti">Mesaj</a></td>
	  </tr>';
	  	}
	  }
	  echo '    
  </table>';
 ?>