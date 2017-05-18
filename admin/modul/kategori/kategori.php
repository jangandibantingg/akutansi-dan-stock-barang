<?php
				if ($_GET[module]=='kategori' && $_GET[acc] == 'view')
					{
					if ($_POST[submit]){
					 $kategori_seo = seo_title($_POST['nama_kategori']);
                     mysql_query("INSERT INTO kategori(nama_kategori,kategori_seo) VALUES('$_POST[nama_kategori]','$kategori_seo')");
					}
					?>
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Tambah kategori</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama kategori </label>
							  <div class="controls">
								<input name="nama_kategori" type="text" class="span6 typeahead" id="typeahead"  >
								
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
				
				if ($_GET[module]=='kategori' && $_GET[acc] == 'view' )
				{

				?>
				<div class="row-fluid sortable">

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>data kategori pin produk</h2>
						<div class="box-icon">
						    <a href="media.php?module=kategori&acc=tambah" class="#"><i class="halflings-icon folder-open"></i></a>
						    <a href="media.php?module=kategori" class=""><i class="halflings-icon refresh"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								
								  <th>nama kategori </th>
								  <th>kategori_seo</th>
								  
							
								  <th>aksi </th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $d=mysql_query("select * from kategori ");
						  while ($r=mysql_fetch_array($d))
						  {
						  $titik= $r[kategori_seo] * 5;
						  ?>
							<tr>
								
								<td class="center"><?php echo "$r[nama_kategori]";?></td>
								<td class="center"><?php echo "$r[kategori_seo]";?></td>
								
								<td class="center"><a class="btn btn-danger" href="modul/kategori/dellkategori.php?id=<?php echo "$r[id_kategori]";?>"><i class="  halflings-icon trash"></i> delete</a>
								<a class="btn btn-info" href="media.php?module=kategori&acc=edit&id=<?php echo "$r[id_kategori]";?>"><i class="  halflings-icon edit"></i> edit</a>
								
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
					if ($_GET[module]=='kategori' && $_GET[acc] == 'edit' )
					{
					if ($_POST[submit1]){
					   $kategori_seo = seo_title($_POST['nama_kategori']);
					   mysql_query("UPDATE kategori SET nama_kategori = '$_POST[nama_kategori]', kategori_seo='$kategori_seo' WHERE id_kategori = '$_POST[id]'");
					   echo "data kategori berhasil di update kembali ke halaman <a class=btn btn-red href=media.php?module=kategori&acc=view>data kategori</a> ";
					}
					$t=mysql_fetch_array(mysql_query("select * from kategori where id_kategori='$_GET[id]'"));
					
					?>
			  <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit kategori</h2>
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
							  <label class="control-label" for="typeahead">nama kategori </label>
							  <div class="controls">
								<input name="nama_kategori"  value="<?php echo "$t[nama_kategori]";?> " type="text" class="span6 typeahead" id="typeahead"  >
								<input name="id"  value="<?php echo "$t[id_kategori]";?> " type="hidden" class="span6 typeahead" id="typeahead"  >
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