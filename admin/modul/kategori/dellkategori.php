<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM kategori WHERE id_kategori='$_GET[id]'");
header('location:../../media.php?module=kategori&acc=view');

?>