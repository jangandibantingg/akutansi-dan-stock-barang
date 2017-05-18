<?php
  include "../config/koneksi.php";

 

function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = $_POST['username'];
$pass     = $_POST['password'];

// pastikan username dan password adalah berupa huruf atau angka.

$login=mysql_query("SELECT * FROM users WHERE username='$username' AND password='$pass' ");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);


//=============================================================================================================================

//===============================================================================================================================  
// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
   $_SESSION['KCFINDER']=array();

  $_SESSION['KCFINDER']['disabled'] = false;

  $_SESSION['KCFINDER']['uploadURL'] = "../tinymcpuk/gambar";

  $_SESSION['KCFINDER']['uploadDir'] = "";

 
  $_SESSION[namauser]     = $r[username];
  $_SESSION[namalengkap]  = $r[nama_lengkap];
  $_SESSION[passuser]     = $r[password];
  $_SESSION[level]        = $r[leveladmin];
  $_SESSION[pin_jar]      = $r[pin_jar];
  $_SESSION[menu1]        = $r[menu1];
  $_SESSION[menu2]        = $r[menu2];
  $_SESSION[menu3]        = $r[menu3];
  $_SESSION[menu4]        = $r[menu4];
  $_SESSION[menu5]        = $r[menu5];
  $_SESSION[menu6]        = $r[menu6];
  $_SESSION[menu7]        = $r[menu7];


  
  header('location:media.php?module=home ');
}
else{
  echo "<script>alert('username/password yang anda masukkan salah'); window.location ='login.php'</script>";
}


?>

  			