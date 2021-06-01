<?php

include '../../polacz.php';
include '../../funkcje.php';
if ($_GET[ins]==1) {
	insert("strzelcy1213", "id,id_z,bk,pp,s", "null,'$_GET[id]','0','0','0'");
}
if ($_GET[id]<>'' && $_GET[roz]<>'') {
	$roz=$_GET[roz];
	$gracz=pobierz("*", "strzelcy1213", "id_z", $_GET[id]);
	if ($_GET[znak]==1) {
		$gracz[$roz]+=1;
	}else $gracz[$roz]-=1;
	update("strzelcy1213", "$roz=$gracz[$roz]", "id_z=$_GET[id]");
}
echo "<table>";
echo "<tr>"."\n".'<th>lp</th>'."\n".'<th>Zawodnik</th>'."\n".'<th>
<a href="javascript:sort_strzelcy(1)">B klasa</a></th>'
."\n".'<th><a href="javascript:sort_strzelcy(2)">Puchar Polski</a></th>'
."\n".'<th><a href="javascript:sort_strzelcy(3)">Sparingi</a></th>'
."\n".'<th><a href="javascript:sort_strzelcy(4)">Razem</a></th>'."\n".'</tr>';
$dane=mysql_query("SELECT * FROM strzelcy1213");

$i=0;
while ($r=mysql_fetch_row($dane)) {
	$i+=1;
	$gracz=pobierz("*", "kadra", "id", $r[1]);
	$suma=$r[2]+$r[3]+$r[4];
	echo "<tr>\n<td>$i</td>\n<td style=\"text-align:left\">
	$gracz[1] $gracz[2]</td>\n<td><a href=\"javascript:dodajBramke('bk',$gracz[0],2)
	\">-</a> $r[2] <a href=\"javascript:dodajBramke('bk',$gracz[0],1)
	\">+</a></td>\n<td><a href=\"javascript:dodajBramke('pp',$gracz[0],2)
	\">-</a> $r[3] <a href=\"javascript:dodajBramke('pp',$gracz[0],1)
	\">+</a></td>\n
	<td><a href=\"javascript:dodajBramke('s',$gracz[0],2)
	\">-</a> $r[4]<a href=\"javascript:dodajBramke('s',$gracz[0],1)
	\">+</a></td>\n<td>$suma</td>\n</tr>\n";
}
echo "</table>\n";
$dane=mysql_query("SELECT * FROM kadra");
while ($r=mysql_fetch_row($dane)) {
	echo "$r[1] $r[2] <a href=\"javascript:dodajStrzelca($r[0])\" class=\"btn_dodaj\"> &nbsp &nbsp &nbsp &nbsp</a>\n<br>";
}

?>