<?php
include '../../polacz.php';
if(!isset($_COOKIE['licz'])){
$ile=mysql_fetch_array(mysql_query("Select value from licznik"));
$ile[0]+=1;
mysql_query("update licznik set value='".$ile[0]."'") or die("Nie udalo sie");
setcookie("licz","",time()+3600);
}
$ile=mysql_fetch_array(mysql_query("Select value from licznik"));
$z=strlen($ile[0]);
echo $ile[0];
echo $_COOKIE[licz];
mysql_close();
//$licz=10-$z;
//for($i=0;$i<$licz;$i++){
//$tab[$i]=0;
//}//for
//for($i=0;$i<$z;$i++){
//$tab[$licz+$i]=substr($ile[0],$i,1);
//}
//echo '<img src="../../PLIKI/cyfry2.gif">';
//echo '<img src="../../PLIKI/cyfry2.gif">';
//header("Content-type: image/gif");
//$obrazek=ImageCreate(150, 22);
//$cyfry=ImageCreateFromGif("../../PLIKI/cyfry2.gif");
//for($i=0;$i<10;$i++){
//ImageCopyResized($obrazek, $cyfry, 15*$i, 1, 15*$tab[$i], 0, 15, 20, 15, 20);
//}
//ImageGif($cyfry);
?>