<?php
				if ($_GET[module]=='jenis' && $_GET[acc] == 'view')
					{
					if ($_POST[submit]){
					 $jenis_seo = seo_title($_POST['nama_jenis']);
                     mysql_query("INSERT INTO jenis(nama_jenis,jenis_seo) VALUES('$_POST[nama_jenis]','$jenis_seo')");
					}
					?>
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Tambah jenis</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama jenis </label>
							  <div class="controls">
								<input name="nama_jenis" type="text" class="span6 typeahead" id="typeahead"  >
								
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
				
				if ($_GET[module]=='jenis' && $_GET[acc] == 'view' )
				{

				?>
				<div class="row-fluid sortable">

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>data jenis pin produk</h2>
						<div class="box-icon">
						 
						    <a href="media.php?module=jenis" class=""><i class="halflings-icon refresh"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								
								  <th>nama jenis </th>
								  <th>jenis_seo</th>
								  
							
								  <th>aksi </th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $d=mysql_query("select * from jenis ");
						  while ($r=mysql_fetch_array($d))
						  {
						  $titik= $r[jenis_seo] * 5;
						  ?>
							<tr>
								
								<td class="center"><?php echo "$r[nama_jenis]";?></td>
								<td class="center"><?php echo "$r[jenis_seo]";?></td>
								
								<td class="center"><a class="btn btn-danger" href="modul/jenis/delljenis.php?id=<?php echo "$r[id_jenis]";?>"><i class="icon-trash"></i> </a>
								<a class="btn btn-info" href="media.php?module=jenis&acc=edit&id=<?php echo "$r[id_jenis]";?>"><i class="icon-edit"></i> </a>
								
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
					if ($_GET[module]=='jenis' && $_GET[acc] == 'edit' )
					{
					if ($_POST[submit1]){
					   $jenis_seo = seo_title($_POST['nama_jenis']);
					   mysql_query("UPDATE jenis SET nama_jenis = '$_POST[nama_jenis]', jenis_seo='$jenis_seo' WHERE id_jenis = '$_POST[id]'");
					   echo "data jenis berhasil di update kembali ke halaman <a class=btn btn-red href=media.php?module=jenis&acc=view>data jenis</a> ";
					}
					$t=mysql_fetch_array(mysql_query("select * from jenis where id_jenis='$_GET[id]'"));
					
					?>
			  <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit jenis</h2>
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
								<input name="nama_jenis"  value="<?php echo "$t[nama_jenis]";?> " type="text" class="span6 typeahead" id="typeahead"  >
								<input name="id"  value="<?php echo "$t[id_jenis]";?> " type="hidden" class="span6 typeahead" id="typeahead"  >
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