<?php
				if ($_GET[module]=='barang' && $_GET[acc] == 'view')
					{
					if ($_POST[submit]){
					 $barang_seo = seo_title($_POST['nama_barang']);
                     mysql_query("INSERT INTO barang(nama_barang,id_jenis,stok,satuan,harga_jual,harga_beli) VALUES('$_POST[nama_barang]','$_POST[id_jenis]','$_POST[stok]','$_POST[satuan]','$_POST[harga_jual]','$_POST[harga_beli]')");
					}
					?>
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Tambah barang</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">jenis barang </label>
							  <div class="controls">
								 <select name="id_jenis"   >
								    <option>-- pilih jenis barang --</option>
								    <?php $k=mysql_query("select * from jenis order by nama_jenis asc ") ;
									while ($v=mysql_fetch_array($k))
									{
									echo "<option value=$v[id_jenis]><b> $v[nama_jenis]</option>";
									}
									?>
								</select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama barang </label>
							  <div class="controls">
								<input name="nama_barang" type="text"   >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">satuan</label>
							  <div class="controls">
								<select name="satuan"  >
								    <option>-- pilih satuan --</option>
								    <?php
								
									echo "<option value=pcs><b> pcs</b></option>";
									echo "<option value=lusin><b> lusin</b></option>";
									echo "<option value=box><b> box</b></option>";
									echo "<option value=galon><b> galon</b></option>";
									?>
									
								
								</select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">harga beli </label>
							  <div class="controls">
								<input name="harga_beli" type="number"  >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">harga jual </label>
							  <div class="controls">
								<input name="harga_jual" type="number"   >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">stok awal </label>
							  <div class="controls">
								<input name="stok" type="number"   >
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
				
				if ($_GET[module]=='barang' && $_GET[acc] == 'view' )
				{

				?>
				<div class="row-fluid sortable">

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>data barang </h2>
						<div class="box-icon">
						    
						    <a href="media.php?module=barang" class=""><i class="halflings-icon refresh"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>kode barang </th>
								  <th>nama barang </th>
								  <th>jenis barang</th>
								  <th>satuan</th>
								  <th>stok </th>
								  <th>harga beli</th>
								  <th>harga jual</th>
								 <th>aksi </th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $d=mysql_query("select * from barang ");
						  while ($r=mysql_fetch_array($d))
						  {
						  $carimasuk=mysql_fetch_array(mysql_query("select sum(stok) as stok from stok where status='buy' and id_barang='$r[id_barang]' "));
						  $stokmasuk=$carimasuk[stok];
						  $nilai_beli=$carimasuk[stok] * $f[harga_beli];
						  $rp_nilaibeli=number_format ($nilai_beli);
						  $carikeluar=mysql_fetch_array(mysql_query("select sum(stok) as stok from stok where status='sell' and id_barang='$r[id_barang]' "));
						  $stokkeluar=$carikeluar[stok];
						  $nilai_jual=$carikeluar[stok] * $f[harga_jual];
						  $rp_nilaijual=number_format ($nilai_jual);
						  $stok_akhir=$carimasuk[stok] - $carikeluar[stok] ;
						  ?>
							<tr>
								<td class="center"><?php echo "$r[id_jenis].$r[id_barang]";?></td>
								<td class="center"><?php echo "$r[nama_barang]";?></td>
								<?php $h=mysql_fetch_array(mysql_query("select * from jenis where id_jenis='$r[id_jenis]'")); ?>
								<td class="center"><?php echo "$h[nama_jenis]";?></td>
								<td class="center"><?php echo "$r[satuan]";?></td>
								<td class="center"><?php echo "$stok_akhir";?> <a href="JavaScript:newPopup('modul/barang/detail_stok.php?id=<?php echo"$r[id_gudang]&idm=$r[id_barang]";?>');"><i class="icon-eye-open"></i> detail </a></td>
								<td class="center"><?php echo "$r[harga_beli]";?></td>
								<td class="center"><?php echo "$r[harga_jual]";?></td>
								
								<td class="center"><a class="btn btn-danger" href="modul/barang/dellbarang.php?id=<?php echo "$r[id_barang]";?>"><i class="icon-trash"></i> </a>
								<a class="btn btn-info" href="media.php?module=barang&acc=edit&id=<?php echo "$r[id_barang]";?>"><i class="icon-edit"></i> </a>
								
								
								</td>
							</tr>
							<?php
							
							}
							
							?>
						  </tbody>
					  </table>            
					</div>
				</div>
				</div>
					<?php
					}
					if ($_GET[module]=='barang' && $_GET[acc] == 'edit' )
					{
					if ($_POST[submit1]){
					   $barang_seo = seo_title($_POST['nama_barang']);
					   mysql_query("UPDATE barang SET nama_barang = '$_POST[nama_barang]', stok='$_POST[stok]', id_jenis='$_POST[jenis]', harga_beli='$_POST[harga_beli]', harga_jual='$_POST[harga_jual]', satuan='$_POST[satuan]' WHERE id_barang = '$_POST[id]'");
					   echo "data barang berhasil di update kembali ke halaman <a class=btn btn-red href=media.php?module=barang&acc=view>data barang</a> ";
					}
					$t=mysql_fetch_array(mysql_query("select * from barang where id_barang='$_GET[id]'"));
					
					?>
			  <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit barang</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
													<div class="control-group">
							  <label class="control-label" for="typeahead">nama jenis </label>
							  <div class="controls">
								<select name="jenis" >
								<?php
								   $tampil=mysql_query("SELECT * FROM jenis ORDER BY nama_jenis");
									  if ($t[id_jenis]==0){
										echo "<option value=0 selected>- Pilih jenis -</option>";
									  }   

									  while($w=mysql_fetch_array($tampil)){
										if ($t[id_jenis]==$w[id_jenis]){
										  echo "<option value=$w[id_jenis] selected>$w[nama_jenis]</option>";
										}
										else{
										  echo "<option value=$w[id_jenis]>$w[nama_jenis]</option>";
										}
									  }
								
								?>
							</select>	
							</div>
							</div>
								
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama barang </label>
							  <div class="controls">
								<input name="nama_barang"  value="<?php echo "$t[nama_barang]";?> " type="text" class="span6 typeahead" id="typeahead"  >
								<input name="id"  value="<?php echo "$t[id_barang]";?> " type="hidden" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">satuan</label>
							  <div class="controls">
								<select name="satuan"  >
								    <option><?php echo "$t[satuan]";?></option>
								    <?php
								
									echo "<option value=pcs><b> pcs</b></option>";
									echo "<option value=lusin><b> lusin</b></option>";
									echo "<option value=box><b> box</b></option>";
									echo "<option value=galon><b> galon</b></option>";
									?>
									
								
								</select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead" >harga beli </label>
							  <div class="controls">
								<input name="harga_beli" type="number"  value="<?php echo "$t[harga_beli]";?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead" >harga jual </label>
							  <div class="controls">
								<input name="harga_jual" type="number"   value="<?php echo "$t[harga_jual]";?>">
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead" >stok awal </label>
							  <div class="controls">
								<input name="stok" type="number"   value="<?php echo "$t[stok]";?>">
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