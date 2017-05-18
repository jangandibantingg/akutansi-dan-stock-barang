<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM income WHERE id_income='$_GET[id]'");
header('location:../../media.php?module=neraca&acc=view');

?>