<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM stok WHERE id_stok='$_GET[id]'");
header('location:../../media.php?module=bkeluar&acc=view');

?>