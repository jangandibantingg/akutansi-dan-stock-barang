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
	

</head>
<body><center><h1><img src="LOGO1.jpg" alt="" width="23"/>PT CAHAYA INSAN SEJATI</h1>
laporan income statment / laba rugi <?php echo $datei ?> </center>
<hr><center><center>
			 <?php
$date=date('Y-m-d');
$iki=explode("-",$date);
if ($_POST[submit] && $_POST[tanggal] && $_POST[master] != '-- pilih nama akun--' && $_POST[nama_keterangan]  )
{
$tanggal=$_POST[tanggal];
$pecah=explode("/",$tanggal);
$fixtanggal=$pecah[2]-$pecah[0]-$pecah[1];
mysql_query("insert into income (id_submaster,jumlah,nama_keterangan,tanggal,debit,kredit,status) value ('$_POST[master]','$_POST[jumlah]','$_POST[nama_keterangan]','".$pecah[2]."-".$pecah[0]."-".$pecah[1]."','$_POST[debit]','$_POST[kredit]','laba/rugi')");
}

$kre=mysql_fetch_array(mysql_query("select sum(kredit) as rp from income where status='laba/rugi' and month(tanggal)='".$iki[1]."' and year(tanggal)='".$iki[0]."'"));
$deb=mysql_fetch_array(mysql_query("select sum(debit) as rp from income where status='laba/rugi' and month(tanggal)='".$iki[1]."' and year(tanggal)='".$iki[0]."'"));
$rp_kre=number_format($kre[rp]);
$rp_deb=number_format($deb[rp]);
$bal=$deb[rp] - $kre[rp] ;
$rp_bal=number_format($bal);
?>
			<div class="row-fluid sortable">	
				<div class="box span12">
					
					<div class="box-content">
						<table border="0" style="width: 800px; ">
							    <thead>
							  <tr>
								  <th> </th>
								 
								  <th style="text-align: right;">debit</th>
								  <th style="text-align: right;">kredit</th>
								
							     
							  </tr>
						  </thead>      
							  <tbody>
							   <?php
						  $d=mysql_query("select * from master where status='laba/rugi' order by id_master asc");
						  while ($r=mysql_fetch_array($d))
						  {
						  $tanggal=tgl_indo($r[tanggal]);
						  $rp=number_format($r[rp]);
						  ?>
							<tr>
								<td><?php echo "<b style=color:#1E90FF;>$r[id_master] $r[nama_master]</b>";?></td>
							
								<?php $f=mysql_query("select * from master,submaster where master.id_master=submaster.id_master and submaster.id_master='$r[id_master]' "); 
								while ($t=mysql_fetch_array($f)){?>
								
								<tr><td class="center" ><?php echo "<p style=padding-left:2em ><b style=color:#00BFFF;>$r[id_master].$t[id_submaster] $t[nama_submaster]</b>";?></td>
								
								<?php $b=mysql_query("select * from submaster,income where income.id_submaster=submaster.id_submaster and submaster.id_submaster='$t[id_submaster]' order by income.id_income asc "); 
								while ($o=mysql_fetch_array($b)){
								$debit=number_format($o[debit]);
								$kredit=number_format($o[kredit]);
								$belah=explode("-",$o[tanggal]);
								?>
								<tr><td class="center" ><?php echo "<p style=padding-left:4em >$r[id_master].$t[id_submaster].$o[id_income].".$belah[1].".".$belah[0]." $o[nama_keterangan]";?></td>
								<td class="center" style="text-align: right;"><?php echo "$debit";?></td>
								<td class="center" style="text-align: right;"><?php echo "$kredit";?></td>
								<td></td>
								</tr>
								<?php } ?>
								
								
								
								</tr>
							</tr>
							<?php
							
							}
							}
							
							?>  
                             <tr><td style="text-align: right;"><b>&sum; debit kredit<b> </td><td style="text-align: right;"><b style="color:green;"><?php echo "$rp_deb"; ?></b></td style="text-align: right;"><td style="text-align: right;"><b style="color:red;"><?php echo "$rp_kre"; ?></b></td></tr>	
					         <tr><td style="text-align: right;"><b>laba/rugi bersih<b> </td><td style="text-align: right;"><b style="color:green;"><?php echo "$rp_bal"; ?></b></td style="text-align: right;"></tr>								 
							  </tbody>
						 </table>  
						
					</div>
				</div><!--/span-->
			</div>
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