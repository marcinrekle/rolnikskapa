<!--HEADER-->
<?php
include("../../../head.php");
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
echo '<h1>Tabela Typerów</h1><br>';
echo '<table>'."\n".'<tr><th>lp</th><th>Typer</th><th>Pkt</th><th>Traf. wyniki</th>
	<th>Traf. rezultaty</th><th>Typ. mecze</th></tr>'."\n";
	echo '<br><h4> Najlepszy typer otrzyma w nagrodę aparat cyfrowy</h4>';	
$dane=mysql_query("SELECT * FROM tab_typerow1112 ORDER by pkt DESC");
$m=0;
while ($r=mysql_fetch_row($dane)) {
	$m+=1;
	$uz=pobierz("login", "uzytkownik", "id", "'".$r[1]."'");
	echo '<tr><td style="text-align:left">'.$m.'</td><td style="text-align:left">'.
	$uz.'</td><td>'.$r[2].'</td><td>'.
	$r[3].'</td><td>'.$r[4].'</td><td>'.$r[5].'</td></tr>';
} 
echo '</table><br><br>';
if($_COOKIE['zalogowany']=="no") pokaz_typy(); else
echo 'Typer jest dostępny tylko dla zalogowanych użytkowników. Jeżeli nie posiadasz 
jeszcze konta w serwisie to <a href="'.$_SESSION['adres'].'rejestracja.php">
zarejestruj się</a>.<br><br>';
function pokaz_typy(){
	echo '<h6> Aby zatwierdzić wynik należy wcisnąć "zielony" przycisk,"czarnym" zamykamy panel</h6>';
$dane=mysql_query("SELECT * FROM mecze11_12");
$kolejka=1;
echo '<div class="t_kolejka_t"><div class="typ_data">Data</div><div class="typ_godz">Godz</div>
<div class="typ_spotkanie">Mecz</div><div class="typ_typ">Typ</div>
<div class="typ_wynik">Wynik</div><div class="typ_pkt">Pkt</div></div>';
echo  '<div class="t_kolejka"><div class="t_kolejka_t">1 Kolejka </div>'."\n";
while ($r=mysql_fetch_row($dane)) {
	if($r[4]==17 OR $r[5]==17) continue;
	$uz=pobierz("id", "uzytkownik", "login", "'$_SESSION[nick]'");
	$typ=mysql_fetch_array(mysql_query("SELECT * FROM typer1112 WHERE id_m='".$r[0]."' AND id_uz='$uz'"));
	if ($kolejka<>$r[1]) {
		echo '</div><div class="t_kolejka"><div class="t_kolejka_t">'.$r[1].' Kolejka</div>'."\n";
		$kolejka=$r[1];
	}
	echo
	'<div id="'.$r[0].'" class="t_mecz"><div class="typ_data">'.data($r[2], "-", ".").'</div>'."\n".
	'<div class="typ_godz">'.godz($r[3]).'</div>'."\n".
	'<div class="typ_spotkanie">'.pobierz("nazwa", "druzyny","id",$r[4]).
	' - '.pobierz("nazwa", "druzyny","id",$r[5]).'</div>'."\n";
	$d=explode("-",$r[2]);//data
	$g=explode(":",$r[3]);//godzina
	$c_m=make_time($d[0], $d[1], $d[2], $g[0], $g[1], $g[2]);
	if ($c_m>time()&& $typ[3]<>NULL){
		$cmt='<a href="javascript:pokaz_typuj('.$r[0].')">'.$typ[3].'</a>';
	}
	elseif ($c_m<time()&& $typ[3]<>NULL) $cmt=$typ[3];elseif ($c_m>time()&& $typ[3]==NULL)
	$cmt='<a href="javascript:pokaz_typuj('.$r[0].')" >typuj</a>';elseif ($c_m<time()&& $typ[3]==NULL) $cmt='NT';
	echo '<div class="typ_typ">'.$cmt.'</div>'."\n".
	'<div class="typ_wynik">'.$r[6].' </div>'."\n";
	$t1=explode(":",$typ[3]);
	$w1=explode(":",$r[6]);
	if ((empty($typ)&&empty($r[6])) || (empty($typ) || empty($r[6]))) $pkt=" ";
	elseif ($typ[3]==$r[6]) $pkt=11;
	elseif ((($t1[0]>$t1[1])&&($w1[0]>$w1[1])) || (($t1[0]<$t1[1])&&($w1[0]<$w1[1])) || (($t1[0]==$t1[1])&&($w1[0]==$w1[1]))) $pkt=1;else $pkt=0;
	echo '<div class="typ_pkt">'.$pkt.'</div>'."\n";
	
	echo '</div>'."\n";
}//while
echo "</div>";
}//pokaz_typy()
?></div>
</div>
</div>

<div id="prawy_bok"><?php
include($_SESSION['adres']."prawy.php");
?></div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
