<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM arus_kas WHERE id_arus_kas='$_GET[id]'");
header('location:../../media.php?module=aruskas&acc=view');

?>