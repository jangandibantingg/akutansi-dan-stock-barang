<?php
include "../../../config/koneksi.php";
  mysql_query("DELETE FROM produk WHERE id_produk='$_GET[id]'");
  header('location:../../media.php?module=produk&acc=view');
?>