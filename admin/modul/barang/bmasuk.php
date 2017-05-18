
<?php

$date=date('Y-m-d');
$iki=explode("-",$date);
                   
				    if ($_GET[module]=='bmasuk' && $_GET[acc] == 'view')
					{
					if ($_POST[submit]){
					$tanggal=$_POST[tanggal];
					$pecah=explode("/",$tanggal);
					$caribarang=mysql_fetch_array(mysql_query("select * from barang where id_barang='$_POST[barang]'"));
					$harga=$caribarang[harga_beli];
					$satuan=$caribarang[satuan];
					$jenis=$caribarang[jenis];
					mysql_query("INSERT INTO stok(id_gudang,id_suplier,stok,satuan,id_barang,tanggal,harga,status) VALUES('$_POST[gudang]','$_POST[suplier]','$_POST[jumlah]','$satuan','$_POST[barang]','".$pecah[2]."-".$pecah[0]."-".$pecah[1]."','$harga','buy')");
					
					}
					if ($_POST[posting]){
					$bmasuk_seo = seo_title($_POST['nama_bmasuk']);
					$tanggal=$_POST[tanggal];
					$pecah=explode("/",$tanggal);
					mysql_query("update stok set posting='Y' where status='buy'");
					 mysql_query("INSERT income (id_submaster,nama_keterangan,tanggal,kredit,status) values ('10','barang masuk gudang ".$iki[2]."-".$iki[1]."-".$iki[0]." ','$date','$_POST[sumnilai]','laba/rugi') ");
                   }
					?>
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>kelola barang masuk ke gudang</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" >
						  <fieldset>
						  <div class="control-group">
							  <label class="control-label" for="date01">Date input</label>
							  <div class="controls">
								<input type="text" name="tanggal" class=" datepicker" id="date01" value="<?php echo "".$iki[1]."/".$iki[2]."/".$iki[0]."";?>">
							  </div>
						  </div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama barang </label>
							  <div class="controls">
								 <select name="barang" id="barang"  >
								    <option>-- pilih nama barang --</value>
								    <?php $k=mysql_query("select * from jenis,barang where barang.id_jenis=jenis.id_jenis order by barang.nama_barang asc ") ;
									while ($v=mysql_fetch_array($k))
									{
									echo "<option value=$v[id_barang]><b>$v[id_jenis].$v[id_barang]  $v[nama_barang]</b></option>";
									}
									
									?>
									
								
								</select>
								
							  </div>
							</div>
							
							 <div class="control-group">
							  <label class="control-label" for="typeahead">dari suplier</label>
							  <div class="controls">
								 <select name="suplier"  >
								    <option>-- pilih suplier --</value>
								    <?php $k=mysql_query("select * from suplier order by nama_suplier asc ") ;
									while ($v=mysql_fetch_array($k))
									{
									echo "<option value=$v[id_suplier]><b>  $v[nama_suplier]</b></option>";
									}
									?>
									
								
								</select>
								
							  </div>
							</div>
							 <div class="control-group">
							  <label class="control-label" for="typeahead">ke gudang</label>
							  <div class="controls">
								 <select name="gudang"  >
								    <option>-- pilih gudang --</value>
								    <?php $k=mysql_query("select * from gudang order by nama_gudang asc ") ;
									while ($v=mysql_fetch_array($k))
									{
									echo "<option value=$v[id_gudang]><b>  $v[nama_gudang]</b></option>";
									}
									?>
									
								
								</select>
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">jumlah </label>
							  <div class="controls">
							 <input type="text" name="jumlah"  >
							 </div>
							</div>
							<div class="form-actions">
							  <input type="submit" name="submit"class="btn btn-primary" value=" Simpan " >
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
				</div>
				<?php
				
				
				}
				
				if ($_GET[module]=='bmasuk' && $_GET[acc] == 'view' )
				{

				?>
				<div class="row-fluid sortable">

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>data barang masuk</h2>
						<div class="box-icon">
						 
						  <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table ">
						  <thead>
							  <tr>
								  <th>tanggal </th>
								  <th>nama barang</th>
								  <th>gudang</th>
								  <th>suplier</th>
								  <th>unit</th>
								  <th>masuk </th>
								  <th>harga pokok </th>
								  <th>nilai </th>
								  <th>aksi </th>
								  
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $d=mysql_query("select * from stok where posting='N' order by id_stok desc");
						  while ($r=mysql_fetch_array($d))
						  {
						  $tanggal_masuk=tgl_indo($r[tanggal]);
						  $nilai=$r[harga] * $r[stok];
						  $nilai_rp=number_format($nilai);
						  $harga_rp=number_format($r[harga]);
					
						  ?>
							<tr>
								<td class="center"><?php echo "$tanggal_masuk";?></td>
								
								<?php $h=mysql_fetch_array(mysql_query("select * from barang where id_barang='$r[id_barang]'")); ?>
								<td class="center"><?php echo "$h[nama_barang]";?></td>
								<?php $k=mysql_fetch_array(mysql_query("select * from gudang where id_gudang='$r[id_gudang]'")); ?>
								<td class="center"><?php echo "$k[nama_gudang]";?></td>
								<?php $c=mysql_fetch_array(mysql_query("select * from suplier where id_suplier='$r[id_suplier]'")); ?>
								<td class="center"><?php echo "$c[nama_suplier]";?></td>
								<td class="center"><?php echo "$r[satuan]";?></td>
								<td class="center" style="text-align: right;"><?php echo "$r[stok]";?></td>
								<td class="center" style="text-align: right;"><?php echo "$harga_rp";?></td>
								<td class="center" style="text-align: right;"><?php echo "$nilai_rp";?></td>
								
								
								<td class="center"><a class="btn btn-danger" href="modul/barang/dellbmasuk.php?id=<?php echo "$r[id_stok]";?>"><i class="icon-trash"></i> </a>
								<a class="btn btn-info" href="media.php?module=bmasuk&acc=edit&id=<?php echo "$r[id_stok]";?>"><i class="icon-edit"></i> </a>
								
								</td>
							</tr>
							
							<?php
							$sumnilai=$sumnilai + $nilai;
							$rp_sumnilai=number_format($sumnilai);
							}
							
							echo "<tr><td></td>
							          <td></td>
									 
									  <td></td>
									  <td></td>
									  <td></td>
									  <td></td>
									  <td style='text-align: right;'><b style=color:red;>sub total</b></td>
									  <td style='text-align: right;'><b style=color:blue;>$rp_sumnilai</b></td>
									  <td></td>
									  </tr>";
							
							
							?>
						  </tbody>
						  </table>
                          <div class="form-actions">
						  <form   action="<?php echo $PHP_SELF ?> " method="post" >
						  <input type="hidden" value="<?php echo $sumnilai ?>" name="sumnilai">
					      <input type="submit" name="posting" class="btn btn-primary" value="posting" ><p>pabila barang sudah fix dalam satu hari klik posting, status akan tersimpan di finance statement</p>
						  </div>
						  </div>					  
					</div>
				</div>
				
					<?php
					}
					if ($_GET[module]=='bmasuk' && $_GET[acc] == 'edit' )
					{
					if ($_POST[submit1]){
					
					   mysql_query("UPDATE stok SET id_barang = '$_POST[barang]', id_gudang='$_POST[gudang]', id_suplier='$_POST[suplier]', stok='$_POST[jumlah]', satuan='$_POST[satuan]', harga='$_POST[harga]'  WHERE id_stok = '$_POST[id]'");
					   echo "data bmasuk berhasil di update kembali ke halaman <a class=btn btn-red href=media.php?module=bmasuk&acc=view>data bmasuk</a> ";
					}
					
					$t=mysql_fetch_array(mysql_query("select * from stok where id_stok='$_GET[id]'"));
					
					?>
			  <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit barang masuk ke gudang</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
						 
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama barang </label>
							  <div class="controls">
								<select name="barang" >
								<?php
								   $tampil=mysql_query("SELECT * FROM barang ORDER BY nama_barang");
									  if ($t[id_barang]==0){
										echo "<option value=0 selected>- Pilih barang -</option>";
									  }   

									  while($w=mysql_fetch_array($tampil)){
										if ($t[id_barang]==$w[id_barang]){
										  echo "<option value=$w[id_barang] selected>$w[nama_barang]</option>";
										}
										else{
										  echo "<option value=$w[id_barang]>$w[nama_barang]</option>";
										}
									  }
								
								?>
								
								</select>
								<input name="id"  value="<?php echo "$t[id_stok]";?> " type="hidden" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">dari suplier </label>
							  <div class="controls">
								<select name="suplier" >
								<?php
								   $tampil=mysql_query("SELECT * FROM suplier ORDER BY nama_suplier");
									  if ($t[id_suplier]==0){
										echo "<option value=0 selected>- Pilih barang -</option>";
									  }   

									  while($w=mysql_fetch_array($tampil)){
										if ($t[id_suplier]==$w[id_suplier]){
										  echo "<option value=$w[id_suplier] selected>$w[nama_suplier]</option>";
										}
										else{
										  echo "<option value=$w[id_suplier]>$w[nama_suplier]</option>";
										}
									  }
								
								?>
								
								</select>
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">ke gudang </label>
							  <div class="controls">
								<select name="gudang" >
								<?php
								   $tampil=mysql_query("SELECT * FROM gudang ORDER BY nama_gudang");
									  if ($t[id_gudang]==0){
										echo "<option value=0 selected>- Pilih barang -</option>";
									  }   

									  while($w=mysql_fetch_array($tampil)){
										if ($t[id_gudang]==$w[id_gudang]){
										  echo "<option value=$w[id_gudang] selected>$w[nama_gudang]</option>";
										}
										else{
										  echo "<option value=$w[id_gudang]>$w[nama_gudang]</option>";
										}
									  }
								
								?>
								
								</select>
								
							  </div>
							</div>        
						
							<div class="control-group">
							  <label class="control-label" for="typeahead">jumlah </label>
							  <div class="controls">
							 <input type="number" name="jumlah" value='<?php echo "$t[stok]";?>'  >
							 </div>
							</div>
						
							<div class="control-group">
							  <label class="control-label" for="typeahead">unit </label>
							  <div class="controls">
							<select name="satuan"  >
								    <option><?php echo "$t[satuan]";?></option>
								    <?php
								
									echo "<option value=pcs><b> pcs</b></option>";
									echo "<option value=lusin><b> lusin</b></option>";
									echo "<option value=box><b> box</b></option>";
									
									?>
									
								
								</select>
							 </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">harga / (unit) </label>
							  <div class="controls">
							 <input type="number" name="harga" value="<?php echo "$t[stok]";?>" >
							 </div>
							</div>
							<div class="form-actions">
							  <input type="submit" name="submit1"class="btn btn-primary" value=" Simpan " >
							
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

				</div>
					<?php
					}
					?>