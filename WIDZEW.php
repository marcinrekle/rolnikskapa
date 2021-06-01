<?php
include '../polacz.php';
include("../head.php");
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"widzew.css\">";
if (!isset($_COOKIE['WIDZEW'])){
	setcookie("WIDZEW","1");
	mysql_query("UPDATE WidzewLicznik SET count=count+1 WHERE id=1");
}else{
	
}

$s=['A1','A2','A2L','A3','A4','A5','A6','A7','A8','B1','B2','B3','B4','B5','B6','B7','B8','B9','B10','C1','C2','C3','C4','C5','C6','C7','C8','C9','D1','D2','D3','D4','D5','D6'];
$mecz='194';
echo"<div id=\"tresc\">\n";

foreach ($s as $i){
	$txt.="<iframe style=\"z-index:-1000\" id=\"$i\" src=\"http://www.rolnikskapa.cba.pl/WIDZEW/sektor.php?s=$i&e=$mecz\"></iframe> \n";	
	$divs.="<div id=\"s$i\" class=\"sektor\"></div>";
}
echo $txt;
echo "</div>";
//echo "<div id=\"cover\" style=\"\"><table><thead><tr><th>Sektor</th><th>Ilość</th></tr></thead><tbody></tbody></table></div>";
echo "<div id=\"cover\" style=\"\"><div id=\"A\"><div id=\"sA8\" class=\"sektor\"></div><div id=\"sA7\" class=\"sektor\"></div><div id=\"sA6\" class=\"sektor\"></div><div id=\"sA5\" class=\"sektor\"></div><div id=\"sA4\" class=\"sektor\"></div><div id=\"sA3\" class=\"sektor\"></div><div id=\"sA2A\" class=\"sektor\"><div id=\"sA2\" class=\"sektor\"></div><div id=\"sA2L\" class=\"sektor\"></div></div><div id=\"sA1\" class=\"sektor\"></div></div><div id=\"B\"><div id=\"sB10\" class=\"sektor\"></div><div id=\"sB9\" class=\"sektor\"></div><div id=\"sB8\" class=\"sektor\"></div><div id=\"sB7\" class=\"sektor\"></div><div id=\"sB6\" class=\"sektor\"></div><div id=\"sB5\" class=\"sektor\"></div><div id=\"sB4\" class=\"sektor\"></div><div id=\"sB3\" class=\"sektor\"></div><div id=\"sB2\" class=\"sektor\"></div><div id=\"sB1\" class=\"sektor\"></div></div><div id=\"C\"><div id=\"sC1\" class=\"sektor\"></div><div id=\"sC2\" class=\"sektor\"></div><div id=\"sC3\" class=\"sektor\"></div><div id=\"sC4\" class=\"sektor\"></div><div id=\"sC5\" class=\"sektor\"></div><div id=\"sC6\" class=\"sektor\"></div><div id=\"sC7\" class=\"sektor\"></div><div id=\"sC8\" class=\"sektor\"></div><div id=\"sC9\" class=\"sektor\"></div></div><div id=\"D\"><div id=\"sD1\" class=\"sektor\"></div><div id=\"sD2\" class=\"sektor\"></div><div id=\"sD3\" class=\"sektor\"></div><div id=\"sD4\" class=\"sektor\"></div><div id=\"sD5\" class=\"sektor\"></div><div id=\"sD6\" class=\"sektor\"></div></div><div id=\"sum\"></div></div>";
$count=mysql_fetch_array(mysql_query("SELECT count FROM WidzewLicznik WHERE id=1"));
echo "<div id=\"licznik\">Licznik odwiedzin:<br><span>$count[0]</span></div>";
echo "<div id=\"loading_dog\">Ładowanie <img src=\"loading_dog.gif\" /></div>";
echo "<script>

$(window).load(function(){
	  
    setTimeout(function(){count();},1000);
	setInterval(function(){reloadIframe();},600000);
});
		function count(){
		var totalCount = 0;
		var txt = '';
		//alert($(\"#A1\").contents().find(\"div:contains('Miejsca na mecz')\").text());
		$(\"iframe\").each(function(index){
			var id = $(this).attr(\"id\");
			var count = $(this).contents().find('td > img[src=\"./s_red.gif\"]').length;
			var countFree = $(this).contents().find('td > img[src=\"./s_free.gif\"]').length;
			var countAll = count + countFree;
			totalCount+=count;
			var tid = (id==\"A2\"|| id==\"A2L\")?\"\":id;
			$(\"#s\"+id).html(\"<span>\"+tid+\" </span><span>\"+count+\"</span><span>(\"+countAll+\")</span>\");
			$(\"#sum\").text(totalCount);
			//txt+='<tr><td>'+$(this).attr(\"id\")+'</td><td>'+count+'</td></tr>';
		});
//var count = $(\"#c2\").contents().find('td > img[src=\"./s_red.gif\"]').length+$(\"#c3\").contents().find('td > img[src=\"./s_red.gif\"]').length+$(\"#c4\").contents().find('td > img[src=\"./s_red.gif\"]').length+$(\"#c5\").contents().find('td > img[src=\"./s_red.gif\"]').length+$(\"#c6\").contents().find('td > img[src=\"./s_red.gif\"]').length+$(\"#c7\").contents().find('td > img[src=\"./s_red.gif\"]').length+$(\"#c8\").contents().find('td > img[src=\"./s_red.gif\"]').length;
	//var count = $(\"#c4\").contents().find('td > img[src=\"./s_red.gif\"]').length;
		//txt+='<tr><td><b>Razem:</b></td><td>'+totalCount+'</td></tr>';
		//$(\"tbody\").html(txt);
		$(\"#loading_dog\").fadeOut(); 
		setTimeout(function(){count();},60000);
}
		function reloadIframe(){
			$('iframe').each(function() {
  				this.contentWindow.location.reload(true);
			});
		}



</script>";



echo"\n</BODY>\n</HTML>";
?>