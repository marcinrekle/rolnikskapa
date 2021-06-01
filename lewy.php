<div id="menu"><?php
include("polacz.php");
echo
     '<dl>
         <dt>Klub</dt>
         <dd><a href="'.$_SESSION['bez'].'historia.php">Historia</a></dd>
         <dd><a href="'.$_SESSION['bez'].'wladze.php">Władze</a></dd>
         <dd><a href="'.$_SESSION['bez'].'stadion.php">Stadion</a></dd>
         <dd><a href="'.$_SESSION['bez'].'kadra.php">Kadra</a></dd>
         <dt>Rozgrywki</dt>
         <dd><a href="'.$_SESSION['bez'].'rozgrywki/1314/terminarz.html">Terminarz</a></dd>
         <dd><a href="'.$_SESSION['bez'].'rozgrywki/1314/tabela.html">Tabela</a></dd>
         <dd><a href="'.$_SESSION['bez'].'rozgrywki/1314/strzelcy.html">Strzelcy</a></dd>
         <dt>Rozrywka</dt>
         <dd><a href="'.$_SESSION['bez'].'galeria.php">Galeria</a></dd>
         <dd><a href="'.$_SESSION['bez'].'dodatki/typer/1314/typer.html">Typer</a></dd>
         <dd><a href="'.$_SESSION['bez'].'kontakt.php">Kontakt</a></dd>
     </dl>

     </div>
     <div class="panel">
     <div class="tyt">Licznik odwiedzin</div>';
if (!isset($_COOKIE['licznik'])){
	setcookie("licznik","1",time()+3600*3);
	mysql_query("UPDATE licznik SET value=value+1 WHERE id=1");
}
$ile=mysql_fetch_array(mysql_query("SELECT value FROM licznik WHERE id=1"));
echo "<div class=\"licznik\">";
echo $ile[0];
echo "</div>\n</div>";

function opis($data){
	$r=mysql_fetch_array(mysql_query("SELECT * from kalendarz where data='".$data."'"));
	return $r;
}//opis
function opis2($data2){
	$a=explode('-',$data2);
	echo $a[2];
	$ur=mysq_fetch_array(mysql_query("SELECT * FROM `kadra` WHERE MONTH(d_ur) = '".$a[1]."' AND DAY(d_ur) = '".$a[2]."'"));

}//opis2

?> <?php
echo '<div class="panel">'."\n".'
	<div class="tyt">Kalendarz</div>'."\n".'<table class="kalendarz">';
for ($i=0;$i<6;$i++){
	$dzien = date("d.m.Y",mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
	echo '<tr><th colspan="2"><b>'.$dzien.'</b></th></tr>'."\n";
	$data = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+$i, date("Y")));
	$r=mysql_fetch_array(mysql_query("SELECT * from kalendarz where data='".$data."'"));
	if (!empty($r)){
		$g=explode(":", $r[2]);
		echo '<tr><td><img src="'.$_SESSION['bez'].'PLIKI/'.$r[3].'.gif"></td><td><b>'.$r[4]."</b><br>".$g[0].":".$g[1].'</td></tr>';
	}//if
	$data2 = date("md",mktime(0, 0, 0, date("m")  , date("d")+$i, 0));
	$ur=mysql_fetch_array(mysql_query('SELECT * FROM kadra WHERE DATE_FORMAT(d_ur,"%m-%d")=DATE_FORMAT('.$data2.',"%m-%d")'));
	if (!empty($ur)){
		$rok=explode("-", $ur[3]);
		$wiek=date("Y")-$rok[0];
		echo '<tr><td><img src="'.$_SESSION['bez'].'PLIKI/urodziny.gif"></td><td><b>'.$ur[1]." ".$ur[2]."</b><br>".$wiek.'</td></tr>';
	}//if
	$bk=mysql_fetch_array(mysql_query("SELECT * FROM mecze1314 WHERE DATE_FORMAT(data,\"%m-%d\")=DATE_FORMAT($data2,\"%m-%d\") && (id_h='1' or id_a='1') && (id_h<>'17' or id_a<>'17')"));
	if (!empty($bk)){
		if($bk[id_h]==1){
			$t1[0]='vs ';
			$t2=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id=$bk[id_a]"));
		}
		else {
			$t2[0]=' vs';
			$t1=mysql_fetch_array(mysql_query("SELECT nazwa FROM druzyny WHERE id=$bk[id_h]"));
		}
		$date = strtotime($bk[data]);
		$godz=date("H:i",$date);
		echo "<tr><td><img src=\"$_SESSION[bez]PLIKI/liga.gif\"></td><td><b>$t1[0] $t2[0]</b><br> $godz </td></tr>";
			
	}//if
}//for

