<?php
include("polacz.php");
$ile=mysql_fetch_array(mysql_query("SELECT MAX(ID) FROM news2011"));
$news=mysql_fetch_array(mysql_query("SELECT * FROM news2011 ORDER By id desc"));
$link_news="$_SESSION[bez]news/$news[7]/$news[15]/$news[1].html";
echo "<div id=\"wyd\">\n<img class=\"wyd_img\" src=\"$_SESSION[bez]$news[6]\" name=\"obrazek\"/>
\n<div class=\"wyd_tlo\"></div>\n<div class=\"wyd_tytul\">$news[4]</div>\n
<div class=\"wyd_opis\"><a href=\"$link_news\">$news[14] </a></div>
\n</div>";
echo "<div class=\"newsy\">\n<div class=\"tyt\">Starsze newsy</div>\n";
$zapytanie=mysql_query("SELECT * FROM news2011 WHERE id<$ile[0] ORDER by id desc limit 5");
while ($news = mysql_fetch_row($zapytanie)) {
	$link_news="$_SESSION[bez]news/$news[7]/$news[15]/$news[1].html";
	echo "<div class=\"newsy_news\">\n
	<a href=\"$link_news\">$news[5]</a>\n
	\n</div>";
}
echo "<div class=\"newsy_news\">\n<a href=\"$_SESSION[bez]news/archiwum.php\" style=\"text-align:right\">Archiwum</a>\n\n</div>\n</div>";
?>

<?php
$ile=mysql_num_fields(mysql_query("SELECT * FROM sonda"));
$f=($ile-2)/2;
$sonda=mysql_fetch_array(mysql_query("SELECT * FROM sonda"));
echo '<div class="panel">'."\n".'<div class="tyt">Sonda</div>'."\n".
'<div class="panel_sonda_pyt_txt">'.$sonda[1].'</div>'."\n".'<div class="panel_sonda_form"><form action="sonda.php" method="POST">';
for($i=1;$i<=$f;$i++){
echo'<input type="radio" name="odp" value="'.$i.'"';
if($i==1) echo ' checked ';
echo ' class="odp">'.$sonda[$i+1].'<br>';
$j=$i+1;
}
echo'<input type="submit" value="glosuj" class="btn">'."\n".'</form>'."\n".'</div>'."\n".'<div class="panel_sonda_wynik">'."\n";
$suma=0;
for($i=1;$i<=$f;$i++){
$suma+=$sonda[$j+$i];
}
for($i=1;$i<=$f;$i++){
if($sonda[$j+$i]==0 OR $suma==0) $wynik=0; else
$wynik=($sonda[$j+$i]*100)/$suma;
$wynik=round($wynik,1);
echo'<img src="PLIKI/sonda.gif" height="18px" width="'.$wynik.'px"> '.$wynik.'%('.$sonda[$j+$i].' głosów)<br>';
}
echo '</div'."\n".'></div>';
?>

