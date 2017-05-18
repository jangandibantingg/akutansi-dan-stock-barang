<?php
include "../../../config/koneksi.php";

mysql_query("DELETE FROM submaster WHERE id_submaster='$_GET[id]'");
header('location:../../media.php?module=master&acc=view');

?>