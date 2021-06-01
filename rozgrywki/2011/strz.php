<?php 
include'../../head.php';
include $_SESSION['adres'].'polacz.php';
include $_SESSION['adres'].'funkcje.php';
if ($_GET['sort']=="4") $sort="bk+pp+s DESC,bk DESC,pp DESC, s DESC";
elseif ($_GET['sort']=="1") $sort="bk DESC";
elseif ($_GET['sort']=="2") $sort="pp DESC";
elseif ($_GET['sort']=="3") $sort="s DESC";
echo "<tr>"."\n".'<th>lp</th>'."\n".'<th>Zawodnik</th>'."\n".'<th>
<a href="javascript:sort_strzelcy(1)">B klasa</a></th>'
."\n".'<th><a href="javascript:sort_strzelcy(2)">Puchar Polski</a></th>'
."\n".'<th><a href="javascript:sort_strzelcy(3)">Sparingi</a></th>'
."\n".'<th><a href="javascript:sort_strzelcy(4)">Razem</a></th>'."\n".'</tr>';
$dane=mysql_query("SELECT * FROM strzelcy1112 where bk+pp+s > 0 ORDER by $sort");
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