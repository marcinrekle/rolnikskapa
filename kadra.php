<!--HEADER-->
<?php
include("head.php");
?>
<!--/HEADER-->
<DIV id="naglowek">
<?php
include("naglowek.php");
?>
</DIV>

<div id="lewy_bok">
     <?php
     include("lewy.php");
     ?>
</div>

<div id="tresc">
<div class="kadra"><div class="tyt">Kadra</div>
<?php
include 'polacz.php';
include 'funkcje.php';
$dane=mysql_query("SELECT * FROM kadra WHERE kol_wys<>0 ORDER by kol_wys");
$i=0;
while ($gracz=mysql_fetch_row($dane)) {
	$i++;
	if($i%2==0) $panel='panel2';else $panel='panel'; 
	if($gracz[3]==null) $gracz[3]='-';
	echo '<div class="'.$panel.'">'."\n".'<div class="panel_text">'."\n".'<div class="text">'.$gracz[1].'</div><div class="text">'.$gracz[2].'</div>'."\n".'<div class="text">'.$gracz[3].'</div><div class="text">'.$gracz[6].'</div>'."\n".'<div class="text">'.$gracz[4].'</div><div class="text">'.$gracz[5].'</div>'."\n".'</div>'."\n".'<div class="panel_foto"><img src="PLIKI/kadra/'.$gracz[9].'" /></div>'."\n".'</div>'."\n";
}
mysql_close();
?>
</div>
</div>
<div id="prawy_bok">
     <?php
     include("prawy.php");
     ?>
</div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
