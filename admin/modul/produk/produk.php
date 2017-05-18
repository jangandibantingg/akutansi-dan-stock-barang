<?php 
if ($_GET[acc] == 'add' ){ 

if ($_POST[submit])
{
 $y=mysql_fetch_array(mysql_query("select * from kategori where kategori_seo='$_POST[kategori]'"));
 
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  $produk_seo      = seo_title($_POST[nama_produk]);
  UploadImage($nama_file_unik);
  
  mysql_query("INSERT INTO produk  (nama_produk,
                                    produk_seo,
                                    id_kategori,
                                    harga,
                                    deskripsi,
                                    tgl_masuk,
                                    gambar) 
                            VALUES('$_POST[nama_produk]',
                                   '$produk_seo',
                                   '$y[id_kategori]',
                                   '$_POST[harga]',
                                   '$_POST[deskripsi]',
                                   '2015-8-8',
                                   '$nama_file_unik')");
								  

}
?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Tambah produk</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
						  <div class="control-group">
								<label class="control-label" for="selectError">Pilih Kategori Produk</label>
								<div class="controls">
								  <select name="kategori" id="selectError" data-rel="chosen">
									<?php $f=mysql_query("select * from kategori order by nama_kategori asc");
									while ($r=mysql_fetch_array($f)){
									echo "<option>$r[kategori_seo]</option>";
								        }
								    ?>
								  </select>
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Nama Produk </label>
							  <div class="controls">
								<input name="nama_produk" type="text" class="span6 typeahead" id="typeahead"  >
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Harga </label>
							  <div class="controls">
								<input name="harga" type="text" class="span6 typeahead" id="typeahead"  >
								<?php   if (empty($_POST[harga])){ echo "<p>tulis harga minimal angka 0</p>";} ?>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">gambar</label>
							  <div class="controls">
								<input class="input-file uniform_on" name="fupload" id="fileInput" type="file">
							  </div>
							  <?php if (empty($_POST[fupload])){ echo "<p>Sisipkan Gambar dengan format JPG/JPEG!</p>";} ?>
							</div>          
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Deskripsi Produk</label>
							  <div class="controls">
								<textarea name="deskripsi" class="cleditor" id="textarea2" rows="3"></textarea>
							  </div>
							</div>
							<div class="form-actions">
							  <input type="submit" name="submit"class="btn btn-primary" value=" Simpan " >
							
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

</div><!--/row-->
<?php  } ?>
<?php if ($_GET[acc] == 'view' ){ ?>
<div class="row-fluid sortable">

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><a  href="media.php?module=produk&acc=add"><i class="  icon-shopping-cart"> </i></a><span class="break"></span>Data Produk yang ditampilkan di halaman website | </h2>
						<div class="box-icon">
							<a href="media.php?module=produk&acc=add" class="#"><i class="halflings-icon folder-open"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Gambar</th>
								  <th>Nama </th>
								  <th>Kategori </th>
								  <th>Harga </th>
							      <th>aksi </th>
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						  $d=mysql_query("select * from produk order by id_produk desc ");
						  while ($r=mysql_fetch_array($d))
						  {
						  $harga=number_format($r[harga]);
						  ?>
							<tr>
								<td><img src="../foto_produk/<?php echo "small_$r[gambar]";?>"></td>
								<td class="center"><?php echo "$r[nama_produk]";?></td>
								<?php 
								$l=mysql_fetch_array(mysql_query("select * from kategori where id_kategori='$r[id_kategori]'")); 
								?>
								<td class="center"><?php echo "$l[nama_kategori]";?></td>
								<td class="center"><?php echo "$harga";?></td>
								<td class="center">
								<a  href="modul/hapus/hapus.php?module=produk&acc=hapus&id=<?php echo "$r[id_produk]"; ?>"><i class="btn btn-danger icon-trash"></i></a>
								<a href="media.php?module=produk&acc=edit&id=<?php echo "$r[id_produk]";?>"><i class="btn btn-info icon-edit"></i></a>
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
			<?php } ?>
			
<?php 
if ($_GET[acc] == 'edit' ){ 

if ($_POST[submit1])
{
 
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  $produk_seo      = seo_title($_POST[nama_produk]);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                   produk_seo  = '$produk_seo', 
                                   id_kategori = '$_POST[kategori]',
                                   harga       = '$_POST[harga]',
                                   deskripsi   = '$_POST[deskripsi]'
                             WHERE id_produk   = '$_POST[id]'");

  }
  else{
    UploadImage($nama_file_unik);
    mysql_query("UPDATE produk SET nama_produk = '$_POST[nama_produk]',
                                   produk_seo  = '$produk_seo', 
                                   id_kategori = '$_POST[kategori]',
                                   harga       = '$_POST[harga]',
                                   deskripsi   = '$_POST[deskripsi]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_produk   = '$_POST[id]'");

  }
								  

}
$t=mysql_fetch_array(mysql_query("select * from produk where id_produk='$_GET[id]'"));
?>
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Edit Produk</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
						  <div class="control-group">
								<label class="control-label" for="selectError">Pilih Kategori Produk</label>
								<div class="controls">
								  <select name='kategori'>";
 <?php
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          if ($t[id_kategori]==0){
            echo "<option value=0 selected>- Pilih Kategori -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($t[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select>";
?>
								</div>
							  </div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Nama Produk </label>
							  <div class="controls">
								<input name="nama_produk"  value="<?php echo "$t[nama_produk]";?> " type="text" class="span6 typeahead" id="typeahead"  >
								<input name="id"  value="<?php echo "$t[id_produk]";?> " type="hidden" class="span6 typeahead" id="typeahead"  >
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">Harga </label>
							  <div class="controls">
								<input name="harga" value="<?php echo "$t[harga]";?> "  type="text" class="span6 typeahead" id="typeahead"  >
								<?php   if (empty($_POST[harga])){ echo "<p>tulis harga minimal angka 0</p>";} ?>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="fileInput">gambar</label>
							  <div class="controls">
								<img src="../foto_produk/<?php echo "small_$t[gambar]";?>">
							  </div>
							  <div class="controls">
								<input class="input-file uniform_on" name="fupload" id="fileInput" type="file">
							  </div>
							  <?php if (empty($_POST[fupload])){ echo "<p>Sisipkan Gambar dengan format JPG/JPEG!</p>";} ?>
							</div>          
							<div class="control-group hidden-phone">
							  <label class="control-label" for="textarea2">Deskripsi Produk</label>
							  <div class="controls">
								<textarea name="deskripsi" class="cleditor" id="textarea2" rows="3"><?php echo "$t[deskripsi]";?> </textarea>
							  </div>
							</div>
							<div class="form-actions">
							  <input type="submit" name="submit1"class="btn btn-primary" value=" Simpan " >
							
							</div>
						  </fieldset>
						</form>   

					</div>
				</div><!--/span-->

</div><!--/row-->
<?php  } ?>			
			
			
			
			
			