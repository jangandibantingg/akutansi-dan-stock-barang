<?php
$date=date('Y-m-d');
$iki=explode("-",$date);
if ($_POST[submit] && $_POST[tanggal] && $_POST[master] != '-- pilih nama akun--' && $_POST[nama_keterangan]  )
{
$tanggal=$_POST[tanggal];
$pecah=explode("/",$tanggal);
$fixtanggal=$pecah[2]-$pecah[0]-$pecah[1];
mysql_query("insert into income (id_submaster,nama_keterangan,tanggal,debit,kredit,status) value ('$_POST[master]','$_POST[nama_keterangan]','".$pecah[2]."-".$pecah[0]."-".$pecah[1]."','$_POST[debit]','$_POST[kredit]','neraca')");
}

$kre=mysql_fetch_array(mysql_query("select sum(kredit) as rp from income where status='neraca' and month(tanggal)='".$iki[1]."' and year(tanggal)='".$iki[0]."'"));
$deb=mysql_fetch_array(mysql_query("select sum(debit) as rp from income where  status='neraca' and month(tanggal)='".$iki[1]."' and year(tanggal)='".$iki[0]."'"));
$rp_kre=number_format($kre[rp]);
$rp_deb=number_format($deb[rp]);
$bal=$deb[rp] - $kre[rp] ;
$rp_bal=number_format($bal);
?>

        
        <div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>tambah rekening</h2>
						<div class="box-icon">
							
						</div>
					</div>
					<div class="box-content">
						<form class="form-horizontal"  action="<?php echo $PHP_SELF ?> " method="post" enctype="multipart/form-data">
						  <fieldset>
						
						  	<div class="control-group">
							  <label class="control-label" for="typeahead">nama subakun </label>
							  <div class="controls">
								<select name="master"  style="width: 500px; ">
								    <option>-- pilih nama akun--</value>
								    <?php $k=mysql_query("select * from master,submaster where master.id_master=submaster.id_master and master.status='neraca' order by master.id_master asc ") ;
									while ($v=mysql_fetch_array($k))
									{
									
									echo "<option value=$v[id_submaster]><b>$v[id_master] $v[nama_master]</b> - $v[id_master].$v[id_submaster] $v[nama_submaster]</option>";
									
									}
									?>
									
								
								</select>
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="date01">Date input</label>
							  <div class="controls">
								<input type="text" name="tanggal" class="input-xlarge datepicker" id="date01" value="<?php echo "".$iki[1]."/".$iki[2]."/".$iki[0]."";?>">
							  </div>
							</div>
							  <div class="control-group">
							  <label class="control-label" for="typeahead">nama rekening  </label>
							  <div class="controls">
								<input name="nama_keterangan" type="text" class="span6 typeahead" id="typeahead"  >
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">debit  </label>
							  <div class="controls">
								<input name="debit" type="number" class="span6 typeahead" id="typeahead"  >
								
							  </div>
							</div>
							<div class="control-group">
							  <label class="control-label" for="typeahead">kredit</label>
							  <div class="controls">
								<input name="kredit" type="number" class="span6 typeahead" id="typeahead"  >
								
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
				<p>berisikan informasi harta (asset), utang atau kewajiban serta modal (capital) pada periode tertentu.
	           <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>neraca  <?php echo "".$iki[1]."-".$iki[0]."  " ?>
						
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
						  $d=mysql_query("select * from master where status='neraca' order by id_master asc");
						  while ($r=mysql_fetch_array($d))
						  {
						  $tanggal=tgl_indo($r[tanggal]);
						  $rp=number_format($r[rp]);
						  ?>
							<tr>
								<td><?php echo "<b style=color:#1E90FF;>$r[id_master] $r[nama_master]</b>";?></td>
							
								<?php $f=mysql_query("select * from master,submaster where master.id_master=submaster.id_master and submaster.id_master='$r[id_master]' "); 
								while ($t=mysql_fetch_array($f)){?>
								
								<tr><td class="center" ><?php echo "<p style=padding-left:2em ><b style=color:#00BFFF;>$r[id_master].$t[id_submaster] $t[nama_submaster]</b>";?></td>
								
								<?php $b=mysql_query("select * from submaster,income where income.id_submaster=submaster.id_submaster and submaster.id_submaster='$t[id_submaster]' order by income.id_income asc "); 
								while ($o=mysql_fetch_array($b)){
								$debit=number_format($o[debit]);
								$kredit=number_format($o[kredit]);
								$belah=explode("-",$o[tanggal]);
								?>
								<tr><td class="center" ><?php echo "<p style=padding-left:4em >$r[id_master].$t[id_submaster].$o[id_income].".$belah[1].".".$belah[0]." $o[nama_keterangan]";?></td>
								<td class="center" style="text-align: right;"><?php echo "$debit";?></td>
								<td class="center" style="text-align: right;"><?php echo "$kredit";?></td>
								<td> &nbsp <a href="modul/neraca/dellneraca.php?id=<?php echo "$o[id_income]";?>"><i class="icon-trash"></i></a> <a href="JavaScript:edit('modul/neraca/neraca_edit.php?id=<?php echo"$o[id_income]";?>');"><i class="icon-edit"></i></a> <a href="media.php?module=neraca&acc=view"><i class="icon-refresh"></i></a></td>
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