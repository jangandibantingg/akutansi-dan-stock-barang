           <a href="print/stokumum.php" class="#"><i class="halflings-icon print"></i> cetak data stok barang umum</a>
			 
			<?php
           	
			$jenis=mysql_query("select * from jenis   "); 
			       while ($r=mysql_fetch_array($jenis)) {    ?>
				<div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span><?php echo "$r[nama_jenis]";?></h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							    <thead>
							  <tr>
								  
								  <th >nama_barang</th>
								  <th>unit</th>
								  <th style="text-align: right;">masuk</th>
								  <th style="text-align: right;">harga beli</th>
							      <th style="text-align: right;">nilai beli</th>
							      <th style="text-align: right;">keluar</th>
							      <th style="text-align: right;">harga jual</th>
							      <th style="text-align: right;">nilai jual</th>
							      <th style="text-align: right;">stok akhir</th>
							    
								  
								  
							      
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
