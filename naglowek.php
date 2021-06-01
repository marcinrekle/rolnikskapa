<?php
echo "<div id=\"fb-root\"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = \"//connect.facebook.net/pl_PL/all.js#xfbml=1\";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><div id=\"fb-lb\"><a href=\"https://www.facebook.com/pages/LZS-Rolnik-Sk%C4%85pa/415896048508624\"><img src=\"".$_SESSION[bez]."PLIKI/fb3-right.png\" alt=\"\"></a><div class=\"fb-like-box\" data-href=\"https://www.facebook.com/pages/LZS-Rolnik-Sk%C4%85pa/415896048508624\" data-width=\"292\" data-show-faces=\"true\" data-header=\"true\" data-stream=\"true\" data-show-border=\"true\"></div></div>";
echo '<a href="'.$_SESSION['bez'].'index.php"><div class="nag_a"></div></a>';
include("polacz.php");
$dane=mysql_query("Select * from mecze1314 where wynik>'' ORDER by id DESC LIMIT 7");
$text='Wyniki ostatniej kolejki: ';
while ($r=mysql_fetch_array($dane)) {
	$nazwa1=mysql_fetch_array(mysql_query("Select * from druzyny where id='".$r[id_h]."'"));
	$nazwa2=mysql_fetch_array(mysql_query("Select * from druzyny where id='".$r[id_a]."'"));
	$text.=$nazwa1[1].' - '.$nazwa2[1].' '.$r[wynik]." | \n";
}
if ($text=='Wyniki ostatniej kolejki: ') {
	$text='';
}
$text.=' Pary następnej kolejki: ';
$dane=mysql_query("Select * from mecze1314 where wynik='' ORDER by id LIMIT 7");
while ($r=mysql_fetch_array($dane)) {
	$nazwa1=mysql_fetch_array(mysql_query("Select * from druzyny where id='".$r[id_h]."'"));
	$nazwa2=mysql_fetch_array(mysql_query("Select * from druzyny where id='".$r[id_a]."'"));
	$text.=$nazwa1[1].' - '.$nazwa2[1].' '.$r[wynik]." | \n ";
}
echo '<MARQUEE style="color:white" class="mar" ALIGN="MIDDLE" DIRECTION="LEFT" BEHAVIOR="SCROLL"  SCROLLAMOUNT="2" SCROLLDELAY="1" LOOP="0">'.$text.' </MARQUEE>';
mysql_close();
?>
