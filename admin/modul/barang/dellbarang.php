<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM barang WHERE id_barang='$_GET[id]'");
header('location:../../media.php?module=barang&acc=view');

?>