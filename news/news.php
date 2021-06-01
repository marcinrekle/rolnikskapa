<?php
include("../head.php");
ECHO"<DIV id=\"naglowek\">";
include("$_SESSION[adres]naglowek.php");
ECHO"</DIV>";
echo"<div id=\"lewy_bok\">";
include("$_SESSION[adres]lewy.php");
echo"</div>";
include ("../polacz.php");
$news=mysql_fetch_array(mysql_query("SELECT * FROM news2011 WHERE url='$_GET[tyt]' AND sezon='$_GET[rok]'"));
if (!isset($_COOKIE['read'.$news[0]])){
	setcookie("read".$news[0],"1",time()+3600*24);
	mysql_query("UPDATE licznik SET value=value+1 WHERE id=$news[0]");
}
$czytano = mysql_fetch_array(mysql_query("SELECT value FROM licznik WHERE id = $news[0]"));
echo"<div id=\"tresc\">\n<div class=\"opis_meczu\">";
echo"<div class=\"autor\">$news[2], $news[3] , czytano: $czytano[0] raz(y)</div>";
if($news[1]<>NULL) echo "<img class=\"opis_meczu_img\"
	src=\"$_SESSION[bez]$news[6]\" />\n";
$txt=htmlkarakter($news[9]);
echo "$txt\n";
echo "<div class=\"fb-like\" data-href=\"http://www.rolnikskapa.cba.pl/news/$_GET[rok]/$_GET[roz]/$_GET[tyt].html\" data-width=\"150\" data-layout=\"button_count\" data-show-faces=\"false\" data-send=\"true\"></div>\n";
echo "<div class=\"fb-follow\" data-href=\"https://www.facebook.com/pages/LZS-Rolnik-Sk%C4%85pa/415896048508624\" data-width=\"150\" data-layout=\"button_count\" data-show-faces=\"false\"></div>";
echo "<a class=\"fb-share-link\" href=\"#\" onclick=\"
    window.open(
      'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
      'facebook-share-dialog', 
      'width=626,height=436'); 
    return false;\">Udostępnij</a>";
for ($i = 10; $i < 14; $i++) {
	$txt=htmlkarakter($news[$i]);
	echo "$txt\n";	
}
echo "<div id=\"kom_content\">";
include '../komentarz2.php';
echo"</div>\n</div>\n</div></div>";

echo"<div id=\"prawy_bok\">";
include("$_SESSION[adres]prawy.php");
echo"</div>\n</BODY>\n</HTML>";
function htmlkarakter($string) 
{ 
   $string = str_replace(array("&lt;", "&gt;", '&amp;', '&#039;', '&quot;','&lt;', '&gt;'), array("<", ">",'&','\'','"','<','>'), htmlspecialchars_decode($string, ENT_NOQUOTES)); 
	return $string; 
} 
mysql_close();
?>