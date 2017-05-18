<?php
$r=mysql_query ("select * from member where id_member='$_GET[id]'");
?>
<div class="row-fluid sortable">
				<div class="box span6">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon edit"></i><span class="break"></span>Pencarian berdasarkan bulan dan tahun</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
					<form method="POST" action="<?php echo $PHP_SELF ?>">
						<table class="table-striped table-bordered bootstrap-datatable ">
						<tbody>
						<tr>
						<td>from </td>
						<td> :
						<select name="from_bulan">
						<option value="0">pilih bulan</option>
						<option value="1">junuari</option>
						<option value="2">februari</option>
						<option value="3">maret</option>
						<option value="4">april</option>
						<option value="5">mei</option>
						<option value="6">juni</option>
						<option value="7">juli</option>
						<option value="8">agustus</option>
						<option value="9">september</option>
						<option value="10">oktober</option>
						<option value="11">november</option>
						<option value="12">desember</option>
						</select>
						</td>
						<td><select name="from_tahun">
						<option value="0">pilih tahun</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						</td></tr>
						<tr>
						</select></td>
						<td>to </td>
						<td> : <select name="to_bulan">
						<option value="0">pilih bulan</option>
						<option value="1">junuari</option>
						<option value="2">februari</option>
						<option value="3">maret</option>
						<option value="4">april</option>
						<option value="5">mei</option>
						<option value="6">juni</option>
						<option value="7">juli</option>
						<option value="8">agustus</option>
						<option value="9">september</option>
						<option value="10">oktober</option>
						<option value="11">november</option>
						<option value="12">desember</option>
						</select></td>
						<td><select name="to_tahun">
						<option value="0">pilih tahun</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						
						</select></td>
						</tr>
						<tr>
						<td></td> <td>&nbsp
						<button type="submit"  class="btn btn-info">Cari data</button>
						</td></tr>
						</tbody>
						
						</table>
                     </form>
					</div>
				</div><!--/span-->

</div><!--/row-->
<?php
if ($_POST[from_bulan])
{

  $_SESSION[from_bulan]     = $_POST[from_bulan];
  $_SESSION[to_bulan]       = $_POST[to_bulan];
  $_SESSION[from_tahun]     = $_POST[from_tahun];
  $_SESSION[to_tahun]       = $_POST[to_tahun];
}
?>

				<div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span><i class="halflings-icon user"></i><span class="break"></span>data invoice member 
						<?php if ( $_SESSION[from_bulan] && $_SESSION[to_bulan]   && $_SESSION[from_tahun] &&  $_SESSION[to_tahun]   )
						{
						echo "select bulan tahun ($_SESSION[from_bulan]-$_SESSION[from_tahun]) => ($_SESSION[to_bulan]-$_SESSION[to_tahun])";
						
						}
						?>  </h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							    <thead>
							  <tr>
								  <th>id cis</th>
								  <th>nama</th>
								  <th>telpon</th>
								  <th>jumlah tf </th>
								  <th>tanggal tf </th>
								  <th>rekening perusahaan</th>
								  <th>rekening member </th>
							     
							  </tr>
						  </thead>      
							  <tbody>
							   <?php
						  $d=mysql_query("SELECT * FROM payment WHERE month(tanggal) between $_SESSION[from_bulan] and $_SESSION[to_bulan] and year(tanggal) between $_SESSION[from_tahun] and $_SESSION[to_tahun]");
						  while ($r=mysql_fetch_array($d))
						  {
						  $tanggal=tgl_indo($r[tanggal]);
						  $rp=number_format($r[rp]);
						  ?>
							<tr>
								<td><?php echo "$r[id_cis]";?></td>
								<?php $f=mysql_fetch_array(mysql_query("select * from member where id_cis='$r[id_cis]' ")); ?>
								<td class="center"><?php echo "$f[nama_lengkap]";?></td>
								<td class="center"><?php echo "$f[telpon]";?></td>
								<td class="center" style="text-align: right;"><?php echo "$rp";?></td>
								<td class="center"><?php echo "$tanggal";?></td>
								<td class="center"><?php echo "$r[bank]";?></td>
								<td class="center"><?php echo "$r[bank_tujuan]";?></td>
							
								
								
							</tr>
							<?php
							
							}
							
							?>                                
							  </tbody>
						 </table>  
						
					</div>
				</div><!--/span-->
			</div>