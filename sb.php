<?php
include 'polacz.php';
$l=3;
$ile=mysql_num_rows(mysql_query("SELECT * FROM mpshout")) or die("buu");
$ile+=2;
$query=mysql_query("SELECT * FROM mpshout order by shoutID desc")or die("buuu;(");
echo "<div id=\"SbText\">";
echo "<a href=\"javascript:SbScroll('up')\"><div class=\"SbUp btn\"></div></a>";
echo "<div class=\"SbTextDiv\"><hr>";
while ($row = mysql_fetch_row($query)) {
	$row[2] = str_replace(":(!","<img src='PLIKI/shout/beczy.gif' border='0'>",$row[2]);
	$row[2] = str_replace(":D","<img src='PLIKI/shout/_haha.gif' border='0'>",$row[2]);
	$row[2] = str_replace(":P","<img src='PLIKI/shout/jezyk.gif' border='0'>",$row[2]);
	$row[2] = str_replace(":)","<img src='PLIKI/shout/usmiech.gif' border='0'>",$row[2]);
	$row[2] = str_replace(":(","<img src='PLIKI/shout/bezradny.gif' border='0'>",$row[2]);
	echo "<span id=\"SbText$row[0]\" style=\"display:none;\"><b>$row[1]</b> <em>$row[3] $row[4]</em>
		<br>$row[2]<hr></span>";
}
echo "</div>";
echo "<a href=\"javascript:SbScroll('down')\"><div class=\"SbDown btn\"></div></a>";
	echo "</div>";
	echo "<span id=\"SbLicz\" style=\"display:none;\">$l</span>";
	echo "<span id=\"SbIle\" style=\"display:none;\">$ile</span>";
	echo "<div class=\"SbMes\">
	<form name=\"SbFormMess\" id=\"SbFormMess\" method=\"POST\">
	<textarea id=\"SbMessage\" name=\"SbMessage\"></textarea>
	<a href=\"javascript:SbSent()\"><div class=\"SbSent btn\"></div></a>
	<input type=\"hidden\" name=\"nick\" value=\"$_SESSION[nick]\">
	<div class=\"SbEmo\">
	<a href=\"javascript:SbEmoDod(':(!')\"><img src=\"PLIKI/shout/beczy.gif\" /></a>
	<a href=\"javascript:SbEmoDod(':D')\"><img src=\"PLIKI/shout/usmiech.gif\" /></a>
	<a href=\"javascript:SbEmoDod(':P')\"><img src=\"PLIKI/shout/jezyk.gif\" /></a>
	<a href=\"javascript:SbEmoDod(':)')\"><img src=\"PLIKI/shout/bezradny.gif\" /></a>
	<a href=\"javascript:SbEmoDod(':(')\"><img src=\"PLIKI/shout/_haha.gif\" /></a>
	</div>
	";
	echo "</form></div>";
?>