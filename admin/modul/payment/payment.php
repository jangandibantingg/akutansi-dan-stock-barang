
			<?php 
			    
				$date=date('Y-m-d');
				$iki=explode("-",$date);
				$b1=mysql_fetch_array(mysql_query("select * from khas where id_khas='1'"));
				$b2=mysql_fetch_array(mysql_query("select * from khas where id_khas='2'"));
				$b3=mysql_fetch_array(mysql_query("select * from khas where id_khas='3'"));
				$b4=mysql_fetch_array(mysql_query("select * from khas where id_khas='4'"));
				$b5=mysql_fetch_array(mysql_query("select * from khas where id_khas='5'"));
				$b6=mysql_fetch_array(mysql_query("select * from khas where id_khas='6'"));
				$b7=mysql_fetch_array(mysql_query("select * from khas where id_khas='7'"));
				$b8=mysql_fetch_array(mysql_query("select * from khas where id_khas='8'"));
		        $j=mysql_fetch_array(mysql_query("select * from p_admin where id_p_admin='1'"));
				$pending_paymentatas=number_format($j[pp]);
				$total_paymentatas=number_format($j[tp]);
				if ($_POST[posting]){
					$bmasuk_seo = seo_title($_POST['nama_bmasuk']);
					$tanggal=$_POST[tanggal];
					$pecah=explode("/",$tanggal);
					mysql_query("update payment set posting='Y'");
                    mysql_query("INSERT income (id_submaster,nama_keterangan,tanggal,kredit,status) values ('10','tf member payment ".$iki[2]."-".$iki[1]."-".$iki[0]." ','$date','$_POST[sumnilai]','laba/rugi') ");
					}
			?>
