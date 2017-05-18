
	<style type="text/css">
			body { background: url(../../img/bg-login.jpg) !important; }
		</style>
<?php
    ini_set( "display_errors", 0);
   include "../../../config/koneksi.php";
   include "../../../config/fungsi_indotgl.php";
   include "../../../config/library.php";
   include "../../../config/fungsi_seo.php";
   include "../../../config/fungsi_rupiah.php";
   include "../../../config/no_acak.php";
   include "../../../config/fungsi_thumb.php";
?>
<table class="table " border="1">
						  <thead>
							  <tr>
								  <th>nama gudang </th>
								  <th>alamat </th>
								  <th>nama_barang</th>
								  <th>satuan</th>
								  <th>stok</th>
								
								  
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $d=mysql_query("select * from gudang ");
						  while ($r=mysql_fetch_array($d))
						  {
						  $tanggal_masuk=tgl_indo($r[tanggal]);
						  $nilai=$r[harga] * $r[stok];
						  $nilai_rp=number_format($nilai);
						  $harga_rp=number_format($r[harga]);
					      $carimasuk=mysql_fetch_array(mysql_query("select sum(stok) as stok from stok where status='buy' and id_barang='$_GET[idm]' and id_gudang='$r[id_gudang]' "));
						  $stokmasuk=$carimasuk[stok];
						  $nilai_beli=$carimasuk[stok] * $f[harga_beli];
						  $rp_nilaibeli=number_format ($nilai_beli);
						  $carikeluar=mysql_fetch_array(mysql_query("select sum(stok) as stok from stok where status='sell' and id_barang='$_GET[idm]' and id_gudang='$r[id_gudang]' "));
						  $stokkeluar=$carikeluar[stok];
						  $nilai_jual=$carikeluar[stok] * $f[harga_jual];
						  $rp_nilaijual=number_format($nilai_jual);
						  $stok_akhir=$carimasuk[stok] - $carikeluar[stok] ;
						  ?>
							<tr>
								<td class="center"><?php echo "$r[nama_gudang]";?></td>
								
								<?php $h=mysql_fetch_array(mysql_query("select * from barang where id_barang='$_GET[idm]' ")); ?>
							
								<td class="center"><?php echo "$r[alamat]";?></td>
								<td class="center"><?php echo "$h[nama_barang]";?></td>
								<td class="center"><?php echo "$h[satuan]";?></td>
								<td class="center"><?php echo " $stok_akhir ";?></td>	<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" >
								<input type="hidden" name="gudang" value="<?php echo "$r[id_gudang]";?>">
								<input type="hidden" name="stok" value="<?php echo "$stok_akhir";?>">
								
								
							</tr>
							
							<?php
							$sumnilai=$sumnilai + $nilai;
							$rp_sumnilai=number_format($sumnilai);
							}
							
							
							
							?>
						  </tbody>
						  </table>

