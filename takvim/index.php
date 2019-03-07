<?php
if($_REQUEST['oAkademi']) {

	if(!empty($_POST['randevuTamam'])) {

	$konu   = $_POST['konu'];
	$takvim = $_POST['takvim'];
	$saat 	= $_POST['saat'];
	$ogrt 	= $_REQUEST['oAkademi'];
	$ogrKim = $_COOKIE['ogrKim'];
	
	if(empty($konu)) {
	echo $mtn['rkonu'];
	}
	elseif(empty($takvim)) {
	echo $mtn['rtarih'];
	}
	elseif(empty($saat)) {
	echo $mtn['rsaat'];
	}
	else {
	
	echo '<big><b>',$mtn['ronay'],'</b></big>';
	
	mysql_query("INSERT INTO randevu VALUES('', '$konu', '$takvim', '$saat', '0', '$ogrt', '$ogrKim', '')");
	
				$rSor = mysql_query("SELECT * FROM randevu WHERE ogrtKim = '".$_REQUEST['oAkademi']."'");
				$rcek = mysql_fetch_object($rSor);
				
				$randevuPosta='<big>Sayin, '.$getirAyrinti->ogrtAd.'</big><br />
				 ======================================================================
				<br /><big>'.$ocek['ogrAd'].', <u>'.$rcek->randevuKonu.'</u> konulu randevu talebinde bulunmuþtur</big><br />
				 ======================================================================';
				
				$alici=$getirAyrinti->ogrtPosta;
				$konu='AtölyemDe - Sayin '.$getirAyrinti->ogrtAd.' \n';
				$postabilgi = "Mime-Version: 1.0\nContent-Type: text/html; charset=ISO-8859-9\nContent-Transfer-Encoding: 7bit \n";
				$postabilgi.="From: AtölyemDe <bilgi@atolyemde.com> \n Reply-To: <bilgi@atolyemde.com>\n";
				$gitti=@mail($alici, $konu, $yorumposta, $postabilgi);
				
	
	
	}
}
else {
?>

  <form name="form1" method="post" action="">
    <table width="100%" align="left" style="text-align:left;">
      <tr>
      <td><b><big>Konu</big></b></td>
      <td><input name="konu" type="text" id="konu" size="20" /></td>
      </tr>
      <tr>
        <td width="121" height="47">&nbsp;</td>
        <td width="1184">
        <input type="date" name="takvim" />
        <input type="time" name="saat" /></td>        
      </tr>
      <tr>
        <td colspan="2"><label>
          <input type="submit" name="randevuTamam" id="randevuTamam" value="Kaydet">
        </label></td>
      </tr>
    </table>
  </form>
<?php
	}
}
?>