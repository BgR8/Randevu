<table width="100%" border="1">
  <tr>
    <td width="45%" align="left" valign="top">
		<?php
    		$ogrAkademi = mysql_query("SELECT * FROM akademisyen");
			while($agetir = mysql_fetch_object($ogrAkademi)) {
				if($_REQUEST['oAkademi'] == $agetir->ogrtKim) {		
				echo '<b><big><a style="text-decoration:none; color:#FFA405;" href="?oAkademi=',$agetir->ogrtKim,'">',$agetir->ogrtAd,'&nbsp;',$agetir->ogrtSoyAd,'</a></big></b><br />';
				}
				if($_REQUEST['oAkademi'] != $agetir->ogrtKim) {		
				echo '<b><big><a style="text-decoration:underline;" href="?oAkademi=',$agetir->ogrtKim,'">',$agetir->ogrtAd,'&nbsp;',$agetir->ogrtSoyAd,'</a></big></b><br />';
				}
			}
			?></td>
	<td width="55%" align="left" valign="top">
	<?php
						
									
			$sorgu = mysql_query("SELECT * FROM ogrtrandevular WHERE ogrtKim = '".$_REQUEST['oAkademi']."'");
			
			$rSorgu = mysql_query("SELECT * FROM randevu WHERE ogrtKim = '".$_REQUEST['oAkademi']."'");
			while($rcek = mysql_fetch_object($rSorgu)):
				
				if(isset($rcek->randevuOnay) and $rcek->randevuOnay == 0) {
				echo '
				<big style="color:red; font-weight:bolder;">'.$rcek->randevuKonu.' konulu ',$rcek->randevuTarih, '&nbsp;', $rcek->randevuSaat,' 
				tarihli randevunuz onay bekliyor</big><hr />';
					if(!empty($rcek->randevuDurum)) {
					echo '<big>'.$rcek->randevuDurum. '</big><hr />';
					}
				}
				elseif(isset($rcek->randevuOnay) and $rcek->randevuOnay == 1) {
				echo '<big style="color:green; font-weight:bolder;">'.$rcek->randevuKonu.' konulu ',$rcek->randevuTarih,'&nbsp;', $rcek->randevuSaat,'
				tarihli randevunuz onaylandi.</big><hr />';
				}	
			endwhile;
				
			while($getirAyrinti = mysql_fetch_object($sorgu)) {
			$oAkademi = $_REQUEST['oAkademi'];
				if($oAkademi == $getirAyrinti->ogrtKim) {
				echo '<big>'. $getirAyrinti->randevuTarih. '&nbsp;'. $getirAyrinti->randevuSaat.', '.$getirAyrinti->randevuBilgi.'</big><br /><hr />';												
				}
			}			
				include 'takvim/index.php';
			
			mysql_close($veri);
			?></td>
  </tr>
</table>
