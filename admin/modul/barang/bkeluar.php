
<?php

$date=date('Y-m-d');
$iki=explode("-",$date);
                   
				    if ($_GET[module]=='bkeluar' && $_GET[acc] == 'view')
					{
					if ($_POST[submit]  ){
					$tanggal=$_POST[tanggal];
					$pecah=explode("/",$tanggal);
					$caribarang=mysql_fetch_array(mysql_query("select * from barang where id_barang='$_POST[barang]'"));
					$harga=$caribarang[harga_jual];
					$satuan=$caribarang[satuan];
					$jenis=$caribarang[jenis];
					
                    mysql_query("INSERT INTO stok(id_gudang,id_stoklist,stok,satuan,id_barang,tanggal,harga,status) VALUES('$_POST[gudang]','$_POST[stoklist]','$_POST[jumlah]','$satuan','$_POST[barang]','".$pecah[2]."-".$pecah[0]."-".$pecah[1]."','$harga','sell')");
					}
					
					if ($_POST[posting]){
					$bkeluar_seo = seo_title($_POST['nama_bkeluar']);
					$tanggal=$_POST[tanggal];
					$pecah=explode("/",$tanggal);
					mysql_query("update stok set posting='Y' where status='sell'");
					 mysql_query("INSERT income (id_submaster,nama_keterangan,tanggal,debit,status) values ('9','barang keluar gudang ".$iki[2]."-".$iki[1]."-".$iki[0]." ','$date','$_POST[sumnilai]','laba/rugi') ");
                   }
				   if($_POST[caribarang])
				   {
				  
				   $_SESSION[barang] = $_POST[barang];
				   $jlimet=mysql_fetch_array(mysql_query("select * from member barang where id_barang='$_SESSION[barang]'"));
				   }
				   if($_POST[submitcari])
				   {
				   $_SESSION[gudang] = $_POST[gudang];
				   $_SESSION[stok] = $_POST[stok];
				   
				   
				   }
					?>
			    <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>kelola barang keluar </h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
					
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" >
						  <fieldset>
						     <div class="control-group">
							  <label class="control-label" for="typeahead">nama barang</label>
							  <div class="controls">
								 <select name="barang"  >
								    <option value="0" >-- pilih barang --</value>
								    <?php $k=mysql_query("select * from barang order by nama_barang asc ") ;
									while ($v=mysql_fetch_array($k))
									{
									echo "<option value=$v[id_barang]><b>  $v[nama_barang]</b></option>";
									}
									?>
								</select>
							</div>
							</div>
						<?php if ($_SESSION[barang]  ){ ?>
                           <table class="table ">
						  <thead>
							  <tr>
								  <th>nama gudang </th>
								  <th>alamat </th>
								  <th>nama_barang</th>
								  <th>satuan</th>
								  <th>stok</th>
								  <th>aksi</th>
								  
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
					      $carimasuk=mysql_fetch_array(mysql_query("select sum(stok) as stok from stok where status='buy' and id_barang='$_SESSION[barang]' and id_gudang='$r[id_gudang]' "));
						  $stokmasuk=$carimasuk[stok];
						  $nilai_beli=$carimasuk[stok] * $f[harga_beli];
						  $rp_nilaibeli=number_format ($nilai_beli);
						  $carikeluar=mysql_fetch_array(mysql_query("select sum(stok) as stok from stok where status='sell' and id_barang='$_SESSION[barang]' and id_gudang='$r[id_gudang]' "));
						  $stokkeluar=$carikeluar[stok];
						  $nilai_jual=$carikeluar[stok] * $f[harga_jual];
						  $rp_nilaijual=number_format ($nilai_jual);
						  $stok_akhir=$carimasuk[stok] - $carikeluar[stok] ;
						  ?>
							<tr>
								<td class="center"><?php echo "$r[nama_gudang]";?></td>
								
								<?php $h=mysql_fetch_array(mysql_query("select * from barang where id_barang='$_SESSION[barang]' ")); ?>
								<?php $c=mysql_fetch_array(mysql_query("select * from stoklist where id_stoklist='$r[id_stoklist]'")); ?>
								<?php $k=mysql_fetch_array(mysql_query("select * from gudang where id_gudang='$r[id_gudang]'")); ?>
								<td class="center"><?php echo "$r[alamat]";?></td>
								<td class="center"><?php echo "$h[nama_barang]";?></td>
								<td class="center"><?php echo "$h[satuan]";?></td>
								<td class="center"><?php echo "$stok_akhir";?></td>	<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" >
								<input type="hidden" name="gudang" value="<?php echo "$r[id_gudang]";?>">
								<input type="hidden" name="stok" value="<?php echo "$stok_akhir";?>">
								<td class="center"><input type="submit" value="pilih gudang" name="submitcari" class="btn btn-primary"></td></form>
								
							</tr>
							
							<?php
							$sumnilai=$sumnilai + $nilai;
							$rp_sumnilai=number_format($sumnilai);
							}
							
							
							
							?>
						  </tbody>
						  </table>


                         <?php } ?>						   
							
							<div class="form-actions">
							  <input type="submit" name="caribarang"class="btn btn-primary" value="cari gudang " >
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
				</div>
				<?php if ($_SESSION[gudang]  ){ ?>
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>kelola barang keluar  </h2>
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
							  <label class="control-label" for="typeahead">dari gudang</label>
							  <div class="controls">
								 <select name="gudang"  >
							
								    <?php $k=mysql_query("select * from gudang where id_gudang='$_SESSION[gudang]' ") ;
									while ($v=mysql_fetch_array($k))
									{
									echo "<option value=$v[id_gudang]><b>  $v[nama_gudang]</b></option>";
									}
									?>
									
								 
								</select>
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead" >stok </label>
							  <div class="controls">
							 <input type="text" name="stok" value="<?php echo "$_SESSION[stok]";?>"   disabled="">
							 <input type="hidden" name="barang" value="<?php echo "$_SESSION[barang]";?>"  >
							 </div>
							</div>
							 <div class="control-group">
							  <label class="control-label" for="typeahead">ke stoklist</label>
							  <div class="controls">
								 <select name="stoklist"  >
								    <option>-- pilih stoklist --</value>
								    <?php $k=mysql_query("select * from stoklist order by nama_stoklist asc ") ;
									while ($v=mysql_fetch_array($k))
									{
									echo "<option value=$v[id_stoklist]><b>  $v[nama_stoklist]</b></option>";
									}
									?>
									
								
								</select>
								
							  </div>
							</div>
							
							<div class="control-group">
							  <label class="control-label" for="typeahead" >jumlah </label>
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
				}
				
				if ($_GET[module]=='bkeluar' && $_GET[acc] == 'view' )
				{

				?>
				<div class="row-fluid sortable">

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>data barang keluar gudang</h2>
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
								  <th>stoklist</th>
								  <th>unit</th>
								  <th>keluar </th>
								  <th>harga pokok </th>
								  <th>nilai </th>
								  <th>aksi </th>
								  
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $d=mysql_query("select * from stok where posting='N' and status='sell' order by id_stok desc");
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
								<?php $c=mysql_fetch_array(mysql_query("select * from stoklist where id_stoklist='$r[id_stoklist]'")); ?>
								<td class="center"><?php echo "$c[nama_stoklist]";?></td>
								<td class="center"><?php echo "$r[satuan]";?></td>
								<td class="center" style="text-align: right;"><?php echo "$r[stok]";?></td>
								<td class="center" style="text-align: right;"><?php echo "$harga_rp";?></td>
								<td class="center" style="text-align: right;"><?php echo "$nilai_rp";?></td>
								
								
								<td class="center"><a class="btn btn-danger" href="modul/barang/dellbkeluar.php?id=<?php echo "$r[id_stok]";?>"><i class="icon-trash"></i> </a>
								<a class="btn btn-info" href="media.php?module=bkeluar&acc=edit&id=<?php echo "$r[id_stok]";?>"><i class="icon-edit"></i> </a>
								
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
					      <input type="submit" name="posting" class="btn btn-primary" value="posting" ><p>apabila barang sudah fix dalam satu hari klik posting, status akan tersimpan di finance statement</p>
						  </div>
						  </div>					  
					</div>
				</div>
				
					<?php
					}
					if ($_GET[module]=='bkeluar' && $_GET[acc] == 'edit' )
					{
					if ($_POST[submit1]){
					
					   mysql_query("UPDATE stok SET id_barang = '$_POST[barang]', id_gudang='$_POST[gudang]', id_suplier='$_POST[suplier]', stok='$_POST[jumlah]', satuan='$_POST[satuan]', harga='$_POST[harga]'  WHERE id_stok = '$_POST[id]'");
					   echo "data bkeluar berhasil di update kembali ke halaman <a class=btn btn-red href=media.php?module=bkeluar&acc=view>data bkeluar</a> ";
					}
					
					$t=mysql_fetch_array(mysql_query("select * from stok where id_stok='$_GET[id]'"));
					
					?>
			  <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit barang keluar dari gudang</h2>
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