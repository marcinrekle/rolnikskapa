<?
include("polacz.php");
if(!isset($_COOKIE['sonda'])){
$ile=mysql_num_fields(mysql_query("SELECT * FROM sonda"));
$f=($ile-2)/2;
$sonda=mysql_fetch_array(mysql_query("SELECT * FROM sonda"));
$sonda[$f+1+$_POST['odp']]+=1;
mysql_query("UPDATE `sonda` SET `ile".$_POST['odp']."` = '".$sonda[$f+1+$_POST['odp']]."' WHERE `id` = '1' LIMIT 1 ;");
setcookie("sonda","tak",time()+24*3600);
}
$adresikg= explode("?",$_SERVER['HTTP_REFERER']);
$adresik=explode("&",$adresikg[1]) ;
$adres='';
$adres.=$adresikg[0];
header("Location:".$adres);
?>