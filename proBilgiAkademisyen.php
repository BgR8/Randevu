<h3 style="margin-top:-10px; color:green"><a href="index.php" style="color:green;">Anasayfa</a> &raquo; Profil Bilgilerimi Değiştir</h3>
<?php
include 'guvenlik.php';
	$sicil 	 =  guvenlik($_POST['sicil']);
	$isim    =  guvenlik($_POST['isim']);
	$soyad   =  guvenlik($_POST['soyad']);
	$bolum   =  guvenlik($_POST['bolum']);
	$fakulte =  guvenlik($_POST['fakulte']);
	$tel     =  guvenlik($_POST['tel']);
	$posta   =  guvenlik($_POST['posta']);
	
	if(!empty($_POST['aproTamam'])) {
	echo 'Profil Bilgileriniz Güncellenmiştir';
		
	mysql_query("UPDATE akademisyen SET ogrtSicil = '$sicil', ogrtAd = '$isim', ogrtSoyAd = '$soyad', 
	ogrtBolum = '$bolum', ogrtFakulte = '$fakulte', ogrtTel = '$tel', ogrtPosta = '$posta' WHERE ogrtKim = '".$_COOKIE['ogrtKim']."' ");
	
	}
	else {

?>
<form name="form1" method="post" action="">
  <table id="support" width="100%" border="1">
    <tr>
      <td width="23%"><big>Sicil</big></td>
      <td width="77%"><input type="text" value="<?php echo $acek['ogrtSicil']; ?>" name="sicil" /></td>
    </tr>
    <tr>
      <td width="23%"><big>Ad</big></td>
      <td width="77%"><input type="text" value="<?php echo $acek['ogrtAd']; ?>" name="isim" /></td>
    </tr>
    <tr>
      <td><big>Soyad</big></td>
      <td>
        <input type="text" name="soyad" value="<?php echo $acek['ogrtSoyAd']; ?>" id="soyad">
      </td>
    </tr>
    <tr>
      <td><big>Bölüm</big></td>
      <td>
        <input type="text" name="bolum" value="<?php echo $acek['ogrtBolum']; ?>" id="bolum">
      </td>
    </tr>
    <tr>
      <td><big>Fakülte</big></td>
      <td>
        <input type="text" name="fakulte" value="<?php echo $acek['ogrtFakulte']; ?>" id="fakulte">
      </td>
    </tr>
    <tr>
      <td><big>Telefon</big></td>
      <td>
        <input type="text" name="tel" value="<?php echo $acek['ogrtTel']; ?>" id="tel">
     </td>
    </tr>
    <tr>
      <td><big>e-Posta</big></td>
      <td>
        <input type="text" name="posta" value="<?php echo $acek['ogrtPosta']; ?>" id="posta">
     </td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" name="aproTamam" id="aproTamam" value="Kaydet">
      </td>
    </tr>
  </table>
</form>
<?php
}
?>