echo "\n"."</table>"."\n"."</div>";
?>

<div class="panel ps">
<div class="tyt">Podobne strony</div>
<table>
	<tr>
		<td><a href="http://sieradzkifutbol.com.pl/">sieradzkifutbol.com.pl</a></td>	
	</tr>
	<tr>
		<td><a href="http://lodzkifutbol.pl/">lodzkifutbol.pl</a></td>	
	</tr>
	<tr>
		<td><a href="http://ozpnsieradz.pl/">OZPN Sieradz</a></td>	
	</tr>
	<tr>
		<td><a href="https://pl-pl.facebook.com/pages/LKS-Baszta-Boles%C5%82awiec/430090143710393">Baszta Bolesławiec</a></td>
	</tr>
	<tr>
		<td><a href="http://www.lksslowian.futbolowo.pl">Słowian Dworszowice</a></td>
		
	</tr>
	<tr>
		<td><a href="prosnawyszanow123.futbolowo.pl">Prosna Wyszanów</a></td>
	</tr>
	<tr>
		<td><a href="http://www.dubidze.gks.com.pl">GKS Dubidze</a></td>
	</tr>
	<tr>
		<td><a href="http://lksmaslowice.futbolowo.pl/">LKS Masłowice</a></td>
	</tr>
	<tr>
		<td><a href="http://www.spartamokrsko.futbolowo.pl/">Sparta Mokrsko</a></td>
	</tr>
	<tr>
		<td><a href="http://www.solenlaszew.ubf.pl">Solen Łaszew</a></td>
	</tr>
	<tr>
		<td><a href="http://victoria-skomlin.futbolowo.pl/">Victoria Skomlin</a></td>
	</tr>
	<tr>
		<td><a href="http://lkswierzchlas.futbolowo.pl/">LKS Wierzchlas</a></td>
	</tr>
	<tr>
		<td><a href="http://gks-siemkowice.futbolowo.pl/">GKS Siemkowice</a></td>
	</tr>
	<tr>
		<td><a href="http://kkskurow.futbolowo.pl/">KKS Kurów</a></td>
	</tr>
	<tr>
		<td><a href="http://gksczastary.futbolowo.pl/">GKS Czastary</a></td>
	</tr>
	<tr>
		<td><a href="http://jagalututow.futbolowo.pl/">Jaga Lututów</a></td>
	</tr>
	<tr>
		<td><a href="http://www.chks.chotow.pl/">ChKS Chotów</a></td>
	</tr>
	
</table>
</div>
<?php

echo '<div id="on"></div>';
echo "<!-- stat.4u.pl NiE KaSoWaC --> 
<a target=_top href=\"http://stat.4u.pl/?marcinrekle\" title=\"statystyki stron WWW\"><img alt=\"stat4u\" src=\"http://adstat.4u.pl/s4u.gif\" border=\"0\"></a> 
<script language=\"JavaScript\" type=\"text/javascript\"> 
<!-- 
function s4upl() { return \"&amp;r=er\";} 
//--> 
</script> 
<script language=\"JavaScript\" type=\"text/javascript\" src=\"http://adstat.4u.pl/s.js?marcinrekle\"></script> 
<script language=\"JavaScript\" type=\"text/javascript\"> 
<!-- 
s4uext=s4upl(); 
document.write('<img alt=\"stat4u\" src=\"http://stat.4u.pl/cgi-bin/s.cgi?i=marcinrekle'+s4uext+'\" width=\"1\" height=\"1\">') 
//--> 
</script> 
<noscript><img alt=\"stat4u\" src=\"http://stat.4u.pl/cgi-bin/s.cgi?i=marcinrekle&amp;r=ns\" width=\"1\" height=\"1\"></noscript> 
<!-- stat.4u.pl KoNiEc -->";
mysql_close();
?>

</div>