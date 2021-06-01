<!--HEADER-->
<?php
include("../head.php");
?>
<!--/HEADER-->

<DIV id="naglowek"><?php
include($_SESSION['adres']."naglowek.php");
?></DIV>

<div id="lewy_bok"><?php
include($_SESSION['adres']."lewy.php");
?></div>

<div id="tresc">
<div class="typer terminarz">
<div class="tyt">Typer</div>

<?php
include $_SESSION[adres].'polacz.php';
include $_SESSION[adres].'funkcje.php';
$tabela = $_GET[sezon];//sezon do nazwy tabeli typerow i typow uzytkownikow 
$sezon="2012/13";
$user_id=pobierz("id", "uzytkownik", "login", "'$_SESSION[nick]'");//id zalogowanego uzytkownika
echo '<h1>Tabela Typerów</h1><br>';
echo '<table>'."\n".'<tr><th>lp</th><th>Typer</th><th>Pkt</th><th>Traf. wyniki</th>
	<th>Traf. rezultaty</th><th>Typ. mecze</th></tr>'."\n";
	echo '<br><h4> Najlepszy typer otrzyma w nagrodę aparat cyfrowy</h4>';	
$dane=mysql_query("SELECT tab_typerow$tabela . * , uzytkownik.login AS user FROM tab_typerow$tabela INNER JOIN uzytkownik ON tab_typerow$tabela.id_uz = uzytkownik.id ORDER BY pkt DESC LIMIT 0 , 30");
$m=0;//zerowanie miejsca typera
while ($r=mysql_fetch_array($dane)) {
	$m+=1;
	//$uz=pobierz("login", "uzytkownik", "id", "'".$r[1]."'");
	echo '<tr><td style="text-align:left">'.$m.'</td><td style="text-align:left">'.
	$r['user'].'</td><td>'.$r[pkt].'</td><td>'.
	$r[tr_w].'</td><td>'.$r[tr_r].'</td><td>'.$r[typ_m].'</td></tr>';
} 
echo '</table><br><br>';
if($_COOKIE['zalogowany']=="no") pokaz_typy($tabela,$user_id); else
echo 'Typer jest dostępny tylko dla zalogowanych użytkowników. Jeżeli nie posiadasz 
jeszcze konta w serwisie to <a href="'.$_SESSION['adres'].'rejestracja.php">
zarejestruj się</a>.<br><br>';
function pokaz_typy($tabela,$user_id){
	echo '<h6> Aby zatwierdzić wynik należy wcisnąć "zielony" przycisk,"czarnym" zamykamy panel</h6>';
$dane=mysql_query("SELECT mecze. * , d1.nazwa AS gosp, d2.nazwa AS gosc,typer.wynik AS typ
FROM mecze$tabela AS mecze
INNER JOIN druzyny AS d1 ON mecze.id_h = d1.id
INNER JOIN druzyny AS d2 ON mecze.id_a = d2.id
LEFT OUTER JOIN typer$tabela AS typer ON typer.id_m = mecze.id
AND typer.id_uz = $user_id");
$kolejka=1;
echo '<div class="t_mecz"><div class="typ_data">Data</div><div class="typ_godz">Godz</div>
<div class="typ_spotkanie">Mecz</div><div class="typ_typ">Wyn</div>
<div class="typ_wynik">Typ</div><div class="typ_pkt">Pkt</div></div>';
echo  '<div class="t_kolejka"><div class="t_kolejka_t">1 Kolejka </div>'."\n"."<table id=\"1\">";
while ($r=mysql_fetch_array($dane)) {
	if($r[id_h]==17 OR $r[id_a]==17) continue;
	$data_m=strtotime($r['data']);
	//$typ=mysql_fetch_array(mysql_query("SELECT * FROM typer1213 WHERE id_m='".$r[0]."' AND id_uz='$uz'"));
	/**if ($kolejka<>$r[nr_k]) {
		echo '</table><div class="t_kolejka_t">'.$r[id_k]." Kolejka</div><table id=\"$r[nr_k]\""."\n";
		$kolejka=int($r[nr_k]);
	}
	echo
	'<div id="'.$r[0].'" class="t_mecz"><div class="typ_data">'.data($r[2], "-", ".").'</div>'."\n".
	'<div class="typ_godz">'.godz($r[3]).'</div>'."\n".
	'<div class="typ_spotkanie">'.pobierz("nazwa", "druzyny","id",$r[4]).
	' - '.pobierz("nazwa", "druzyny","id",$r[5]).'</div>'."\n";
	**/
	//$d=explode("-",$r[2]);//data
	//$g=explode(":",$r[3]);//godzina
	//$c_m=make_time($d[0], $d[1], $d[2], $g[0], $g[1], $g[2]);
	$typTxt="";
	$pkt="";
	if($data_m<time()&&$r[typ]==NULL){
		$typTxt="NT";
	}elseif ($data_m<time()&&$r[typ]!=NULL && $r[wynik]!=NULL){
		$typTxt="$r[typ] ";
		if($r[typ]==$r[wynik])$pkt=11; else{
			
			$t=explode(":",$r[typ]);
			$w=explode(":",$r[wynik]);
			if(($t[0]>$t[1]&&$w[0]>$w[1])||($t[0]==$t[1]&&$w[0]==$w[1])||($t[0]<$t[1]&&$w[0]<$w[1]))$pkt=1;else $pkt=0;
		}
	}elseif ($data_m>time()&&$r[typ]==NULL)$typTxt="<a href=\"$data_m\">typuj</a>";else{
		$typTxt="<a href=\"$data_m\">$r[typ]</a>";
	}
	/**
	if ($data_m>time()&& $r[typ]<>NULL){
		$cmt='<a href="'.$data_m.'">'.$r[typ].'</a>';
	}
	elseif ($data_m<time()&& $r[typ]<>NULL) $cmt=$r[typ];elseif ($data_m>time()&& $r[typ]==NULL)
	$cmt='<a href="'.$data_m.'" >typuj</a>';elseif ($data_m<time()&& $r[typ]==NULL) $cmt='NT';
	if($data_m>time()){
		echo '<div class="typ_typ typa" >'.$cmt.'</div>'."\n";
	}else{
	echo '<div class="typ_typ">'.$cmt.'</div>'."\n".
	'<div class="typ_wynik">'.$r[6].' </div>'."\n";
	$t1=explode(":",$typ[3]);
	$w1=explode(":",$r[6]);
	if ((empty($typ)&&empty($r[6])) || (empty($typ) || empty($r[6]))) $pkt=" ";
	elseif ($typ[3]==$r[6]) $pkt=11;
	elseif ((($t1[0]>$t1[1])&&($w1[0]>$w1[1])) || (($t1[0]<$t1[1])&&($w1[0]<$w1[1])) || (($t1[0]==$t1[1])&&($w1[0]==$w1[1]))) $pkt=1;else $pkt=0;
	
	**/
	if ($kolejka<>$r['nr_k']) {
		echo '</table></div><div class="t_kolejka">'."\n".
				'<div class="t_kolejka_t">'.$r['nr_k'].' Kolejka </div>'."\n";
		echo "<table>";
		$kolejka=$r['nr_k'];
	}
	echo "<tr id_m=\"$r[id]\"><td>".date("Y-m-d H:i",$data_m)."</td><td>$r[gosp]</td></td><td>-</td></td><td>$r[gosc]</td><td>$r[wynik]</td><td>$typTxt</td><td>$pkt</td></tr>";
	//echo '<div class="typ_pkt">'.$pkt.'</div>'."\n";
	//echo '</div>'."\n";
}//while
echo "</table></div>";
}//pokaz_typy()
?>
<div id="typer_form" style="top:-50px;">
<input type="text" id="gosp">:<input type="text" id="gosc">
<div class="im" title="typuj" id="typ_typuj"></div><div class="im" title="typuj" id="typ_usun"></div>
</div>
<div id="loading" class="im" style=""><img src="../../../PLIKI/loading.gif" /></div>
</div>
</div>

<div id="prawy_bok"><?php

include("$_SESSION[adres]prawy.php");
?></div>

<!--FOOTER-->
</BODY>
</HTML>
<!--/FOOTER-->
