<?php
include $_SESSION['adres'].'polacz.php';
include $_SESSION['adres'].'funkcje.php';
$sezon="2012/13";
$sezon="mecze$_GET[sezon]";
$sql=mysql_fetch_array(mysql_query("SELECT mecze . * , d1.nazwa AS gosp, d2.nazwa AS gosc
	FROM $sezon AS mecze INNER JOIN druzyny AS d1 ON mecze.id_h = d1.id INNER JOIN druzyny 
	AS d2 ON mecze.id_a = d2.id"));
echo '<div class="terminarz">'."\n".'<div class="t_tytul">Terminarz sezonu '.$sezon.' 1-ej grupy B Klasy </div>'."\n";
$dane=mysql_query("SELECT mecze . * , d1.nazwa AS gosp, d2.nazwa AS gosc
	FROM $sezon AS mecze INNER JOIN druzyny AS d1 ON mecze.id_h = d1.id INNER JOIN druzyny 
	AS d2 ON mecze.id_a = d2.id");
$kolejka=1;
echo '<div class="t_kolejka">'."\n".
        '<div class="t_kolejka_t">1 Kolejka </div>'."\n"."<table>";
while ($r=mysql_fetch_assoc($dane)) {
	//var_dump($r);
	if ($kolejka<>$r['nr_k']) {
		echo '</table></div><div class="t_kolejka">'."\n".
        '<div class="t_kolejka_t">'.$r['nr_k'].' Kolejka </div>'."\n";
		echo "<table>";
		$kolejka=$r['nr_k'];
	}
	echo "<tr><td>".date("Y-m-d H:i",strtotime($r['data']))."</td><td>$r[gosp]</td></td><td>-</td></td><td>$r[gosc]</td><td>$r[wynik]</td></tr>";
	
}
echo "</table>";
echo "</div></div>";
?>
