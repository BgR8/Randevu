<?php
error_reporting(E_STRICT);
ob_start();
session_start();
include 'ayar.php';
$mtn['ronay'] = 'Randevunuz Başarıyla Gönderilmiştir';
$mtn['rkonu'] = '<big>Lütfen Randevunuzun Konusunu Belirleyiniz.</big>';
$mtn['rtarih'] = '<big>Lütfen Randevunuzun Tarihini Belirleyiniz.</big>';
$mtn['rsaat'] = '<big>Lütfen Randevunuzun Saatini Belirleyiniz.</big>';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

	<title>Architecture</title>
	<link rel="stylesheet" href="style.css" type="text/css"/>
    	
</head>

<body>
<?php
$asor = mysql_query("SELECT * FROM akademisyen WHERE ogrtKim = '".$_COOKIE['ogrtKim']."'");
$acek = mysql_fetch_array($asor);

$osor = mysql_query("SELECT * FROM ogrenci WHERE ogrKim = '".$_COOKIE['ogrKim']."'");
$ocek = mysql_fetch_array($osor);

?>
  <div id="wrapper">
    <div id="header"></div>
    <div id="left">
      <div id="logo">
        <h2><br /> <br />
        </h2>
        <h3>       Öğrenci Randevu Sistemi</h3>
        <p>Hızlı Erişim</p>
      </div>
      <div id="nav">
        <ul>
          <li class="important"><a href="index.php">Anasayfa</a></li>
          <li><a href="http://www.aksaray.edu.tr" target="blank">Aksaray Üniversitesi</a> </li>
          <li><a href="http://obs.aksaray.edu.tr/" target="blank">Öğrenci Bilgi Sistemi</a></li>
          <li><a href="hakkimizda.html" target="blank">Hakkımızda</a></li>
          <li><a href="proje.html" target="blank">Adım Adım Proje</a></li>

        </ul>
      </div>
      <div id="news">

        <div class="hr-dots"> </div>
        <h3>Hocalarla görüşmek artık daha kolay. Bir tık yeterli</h3>
      </div>
      <div id="support">

      </div>
    </div>
    <div id="right">
      <h2>HOŞGELDİNİZ! <?=($_COOKIE['ogrtOturum']) ? $acek['ogrtAd'].'&nbsp;'.$acek['ogrtSoyAd'] : (($_COOKIE['ogrOturum']) ? $ocek['ogrAd'].'&nbsp;'.$ocek['ogrSoyad']: '');?>
      
      <div style="float:right; margin-right:20px;"> <?php
	  if(isset($_COOKIE['ogrtOturum'])) {
	  echo '
      <a href="cikisOgrt.php">Çıkış</a>';
	  }
	  elseif(isset($_COOKIE['ogrOturum'])) {
	  echo '<a href="cikisOgr.php">Çıkış</a>';
	  }
	  ?></div></h2>
      <div id="welcome">
      <?php
	  	if(empty($_COOKIE['ogrtOturum']) and empty($_COOKIE['ogrOturum'])) {	  
	  ?>
        <table width="468" height="131" border="2">
          <tr>
            <td width="240">AKADEMİSYEN GİRİŞİ</td>
            <td width="212">ÖĞRENCİ GİRİŞİ</td>
          </tr>
          <tr>
            <td><form id="akademigiris" name="akademigiris" method="post" action="akademiGiris.php">
              <p>
                <label>
                KULLANICI ADI:
                <input name="akul" type="text" id="akul" size="15" /></label>
              </p>
              <p>
                <label>ŞİFRE: 
                <input name="asifre" type="password" id="asifre" size="12" /></label>
              </p>
              <p>
                <input type="submit" name="agiris" id="agiris" value="Giriş" />
              </p>
            </form></td>
            <td><form id="ogiris" method="post" action="ogrenciGiris.php">
              <p> <label>KULLANICI ADI:                
              <input name="oadi" type="text" id="oadi" size="12" />
              </label>
              <p>
                <label>ŞİFRE:
                <input name="osifre" type="password" id="osifre" size="12" /></label>
              </p>
              <p>
                <input type="submit" name="ogiris" id="ogiris" value="Giriş" />
              </p>
            </form></td>
          </tr>
        </table>
        <p>Akademisyenler kullanıcı adı olarak Sicil Numaralarını, Öğrenciler ise Okul Numaralarını girmeliler.</p>
       <?php
	   }
	   else {
		   	if($_COOKIE['ogrKim']) {
			   $oProfil = $_REQUEST['oProfil'];
			   switch($oProfil) {
			   case 'proBilgi':
			   include 'proBilgiOgrenci.php';
			   echo '<br />
					<a href="index.php"><b><big>Geri Dön</big></b></a>';
			   break;
			   case 'proSifre':
			   include 'proSifreOgrenci.php';
			   echo '<br />
					<a href="index.php"><b><big>Geri Dön</big></b></a>';
			   break;
			   default:
			 	echo '<b><a href="?oProfil=proBilgi">Profil Bilgilerimi Değiştir</a></b><br /><br />
			   		 <b><a href="?oProfil=proSifre">Şifre</a></b><br /><br />
					 <big><b>Akademisyenler</b></big>';
				include 'ogrAkademiSec.php';
				break;
			 	}
	   }
	   
		   if($_COOKIE['ogrtKim']) {
		   	   $aProfil = $_REQUEST['aProfil'];
			   
			   		 $rSQL = "SELECT * FROM randevu WHERE randevuOnay = 0 AND ogrtKim = '".$_COOKIE['ogrtKim']."'";
					 $rSorgu = mysql_query($rSQL);			   
			   
			   switch($aProfil) {
			   case 'musaitZaman':
			   include 'proMusaitAkademisyen.php';
			   echo '<br /><br />
					<a href="javascript:history.back();"><b><big>Geri Dön</big></b></a>';
			   break;
			   case 'randevum':
			   include 'randevum.php';
			   echo '<br /><br />
					<a href="javascript:history.back();"><b><big>Geri Dön</big></b></a>';
			   break;
			   case 'proBilgi':
			   include 'proBilgiAkademisyen.php';
			   echo '<br /><br />
					<a href="javascript:history.back();"><b><big>Geri Dön</big></b></a>';
			   break;
			   case 'proSifre':
			   include 'proSifreAkademisyen.php';
			   echo '<br /><br />
					<a href="javascript:history.back();"><b><big>Geri Dön</big></b></a>';
			   break;
			   default:
			   echo '<b><a href="?aProfil=musaitZaman">Müsait Zamanlarınızı Belirleyiniz</a><br /><br />
			   		 <b><a href="?aProfil=randevum">Randevularım</a> ';
					 
					 $rSayi = mysql_num_rows($rSorgu);
					 if($rSayi>0) {
					 echo '<font color="red">(' , $rSayi , ')</font>';
					 }
					 
					 echo '<br /><br />
			   		 <a href="?aProfil=proBilgi">Profil Bilgilerimi Değiştir</a><br /><br />
			   		 <a href="?aProfil=proSifre">Şifre</a></b>';
			   break;
			   }
		   }
	   }
	   mysql_close($veri);
	   ?>
      </div>
      <h3>TANITICI PROFİL</h3>
      <div id="profile">
        <div id="corp">
          <div id="corp-img">YBS 2 A</div>
          <p><u>Proje Sahipleri</u>          </p>
          <p></p>
         
        </div>
        <div id="indu">
          <div id="indu-img">
            YBS ÖĞRENCİLERİ
          </div>
          <p>Bu Randevu Sistemi Aksaray Üniversitesi Yönetim Bilişim Sistemleri Öğrencileri için yapılmıştır.</p>
        </div>
        <div class="clear"> </div>
        <p class="more"></p>
      </div>
    </div>
    <div class="clear"> </div>
    <div id="spacer"> </div>
    <div id="footer">
      <div id="copyright">
        Copyright &copy; 2015 HER HAKKI SAKLIDIR</div>
	  <div id="footerline"></div>
    </div>
	
  </div>
</body>
</html>
