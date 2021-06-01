<?php
include $_SESSION['adres'].'polacz.php';
include $_SESSION['adres'].'funkcje.php';
$sezon="2012/13";
echo '<div class="terminarz">'."\n".'<div class="t_tytul">Terminarz sezonu '.$sezon.' 1-ej grupy B Klasy </div>'."\n";
$dane=mysql_query("SELECT * FROM mecze1213");
$kolejka=1;
echo '<div class="t_kolejka">'."\n".
        '<div class="t_kolejka_t">1 Kolejka </div>'."\n";
$dane=mysql_query("SELECT * FROM mecze1213");
while ($r=mysql_fetch_row($dane)) {
	if ($kolejka<>$r[1]) {
		echo '</div><div class="t_kolejka">'."\n".
        '<div class="t_kolejka_t">'.$r[1].' Kolejka </div>'."\n";
		$kolejka=$r[1];
	}
	echo '<div class="t_mecz">'."\n".
	'<div class="t_data">'.data($r[2], "-", " ").'</div>'."\n".
	'<div class="t_godz">'.godz($r[3]).'</div>'."\n".
	'<div class="t_gosp">'.pobierz("nazwa", "druzyny","id",$r[4]).'</div>'."\n".
	'<div class="t_kreska"> - </div>'."\n".'
	<div class="t_gosc"> '.pobierz("nazwa", "druzyny","id",$r[5]).'</div>'."\n".'
	<div class="t_wynik">'.$r[6];
	if ($r[7]==1) echo'<small>(wo)</small>';
	echo'</div>'."\n".'</div>';
}
echo "</div></div>";
?>
