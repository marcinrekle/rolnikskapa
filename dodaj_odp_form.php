<?php
session_start();
include 'polacz.php';
$info=browser($_SERVER[HTTP_USER_AGENT]);
echo "<form action=\"../../../dodaj_kom.php\" method=\"POST\" name=\"dod_odp\" id=\"dod_odp\">";
echo "<textarea cols=\"45\" rows=\"10\" name=\"kom_text\"></textarea>
		<input type=\"hidden\" name=\"autor\" value=\"$_SESSION[nick]\">
		<input type=\"hidden\" name=\"system\" value=\"$info[os]\">
		<input type=\"hidden\" name=\"przeg\" value=\"$info[name]\">
		<input type=\"hidden\" name=\"wersja\" value=\"$info[version]\">
		";
echo "</form>";
mysql_close();
?>