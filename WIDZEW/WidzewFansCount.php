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
foreach ($s as $i){
	$txt.="<iframe style=\"z-index:-1000\" id=\"$i\" src=\"http://www.rolnikskapa.cba.pl/WIDZEW/sektor.php?s=$i&e=$mecz\"></iframe> \n";	
}
echo $txt;
echo "</div>";
//echo "<div id=\"test\"></div>";
echo "<script>

$(window).load(function(){
    setTimeout(function(){count();},1000);
});
		function count(){
		totalCount = 0;
		var txt = '0';
		var sector = '';
		$(\"iframe\").each(function(index){
			var count = $(this).contents().find('td > img[src=\"./s_red.gif\"]').length;
			var countFree = $(this).contents().find('td > img[src=\"./s_free.gif\"]').length;
			var countAll = count + countFree;
			totalCount+=count;
			txt+=','+count+','+countAll;
			$(\"td,img\",$(this).contents()).removeAttr(\"style border hspace vspace\");
			var people = $(\"tbody\",$(this).contents()).html();
			people = typeof people!=='undefined'? people.replace(/<td>\&nbsp;<\/td>/g, \".n\").replace(/<td>(\d+)<\/td>/g,\".$1\").replace(/<td><img src=\".\/s_free.gif\"><\/td>/g,\".f\").replace(/<td><img src=\".\/s_red.gif\"><\/td>/g,\".r\").replace(/<td><img src=\".\/s_blank.gif\"><\/td>/g,\".b\").replace(/<tr>/g, \".t\").replace(/<\/tr>/g, \".e\"):'';
			sector+='|'+people;
		});
		txt+=','+totalCount;
		sector = sector.replace(\"|\",\"\");
		//var people = $(\"tbody\",$(\"#A1\").contents()).html();
		//alert(test);
		//test = test.replace(/<td>\&nbsp;<\/td>/g, \"n\").replace(/<td>(\d+)<\/td>/g,\".$1\").replace(/<td><img src=\".\/s_free.gif\"><\/td>/g,\"f\").replace(/<td><img src=\".\/s_red.gif\"><\/td>/g,\"r\").replace(/<td><img src=\".\/s_blank.gif\"><\/td>/g,\"b\").replace(/<tr>/g, \"t\").replace(/<\/tr>/g, \"e\");
		//alert(sector);
		//$(\"#test\").text(txt);
		
		$.post( \"saveToDb.php\", { id: \"$temp[id]\", ilosc: txt, schema : sector } );
	}

</script>";

mysql_query("UPDATE WidzewLicznik SET count=count+1 WHERE id=2");
mysql_close();
echo"\n</BODY>\n</HTML>";
?>