<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM gudang WHERE id_gudang='$_GET[id]'");
header('location:../../media.php?module=gudang&acc=view');

?>