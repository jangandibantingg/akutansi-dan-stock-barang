<?php
				if ($_GET[module]=='master' && $_GET[acc] == 'view')
					{
					if ($_POST[submit]  ){
					 $master_seo = seo_title($_POST['nama_master']);
                     mysql_query("INSERT INTO master(nama_master,master_seo,status) VALUES('$_POST[nama_master]','$master_seo','$_POST[kategori]')");
					}
					if ($_POST[submitsub]){
                     mysql_query("INSERT INTO submaster(nama_submaster,id_master) VALUES('$_POST[nama_submaster]','$_POST[master]')");
					}
					?>
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Tambah akun</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama akun </label>
							  <div class="controls">
								<input name="nama_master" type="text" class="span6 typeahead" id="typeahead"  >
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">kategori akun </label>
							  <div class="controls">
								<select name="kategori">
								    <option value="0">-- pilih kategori akun--</value>
								    <?php 
									
									echo "<option value=laba/rugi>laba/rugi</option>";
									echo "<option value=neraca>neraca</option>";
									echo "<option value=arus-kas>arus-kas</option>";
									?>
									
								
								</select>
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
				<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Tambah subakun</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
						  <div class="control-group">
							  <label class="control-label" for="typeahead">nama akun </label>
							  <div class="controls">
								<select name="master">
								    <option>-- pilih nama akun--</value>
								    <?php $k=mysql_query("select * from master ") ;
									while ($t=mysql_fetch_array($k))
									{
									
									echo "<option value=$t[id_master]>$t[nama_master]-($t[status])</option>";
									
									}
									?>
									
								
								</select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama subakun </label>
							  <div class="controls">
								<input name="nama_submaster" type="text" class="span6 typeahead" id="typeahead"  >
								
							  </div>
							</div>
							 
							
							    
							
							<div class="form-actions">
							  <input type="submit" name="submitsub"class="btn btn-primary" value=" Simpan " >
							
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
				</div>
				<?php
				
				
				}
				
				if ($_GET[module]=='master' && $_GET[acc] == 'view' )
				{

				?>
				<div class="row-fluid sortable">

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>data akun </h2>
						<div class="box-icon">
						
							<a href="<?php echo "#" ;?>" class="#" target="_blank"><i class="halflings-icon print"></i></a>
							<a href="<?php echo "media.php?module=master&acc=view" ;?>" class="#" ><i class="halflings-icon refresh"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						
						</div>
					</div>
					<div class="box-content">
						
						  <?php
						  $d=mysql_query("select * from master ");
						  while ($r=mysql_fetch_array($d))
						  {
				
						  ?>
							<tr>
								
								<td class="center"><?php echo "<h5 style=color:#1E90FF;>$r[id_master] $r[nama_master] ($r[status]) <a href=JavaScript:newPopup('media.php?module=master&acc=edit&id=$r[id_master]');><i class=icon-edit></i> </a></h5>";?></td>
								
							</tr>
							<?php $rt=mysql_query("select * from submaster where id_master='$r[id_master]'");
								while ($n=mysql_fetch_array($rt)){
									?>
								<td class="center"><?php echo "<p style=padding-left:2em ><b style=color:#00BFFF;>$r[id_master].$n[id_submaster] $n[nama_submaster]</b> <a href=modul/master/dellmaster.php?id=$n[id_submaster]><i class=icon-trash></i></a>";?></td>
								<?php } ?>
								
							<?php
							
							}
							
							?>
						 
					<?php
					}
					if ($_GET[module]=='master' && $_GET[acc] == 'edit' )
					{
					if ($_POST[submit1]){
					   $master_seo = seo_title($_POST['nama_master']);
					   mysql_query("UPDATE master SET nama_master = '$_POST[nama_master]', master_seo='$master_seo', status='$_POST[kategori]' WHERE id_master = '$_POST[id]'");
					   echo "<body onLoad=self.close()>";  
					}
					$t=mysql_fetch_array(mysql_query("select * from master where id_master='$_GET[id]'"));
					
					?>
			  <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Tambah akun</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama akun </label>
							  <div class="controls">
								<input name="nama_master" value="<?php echo "$t[nama_master]";?>" type="text" class="span6 typeahead" id="typeahead"  >
								<input name="id" value="<?php echo "$_GET[id]";?>" type="hidden" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">kategori akun </label>
							  <div class="controls">
								<select name="kategori">
								    <option value="0"><?php echo "$t[status]";?> </value>
								    <?php 
									
									echo "<option value=laba/rugi>laba/rugi</option>";
									echo "<option value=neraca>neraca</option>";
									
									?>
									
								
								</select>
							  </div>
							</div>
							
							    
							
							<div class="form-actions">
							  <input type="submit" name="submit1"class="btn btn-primary" value=" update " >
							
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->
				</div>
					<?php
					}
					?>