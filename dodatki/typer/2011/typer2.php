<!--HEADER-->
<?php
include($_SESSION['adres']."head.php");
?>
<!--/HEADER-->

<DIV id="naglowek"><?php
include($_SESSION['adres']."naglowek.php");
?></DIV>

<div id="lewy_bok"><?php
include($_SESSION['adres']."lewy.php");
?></div>

<div id="tresc">
<div class="typer">
<div class="tyt">Typer</div>

<?php
include $_SESSION['adres'].'polacz.php';
include $_SESSION['adres'].'funkcje.php';
$sezon="2011/12";
//echo '<div class="terminarz">'."\n".'<div class="t_tytul">Typer sezonu '.$sezon.'</div>'."\n";
$dane=mysql_query("SELECT * FROM mecze11_12");
$kolejka=1;
echo'<table rules="rows" class="typer">
      <tr><th>Data</th><th>Godz</th><th>Mecz</th><th>Typ</th><th>Wynik</th><th>Pkt</th></tr>'."\n".'<tr><th colspan="6">1 Kolejka</th></tr>'."\n";
while ($r=mysql_fetch_row($dane)) {
	$typ=mysql_fetch_array(mysql_query("SELECT * FROM typer1112 WHERE id_m='".$r[0]."' AND id_uz='1'"));
	if ($kolejka<>$r[1]) {
		echo '<tr><th colspan="6">'.$r[1].' Kolejka</th></tr>'."\n";
		$kolejka=$r[1];
	}
	echo
	'<tr><td>'.data($r[2], "-", " ").'</td>'."\n".
	'<td>'.godz($r[3]).'</td>'."\n".
	'<td>'.pobierz("nazwa", "druzyny","id",$r[4]).
	' - '.pobierz("nazwa", "druzyny","id",$r[5]).'</td>'."\n";
	$d=explode("-",$r[2]);//data
	$g=explode(":",$r[3]);//godzina
	$c_m=make_time($d[0], $d[1], $d[2], $g[0], $g[1], $g[2]);
	if ($c_m>now()&& $typ[3]=!NULL){
		$cmt='<a href="javascript:pokaz_typuj('.$r[0].')">'.$typ[3].'</a>';
	}elseif ($c_m<now()&& $typ[3]=!NULL) $cmt=$typ[3];elseif ($c_m>now()&& $typ[3]==NULL)
	$cmt='<a href="javascript:pokaz_typuj('.$r[0].')">typuj</a>';elseif ($c_m<now()&& $typ[3]==NULL) $cmt='NT';
	echo '<td>'.$cmt.'</td>'."\n".
	'<td>'.$r[6].'</td>'."\n";
	if ($typ==NULL) $pkt="-";
	elseif ($typ[3]==$r[6]) $pkt=10;else $pkt=0;
	$t1=explode(":",$typ[3]);
	$w1=explode(":",$r[6]);
	if ((($t1[0]>$t1[1])&&($w1[0]>$w1[1])) || (($t1[0]<$t1[1])&&($w1[0]<$w1[1])) || (($t1[0]==$t1[1])&&($w1[0]==$w1[1]))) $pkt=$pkt+1;
	echo '<td>'.$pkt.'</td></tr>'."\n";
}
	echo "</table>";
	?></div>
</div>

<div id="prawy_bok"><?php
include("../../prawy.php");
?></div>
</BODY>
</HTML>