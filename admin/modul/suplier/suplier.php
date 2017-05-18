<?php
				if ($_GET[module]=='suplier' && $_GET[acc] == 'view')
					{
					if ($_POST[submit]){
					  
					  mysql_query("INSERT INTO suplier(nama_suplier,alamat) VALUES('$_POST[nama_suplier]','$_POST[alamat]')");
					}
					?>
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Tambah suplier</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama suplier </label>
							  <div class="controls">
								<input name="nama_suplier" type="text" class="span6 typeahead" id="typeahead"  >
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">alamat</label>
							  <div class="controls">
								<textarea name="alamat" type="text" class="span6 typeahead" id="typeahead"  ></textarea>
								
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
				
				if ($_GET[module]=='suplier' && $_GET[acc] == 'view' )
				{

				?>
				<div class="row-fluid sortable">

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>data suplier </h2>
						<div class="box-icon">
				
						    <a href="media.php?module=suplier" class=""><i class="halflings-icon refresh"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								
								  <th>Nama suplier </th>
								  <th>alamat</th>
							
							
								  <th>aksi </th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $d=mysql_query("select * from suplier ");
						  while ($r=mysql_fetch_array($d))
						  {
						
						  ?>
							<tr>
								
								<td class="center"><?php echo "$r[nama_suplier]";?></td>
								<td class="center"><?php echo "$r[alamat]";?></td>
								
								<td class="center"><a class="btn btn-danger" href="modul/suplier/dellsuplier.php?id=<?php echo "$r[id_suplier]";?>"><i class="icon-trash"></i> </a>
								<a class="btn btn-info" href="media.php?module=suplier&acc=edit&id=<?php echo "$r[id_suplier]";?>"><i class=" icon-edit"></i> </a>
								
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
					if ($_GET[module]=='suplier' && $_GET[acc] == 'edit' )
					{
					if ($_POST[submit1]){
					  $jumlah = $_POST[jumlah];
                      mysql_query("UPDATE suplier SET nama_suplier = '$_POST[nama_suplier]', alamat='$_POST[alamat]' WHERE id_suplier = '$_POST[id]'");
					 echo "data suplier berhasil di update kembali ke halaman <a class=btn btn-red href=media.php?module=suplier&acc=view>data suplier</a> ";
					}
					$t=mysql_fetch_array(mysql_query("select * from suplier where id_suplier='$_GET[id]'"));
					
					?>
			  <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit suplier</h2>
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
							  <label class="control-label" for="typeahead">nama suplier </label>
							  <div class="controls">
								<input name="nama_suplier"  value="<?php echo "$t[nama_suplier]";?> " type="text" class="span6 typeahead" id="typeahead"  >
								<input name="id"  value="<?php echo "$t[id_suplier]";?> " type="hidden" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">alamat </label>
							  <div class="controls">
								<textarea name="alamat"   class="span6 typeahead" id="typeahead"  ><?php echo "$t[alamat]";?></textarea>
								
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