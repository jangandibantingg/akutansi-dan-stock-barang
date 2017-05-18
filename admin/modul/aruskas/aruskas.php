<?php
$date=date('Y-m-d');
$iki=explode("-",$date);
if ($_POST[submit]   )
{
$tanggal=$_POST[tanggal];
$pecah=explode("/",$tanggal);
$fixtanggal=$pecah[2]-$pecah[0]-$pecah[1];
mysql_query("insert into arus_kas (id_submaster,id_master,tanggal) value ('$_POST[submaster]','$_POST[master]','".$pecah[2]."-".$pecah[0]."-".$pecah[1]."')");
}

$kre=mysql_fetch_array(mysql_query("select sum(kredit) as rp from income where month(tanggal)='".$iki[1]."' and year(tanggal)='".$iki[0]."'"));
$deb=mysql_fetch_array(mysql_query("select sum(debit) as rp from income where month(tanggal)='".$iki[1]."' and year(tanggal)='".$iki[0]."'"));
$rp_kre=number_format($kre[rp]);
$rp_deb=number_format($deb[rp]);
$bal=$deb[rp] - $kre[rp] ;
$rp_bal=number_format($bal);
?>

        
        <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>tambah arus khas</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
						    <div class="control-group">
							  <label class="control-label" for="date01">Date input</label>
							  <div class="controls">
								<input type="text" name="tanggal" class="input-xlarge datepicker" id="date01" value="<?php echo "".$iki[1]."/".$iki[2]."/".$iki[0]."";?>">
							  </div>
							</div>
						  	<div class="control-group">
							  <label class="control-label" for="typeahead"> arus khas </label>
							  <div class="controls">
								<select name="master"  style="width: 500px; ">
								    <option>-- pilih arus khas--</value>
								    <?php $k=mysql_query("select * from master where status='arus-kas' ") ;
									while ($v=mysql_fetch_array($k))
									{
									
									echo "<option value=$v[id_master]><b>$v[id_master] $v[nama_master]</b> - </option>";
									
									}
									?>
									
								
								</select>
							</div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">nama subakun </label>
							   <div class="controls">
								<select name="submaster"  style="width: 500px; ">
								    <option>-- pilih sub master --</value>
								    <?php $k=mysql_query("select * from master,submaster where master.id_master=submaster.id_master order by master.id_master asc ") ;
									while ($v=mysql_fetch_array($k))
									{
									
									echo "<option value=$v[id_submaster]><b>$v[id_master] $v[nama_master]</b> - $v[id_master].$v[id_submaster] $v[nama_submaster]</option>";
									
									}
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
				<p>Laporan keuangan yang berisikan aliran kas masuk dan kas keluar suatu perusahaan pada periode tertentu. Laporan ini biasanya berisikan mengenai informasi kegiatan operasional (operating activities), investasi (investing activities) dan keuangan (financing activities)
	           <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>arus kas  <?php echo "".$iki[1]."-".$iki[0]."  " ?>
						
						  </h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table border="0" style="width: 800px; ">
							    <thead>
							  <tr>
								  <th> </th>
								 
								  <th style="text-align: right;">debit</th>
								  <th style="text-align: right;">kredit</th>
								
							     
							  </tr>
						  </thead>      
							  <tbody>
							   <?php
						  $d=mysql_query("select * from master where status='arus-kas' order by id_master asc");
						  while ($r=mysql_fetch_array($d))
						  {
						  $tanggal=tgl_indo($r[tanggal]);
						  $rp=number_format($r[rp]);
						  ?>
							<tr>
								<td><?php echo "<b style=color:#1E90FF;>$r[id_master] $r[nama_master]</b>";?></td>
							
								<?php $f=mysql_query("select * from arus_kas,submaster where arus_kas.id_submaster=submaster.id_submaster and arus_kas.id_master='$r[id_master]' "); 
								while ($t=mysql_fetch_array($f)){?>
								
								<tr><td class="center" ><?php echo "<p style=padding-left:2em ><b style=color:#00BFFF;>$r[id_master].$t[id_submaster] $t[nama_submaster]</b>";?>&nbsp <a href="modul/aruskas/dellaruskas.php?id=<?php echo "$t[id_arus_kas]";?>"><i class="icon-trash"></i></td>
								
								<?php $b=mysql_query("select * from submaster,income where income.id_submaster=submaster.id_submaster and submaster.id_submaster='$t[id_submaster]' order by income.id_income asc "); 
								while ($o=mysql_fetch_array($b)){
								$debit=number_format($o[debit]);
								$kredit=number_format($o[kredit]);
								$belah=explode("-",$o[tanggal]);
								?>
								<tr><td class="center" ><?php echo "<p style=padding-left:4em >$r[id_master].$t[id_submaster].$o[id_income].".$belah[1].".".$belah[0]." $o[nama_keterangan]";?></td>
								<td class="center" style="text-align: right;"><?php echo "$debit";?></td>
								<td class="center" style="text-align: right;"><?php echo "$kredit";?></td>
								
								</tr>
								<?php } ?>
								
								
								
								</tr>
							</tr>
							<?php
							
							}
							}
							
							?>  
                             <tr><td style="text-align: right;"><b>&sum; debit kredit<b> </td><td style="text-align: right;"><b style="color:green;"><?php echo "$rp_deb"; ?></b></td style="text-align: right;"><td style="text-align: right;"><b style="color:red;"><?php echo "$rp_kre"; ?></b></td></tr>	
					         <tr><td style="text-align: right;"><b>balance<b> </td><td style="text-align: right;"><b style="color:green;"><?php echo "$rp_bal"; ?></b></td style="text-align: right;"></tr>								 
							  </tbody>
						 </table>  
						
					</div>
				</div><!--/span-->
			</div>