<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM suplier WHERE id_suplier='$_GET[id]'");
header('location:../../media.php?module=suplier&acc=view');

?>