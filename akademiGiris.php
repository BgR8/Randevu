<?php error_reporting(E_ALL & ~E_NOTICE);  ?>
<?php
include 'ayar.php';
include 'guvenlik.php';
echo '<div>
<h1 style="margin-left: 5px;">Giriş Yap</h1>';
		$simge=guvenlik($_POST['akul']);
		$sifre=guvenlik($_POST['asifre']);
		
		$simge = htmlspecialchars($simge);
		$sifre = htmlspecialchars($sifre);
				
		$sorgu = @mysql_query("SELECT * FROM akademisyen WHERE ogrtSicil='".$simge."' AND ogrtSifre ='".md5($sifre)."'");
		$satir = @mysql_fetch_array($sorgu);
		
  if(empty($simge) or empty($sifre)) {
	echo '
  <p align="center"><img border="0" src="resim/kapali.png"></p>
  <p align="center">
  <b><font size="1" face="Tahoma" color="#FF0000"><big>Tüm alanları girmeniz gerekmektedir!</big></font></b>
  </p>
  <p align="center"><font size="1" face="Tahoma">
  <a href="javascript:history.back()"><big><b>Geri Dön</b></big></a>
  </font></p>';
   }
   elseif (@mysql_num_rows($sorgu) < 1) {
 
  		echo '
		<p align="center">
		<img border="0" src="resim/kapali.png"></p>
		<p align="center">
		<b><font size="1" face="Tahoma" color="#FF0000"><big>Kullanıcı Adınız yada Şifreniz yanlış.</big></font></b>
		</p>
		<p align="center"><font size="1" face="Tahoma">
		<a href="javascript:history.back()"><big><b>Geri Dön</b></big></a>
		</font></p>';
		}		
		
   elseif (@mysql_num_rows($sorgu) == 1) {
						$zaman = time()+60*3153600;
						@mysql_real_escape_string($oturum =  md5(uniqid (rand())));
												
						setcookie("ogrtOturum", $oturum, $zaman);
						setcookie("ogrtKim", $satir['ogrtKim'], $zaman);
												
						mysql_query("UPDATE akademisyen SET ogrtOturum = '$oturum'
						WHERE ogrtKim = '".$satir['ogrtKim']."'");
						
							@header("Location: index.php");
							
						}
						echo '</div>';
	echo '</div>';
?>