<?php
include '../polacz.php';
include("../head.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"widzew.css\">";
if (!isset($_COOKIE['WIDZEW'])){
	setcookie("WIDZEW","1",time()+3600*3);
	mysql_query("UPDATE WidzewLicznik SET count=count+1 WHERE id=1");
}
$s=['A8','A7','A6','A5','A4','A3','A2L','A2','A1','B9','B8','B7','B6','B5','B4','B3','B2','B1','C3','C4','C5','C6','C7','D1','D2','D3','D4','D5','D6'];
if(!empty($_REQUEST[m])){
		$temp = mysql_fetch_array(mysql_query("SELECT * FROM WidzewMecze WHERE id=$_GET[m]"));
	}else{
		$temp=mysql_fetch_array(mysql_query("SELECT * FROM `WidzewMecze` WHERE `data` >= CURDATE() ORDER BY `data` LIMIT 1;"));
	}
$mecz=$temp[0];
$rywal=$temp[1];
$data=$temp[2];
$ilosc = explode(",", $temp[3]);
//var_dump($temp[4]);
//$temp[4]=preg_replace(['/n/','/.(\d+)/','/f/','/r/','/b/','/t/','/e/'], ['<td>&nbsp;</td>','<td>$1</td>','<td><img src="./s_free.gif"></td>','<td><img src="./s_red.gif"></td>','<td><img src="./s_blank.gif"></td>','<tr>','</tr>'], $temp[4]);
//var_dump($temp[4]);
//$a=".t.n.n.n.1.2.3.f.f.f.e";
//var_dump($a);
//$a=preg_replace(['/\.n/','/\.(\d+)/','/\.f/','/\.r/','/\.b/','/\.t/','/\.e/'], ['<td>&nbsp;</td>','<td>$1</td>','<td><img src="./s_free.gif"></td>','<td><img src="./s_red.gif"></td>','<td><img src="./s_blank.gif"></td>','<tr>','</tr>'], $a);
//$a=preg_replace(['/.n/','/.(\d+)/','/.f/','/.t/','/.e/'], ['<td>&nbsp</td>','<td>$1</td>','<td><img src="./s_free.gif"></td>','<tr>','</tr>'], $a);
//echo "<table>$a</table>";
$temp[4]=preg_replace(['/\.n/','/\.(\d+)/','/\.f/','/\.r/','/\.b/','/\.t/','/\.e/'], ['<td>&nbsp;</td>','<td>$1</td>','<td><img src="./s_free.gif"></td>','<td><img src="./s_red.gif"></td>','<td><img src="./s_blank.gif"></td>','<tr>','</tr>'], $temp[4]);
//var_dump($temp[4]);
$schema = explode("|",$temp[4]);
echo"<div id=\"tresc\" style=\"display:none\">\n";
$licz=0;
$tab=0;
$divs="<div id=\"A\">";
foreach ($s as $i){
	$licz+=2;
	$table.="<table id=\"$i\"><tbody>".$schema[$tab]."</tbody></table>";
	$tab++;
	if($i=='A2')continue;
	//$txt.="<iframe style=\"z-index:-1000\" id=\"$i\" src=\"http://www.rolnikskapa.cba.pl/WIDZEW/sektor.php?s=$i&e=$mecz\"></iframe> \n";	
	if($i=='B9')$divs.="</div><div id=\"B\"><div id=\"sB10\" class=\"sektor\"></div>";
	if($i=='C3')$divs.="</div><div id=\"C\">";
	if($i=='D1')$divs.="</div><div id=\"D\">";
	if($i=='A2L'){
		$divs.="<div id=\"sA2A\" class=\"sektor\"><div id=\"sA2\" class=\"sektor\"><span></span><span>".$ilosc[$licz-1]."</span><span>($ilosc[$licz])</span></div><div id=\"sA2L\" class=\"sektor\"><span></span><span>".$ilosc[$licz+1]."</span><span>(".$ilosc[$licz+2].")</span></div></div>";
	}else{
		$divs.="<div id=\"s$i\" class=\"sektor\"><span>$i </span><span>".$ilosc[$licz-1]."</span><span>($ilosc[$licz])</span></div>";
	}
}
//echo $txt;
echo $table;
echo "</div>";
//var_dump($ilosc);

echo "<div id=\"title\"><h3>Ilo???? wykupionych bilet??w na mecz Widzew ????d?? -  $rywal</h3></div>";
echo "<div id=\"cover\" style=\"\">
		$divs
		</div><div id=\"sum\">$ilosc[59]</div>
		</div>";
$count=mysql_fetch_array(mysql_query("SELECT count FROM WidzewLicznik WHERE id=1"));
echo "<div id=\"licznik\">Licznik odwiedzin:<br><span>$count[0]</span></div>";
echo "<div id=\"loading_dog\" class=\"shadows\">??adowanie podgl??du sektor??w<img src=\"loading_dog.gif\" /></div>";
echo "<div id=\"help\"><span>Obja??nienia</span><ul><li>Strona przedstawia liczb?? widz??w na najbli??szym meczu domowym Widzewa z wyszczeg??lnieniem ilo??ci na poszczeg??lnych sektorach.</li><li> Opcjonalny parametr w postaci '?m=id_meczu' pozwala sprawdzi?? ilo???? na innych meczach,jednak nie wszystkie s?? dost??pne.</li><li> Dane przedstawione na stronie s?? obliczane na podstawie strony ks-widzew.pl/stadion/.</li><li> Zliczane s?? tzw. 'czerwone krzese??ka' czyli miejsca wykupione przez kibic??w. </li><li>Dane s?? aktualizowane co 5 minut.</li><li> Autor nie odpowiada za b????dy, ale ch??tnie je naprawi. </li><li>Kontakt : marcinrekle@gmail.com</li></ul></div>";
echo "<div id=\"view\" class=\"shadows\"><table></table></div>";
echo "<script>

$(document).ready(function(){
	var xy = $(\"#sB9\").offset();
	$(\"#view\").css({top:xy.top,left:xy.left+120});
	$(\"#loading_dog\").fadeOut();
	$(\"#cover\").on(\"mouseenter\",\".sektor\",function(){
		var id = $(this).attr(\"id\").substring(1);
		var pos = $(this).offset();
		$(\"table\",\"#view\").html($(\"#\"+id).html());
		$(\"#view\").fadeIn();
		
	});
	$(\"#cover\").on(\"mouseleave\",\".sektor\",function(){
		$(\"#view\").fadeOut();
	});
});
</script>";


mysql_close();
echo"\n</BODY>\n</HTML>";
?>