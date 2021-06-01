<?
include("polacz.php");
if(!isset($_COOKIE['licz'])){
$ile=mysql_fetch_array(mysql_query("Select value from licznik"));
$ile[0]+=1;
mysql_query("update licznik set value='".$ile[0]."'");
setcookie("licz");
}
mysql_close();
?>
