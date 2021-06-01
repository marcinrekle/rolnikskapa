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
echo"<div id=\"tresc\">\n";
//echo "temp3=$temp[3]";
$licz=0;
$divs="<div id=\"A\">";
foreach ($s as $i){
	$licz+=2;
	if($i=='A2')continue;
	$txt.="<iframe style=\"z-index:-1000\" id=\"$i\" src=\"http://www.rolnikskapa.cba.pl/WIDZEW/sektor.php?s=$i&e=$mecz\"></iframe> \n";	
	if($i=='B9')$divs.="</div><div id=\"B\"><div id=\"sB10\" class=\"sektor\"></div>";
	if($i=='C3')$divs.="</div><div id=\"C\">";
	if($i=='D1')$divs.="</div><div id=\"D\">";
	if($i=='A2L'){
		$divs.="<div id=\"sA2A\" class=\"sektor\"><div id=\"sA2\" class=\"sektor\"><span></span><span>".$ilosc[$licz-1]."</span><span>($ilosc[$licz])</span></div><div id=\"sA2L\" class=\"sektor\"><span></span><span>".$ilosc[$licz+1]."</span><span>(".$ilosc[$licz+2].")</span></div></div>";
	}else{
		$divs.="<div id=\"s$i\" class=\"sektor\"><span>$i </span><span>".$ilosc[$licz-1]."</span><span>($ilosc[$licz])</span></div>";
	}
}
echo $txt;
echo "</div>";
//var_dump($ilosc);
$tmp="0,230,230,25,114,90,127,230,230,97,224,160,240,96,224,136,229,41,330,56,
		124,8,270,170,203,207,300,54,285,102,
		285,71,270,19,225,9,210,526,532,162,
		540,251,540,232,494,98,299,50,326,176,
		190,113,285,105,285,7,190,6,190,0,
		0,3527";

//echo "<div id=\"cover\" style=\"\"><table><thead><tr><th>Sektor</th><th>Ilość</th></tr></thead><tbody></tbody></table></div>";
echo "<div id=\"title\"><h3>Ilość wykupionych biletów na mecz Widzew Łódź -  $rywal</h3></div>";
echo "<div id=\"cover\" style=\"\">
		$divs
		</div><div id=\"sum\">$ilosc[59]</div>
		</div>";
$count=mysql_fetch_array(mysql_query("SELECT count FROM WidzewLicznik WHERE id=1"));
echo "<div id=\"licznik\">Licznik odwiedzin:<br><span>$count[0]</span></div>";
echo "<div id=\"loading_dog\" class=\"shadows\">Ładowanie podglądu sektorów<img src=\"loading_dog.gif\" /></div>";
echo "<div id=\"view\" class=\"shadows\"><table></table></div>";
echo "<script>

$(window).load(function(){
	var xy = $(\"#sB9\").offset();
	$(\"#view\").css({top:xy.top,left:xy.left+120});  
});
	$(\"#cover\").on(\"mouseenter\",\".sektor\",function(){
		var id = $(this).attr(\"id\").substring(1);
		var pos = $(this).offset();
		$(\"table\",\"#view\").html($(\"table\",$(\"#\"+id).contents()).html());
		$(\"#view\").fadeIn();
		
	});
	$(\"#cover\").on(\"mouseleave\",\".sektor\",function(){
		$(\"#view\").fadeOut();
	});

</script>";


mysql_close();
echo"\n</BODY>\n</HTML>";
?>