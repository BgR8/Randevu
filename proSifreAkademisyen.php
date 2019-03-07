<h3 style="margin-top:-10px; color:green"><a href="index.php" style="color:green;">Anasayfa</a> &raquo; Profil Bilgilerimi Değiştir</h3>
<?php
include 'guvenlik.php';
	$sifre 	 =  guvenlik($_POST['sifre']);
	$sifre = md5($sifre);
	
	if(!empty($_POST['aproTamam'])) {
	echo 'Şifreniz Güncellenmiştir';
		
	mysql_query("UPDATE akademisyen SET ogrtSifre = '$sifre' WHERE ogrtKim = '".$_COOKIE['ogrtKim']."' ");
	
	}
	else {

?>
<form name="form1" method="post" action="">
  <table id="support" width="100%" border="1">
    <tr>
      <td width="23%"><big>Şifre</big></td>
      <td width="77%"><input type="password" value="" name="sifre" /></td>
    </tr>

    <tr>
      <td colspan="2">
        <input type="submit" name="aproTamam" id="aproTamam" value="Kaydet">      </td>
    </tr>
  </table>
</form>
<?php
}
?>
