<?php
include '../head.php';
include '../polacz.php';
$url=stripcslashes(htmlspecialchars($_POST[url]));
$autor=$_SESSION[nick];
$data=date("Y-m-d G:i:s");
$tyt_gl=stripcslashes(htmlspecialchars($_POST[tytNg]));
$tyt=stripcslashes(htmlspecialchars($_POST[tyt]));
$zdjecie=stripcslashes(htmlspecialchars($_POST[foto]));
$sezon=stripcslashes(htmlspecialchars($_POST[rok]));
$mecz=0;
$wprowadzenie=stripcslashes(htmlspecialchars("<p class=\"wprowadzenie\">".$_POST[wpr]));
$opis=stripcslashes(htmlspecialchars("<p>".$_POST[opis]));
$podsumowanie=stripcslashes(htmlspecialchars("<p>".$_POST[pods]));
$sklad=stripcslashes(htmlspecialchars($_POST[news_sklad]));
$stat=stripcslashes(htmlspecialchars($_POST[news_omeczu]));
$link_tyt=stripcslashes(htmlspecialchars($_POST[link]));
$rozgrywki=stripcslashes(htmlspecialchars($_POST[rozgrywki]));
//echo "$url<br>$autor<br>$data<br>$tyt_gl<br>$tyt<br>$zdjecie<br>$sezon<br>$mecz<br>
//$wprowadzenie<br>$opis<br>$podsumowanie<br>$sklad<br>$link_tyt<br>$stat<br>$rozgrywki<br>";

echo "mysql_query(\"INSERT INTO `news2011` (`id`, `url`, `autor`, `data`, 
`tyt_gl`, `tyt`, `zdjecie`, `sezon`, `mecz`, `wprowadzenie`, `opis`, `podsumowanie`, 
`stat`, `sklad`, `link_tyt`, `rozgrywki`) VALUES 
(NULL, '$url', '$autor', '$data', '$tyt_gl', '$tyt', 
'$zdjecie', '$sezon', '$mecz', '$wprowadzenie', '$opis', '$podsumowanie', '$stat', '$sklad', 
'$link_tyt', '$rozgrywki');\")";

mysql_query("INSERT INTO `news2011` (`id`, `url`, `autor`, `data`, 
`tyt_gl`, `tyt`, `zdjecie`, `sezon`, `mecz`, `wprowadzenie`, `opis`, `podsumowanie`, 
`stat`, `sklad`, `link_tyt`, `rozgrywki`) VALUES 
(NULL, '$url', '$autor', '$data', '$tyt_gl', '$tyt', 
'$zdjecie', '$sezon', '$mecz', '$wprowadzenie', '$opis', '$podsumowanie', '$stat', '$sklad', 
'$link_tyt', '$rozgrywki');")or die("nie udalo sie");
mysql_close();
?>
