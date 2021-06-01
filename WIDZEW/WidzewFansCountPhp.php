<?php
include '../polacz.php';
include("../head.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"widzew.css\">";
$s=['A8','A7','A6','A5','A4','A3','A2L','A2','A1','B9','B8','B7','B6','B5','B4','B3','B2','B1','C3','C4','C5','C6','C7','D1','D2','D3','D4','D5','D6'];//caly stadion
//$s=['A8','A7','A6','A5','A4','A3','A2L','A2','A1','C3','C4','C5','C6','C7'];//tylko A i C
if(!empty($_REQUEST[m])){
		$temp = mysql_fetch_array(mysql_query("SELECT * FROM WidzewMecze WHERE id=$_GET[m]"));
	}else{
		$temp=mysql_fetch_array(mysql_query("SELECT * FROM `WidzewMecze` WHERE `data` >= CURDATE()- INTERVAL 1 HOUR ORDER BY `data` LIMIT 1;"));
	}
$mecz=$temp[0];
$rywal=$temp[1];
$data=$temp[2];
echo"<div id=\"tresc\">\n";
$totalCount = 0;
$txt = '0';
$tables = '';
foreach ($s as $i){
	$sektor =file_get_contents("https://www.ks-widzew.pl/stadion/?s=$i&e=$mecz");
	$sektor=str_replace([' style="font-size: 8pt; text-align: center;"',' style="text-align: right;"',' hspace="1"',' vspace="1"',' border="0"'],['','','','',''],$sektor);
	$start=strpos($sektor, "<table>")+7;
	$stop=strpos($sektor, "</table>");
	$sektor = substr($sektor, $start,$stop-$start);
	$sektor = preg_replace("/<td>(\d+)<\/td>/", ".$1", $sektor);
	$search = ['<td><img src="./s_free.gif" ></td>','<td><img src="./s_red.gif" ></td>','<td><img src="./s_blank.gif" ></td>','<td>&nbsp;</td>','<tr>','</tr>'];
	$replace = ['.f','.r','.b','.n','.t','.e'];
	$sektor = str_replace ($search, $replace, "$sektor");
	$count = substr_count($sektor,'.r');
	$countFree = substr_count($sektor,'.f');
	$countAll = $count + $countFree;
	$totalCount+=$count;
	$txt.=",$count,$countAll";
	$tables.="|$sektor";
}
$txt.=",$totalCount";
echo $txt."<br/>$tables<br/>";
echo "UPDATE WidzewMecze SET ilosc = '$txt',fans='$tables' WHERE id=$mecz";
echo "</div>";

mysql_query("UPDATE WidzewMecze SET ilosc = '$txt',fans='$tables' WHERE id=$mecz") or die("Błąd : ".mysql_error());
//mysql_query("UPDATE WidzewLicznik SET count=count+1 WHERE id=3");
//mysql_query("UPDATE WidzewLicznik SET count=count+1 WHERE id=2");
mysql_close();
echo"\n</BODY>\n</HTML>";
?>