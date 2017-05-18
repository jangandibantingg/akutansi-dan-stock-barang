<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM stoklist WHERE id_stoklist='$_GET[id]'");
header('location:../../media.php?module=stoklist&acc=view');

?>