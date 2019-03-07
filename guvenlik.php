<?php
function guvenlik($isim) {
		mysql_real_escape_string($isim);
		htmlspecialchars($isim);
		return $isim;
	}
function postami($posta)
  {
    if (!@eregi ("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$", $posta))
    {
      return false;
    } else {
      return true;
    }
  }
?>