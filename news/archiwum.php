<!--HEADER-->
<?php
include("../head.php");
?>
<!--/HEADER-->

<DIV id="naglowek">
<?php
include("../naglowek.php");
?>
</DIV>
<div id="lewy_bok">
<?php
include("../lewy.php");
?>
</div>
<div id="tresc">
<?php
include '../polacz.php';
include '../funkcje.php';
$query=mysql_query("SELECT * FROM news2011 order by id desc");
$rok='0';
$m='0';
echo"<div class=\"archiwum\">\n
<div class=\"tyt\">Archiwum newsów</div>
<div class=\"content\">\n";
while ($row=mysql_fetch_row($query)) {
	$data=explode(" ", $row[3]);
	$data2=explode("-", $data[0]);
	if ($rok<>$data2[0]) {
		if($rok=='0')echo "<b>Rok ".$data2[0]."</b><ul>";else
		echo "</ul><br><b>Rok ".$data2[0]."</b><br><br><ul>";
		$rok=$data2[0];
	}
	if ($m<>$data2[1]) {
		if($m=='0')echo "<li>".jaki_mies($data2[1])."\n<ul>";else 
		echo "</ul>\n</li>\n<li>".jaki_mies($data2[1])."\n<ul>";
		$m=$data2[1];
	}
	$link_news="$_SESSION[bez]news/$row[7]/$row[15]/$row[1].html";
	echo "<li><a href=\"$link_news\">$row[5]</a></li>";	
}
echo"</li></ul></div>\n</div>";
mysql_close();
?>
</div>
<div id="prawy_bok"><?php
include("../prawy.php");
?></div>
</BODY>
</HTML>
<!--/FOOTER-->