<div class="row-fluid sortable">

				<div class="box span10<div class="row-fluid">
				
				<div class="span3 statbox purple" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,4,2,4,8,2,3,3,2</div>
					<div class="number"><?php echo "$j[jm]"; ?> <i class="icon-user"></i></div>
					<div class="title">member</div>
					<div class="footer">
						<a href="#"> Jumlah Member</a>
					</div>	
				</div>
					<div class="span3 statbox yellow" onTablet="span6" onDesktop="span3">
					<div class="boxchart">7,2,2,2,1,-4,-2,4,8,,0,3,3,5</div>
					<div class="number"><?php echo "$j[tw]"; ?> <i class="icon-money"></i></div>
					<div class="title">Member</div>
					<div class="footer">
						<a href="#">Transfer Wajib</a>
					</div>
				</div>	
				
				<div class="span3 statbox red" onTablet="span6" onDesktop="span3">
					<div class="boxchart">1,2,6,4,0,8,2,4,5,3,1,7,5</div>
					<div class="number"><?php echo "$pending_paymentatas"; ?><i class="icon-arrow-down"></i></div>
					<div class="title">IDR</div>
					<div class="footer">
						<a href="#"> Pending Payment </a>
					</div>
				</div>
				<div class="span3 statbox green noMargin" onTablet="span6" onDesktop="span3">
					<div class="boxchart">5,6,7,2,0,-4,-2,4,8,2,3,3,2</div>
					<div class="number"><?php echo "$total_paymentatas"; ?> <i class="icon-arrow-up"></i></div>
					<div class="title">IDR</div>
					<div class="footer">
						<a href="#"> Total Payment</a>
					</div>
				</div>
			
			</div>	
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Data Member Payment CIS</h2>
						<div class="box-icon">
							<a href="media.php?module=payment" ><i class="halflings-icon refresh"></i> refresh</a>
							
						</div>
					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr><th>No.</th>
								  <th>id cis</th>
								  <th>nama </th>
								  <th>peringkat</th>
								  <th>A (RP)</th>
								  <th>A (RO)</th>
							      <th>B (int) </th>
								  <th>B (SL) </th>
								  <th>B (SU) </th>
								  <th>B (BP) </th>
								  <th>Total </th>
								  <th>Payment </th>
								  <th>sisa </th>
								  <th>aksi </th>
								  
							  </tr>
						  </thead>   
						  <tbody>
						  <?php
						 
						  $d=mysql_query("select * from member order by id_member ASC ");
						  while ($r=mysql_fetch_array($d))
						  {
							  $no++;
				
						  ?>
							<tr><td><?php echo "$no";?></td>
								<td><?php echo "$r[id_cis]";?></td>
								<td class="center"><?php echo "$r[nama_lengkap]";?></td>
								<td class="center"><?php echo "$r[peringkat]";?></td>
								<?php
								
								
								
								$cariperingkat=mysql_fetch_array(mysql_query("select sum(rp) as rp from peringkat where id_cis='$r[id_cis]'"));
								$rpperingkatuo=number_format($cariperingkat[rp]);
								
								?>
								<td class="center" style="text-align: right;"><?php echo "$rpperingkatuo";?></td>
								
								
								
								<?php
						
									
								$roadmin=mysql_fetch_array(mysql_query("select ro from tf where id_cis='$r[id_cis]' "));
								$ro=$roadmin[ro] ; 
								$roadmindf= number_format($ro);
								$interval1=mysql_num_rows(mysql_query("select * from order_produk where username='$r[id_cis]' and entri='Y'"));
								$interval2=mysql_num_rows(mysql_query("select * from program2 where username='$r[id_cis]' and entri='Y'"));
								$interval3=mysql_num_rows(mysql_query("select * from program3 where username='$r[id_cis]' and entri='Y'"));
								$interval4=mysql_num_rows(mysql_query("select * from program4 where username='$r[id_cis]' and entri='Y'"));
								$interval5=mysql_num_rows(mysql_query("select * from program5 where username='$r[id_cis]' and entri='Y'"));
								$interval6=mysql_num_rows(mysql_query("select * from program6 where username='$r[id_cis]' and entri='Y'"));
								$interval7=mysql_num_rows(mysql_query("select * from program7 where username='$r[id_cis]' and entri='Y'"));
								$interval8=mysql_num_rows(mysql_query("select * from program8 where username='$r[id_cis]' and entri='Y'"));
								$sponsorlang=mysql_num_rows(mysql_query("select * from order_produk where sponsor='$r[id_cis]' and entri='Y'"));
								$sponsorsu1=mysql_num_rows(mysql_query("select * from order_produk where sponsor='$r[id_cis]' and entri='Y'"));
								$sponsorsu2=mysql_num_rows(mysql_query("select * from program2 where sponsor='$r[id_cis]' and entri='Y'"));
								$sponsorsu3=mysql_num_rows(mysql_query("select * from program3 where sponsor='$r[id_cis]' and entri='Y'"));
								$sponsorsu4=mysql_num_rows(mysql_query("select * from program4 where sponsor='$r[id_cis]' and entri='Y'"));
								$sponsorsu5=mysql_num_rows(mysql_query("select * from program5 where sponsor='$r[id_cis]' and entri='Y'"));
								$sponsorsu6=mysql_num_rows(mysql_query("select * from program6 where sponsor='$r[id_cis]' and entri='Y'"));
								$sponsorsu7=mysql_num_rows(mysql_query("select * from program7 where sponsor='$r[id_cis]' and entri='Y'"));
								$sponsorsu8=mysql_num_rows(mysql_query("select * from program8 where sponsor='$r[id_cis]' and entri='Y'"));
								$bonus4=mysql_num_rows(mysql_query("select * from program4 where username='$r[id_cis]' and entri='Y'"));
								$bonus5=mysql_num_rows(mysql_query("select * from program4 where username='$r[id_cis]' and entri='Y'"));
								$bonus6=mysql_num_rows(mysql_query("select * from program4 where username='$r[id_cis]' and entri='Y'"));
								$bonus7=mysql_num_rows(mysql_query("select * from program4 where username='$r[id_cis]' and entri='Y'"));
								$bonus8=mysql_num_rows(mysql_query("select * from program4 where username='$r[id_cis]' and entri='Y'"));
								
								$bonussponsorsu= ( $b1[sponsor_ulang] * $sponsorsu1  ) + ( $b2[sponsor_ulang] * $sponsorsu2 ) + ( $b3[sponsor_ulang] * $sponsorsu3 ) + ( $b4[sponsor_ulang] * $sponsorsu4 ) + ( $b5[sponsor_ulang] * $sponsorsu5 ) + ( $b6[sponsor_ulang] * $sponsorsu6 ) + ( $b7[sponsor_ulang] * $sponsorsu7 ) + ( $b8[sponsor_ulang] * $sponsorsu8 ) ;
								$bonusinterval= ( $b1[bonus_interval] * $interval1 * 27) + ( $b2[bonus_interval] * $interval2 * 27) + ( $b3[bonus_interval] * $interval3 * 27) + ( $b4[bonus_interval] * $interval4 * 27) + ( $b5[bonus_interval] * $interval5 * 27) + ( $b6[bonus_interval] * $interval6 * 27) + ( $b7[bonus_interval] * $interval7 * 27) + ( $b8[bonus_interval] * $interval8 * 27) ;
								$bonusprod= ($b4[produk] *$bonus4 ) + ($b5[produk] *$bonus5 ) + ($b6[produk] *$bonus6 ) + ($b7[produk] *$bonus7 ) + ($b8[produk] *$bonus8 ) ;
								$rp_bunus=number_format($bonusprod);
								$intervalrp= number_format($bonusinterval);
								$bonussl= $sponsorlang * 10 ;
								$rpsl= number_format($bonussl);
								$rpsu=number_format ($bonussponsorsu);
								$totalkhas= $bonussponsorsu + $bonusinterval + $bonussl + $cariperingkat[rp] + $ro + $bonusprod;
								$rp_totalkhas=number_format($totalkhas);
								$rpbonus=number_format($rpbonus);
								
								?>
								<td class="center" style="text-align: right;"><?php echo "$roadmindf";?></td>
								
								<?php
								$k=mysql_fetch_array(mysql_query("select * from member where id_cis='$r[sponsor]'"));
								$p=mysql_fetch_array(mysql_query("select sum(rp) as rp from payment where id_cis='$r[id_cis]'"));
								$rp_payment=number_format($p[rp]);
								$sisa= $totalkhas - $p[rp] ;
								$rp_sisa=number_format($sisa);
								$pending_payment=$pending_payment + $sisa;
								$rppending_payment=number_format($pending_payment);
								$total_payment=$total_payment + $p[rp] ;
								$rptotal_payment=number_format($total_payment);
								mysql_query("update tf set intv='$bonusinterval', su='$bonussponsorsu', sl='$bonussl',bp='$bonusprod' where id_cis='$r[id_cis]' ");
								if ($sisa < 105000 )
								{
								$tf=danger;
								$color=red;
								$icon=down;
								}
								else
								{
								
								$tf=success;
								$color=green;
								$icon=up;
								$wajib=1;
								$transfer_wajib= $transfer_wajib + $wajib ;		
								}
                               	$jumlah_member=$jumlah_member + 1 ;						
								?>
								
								<td class="center" style="text-align: right;"><?php echo "$intervalrp  ";?></td>
								<td class="center" style="text-align: right;"><?php echo "$rpsl";?></td>
								<td class="center" style="text-align: right;"><?php echo "$rpsu ";?></td>
								<td class="center" style="text-align: right;"><?php echo "$rp_bunus ";?></td>
							    <td class="center" style="text-align: right;"><?php echo "<p style='color: blue;'>$rp_totalkhas</p>";?></td>
								<td class="center" style="text-align: right;"><?php echo "<p style='color: green;'>$rp_payment</p>";?></td>
								<td class="center "style="text-align: right;"><?php echo "<a style='color:$color;'>$rp_sisa</a> <i class=icon-arrow-$icon style=color:$color;></i>";?></td>
								<td class="center" >
								<?php
							
								?>
								<a class="btn btn-info" href="JavaScript:newPopup('modul/detail-payment/detail-payment.php?id=<?php echo "$r[id_cis]";?>');" ><i class="icon-print"></i> </a>
								<?php
								if ( $tf == 'danger' )
								{
								echo "<a class='btn btn-danger' href='#' ><i class='icon-money'></i></a> ";
								
								}
								if ( $tf == 'success' ){
								?>
								<a class="btn btn-success" href="JavaScript:newPopup('media.php?module=bonus&id=<?php echo "$r[id_cis]";?>&sisa=<?php echo "$sisa";?>');" ><i class="icon-money"></i></a>
								<?php
								}
								?>
								</td>
							</tr>
							<?php
							
							}
							
							?>
						  </tbody>
					  </table>   
										  
					</div>
				</div>
				
				<?php
				mysql_query("update p_admin set pp='$pending_payment', tp='$total_payment', tw='$transfer_wajib', jm='$jumlah_member' where id_p_admin='1' ");
				?>
				<div class="row-fluid sortable">

				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>data member payment yang belum terposting</h2>
						<div class="box-icon">
						 
						  <a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table ">
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
						 $d=mysql_query("SELECT * FROM payment WHERE posting='N'");
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
							$sumnilai=$sumnilai + $r[rp];
							$rp_sumnilai=number_format($sumnilai);
							}
							
							echo "<tr><td></td>
							          <td></td>
									  <td style='text-align: right;'><b style=color:red;>sub total</b></td>
									  <td style='text-align: right;'><b style=color:blue;>$rp_sumnilai</b></td>
									  <td></td>
									  <td></td>
									  <td></td>
								 </tr>";
							
							
							?>
						  </tbody>
						  </table>
                          <div class="form-actions">
						  <form   action="<?php echo $PHP_SELF ?> " method="post" >
						  <input type="hidden" value="<?php echo $sumnilai ?>" name="sumnilai">
					      <input type="submit" name="posting" class="btn btn-primary" value="posting" ><p>klik posting, status akan tersimpan di finance statement</p>
						  </div>
						  </div>					  
					</div>
				</div>
				
				
			