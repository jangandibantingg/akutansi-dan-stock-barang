<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM jenis WHERE id_jenis='$_GET[id]'");
header('location:../../media.php?module=jenis&acc=view');

?>