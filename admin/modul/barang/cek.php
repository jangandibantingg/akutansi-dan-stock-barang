<?php
					include "../../../config/koneksi.php";
                    $stok=mysql_query("select * from stok where posting='N'");
					while ($rstok=mysql_fetch_array($stok))
					{
					
					$caristok=mysql_fetch_array(mysql_query("select sum(stok) as stok from stok where id_barang='$rstok[id_barang]'"));
					mysql_query("update barang set stok='stok+$caristok[stok]' where id_barang='$rstok[id_barang]' ");
					echo "$rstok[id_barang] - $caristok[stok] update=>update barang set stok='stok+$caristok[stok]' where id_barang='$rstok[id_barang]'  <br> ";
					}



?>