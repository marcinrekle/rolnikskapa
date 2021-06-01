<?php
include'head.php';
include 'polacz.php';
include 'funkcje.php';
echo "<script type=\"text/javascript\" src=\"$_SESSION[bez]editTable.js\"></script>";

echo "<div id=\"operations\"><button id=\"oblTab\">Oblicz tabele ligową</button>
		<button id=\"oblTabTyp\">Oblicz tabele typerów</button><button id=\"goHome\">Strona główna</button></div><div id=\"accordion\">";
showTable("druzyny");
showTable("kadra");
showTable("kalendarz");
showTable("mecze1314");
showTable("news2011");
showTable("strzelcy1314");
showTable("tabela1314");
showTable("uzytkownik");

function showTable($table){
	/**
	echo "<table id=\"editStrzelcy\">";
	echo "<tr>"."\n".'<th>lp</th>'."\n".'<th>Zawodnik</th>'."\n".'<th>
	<a href="javascript:sort_strzelcy(1)">Liga</a></th>'
	."\n".'<th>Puchar Polski</th>'
	."\n".'<th>Sparingi</th>'
	."\n".'<th>Razem</th>'."\n".'</tr>';
	$dane=mysql_query("SELECT * FROM strzelcy1314");

	$i=0;
	while ($r=mysql_fetch_row($dane)) {
		$i+=1;
		$gracz=pobierz("*", "kadra", "id", $r[1]);
		$suma=$r[2]+$r[3]+$r[4];
		echo "<tr id=\"$gracz[0]\">\n<td>$i</td>\n<td style=\"text-align:left\">
		$gracz[1] $gracz[2]</td>\n<td class=\"bk\"><a href=\"#\">-</a> $r[2] <a href=\"#
		\">+</a></td>\n<td class=\"pp\"><a href=\"#
		\">-</a> $r[3] <a href=\"#
		\">+</a></td>\n
		<td class=\"s\"><a href=\"#
		\">-</a> $r[4]<a href=\"#
		\">+</a></td>\n<td>$suma</td>\n</tr>\n";
	}
	echo "</table>\n";
	*/
	//$result=mysql_query("SELECT * FROM $table");
	//echo "<div id=\"$r[0]\">";
	//while ($r=mysql_fetch_row($result)) {
	
		//echo "$r[1] $r[2] <a href=\"#\" class=\"btn_dodaj\" gid=\"$r[0]\"> &nbsp &nbsp &nbsp &nbsp</a>\n<br>";
	
	//}
	//echo "</div>";
	echo "<div class=\"tyt\">$table</div>";
	$result=mysql_query("SELECT * FROM $table");
	$i = 0;
	$tab[0];
	$count=mysql_num_fields($result);
	echo "<div><div class=\"add\">Dodaj</div><table id=\"$table\"><tr>";
	while ($i < $count) {
		$meta = mysql_fetch_field($result, $i);
		$nn=($meta->not_null==1?"not_null":"");
    	echo "<th title=\"$meta->type\" class=\"$nn\">$meta->name</th>";
    	$tab[$i]=$meta->type;
		$i++;
	}
	echo "<th>opcje</th></tr>";
	while($row=mysql_fetch_row($result)){
		$i=0;
		echo "<tr>";
		while($i<$count){
			echo "<td class=\"$tab[$i] $nn\">$row[$i]</td>";
			$i++;
		}
		echo"<td><a href=\"#\" class=\"delete\">usuń</a></td></tr>";
	}
	echo "</table></div>";

}
echo "</div>";
?>

<img id="loading" src="../../PLIKI/loading.gif" style="display:none;width:24px;height:24px;border:1px solid black;border-left:0;">
<div class="cText" style="display:none;position:absolute;z-index:999;background:rgba(0,0,0,.8);"></div>
<textarea style="border-color:black;display:none;" class="text"></textarea>
<div id="message" style="display: none"><span>Wiadomość</span></div>
<div id="newRow" style="display:none;"></div>
<input type="text" class="dateP" style="display:none;">