<h3 style="margin-top:-10px; color:green"><a href="index.php" style="color:green;">Anasayfa</a> &raquo; Profil Bilgilerimi Değiştir</h3>
<?php
include 'guvenlik.php';
	$no 	 =  guvenlik($_POST['no']);
	$isim    =  guvenlik($_POST['isim']);
	$soyad   =  guvenlik($_POST['soyad']);
	$posta   =  guvenlik($_POST['posta']);
	
	if(!empty($_POST['aproTamam'])) {
	echo 'Profil Bilgileriniz Güncellenmiştir';
		
	mysql_query("UPDATE ogrenci SET ogrNo = '$no', ogrAd = '$isim', ogrSoyad = '$soyad', 
	ogrPosta = '$posta' WHERE ogrKim = '".$_COOKIE['ogrKim']."' ");
	
	}
	else {

?>
<form name="form1" method="post" action="">
  <table id="support" width="100%" border="1">
    <tr>
      <td width="23%"><big>Öğrenci No</big></td>
      <td width="77%"><input type="text" value="<?php echo $ocek['ogrNo']; ?>" name="no" /></td>
    </tr>
    <tr>
      <td width="23%"><big>Ad</big></td>
      <td width="77%"><input type="text" value="<?php echo $ocek['ogrAd']; ?>" name="isim" /></td>
    </tr>
    <tr>
      <td><big>Soyad</big></td>
      <td>
        <input type="text" name="soyad" value="<?php echo $ocek['ogrSoyad']; ?>" id="soyad">
      </td>
    </tr>
    <tr>
      <td><big>Posta</big></td>
      <td>
        <input type="text" name="posta" value="<?php echo $ocek['ogrPosta']; ?>" id="posta">
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
