<?php
error_reporting(0);
session_start();	
include "../config/koneksi.php";


if ($_SESSION[namauser] )
{
 header('location:media.php?module=home'); 
}
 if ($_SESSION[level] == null )
{
header ('location:login.php');
}
?>
