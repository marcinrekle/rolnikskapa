<!--HEADER-->
<?php
include'../../head.php';
?>
<!--/HEADER-->

<DIV id="naglowek"><?php
include($_SESSION['adres']."naglowek.php");
?></DIV>

<div id="lewy_bok"><?php
include($_SESSION['adres']."lewy.php");
?></div>

<div id="tresc">
<div class="panel">
<div class="tyt">Strzelcy Rolnika w obecnym sezonie</div>
<table id="strzelcy" rules="rows" style="padding: 5px">
<?php 
include $_SESSION['adres'].'polacz.php';
include $_SESSION['adres'].'funkcje.php';

echo "<tr>"."\n".'<th>lp</th>'."\n".'<th>Zawodnik</th>'."\n".'<th>
<a href="javascript:sort_strzelcy(1)">B klasa</a></th>'
."\n".'<th><a href="javascript:sort_strzelcy(2)">Puchar Polski</a></th>'
."\n".'<th><a href="javascript:sort_strzelcy(3)">Sparingi</a></th>'
."\n".'<th><a href="javascript:sort_strzelcy(4)">Razem</a></th>'."\n".'</tr>';
$dane=mysql_query("SELECT * FROM strzelcy1112 ORDER by bk+pp+s DESC,bk DESC,pp DESC, s DESC");
$i=0;
while ($r=mysql_fetch_row($dane)) {
	$i+=1;
	$gracz=pobierz("*", "kadra", "id", $r[1]);
	$suma=$r[2]+$r[3]+$r[4];
	echo '<tr>'."\n"."<td>".$i."</td>"."\n".'<td style="text-align:left">'.
	$gracz[1].' '.$gracz[2]."</td>"."\n"."<td>$r[2]</td>\n<td>$r[3]</td>\n
	<td>$r[4]</td>\n<td>".$suma."</td>\n</tr>";
}
?>
</table>
<p>Kliknięcie w nazwę kolumny spowoduję posortowanie tabeli według tej kolumny</span>
</div>
</div>

<div id="prawy_bok"><?php
include($_SESSION['adres']."prawy.php");
?></div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
