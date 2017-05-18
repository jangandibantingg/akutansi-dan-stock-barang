	<style type="text/css">
			body { background: url(../../img/bg-login.jpg) !important; }
		</style>
<?php
include "../../../config/koneksi.php";

if($_POST[submit])
{
mysql_query("update income set id_submaster='$_POST[submaster]', debit='$_POST[debit]', kredit='$_POST[kredit]' where id_income='$_POST[id]'");
echo "<center>update berhasil, close dan segarkan halaman</center>";

}
$r=mysql_fetch_array(mysql_query("select * from income where id_income='$_GET[id]'"));
echo "<center><form action='$PHP_SELF'  method=post enctype=multipart/form-data>
    <table border=0>
<tbody>
<tr><td>subakun</td><td><select name=submaster>";
          $tampil=mysql_query("SELECT * FROM submaster ORDER BY nama_submaster");
          if ($r[id_submaster]==0){
            echo "<option value=0 selected>- Pilih submaster -</option>";
          }   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_submaster]==$w[id_submaster]){
              echo "<option value=$w[id_submaster] selected>$w[nama_submaster]</option>";
            }
            else{
              echo "<option value=$w[id_submaster]>$w[nama_submaster]</option>";
            }
          }

echo "</select></td></tr>
<tr><td>debit</td><td><input type=text name=debit value=$r[debit]></td></tr>
<tr><td>kredit</td><td><input type=text name=kredit value=$r[kredit]><input type=hidden name=id value=$_GET[id]></td></tr>
<tr><td></td><td><input type=submit name=submit value=update></td></tr>
</tbody>
</table>
</form>
</center";
?>
