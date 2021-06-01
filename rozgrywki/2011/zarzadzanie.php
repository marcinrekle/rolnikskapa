<?php
include '../../polacz.php';
include '../../funkcje.php';
$sezon="2011/12";
echo "\n";
$dane=mysql_query("SELECT * FROM mecze11_12");
$kolejka=1;
echo '<div class="t_kolejka">'."\n".
        '<div class="t_kolejka_t">1 Kolejka </div>'."\n";
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
	<div class="t_gosc"> '.pobierz("nazwa", "druzyny","id",$r[5]).'</div>'."\n".'<div "class="t_wynik">';
	if ($r[6]==" "or $r[6]=="") {
		echo '<a id="m'.$r[0].'" href="javascript:wyswietl_edycja_meczu('.$r[0].')">Edytuj</a>';
	}else echo '<a id="m'.$r[0].'" href="javascript:wyswietl_edycja_meczu('.$r[0].')">'.$r[6].'</a>';
	if ($r[7]==1) echo'<small>(wo)</small>';
	echo'</div>'."\n";
	echo '<div id="'.$r[0].'" class="ukryta">
	<FORM id="f'.$r[0].'"><SELECT id="gosp" name="gosp">';
	echo '<option value=" "> </option>';
	$w=explode(":",$r[6]);
	for ($i = 0; $i <=30; $i++) {
	if ($i==$w[0]) {
		echo '<option selected value="'.$i.'">'.$i.'</option>'."\n";
	}else
	echo '<option value="'.$i.'">'.$i.'</option>'."\n";
}
echo '</SELECT><SELECT id="gosc" name="gosc">';
echo '<option value=" "> </option>';
for ($i = 0; $i <= 30; $i++) {
	if ($i==$w[1]) {
		echo '<option selected>'.$i.'</option>'."\n";
	}
	echo '<option value="'.$i.'">'.$i.'</option>'."\n";
}
echo '</SELECT>';
	echo '<a href="javascript:wyswietl_cos('.$r[0].')">Zmień</a></form>
	</div>'."\n".'</div>';
}
echo "</div>";
?>