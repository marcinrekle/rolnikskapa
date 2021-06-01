<?php
include 'polacz.php';
$limit = 60;
$czas_aktualny = time();
$czas_zliczany = $czas_aktualny - $limit;
$ip =$_COOKIE["PHPSESSID"];//$_COOKIE["PHPSESSID"]session_id();
//$ip = $_SERVER['REMOTE_ADDR'];
$usun = mysql_query("DELETE FROM `online` WHERE czas<'$czas_zliczany' OR ip='$ip'");
$dodaj = mysql_query("INSERT INTO `online` (id, czas, ip) VALUES (NULL, '$czas_aktualny', '$ip')");
$wyswietl = mysql_query("SELECT DISTINCT `ip` FROM `online`");
$osob = mysql_num_rows($wyswietl);
//echo "<div id=\"odp\">Osoby on-line: $osob</div>";
echo "{\"on\":\"Osoby on-line: $osob\"}";
mysql_close();
?>