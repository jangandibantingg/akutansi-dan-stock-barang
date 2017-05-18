            <?php 


  error_reporting(0);
  session_start();	
  include "../../config/koneksi.php";
  

if ( $_SESSION[level] == 'superadmin' )
{
  include "../../config/fungsi_indotgl.php";
  include "../../config/library.php";
  include "../../config/fungsi_seo.php";
  include "../../config/fungsi_rupiah.php";
  include "../../config/no_acak.php";
  include "../../config/fungsi_thumb.php";
  include "totpaymen.php";
  $date=date('Y-m-d');									
  $datei=tgl_indo($date);

  ?>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	

</head>
<body><center><h1><img src="LOGO1.jpg" alt="" width="23"/>PT CAHAYA INSAN SEJATI</h1>
laporan stok umum per tanggal <?php echo $datei ?> </center>
<hr>
			 
			<?php
           	
			$jenis=mysql_query("select * from jenis   "); 
			       while ($r=mysql_fetch_array($jenis)) {    ?>
				<div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header">
						<p><b style="color:red; text-align: right;"><?php echo "$r[nama_jenis]";?></b></p>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table  border="1">
							    <thead>
							  <tr>
								  
								  <th style="color:#00BFFF;">nama barang</th>
								  <th style="color:#00BFFF;">unit</th>
								  <th style="text-align: right; color:#00BFFF;">masuk</th>
								  <th style="text-align: right; color:#00BFFF;">harga beli</th>
							      <th style="text-align: right; color:#00BFFF;">nilai beli</th>
							      <th style="text-align: right; color:#00BFFF;">keluar</th>
							      <th style="text-align: right; color:#00BFFF;">harga jual</th>
							      <th style="text-align: right; color:#00BFFF;">nilai jual</th>
							      <th style="text-align: right; color:#00BFFF;">stok akhir</th>
							    
								  
								  
							      
							  </tr>
						  </thead>      
							  <tbody>
							   <?php
						  $d=mysql_query("SELECT * FROM barang where id_jenis='$r[id_jenis]' ");
						  while ($f=mysql_fetch_array($d))
						  {
						  $tanggal=tgl_indo($r[tanggal]);
						  $rp_beli=number_format($f[harga_beli]);
						  $rp_jual=number_format($f[harga_jual]);
						  $carimasuk=mysql_fetch_array(mysql_query("select sum(stok) as stok from stok where status='buy' and id_barang='$f[id_barang]' "));
						  $stokmasuk=$carimasuk[stok];
						  $nilai_beli=$carimasuk[stok] * $f[harga_beli];
						  $rp_nilaibeli=number_format ($nilai_beli);
						  $carikeluar=mysql_fetch_array(mysql_query("select sum(stok) as stok from stok where status='sell' and id_barang='$f[id_barang]' "));
						  $stokkeluar=$carikeluar[stok];
						  $nilai_jual=$carikeluar[stok] * $f[harga_jual];
						  $rp_nilaijual=number_format ($nilai_jual);
						  $stok_akhir=$carimasuk[stok] - $carikeluar[stok] ;
						  ?>
							<tr>
							
								<td><?php echo "$f[nama_barang]";?></td>
								<?php $p=mysql_fetch_array(mysql_query("select * from member where id_cis='$r[id_cis]' ")); ?>
								<td class="center"><?php echo "$f[satuan]";?></td>
								<td class="center" style="text-align: right;"><?php echo "$stokmasuk";?></td>
								<td class="center" style="text-align: right;"><?php echo "$rp_beli";?></td>
								<td class="center" style="text-align: right;"><?php echo "$rp_nilaibeli";?></td>
								<td class="center" style="text-align: right;"><?php echo "$stokkeluar";?></td>
								<td class="center" style="text-align: right;"><?php echo "$rp_jual";?></td>	
								<td class="center" style="text-align: right;"><?php echo "$rp_nilaijual";?></td>
								<td class="center" style="text-align: right;"><?php echo "$stok_akhir";?></td>
							</tr>
							<?php
							
							}
							
							?>                                
							  </tbody>
						 </table>  
						
					</div>
				</div><!--/span-->
			</div>
			<?php
			}
			
			?>
</center></body>
</html>
<?php

}
else 
{

?>

			<style type="text/css">
			body { background: url(img/bg-login.jpg) !important; }
		</style>
		<?php
  echo "<link href='css/screen.css' rel='stylesheet' type='text/css'><link href='css/reset.css' rel='stylesheet' type='text/css'>


 <center><br><br><br><br><br><br>Maaf, untuk masuk <b>Halaman Administrator</b><br>
  <center>anda harus <b>Login</b> dahulu!<br><br>";
 echo "<div> <a href='index.php'><img src='img/loading.gif'  height=176 width=143></a>
             </div>";
  echo "<input type=button class=simplebtn value='LOGIN DI SINI' onclick=location.href='index.php'></a></center>";
}

?>